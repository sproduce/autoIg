<?php

namespace App\Http\Controllers;

use App\Services\CarGroupService;

class CarGroupController extends Controller
{
    private $carGroupServ;
    function __construct(CarGroupService $carGroupServ)
    {
        $this->carGroupServ=$carGroupServ;
    }


    public function show()
    {
        $carGroupsObj=$this->carGroupServ->getCarGroups();
        return view('carGroup.CarGroupList',['carGroups'=>$carGroupsObj]);
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
        $carGroupInfoObj=$this->carGroupServ->carGroupInfo();
        return view('carGroup.CarGroupInfo',['carGroupInfoObj'=>$carGroupInfoObj]);
    }


    public function addCarToGroup()
    {
        $this->carGroupServ->addCarToGroup();
        return redirect()->back();
    }

    public function searchDialog()
    {
        $carGroupsObj=$this->carGroupServ->getLastCarGroups(5);

        return view('dialog.CarGroup.searchCarGroup',['carGroups'=>$carGroupsObj]);
    }

    public function search()
    {
        $carGroupSearchObj=$this->carGroupServ->searchCarGroup();
        return view('carGroup.carGroupSearchResult',['carGroups'=>$carGroupSearchObj]);
    }



}
