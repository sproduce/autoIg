<?php

namespace App\Http\Controllers;

use App\Services\CarDriverService;

class CarDriverController extends Controller
{
    private $carDriverServ;
    function __construct(CarDriverService $carDriverServ)
    {
        $this->carDriverServ=$carDriverServ;
    }


    public function show()
    {
        $carDriversObj=$this->carDriverServ->getCarDrivers();
        return view('carDriver.CarDriverList',['carDrivers'=>$carDriversObj]);
    }

    public function add()
    {
        $this->carDriverServ->addCarDriver();
        return redirect()->back();
    }


    public function addDialog()
    {
        $carDriverRegionsObj=$this->carDriverServ->getCarDriverRegions();
        return view('dialog.CarDriver.addCarDriver',['carDriverRegions'=>$carDriverRegionsObj]);
    }


    public function search()
    {
        $this->carDriverServ->searchDriver();
    }


}
