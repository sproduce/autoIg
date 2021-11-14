<?php

namespace App\Http\Controllers;

use App\Services\CarDriverService;
use Illuminate\Http\Request;


class CarDriverController extends Controller
{

    public function show(CarDriverService $carDriverServ)
    {
        $carDriversObj=$carDriverServ->getCarDrivers();
        return view('carDriver.CarDriverList',['carDrivers'=>$carDriversObj]);
    }

    public function add(CarDriverService $carDriverServ)
    {
        $carDriverServ->addCarDriver();
        return redirect()->back();
    }


}
