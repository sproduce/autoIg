<?php
namespace App\Services;
use App\Repositories\Interfaces\CarGroupRepositoryInterface;
use Illuminate\Http\Request;
use App\Models\rentCarGroupLink;



Class CarGroupService{

    private $carGroupRep,$request;

    function __construct(CarGroupRepositoryInterface $carGroupRepository,Request $request)
    {
        $this->carGroupRep=$carGroupRepository;
        $this->request=$request;
    }


    public function getCarGroups()
    {
        return $this->carGroupRep->getCarGroups();
    }

    public function getLastCarGroups($kol)
    {
        return $this->carGroupRep->getLastCarGroups($kol);
    }

    public function getCarGroup()
    {
        $validate=$this->request->validate(['carGroupId'=>'required']);
        return $this->carGroupRep->getCarGroup($validate['carGroupId']);
    }


    public function addCarGroup()
    {
        $groupArray=$this->request->validate(['name'=>'required',
                                            'nickName'=>'',
                                            'start'=>'required',
                                            'finish'=>''
        ]);
        $this->carGroupRep->addCarGroup($groupArray);
    }

    public function carGroupInfo()
    {
        $carGroup=$this->request->validate(['carGroupId'=>'required']);
        $carGroupObj=$this->carGroupRep->getCarGroup($carGroup['carGroupId']);
        $carGroupInfoObj=$this->carGroupRep->carGroupInfo($carGroup['carGroupId']);
        $groupObj=collect(['carGroup'=>$carGroupObj,'carGroupInfo'=>$carGroupInfoObj]);
        return $groupObj;
    }

    public function addCarToGroup()
    {
        $carGroupArray=$this->request->validate(['groupId'=>'required',
            'carId'=>'',
            'start'=>'',
            'finish'=>'']);

        $this->carGroupRep->addCarToGroup($carGroupArray);


    }

    public function searchCarGroup()
    {
        $validate=$this->request->validate(['carGroupText'=>'required']);
        return $this->carGroupRep->searchCarGroup($validate['carGroupText']);
    }


    public function getCarGroupsByCar($carId)
    {
        return $this->carGroupRep->getCarGroupsByCar($carId);
    }

    
    public function getCarGroupLink($carGroupId = null): rentCarGroupLink 
    {
        return $this->carGroupRep->getCarGroupLink($carGroupId);
    }
    
    
    public function storeCarInCarGroup(rentCarGroupLink $carGroupLinkObj) 
    {
        $this->carGroupRep->storeCarGroupLink($carGroupLinkObj);
    }
    
    

}
