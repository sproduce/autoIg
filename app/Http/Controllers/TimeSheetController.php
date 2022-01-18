<?php

namespace App\Http\Controllers;

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
        //$motorPoolObj=$motorPool->getCars();
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



    public function addEventDialog(Request $request,RentEventService $rentEventServ)
    {
        $validate=$request->validate(['carId'=>'required|integer',
            'date'=>'required'
        ]);
        $date=new Carbon();
        $date=$validate['date'].'T'.$date->format('H:i');
        $rentEventsObj=$rentEventServ->getRentEvents();
        return view('rentEvent.addEvent',['carId'=>$validate['carId'],'dateTime'=>$date,'rentEvents'=>$rentEventsObj]);
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
