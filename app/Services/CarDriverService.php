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
        $validated=$this->request->validate(['carDriverId'=>'integer']);
        $validated['carDriverId']=$validated['carDriverId']??0;
        return $this->carDriverRep->getCarDriver($validated['carDriverId']);

    }

    public function addCarDriver()
    {
        $validated=$this->request->validate(['surname'=>'required',
            'regionId'=>'required|integer',
            'name'=>'',
            'male'=>'',
            'birthday'=>'',
            'nickname'=>'',
            'patronymic'=>'',
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


    public function editCarDriver()
    {
        $validated=$this->request->validate(['id'=>'required|integer',
            'surname'=>'required',
            'regionId'=>'required|integer',
            'name'=>'',
            'male'=>'',
            'birthday'=>'',
            'nickname'=>'',
            'patronymic'=>'',
            'comment'=>'']);
            $carDriverId=$validated['id'];
            empty($validated['id']);
            $this->carDriverRep->updateCarDriver($carDriverId,$validated);
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
