<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MotorPoolService;


class MotorPoolController extends Controller
{
    //

    public function show(MotorPoolService $motorPoolServ)
    {
        $carsPoolObj=$motorPoolServ->getCars();

        return view('motorPool.motorPoolList',['carsPool'=>$carsPoolObj]);
    }

    public function add(MotorPoolService $motorPoolServ)
    {
        $motorPoolServ->addCar();
        return redirect()->back();
    }


    public function edit()
    {


    }

    public function dialogCarInfo(MotorPoolService $motorPoolServ)
    {
        $carObj=$motorPoolServ->getCar();
        return view('dialog.MotorPool.carInfo',['car'=>$carObj]);
    }



}
