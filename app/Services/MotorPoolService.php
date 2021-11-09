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


    public function getCar()
    {

    }



    public function addCar()
    {
        $validated = $this->request->validate([
            'generationId'=>'required|integer',
            'typeId'=>'integer',
            'engineId'=>'integer',
            'transmissionTypeId'=>'integer',
            'year'=>'',
            'displacement'=>'',
            'hp'=>'',
            'regNumber'=>'',
            'vin'=>'',
            'color'=>'',
            'nickName'=>'',
            'ownerId'=>''
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
