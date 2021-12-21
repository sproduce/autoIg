<?php
namespace App\Services;
use App\Repositories\Interfaces\MotorPoolRepositoryInterface;
use Illuminate\Http\Request;

Class TimeSheetService{
    private $motorPoolRep,$request;

    function __construct(MotorPoolRepositoryInterface $motorPoolRep,Request $request)
    {
        $this->motorPoolRep=$motorPoolRep;
        $this->request=$request;
    }

    public function getCarsTimeSheets()
    {
        $carsObj=$this->motorPoolRep->getCars()->keyBy('id');
        //$carsObj=$this->motorPoolRep->getCars();
        //$carsObj->dump();
        //var_dump($carsObj);
        return$carsObj;
    }




}
