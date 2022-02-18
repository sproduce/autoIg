<?php

namespace App\Http\Controllers;

use App\Http\Requests\DateSpan;
use App\Repositories\ContractRepository;
use App\Repositories\Interfaces\MotorPoolRepositoryInterface;
use App\Services\RentEventService;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use App\Services\TimeSheetService;


class TimeSheetController extends Controller
{
    private $request,$motorPoolRep,$timeSheetServ;

    public function __construct(Request $request,MotorPoolRepositoryInterface $motorPoolRep,TimeSheetService $timeSheetServ)
    {
        $this->request=$request;
        $this->motorPoolRep=$motorPoolRep;
        $this->timeSheetServ=$timeSheetServ;
    }


    public function show()
    {
        $validate=$this->request->validate(['currentDate'=>'date','subDays'=>'','addDays'=>'']);

        if (isset($validate['currentDate'])){
            $currentDate=CarbonImmutable::create($validate['currentDate']);
        } else {
            $currentDate = CarbonImmutable::today();
        }
        if (isset($validate['subDays'])){
            $subDays=$validate['subDays'];
        } else {
            $subDays=12;
        }
        if (isset($validate['addDays'])){
            $addDays=$validate['addDays'];
        } else {
            $addDays=7;
        }

        $dateFrom=$currentDate->subDays($subDays);
        $dateTo=$currentDate->addDays($addDays);
        $periodDate=CarbonPeriod::create($dateFrom,$dateTo);
        $accuracy=4;
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



    public function addEvent(RentEventService $rentEventServ,ContractRepository $contractRep)
    {
        $validate=$this->request->validate(['carId'=>'',
            'date'=>'',
            'contractId' => ''
        ]);
        $carId=$validate['carId'] ??0;
        $selectDate=$validate['date'] ?? '';
        $contractId=$validate['contractId'] ??0;
        $carObj=$this->motorPoolRep->getCar($carId);

        $contractObj=$contractRep->getContract($contractId);
        $date=new Carbon($selectDate);
        $rentEventsObj=$rentEventServ->getRentEvents();
        return view('rentEvent.addEvent',['carObj' => $carObj,
                                               'dateTime' => $date,
                                               'contractObj' => $contractObj,
                                               'rentEvents'=>$rentEventsObj]);
    }

    public function infoDialog()
    {
        $validate=$this->request->validate(['carId'=>'required|integer',
            'date'=>'required'
        ]);
        $datePeriod=new CarbonPeriod($validate['date']);
        $datePeriod->setEndDate($datePeriod->getStartDate());

        $carObj=$this->motorPoolRep->getCar($validate['carId']);
        $timeSheetsObj=$this->timeSheetServ->getCarTimeSheets($carObj,$datePeriod);
        return view('dialog.TimeSheet.infoTimeSheet',['timeSheets'=>$timeSheetsObj]);
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



    public function showCarTimeSheet(DateSpan $dateSpan)
    {
        $dateFromTo=$dateSpan->validated();
        $periodDate=new CarbonPeriod($dateFromTo['fromDate'],$dateFromTo['toDate']);
        $validate=$this->request->validate(['carId'=>'required|integer']);
        $carObj=$this->motorPoolRep->getCar($validate['carId']);
        $timeSheetsObj=$this->timeSheetServ->getCarTimeSheets($carObj,$periodDate);

        $timeSheetSpan=$this->timeSheetServ->getCarSpanTimeSheets($carObj,$periodDate);
        //$timeSheetSpan->dd();
        return view('timeSheet.car',['carObj' => $carObj,'periodDate' => $periodDate,
            'timeSheetsObj'=>$timeSheetsObj,
            'timeSheetSpan'=>$timeSheetSpan
            ]);
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


}
