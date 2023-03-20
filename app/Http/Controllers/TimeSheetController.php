<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarIdDate;
use App\Http\Requests\DateSpan;
use App\Http\Requests\Event\EventRequest;
use App\Http\Requests\EventIdRequest;
use App\Http\Requests\Filters;
use App\Repositories\ContractRepository;
use App\Repositories\Interfaces\CarGroupRepositoryInterface;
use App\Repositories\Interfaces\ContractRepositoryInterface;
use App\Repositories\Interfaces\MotorPoolRepositoryInterface;
use App\Repositories\Interfaces\PaymentRepositoryInterface;
use App\Repositories\Interfaces\RentEventRepositoryInterface;
use App\Repositories\RentEventRepository;
use App\Repositories\TimeSheetRepository;
use App\Services\RentEventService;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use App\Services\TimeSheetService;



class TimeSheetController extends Controller
{
    private $request,$motorPoolRep,$timeSheetServ,$carGroupRep;

    public function __construct(
        Request $request,
        MotorPoolRepositoryInterface $motorPoolRep,
        TimeSheetService $timeSheetServ,
        CarGroupRepositoryInterface $carGroupRep
    ){
        $this->request = $request;
        $this->motorPoolRep = $motorPoolRep;
        $this->timeSheetServ = $timeSheetServ;
        $this->carGroupRep = $carGroupRep;
    }


    public function show(Filters\TimeSheetRequest $timeSheetRequest)
    {
        $currentDate = $timeSheetRequest->get('currentDate');
        $subDays = $timeSheetRequest->get('subDays');
        $addDays = $timeSheetRequest->get('addDays');
        $carGroupId = $timeSheetRequest->get('carGroupId');

        $dateFrom = $currentDate->subDays($subDays);
        $dateTo = $currentDate->addDays($subDays);

        $periodDate = CarbonPeriod::create($dateFrom,$dateTo);
        $accuracy = 4;
        $timeSheetArray = $this->timeSheetServ->getCarsTimeSheets($periodDate,$accuracy);

        $motorPoolObj = $this->timeSheetServ->getActualCarsByGroup($periodDate,$carGroupId);
        //$motorPoolObj =

        $carGroupObj = $this->carGroupRep->getCarGroups();

        return view('timeSheet.list', [
            'timeSheetArray' => $timeSheetArray,
            'periodDate' => $periodDate,
            'currentDate' => $currentDate,
            'motorPoolObj' => $motorPoolObj,
            'carGroupObj' => $carGroupObj,
            'accuracy' => $accuracy,
            'subDays' => $subDays,
            'addDays' => $addDays,
            'carGroupId' => $carGroupId,
        ]);
    }



    public function addEvent($eventId=null,RentEventService $rentEventServ,ContractRepository $contractRep,EventRequest $eventReq)
    {

        $carObj = $this->motorPoolRep->getCar($eventReq->get('carId'));

        
        $contractObj = $contractRep->getContract($eventReq->get('contractId'));
        $parentObj = $this->timeSheetServ->getTimeSheetInfo($eventReq->get('parentId'));

        $rentEventsObj = $rentEventServ->getRentEvents();
        return view('rentEvent.addEvent',[
            'carObj' => $carObj,
            'dateTime' => $eventReq->get('date'),
            'contractObj' => $contractObj,
            'rentEvents' => $rentEventsObj,
            'parentObj' => $parentObj,
        ]);
    }


    public function infoDialog(CarIdDate $carIdDateRequest,RentEventRepository $rentEventRep,ContractRepositoryInterface $contractRepObj,PaymentRepositoryInterface $paymentRepObj)
    {
        $carIdDate = $carIdDateRequest->validated();
        $rentEventObjs = $rentEventRep->getEvents();

        $datePeriod = $carIdDateRequest->getCarbonPeriodDay();
        $carObj = $this->motorPoolRep->getCar($carIdDate['carId']);

        $timeSheetsObj = $this->timeSheetServ->getCarTimeSheets($carObj,$datePeriod,$contractRepObj);


        return view('dialog.TimeSheet.infoTimeSheet',[
            'timeSheets' => $timeSheetsObj,
            'carIdDate' => $carIdDate,
            'carObj' => $carObj,
            'rentEventObjs' => $rentEventObjs,
            ]);
    }


    public function editEventDialog()
    {
        $validate=$this->request->validate(['timeSheetId'=>'required|integer']);
        $timeSheetsObj=$this->timeSheetServ->getTimeSheetInfo($validate['timeSheetId']);

        return view('dialog.TimeSheet.editEvent',['timeSheet'=>$timeSheetsObj]);
    }







    public function add()
    {
        $this->timeSheetServ->addEvent();
        return  redirect()->back();
    }


