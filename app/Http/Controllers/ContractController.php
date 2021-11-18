<?php

namespace App\Http\Controllers;

use App\Services\ContractService;
use App\Services\MotorPoolService;
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




    public function addContract(MotorPoolService $motorPoolServ,CarDriverService $carDriverServ)
    {
        $directory=$this->contractServ->getContractDirectory();
        $carObj=$motorPoolServ->getCar();
        $driverObj=$carDriverServ->getCarDriver();
        return view('contract.addCarContract',['contractObj'=>$directory,'car'=>$carObj,'driver'=>$driverObj]);
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
        return redirect('/contract/actualList');
    }

    public function updateContract()
    {
        $this->contractServ->editContract();
        return redirect('/contract/actualList');
    }


    public function editContract()
    {
        $contractObj=$this->contractServ->getContract();
        $directoryObj=$this->contractServ->getContractDirectory();
        return view('contract.editCarContract',['contract'=>$contractObj,'directory'=>$directoryObj]);
    }


}
