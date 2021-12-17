<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\MotorPoolService;

class TimeSheetController extends Controller
{
    public function show(MotorPoolService $motorPool)
    {
        $motorPoolObj=$motorPool->getCars();
        $tmpCarbon=new Carbon();
        return view('timeSheet.list',['motorPool'=>$motorPoolObj,'carbon'=>$tmpCarbon]);
    }




}