    public function showContractTimeSheet(ContractRepository $contractRep)
    {
        $contractIdValidate=$this->request->validate(['contractId'=>'required|integer']);
        $contractObj=$contractRep->getContract($contractIdValidate['contractId']);

        $timeSheetsObj=$this->timeSheetServ->getContractTimeSheets($contractIdValidate['contractId']);
        return view('timeSheet.contract',['timeSheetsObj' =>  $timeSheetsObj,
                                                'contractObj' => $contractObj]);
    }



    public function showCarTimeSheet(CarIdDate $carIdDate)
    {

        $carIdDate->validated();
        //$periodDate = $dateSpan->getCarbonPeriod();
        //$periodDate=new CarbonPeriod($dateFromTo['fromDate'],$dateFromTo['toDate']);
        $periodDate = $carIdDate->getCarbonPeriodMonth();
        $carObj = $this->motorPoolRep->getCar($carIdDate->getCarId());
        $timeSheetsObj = $this->timeSheetServ->getCarTimeSheets($carObj,$periodDate);

        $timeSheetSpan  =$this->timeSheetServ->getCarSpanTimeSheets($carObj,$periodDate);

        return view('timeSheet.car',['carObj' => $carObj,'periodDate' => $periodDate,
            'timeSheetsObj'=>$timeSheetsObj,
            'timeSheetSpan'=>$timeSheetSpan
            ]);
    }

    public function showDaysTimeSheet(DateSpan $dateSpan)
    {
        $dateFromTo=$dateSpan->validated();
        $periodDate=new CarbonPeriod($dateFromTo['fromDate'],$dateFromTo['toDate']);

        return view('timeSheet.days',['periodDate' => $periodDate]);
    }



    public function updateTimeSheet()
    {
        $validate=$this->request->validate(['timeSheetId'=>'required|integer',
            'date'=>'',
            'time'=>'',
            'sum'=>'',
            'mileage'=>'',
            'duration'=>'']);
        $this->timeSheetServ->updateTimeSheet($validate);
        return  redirect()->back();

    }

    public function carContractDialog(ContractRepository $contractRep,TimeSheetRepository $timeSheetRep)
    {
        $validate=$this->request->validate(['timeSheetId'=>'required|integer']);
        $timeSheetObj=$timeSheetRep->getTimeSheet($validate['timeSheetId']);
        $contractsObj=$contractRep->getContractsByCarId($timeSheetObj->carId);

        return view('dialog.TimeSheet.carContracts',['contractsObj' => $contractsObj,
                                                         'timeSheetObj' => $timeSheetObj]);
    }


    public function addContractTimeSheet()
    {
        $validate=$this->request->validate(['timeSheetId'=>'required|integer',
                                            'contractId' => 'required|integer']);
        $this->timeSheetServ->addTimeSheetContract($validate['timeSheetId'],$validate['contractId']);
        //var_dump($validate);
    }


    public function listByEvent(RentEventRepositoryInterface  $rentEventRep,DateSpan $dateSpan,EventIdRequest $eventIdrequest)
    {

        $periodDate = $dateSpan->getCarbonPeriod();
        $eventId = $eventIdrequest->getEventId();
        $eventObj = $rentEventRep->getEvent($eventId);
        $rentEvents = $rentEventRep->getEvents();
        return view('timeSheet.events',[
            'eventObj' => $eventObj,
            'rentEvents' => $rentEvents,
            'periodDate' => $periodDate,
        ]);
    }


    public function listEvents(DateSpan $dateSpan,RentEventRepositoryInterface  $rentEventRep,Filters\EventListRequest $eventListRequest)
    {
        $eventListFilter = collect([
            'eventId' => $eventListRequest->get('eventId'),
            'carId' => $eventListRequest->get('carId'),
            'contractId' => $eventListRequest->get('contractId'),
            'delete'=> $eventListRequest->get('delete'),
            ]);
        
        $periodDate = $dateSpan->getCarbonPeriod();
        $carbonDate =  Carbon::create($periodDate->getStartDate());
        $periodDate->setStartDate($carbonDate->addWeeks(2));
        
        $eventsArray = $this->timeSheetServ->getAllTimeSheets($eventListFilter,$periodDate);

        $carsObj = $this->motorPoolRep->getCars();
        $rentEvents = $rentEventRep->getEvents();

        return view('timeSheet.allEvents',[
            'filterObj' => $eventListRequest,
            'carsObj' => $carsObj,
            'eventsObj' => $rentEvents,
            'eventsArray' => $eventsArray,
            'periodDate' => $periodDate,
        ]);
    }


    public function getLastRecord($eventId,$carId=null,ContractRepositoryInterface $contractRep)
    {
        $timeSheetObj = $this->timeSheetServ->getLastRecord($eventId,$carId,$contractRep);
        return response()->json($timeSheetObj);
    }


}
