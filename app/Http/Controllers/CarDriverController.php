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

    public function saveCarDriver()
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
        $carDriversObj=$this->carDriverServ->searchDriver();
        return view('carDriver.carDriverSearchResult',['carDrivers'=>$carDriversObj]);
    }

    public function dialogInfo()
    {
        $carDriverObj=$this->carDriverServ->getCarDriver();
        return view('dialog.CarDriver.info',['carDriver'=>$carDriverObj]);
    }


    public function editCarDriver()
    {
        $carDriverObj=$this->carDriverServ->getCarDriver();
        $carDriverRegionsObj=$this->carDriverServ->getCarDriverRegions();
        return view('dialog.CarDriver.editCarDriver',['carDriver'=>$carDriverObj,'carDriverRegions'=>$carDriverRegionsObj]);
    }

    public function updateCarDriver()
    {
        $this->carDriverServ->editCarDriver();
        return redirect()->back();
    }


}
