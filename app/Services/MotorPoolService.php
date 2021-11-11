<?php
namespace App\Services;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\MotorPoolRepositoryInterface;

Class MotorPoolService{

    private $motorPoolRep,$request;


    function __construct(Request $request,MotorPoolRepositoryInterface $motorPoolRep){
        $this->request=$request;
        $this->motorPoolRep=$motorPoolRep;
    }


    public function getCars()
    {
        return $this->motorPoolRep->getCars();
    }


    public function getCar()
    {
        $validated = $this->request->validate(['carId'=>'required|integer']);
        return $this->motorPoolRep->getCar($validated['carId']);
    }




    public function addCar()
    {
        $validated = $this->request->validate([
            'generationId'=>'required|integer',
            'typeId'=>'integer',
            'engineTypeId'=>'integer',
            'transmissionTypeId'=>'integer',
            'year'=>'required',
            'displacement'=>'',
            'hp'=>'',
            'regNumber'=>'required',
            'vin'=>'required',
            'color'=>'',
            'nickName'=>'',
            'ownerId'=>'',
            'dateStart'=>'required',
            'dateFinish'=>'',
            'comment'=>''
        ]);
        $this->motorPoolRep->addCar($validated);
    }


    public function edit()
    {


    }

    public function del()
    {


    }




}
