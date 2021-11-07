<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MotorPoolService;


class MotorPoolController extends Controller
{
    //

    public function show()
    {
        return view('motorPool.motorPoolList');
    }

    public function add(MotorPoolService $motorPoolServ)
    {
        $motorPoolServ->addCar();
    }


    public function edit()
    {


    }

}
