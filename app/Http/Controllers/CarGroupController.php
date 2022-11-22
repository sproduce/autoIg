<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarIdRequest;
use App\Http\Requests\AddCarInGroupRequest;

use App\Repositories\CarGroupRepository;
use App\Services\CarGroupService;
use App\Services\MotorPoolService;



class CarGroupController extends Controller
{
    private $carGroupServ,$carGroupRep,$carServ;
    function __construct(
            CarGroupService $carGroupServ,
            CarGroupRepository $carGroupRepository,
            MotorPoolService $carServ
        ){
        $this->carGroupServ = $carGroupServ;
        $this->carGroupRep = $carGroupRepository;
        $this->carServ = $carServ;
    }


    public function show()
    {
        $carGroupsObj = $this->carGroupServ->getCarGroups();
        return view('carGroup.CarGroupList',['carGroups' => $carGroupsObj]);
    }


    public function addDialog()
    {
        return view('dialog.CarGroup.addCarGroup');
    }

    public function save()
    {

        $this->carGroupServ->addCarGroup();
        return redirect()->back();
    }

    public function info()
    {
        $carGroupInfoObj = $this->carGroupServ->carGroupInfo();
        return view('carGroup.CarGroupInfo',['carGroupInfoObj' => $carGroupInfoObj]);
    }


    public function addCarToGroup()
    {
        $this->carGroupServ->addCarToGroup();
        return redirect()->back();
    }

    public function addCarGroupToDialog()
    {
        $carGroupsObj = $this->carGroupServ->getLastCarGroups(5);

        return view('dialog.CarGroup.addCarGroupTo',['carGroups' => $carGroupsObj]);
    }




    public function search()
    {
        $carGroupSearchObj = $this->carGroupServ->searchCarGroup();
        return view('carGroup.carGroupSearchResult',['carGroups' => $carGroupSearchObj]);
    }


    public function dialogInfo()
    {
        $carGroupObj = $this->carGroupServ->getCarGroup();
        return view('dialog.CarGroup.fullInfoCarGroup',['carGroup' => $carGroupObj]);
    }


    public function getCarGroupsApi($carId)
    {
        $carGroups = $this->carGroupRep->getCarGroupsByCar($carId);
        if (!count($carGroups)){
            $carGroups = $this->carGroupRep->getCarGroups();
        }
        return response()->json($carGroups);
    }


    public function carInCarGroups(CarIdRequest $carIdRequest) 
    {
        $carId = $carIdRequest->carId;
        $carGroups = $this->carGroupRep->getCarGroupsByCar($carId);
        $carObj = $this->carServ->getCar($carId);
        return view('carGroup.CarInCarGroups',['carObj' => $carObj,'carGroups' => $carGroups]);
    }
    
    
    
    public function addCarInCarGroupDialog(CarIdRequest $carIdRequest) 
    {
        $carGroups = $this->carGroupServ->getCarGroups();
        //$carObj = $this->carServ->getCar($carIdRequest->carId);
        $carGroupLinkObj = $this->carGroupServ->getCarGroupLink();
        $carGroupLinkObj->carId = $carIdRequest->carId;
        return view('dialog.CarGroup.addCarInCarGroup',['carGroupLinkObj' => $carGroupLinkObj,'carGroups' => $carGroups]);
    }
    
    
    public function editCarInCarGroupDialog($carGroupLinkId) 
    {
        $carGroupLinkObj = $this->carGroupServ->getCarGroupLink($carGroupLinkId);
        $carGroups = $this->carGroupServ->getCarGroups();
        return view('dialog.CarGroup.addCarInCarGroup',['carGroupLinkObj' => $carGroupLinkObj,'carGroups' => $carGroups]);
    }
        

    
    public function storeCarInCarGroup(AddCarInGroupRequest $carGroupLinkRequest) 
    {
        $carGroupLinkObj = $this->carGroupServ->getCarGroupLink($carGroupLinkRequest->id);
        $carGroupLinkObj->carId = $carGroupLinkRequest->carId;
        $carGroupLinkObj->groupId = $carGroupLinkRequest->groupId;
        $carGroupLinkObj->start = $carGroupLinkRequest->start;
        $carGroupLinkObj->finish = $carGroupLinkRequest->finish;
        $this->carGroupServ->storeCarInCarGroup($carGroupLinkObj);
        return redirect()->back();
    }
    
    
}
