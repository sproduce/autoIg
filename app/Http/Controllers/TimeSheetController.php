<?php

namespace App\Http\Controllers;

use App\Services\RentEventService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\TimeSheetService;

class TimeSheetController extends Controller
{
    public function show(TimeSheetService $timeSheetServ)
    {
        //$motorPoolObj=$motorPool->getCars();
        $timeSheetCollect = $timeSheetServ->getCarsTimeSheets();
        $tmpCarbon = new Carbon();
        return view('timeSheet.list', ['timeSheetCollect' => $timeSheetCollect, 'carbon' => $tmpCarbon]);
    }



    public function addEventDialog(Request $request,RentEventService $rentEventServ)
    {
        $validate=$request->validate(['carId'=>'required|integer',
            'date'=>'required'
        ]);
        $date=new Carbon();
        $date=$validate['date'].'T'.$date->format('H:i');
        $rentEventsObj=$rentEventServ->getRentEvents();
        return view('dialog.TimeSheet.addEvent',['carId'=>$validate['carId'],'dateTime'=>$date,'rentEvents'=>$rentEventsObj]);
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
