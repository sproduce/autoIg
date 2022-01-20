<?php

namespace App\Http\Controllers;

use App\Services\MotorPoolService;
use Illuminate\Http\Request;


class MotorPoolController extends Controller
{
    private $motorPoolServ,$request;
    function __construct(MotorPoolService $motorPoolServ,Request $request)
    {
        $this->motorPoolServ=$motorPoolServ;
        $this->request=$request;
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
        $validated = $this->request->validate(['carId' => 'integer']);
        $carObj=$this->motorPoolServ->getCar($validated['carId']);
        return view('dialog.MotorPool.editCar',['car'=>$carObj]);
    }

    public function dialogCarInfo()
    {
        $validated = $this->request->validate(['carId' => 'integer']);
        $carObj=$this->motorPoolServ->getCar($validated['carId']);
        return view('dialog.MotorPool.carInfo',['car'=>$carObj]);
    }


    public function search()
    {
        $carsObj=$this->motorPoolServ->search();
        return view('car.carSearchResult',['cars'=>$carsObj]);
    }


    public function getCarInfo($id=null)
    {
        if ($id){
            $carId=$id;
        } else{
            $validated = $this->request->validate(['carId' => 'integer']);
            $carId = $validated['carId']??0;
        }
        $carInfo=$this->motorPoolServ->getCar($carId);
        return response()->json($carInfo);
    }

}
