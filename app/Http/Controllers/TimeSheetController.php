<?php

namespace App\Http\Controllers;

use App\Repositories\MotorPoolRepository;
use App\Services\MotorPoolService;
use App\Services\RentEventService;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use App\Services\TimeSheetService;

class TimeSheetController extends Controller
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request=$request;
    }


    public function show(TimeSheetService $timeSheetServ,MotorPoolRepository $motorPoolRep)
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
        $motorPoolObj=$motorPoolRep->getCars();
        return view('timeSheet.list', ['timeSheetArray' => $timeSheetArray, 'periodDate' => $periodDate,'currentDate'=> $currentDate,'motorPoolObj'=>$motorPoolObj]);
    }



    public function addEvent(RentEventService $rentEventServ,MotorPoolService $motorPoolServ)
    {
        $validate=$this->request->validate(['carId'=>'',
            'date'=>''
        ]);
        $carId=$validate['carId'] ??0;
        $selectDate=$validate['date'] ?? '';
        $carObj=$motorPoolServ->getCar( $carId);
        $date=new Carbon($selectDate);
        $rentEventsObj=$rentEventServ->getRentEvents();
        return view('rentEvent.addEvent',['carObj'=>$carObj,'dateTime'=>$date,'rentEvents'=>$rentEventsObj]);
    }

    public function infoDialog(TimeSheetService $timeSheetServ)
    {
        $validate=$this->request->validate(['carId'=>'required|integer',
            'date'=>'required'
        ]);
        $timeSheetsObj=$timeSheetServ->getCarTimeSheets($validate['carId'],$validate['date']);
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


}
