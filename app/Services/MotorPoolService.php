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


    public function addCar()
    {
        $validated = $this->request->validate([
            'manufId'=>'required|alpha_dash',
            'modelId' => 'required|integer',
            'generationId'=>'required|alpha_dash',
            'typeId'=>'required|alpha_dash',
            'year'=>'',
            'displacement'=>'',
            'hp'=>'',
            'regNumber'=>'',
            'vin'=>'',
            'color'=>'',
            'nickName'=>''
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
