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
        return $this->carGroupRep->carGroupInfo($carGroup['carGroupId']);
    }

    public function addCarToGroup()
    {
        $carGroupArray=$this->request->validate(['carGroupId'=>'required',
            'carId'=>'',
            'start'=>'',
            'finish'=>'']);

        $this->carGroupRep->addCarToGroup($carGroupArray);


    }


}
