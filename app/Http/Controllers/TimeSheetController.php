<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarIdDate;
use App\Http\Requests\DateSpan;
use App\Http\Requests\Event\EventRequest;
use App\Http\Requests\EventIdRequest;
use App\Repositories\ContractRepository;
use App\Repositories\Interfaces\MotorPoolRepositoryInterface;
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
    private $request,$motorPoolRep,$timeSheetServ;

    public function __construct(
        Request $request,
        MotorPoolRepositoryInterface $motorPoolRep,
        TimeSheetService $timeSheetServ
    ){
        $this->request=$request;
        $this->motorPoolRep=$motorPoolRep;
        $this->timeSheetServ=$timeSheetServ;
    }


    public function show()
    {
        $validate=$this->request->validate(['currentDate'=>'date','subDays'=>'','addDays'=>'']);

        if (isset($validate['currentDate'])){
            $currentDate = CarbonImmutable::create($validate['currentDate']);
        } else {
            $currentDate = CarbonImmutable::today();
        }
        if (isset($validate['subDays'])){
            $subDays = $validate['subDays'];
        } else {
            $subDays = 12;
        }
        if (isset($validate['addDays'])){
            $addDays = $validate['addDays'];
        } else {
            $addDays = 7;
        }

        $dateFrom = $currentDate->subDays($subDays);
        $dateTo = $currentDate->addDays($addDays);
        $periodDate = CarbonPeriod::create($dateFrom,$dateTo);
        $accuracy = 4;
        $timeSheetArray = $this->timeSheetServ->getCarsTimeSheets($periodDate,$accuracy);
        $motorPoolObj=$this->motorPoolRep->getCars();
        return view('timeSheet.list', ['timeSheetArray' => $timeSheetArray,
                                            'periodDate' => $periodDate,
                                            'currentDate'=> $currentDate,
                                            'motorPoolObj'=>$motorPoolObj,
                                            'accuracy'=>$accuracy,
                                            'subDays'=>$subDays,
                                            'addDays'=>$addDays]);
    }



    public function addEvent(RentEventService $rentEventServ,ContractRepository $contractRep,EventRequest $eventReq)
    {
//        $validate=$this->request->validate(['carId'=>'',
//            'date'=>'',
//            'contractId' => ''
//        ]);
//        $carId = $validate['carId'] ??0;
//        $selectDate = $validate['date'] ?? '';
//        $contractId = $validate['contractId'] ??0;
        $carObj = $this->motorPoolRep->getCar($eventReq->get('carId'));

        $contractObj = $contractRep->getContract($eventReq->get('contractId'));


        $rentEventsObj=$rentEventServ->getRentEvents();
        return view('rentEvent.addEvent',['carObj' => $carObj,
                                               'dateTime' => $eventReq->get('date'),
                                               'contractObj' => $contractObj,
                                               'rentEvents' => $rentEventsObj]);
    }


    public function infoDialog(CarIdDate $carIdDateRequest,RentEventRepository $rentEventRep)
    {
        $carIdDate = $carIdDateRequest->validated();
        $rentEventObjs = $rentEventRep->getEvents();

        $datePeriod = $carIdDateRequest->getCarbonPeriodDay();
        $carObj = $this->motorPoolRep->getCar($carIdDate['carId']);

        $timeSheetsObj = $this->timeSheetServ->getCarTimeSheets($carObj,$datePeriod);

        return view('dialog.TimeSheet.infoTimeSheet',[
            'timeSheets' => $timeSheetsObj,
            'carIdDate' => $carIdDate,
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
        $rentEvents=$rentEventRep->getEvents();
        return view('timeSheet.events',[
            'eventObj' => $eventObj,
            'rentEvents' => $rentEvents,
            'periodDate' => $periodDate,
        ]);
    }


    public function listEvents(DateSpan $dateSpan)
    {
        $periodDate = $dateSpan->getCarbonPeriod();
        $eventsArray = $this->timeSheetServ->getAllTimeSheets($periodDate);
        //$eventsArray->dd();
        return view('timeSheet.allEvents',[
            'eventsArray' => $eventsArray,
            'periodDate' => $periodDate,
        ]);
    }

}
