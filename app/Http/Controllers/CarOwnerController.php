<?php

namespace App\Http\Controllers;
use App\Services\CarOwnerService;


class CarOwnerController extends Controller
{
    private $carOwnerServ;
    function __construct(CarOwnerService $carOwnerServ)
    {
        $this->carOwnerServ=$carOwnerServ;
    }

    public function show()
    {
        $carOwnersObj=$this->carOwnerServ->getCarOwners();

        return view('carOwner.CarOwnerList',['carOwners'=>$carOwnersObj]);
    }

    public function addDialog()
    {
        return view('dialog.CarOwner.addCarOwner');
    }

    public function save()
    {
        $this->carOwnerServ->addCarOwner();
        return redirect()->back();
    }

    public function editDialog()
    {
        $carOwnerObj=$this->carOwnerServ->getCarOwner();
        return view('dialog.CarOwner.editCarOwner',['carOwner'=>$carOwnerObj]);
    }

    public function DialogInfo()
    {
        $carOwnerObj=$this->carOwnerServ->getCarOwner();
        return view('dialog.CarOwner.fullInfoCarOwner',['carOwner'=>$carOwnerObj]);
    }

    public function update()
    {
        $this->carOwnerServ->editCarOwner();
        return redirect()->back();
    }

    public function searchDialog()
    {
        $carOwnersObj=$this->carOwnerServ->getLastOwners(5);
        return view('dialog.CarOwner.searchCarOwner',['carOwners'=>$carOwnersObj]);
    }

    public function search()
    {
        $carOwnersObj=$this->carOwnerServ->searchOwner();
        return view('carOwner.carOwnerSearchResult',['carOwners'=>$carOwnersObj]);
    }

}
