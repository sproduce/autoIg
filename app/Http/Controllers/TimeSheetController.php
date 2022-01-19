<?php

namespace App\Http\Controllers;

use App\Services\MotorPoolService;
use App\Services\RentEventService;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use App\Services\TimeSheetService;

class TimeSheetController extends Controller
{
    public function show(Request $request,TimeSheetService $timeSheetServ)
    {
        $validate=$request->validate(['currentDate'=>'date']);
        if (isset($validate['currentDate'])){
            $currentDate=CarbonImmutable::create($validate['currentDate']);
        } else {
            $currentDate = CarbonImmutable::now();
        }
        $dateFrom=$currentDate->subDays(12);
        $dateTo=$currentDate->addDays(11);
        $periodDate=CarbonPeriod::create($dateFrom,$dateTo);

        $timeSheetCollect = $timeSheetServ->getCarsTimeSheets($periodDate);

        return view('timeSheet.list', ['timeSheetCollect' => $timeSheetCollect, 'periodDate' => $periodDate,'currentDate'=> $currentDate]);
    }



    public function addEvent(Request $request,RentEventService $rentEventServ,MotorPoolService $motorPoolServ)
    {
        $validate=$request->validate(['carId'=>'required|integer',
            'date'=>'required'
        ]);
        $carObj=$motorPoolServ->getCar($validate['carId']);
        $date=new Carbon($validate['date']);
        $rentEventsObj=$rentEventServ->getRentEvents();
        return view('rentEvent.addEvent',['carObj'=>$carObj,'dateTime'=>$date,'rentEvents'=>$rentEventsObj]);
    }

    public function infoDialog(TimeSheetService $timeSheetServ)
    {
        $timeSheetsObj=$timeSheetServ->getCarTimeSheets();
        return view('dialog.TimeSheet.infoTimeSheet',['timeSheets'=>$timeSheetsObj]);
    }


    public function editEventDialog(Request $request,TimeSheetService $timeSheetServ)
    {
        $validate=$request->validate(['carId'=>'required|integer']);
        $timeSheetsObj=$timeSheetServ->getCarTimeSheets();
        return view('dialog.TimeSheet.editEvent',['carId'=>$validate['carId'],'timeSheets'=>$timeSheetsObj]);
    }





    public function add(TimeSheetService $timeSheetServ)
    {
        $timeSheetServ->addEvent();
        return  redirect()->back();
    }


}
