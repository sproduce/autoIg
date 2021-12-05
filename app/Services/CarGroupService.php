<?php
namespace App\Services;
use App\Repositories\Interfaces\CarGroupRepositoryInterface;
use Illuminate\Http\Request;

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


}