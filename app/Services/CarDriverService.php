<?php
namespace App\Services;
use App\Repositories\Interfaces\CarDriverRepositoryInterface;
use Illuminate\Http\Request;

Class CarDriverService{

    private $carDriverRep,$request;

    function __construct( CarDriverRepositoryInterface $carDriverRepository,Request $request)
    {
        $this->carDriverRep=$carDriverRepository;
        $this->request=$request;
    }

    public function getCarDrivers()
    {
        return $this->carDriverRep->getCarDrivers();
    }


    public function getCarDriver()
    {
        $validated=$this->request->validate(['carDriverId'=>'required|integer']);
        return $this->carDriverRep->getCarDriver($validated['carDriverId']);

    }

    public function addCarDriver()
    {
        $validated=$this->request->validate(['surname'=>'required',
            'name'=>'',
            'male'=>'',
            'birthday'=>'',
            'nickname'=>'',
            'comment'=>'']);

            $carDriverObj=$this->carDriverRep->addCarDriver($validated);
            $validatedcontact=$this->request->validate(['phone'=>'']);
            if ($validatedcontact['phone']){
                $validatedcontact['driverId']=$carDriverObj->id;
                $this->carDriverRep->addCarDriverContact($validatedcontact);
            }

    }



}
