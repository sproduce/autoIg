<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class TimeSheetController extends Controller
{
    public function show()
    {
        $currentDate=Carbon::now();
        $currentDate->subDays(8);
        return view('timeSheet.list',['currentDate'=>$currentDate]);
    }




}
