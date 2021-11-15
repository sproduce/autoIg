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
            'regionId'=>'required',
            'name'=>'',
            'male'=>'',
            'birthday'=>'',
            'nickname'=>'',
            'comment'=>'']);

            $carDriverObj=$this->carDriverRep->addCarDriver($validated);
            $validatedcontact=$this->request->validate(['phone'=>'']);
            foreach($validatedcontact['phone'] as $phone){
                if($phone){
                    $driverContactArray['driverId']=$carDriverObj->id;
                    $driverContactArray['phone']=$phone;
                    $this->carDriverRep->addCarDriverContact($driverContactArray);
                }

                }
    }


    public function getCarDriverRegions()
    {
        return $this->carDriverRep->getCarDriverRegions();
    }

    public function getLastDrivers($kol)
    {
        return $this->carDriverRep->getLastDrivers($kol);
    }


    public function searchDriver()
    {
        $validate=$this->request->validate(['driverText'=>'required']);
        return $this->carDriverRep->carDriverSearch($validate['driverText']);
    }




}
