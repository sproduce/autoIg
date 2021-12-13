<?php
namespace App\Services;
use App\Repositories\Interfaces\CarOwnerRepositoryInterface;
use Illuminate\Http\Request;

Class CarOwnerService{

    private $carOwnerRep,$request;

    function __construct( CarOwnerRepositoryInterface $carOwnerRepository,Request $request)
    {
        $this->carOwnerRep=$carOwnerRepository;
        $this->request=$request;
    }

    public function getCarOwners()
    {
        return $this->carOwnerRep->getCarOwners();
    }


    public function getCarOwner()
    {
        $validate=$this->request->validate(['carOwnerId'=>'required|integer']);
        return $this->carOwnerRep->getCarOwner($validate['carOwnerId']);
    }

    public function addCarOwner()
    {
        $validate=$this->request->validate(['name'=>'required','nickName'=>'','comment'=>'']);
        $this->carOwnerRep->addCarOwner($validate);
    }


    public function editCarOwner()
    {
        $validateData=$this->request->validate(['name'=>'required','nickName'=>'','comment'=>'']);
        $validateId=$this->request->validate(['carOwnerId'=>'required|integer']);
        $this->carOwnerRep->updateCarOwner($validateId['carOwnerId'],$validateData);
    }



    public function getLastOwners($kol)
    {
        return $this->carOwnerRep->getLastOwners($kol);
    }


    public function searchOwner()
    {
        $validate=$this->request->validate(['carOwnerText'=>'required']);
        return $this->carOwnerRep->carOwnerSearch($validate['carOwnerText']);
    }




}
