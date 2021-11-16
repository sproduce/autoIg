<?php

namespace App\Http\Controllers;

use App\Services\ContractService;
use App\Services\MotorPoolService;
use App\Models\rentContractStatus;
use App\Models\rentContractTariff;
use App\Models\rentContractType;
use App\Services\CarDriverService;

class ContractController extends Controller
{
    private $contractServ;

    function __construct(ContractService $contractServ)
    {
        $this->contractServ = $contractServ;
    }

    public function showActual()
    {
        $contractsObj = $this->contractServ->getContracts();
        return view('contract.ContractActualList', ['contracts' => $contractsObj]);
    }

    public function showCompleted()
    {
        return view('contract.ContractCompletedList');
    }




    public function addContract(MotorPoolService $motorPoolServ)
    {
        $contractStatusObj=rentContractStatus::all();
        $contractTariffObj=rentContractTariff::all();
        $contractTypeObj=rentContractType::all();
        $carObj=$motorPoolServ->getCar();
        return view('contract.addCarContract',['contractStatuses'=>$contractStatusObj,'contractTariffs'=>$contractTariffObj,'contractTypes'=>$contractTypeObj,'car'=>$carObj]);
    }


    public function addDriverDialog(CarDriverService $carDriverServ)
    {
        $carDriversObj=$carDriverServ->getLastDrivers(5);

        return view('dialog.Contract.addDriverContract',['carDrivers'=>$carDriversObj]);
    }


    public function addCarDialog(MotorPoolService $motorPoolServ)
    {
        $carsObj=$motorPoolServ->getLastCars(7);
        return view('dialog.Contract.addCarContract',['cars'=>$carsObj]);
    }

    public function saveContract()
    {
        $this->contractServ->addContract();
        return redirect('/contract/list');
    }


}
