<?php

namespace App\Http\Controllers;

use App\Services\MotorPoolService;


class MotorPoolController extends Controller
{
    private $motorPoolServ;
    function __construct(MotorPoolService $motorPoolServ)
    {
        $this->motorPoolServ=$motorPoolServ;
    }

    public function show()
    {
        $carsPoolObj=$this->motorPoolServ->getCars();

        return view('motorPool.motorPoolList',['carsPool'=>$carsPoolObj]);
    }

    public function add()
    {
        $this->motorPoolServ->addCar();
        return redirect()->back();
    }


    public function edit()
    {


    }

    public function dialogCarInfo()
    {
        $carObj=$this->motorPoolServ->getCar();
        return view('dialog.MotorPool.carInfo',['car'=>$carObj]);
    }


    public function search()
    {
        $carsObj=$this->motorPoolServ->search();
        return view('car.carSearchResult',['cars'=>$carsObj]);
    }


}
