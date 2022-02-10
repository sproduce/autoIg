<?php

namespace App\Http\Controllers;

use App\Http\Requests\DateSpan;
use App\Repositories\Interfaces\MotorPoolRepositoryInterface;
use App\Services\RentEventService;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use App\Services\TimeSheetService;


class TimeSheetController extends Controller
{
    private $request,$motorPoolRep;

    public function __construct(Request $request,MotorPoolRepositoryInterface $motorPoolRep)
    {
        $this->request=$request;
        $this->motorPoolRep=$motorPoolRep;
    }


    public function show(TimeSheetService $timeSheetServ)
    {
        $validate=$this->request->validate(['currentDate'=>'date']);

        if (isset($validate['currentDate'])){
            $currentDate=CarbonImmutable::create($validate['currentDate']);
        } else {
            $currentDate = CarbonImmutable::today();
        }
        $dateFrom=$currentDate->subDays(12);
        $dateTo=$currentDate->addDays(8);
        $periodDate=CarbonPeriod::create($dateFrom,$dateTo);

        $timeSheetArray = $timeSheetServ->getCarsTimeSheets($periodDate);
        $motorPoolObj=$this->motorPoolRep->getCars();
        return view('timeSheet.list', ['timeSheetArray' => $timeSheetArray, 'periodDate' => $periodDate,'currentDate'=> $currentDate,'motorPoolObj'=>$motorPoolObj]);
    }



    public function addEvent(RentEventService $rentEventServ)
    {
        $validate=$this->request->validate(['carId'=>'',
            'date'=>''
        ]);
        $carId=$validate['carId'] ??0;
        $selectDate=$validate['date'] ?? '';
        $carObj=$this->motorPoolRep->getCar($carId);
        $date=new Carbon($selectDate);
        $rentEventsObj=$rentEventServ->getRentEvents();
        return view('rentEvent.addEvent',['carObj'=>$carObj,'dateTime'=>$date,'rentEvents'=>$rentEventsObj]);
    }

    public function infoDialog(TimeSheetService $timeSheetServ)
    {
        $validate=$this->request->validate(['carId'=>'required|integer',
            'date'=>'required'
        ]);
        $datePeriod=new CarbonPeriod($validate['date']);
        $datePeriod->setEndDate($datePeriod->getStartDate()->addDay(1));

        $carObj=$this->motorPoolRep->getCar($validate['carId']);
        $timeSheetsObj=$timeSheetServ->getCarTimeSheets($carObj,$datePeriod);
        return view('dialog.TimeSheet.infoTimeSheet',['timeSheets'=>$timeSheetsObj]);
    }


    public function editEventDialog(TimeSheetService $timeSheetServ)
    {
        //$validate=$this->request->validate(['carId'=>'required|integer']);
        //$timeSheetsObj=$timeSheetServ->getCarTimeSheets();
        //return view('dialog.TimeSheet.editEvent',['carId'=>$validate['carId'],'timeSheets'=>$timeSheetsObj]);
    }





    public function add(TimeSheetService $timeSheetServ)
    {
        $timeSheetServ->addEvent();
        return  redirect()->back();
    }



    public function showCarTimeSheet(DateSpan $dateSpan,TimeSheetService $timeSheetServ)
    {
        $dateFromTo=$dateSpan->validated();
        $periodDate=new CarbonPeriod($dateFromTo['fromDate'],$dateFromTo['toDate']);
        $validate=$this->request->validate(['carId'=>'required|integer']);
        $carObj=$this->motorPoolRep->getCar($validate['carId']);
        $timeSheetsObj=$timeSheetServ->getCarTimeSheets($carObj,$periodDate);

        return view('timeSheet.car',['carObj' => $carObj,'periodDate' => $periodDate,'timeSheetsObj'=>$timeSheetsObj]);
    }

}
