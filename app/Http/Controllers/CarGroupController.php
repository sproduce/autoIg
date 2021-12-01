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

    }



}
