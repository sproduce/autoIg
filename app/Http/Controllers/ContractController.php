<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ContractService;
use App\Models\rentContractStatus;
use App\Models\rentContractTariff;
use App\Models\rentContractType;
use App\Services\CarDriverService;

class ContractController extends Controller
{
    private $contractServ;
    function __construct(ContractService $contractServ)
    {
        $this->contractServ=$contractServ;
    }

    public function show()
    {
        $contractsObj=$this->contractServ->getContracts();
        return view('contract.ContractList',['contracts'=>$contractsObj]);
    }

    public function addContract()
    {
        $contractStatusObj=rentContractStatus::all();
        $contractTariffObj=rentContractTariff::all();
        $contractTypeObj=rentContractType::all();

        return view('contract.addCarContract',['contractStatuses'=>$contractStatusObj,'contractTariffs'=>$contractTariffObj,'contractTypes'=>$contractTypeObj]);
    }


    public function addDriverDialog(CarDriverService $carDriverServ)
    {
        $carDriversObj=$carDriverServ->getLastDrivers(5);

        return view('dialog.Contract.addDriverContract',['carDrivers'=>$carDriversObj]);
    }


    public function addCarDialog()
    {
        return view('dialog.Contract.addCarContract');
    }

    public function saveContract()
    {
        $this->contractServ->addContract();
    }


}
