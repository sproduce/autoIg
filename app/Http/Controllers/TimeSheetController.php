<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\TimeSheetService;

class TimeSheetController extends Controller
{
    public function show(TimeSheetService $timeSheetServ)
    {
        //$motorPoolObj=$motorPool->getCars();
        $motorPoolObj = $timeSheetServ->getCarsTimeSheets();
        $tmpCarbon = new Carbon();
        return view('timeSheet.list', ['motorPool' => $motorPoolObj, 'carbon' => $tmpCarbon]);
    }



    public function addEventDialog()
    {
        return view('dialog.TimeSheet.addEvent');
    }




}
