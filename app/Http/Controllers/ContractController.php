<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ContractService;
use App\Models\rentContractStatus;
use App\Models\rentContractTariff;
use App\Models\rentContractType;

class ContractController extends Controller
{
    public function show(ContractService $contractServ)
    {
        $contractsObj=$contractServ->getContracts();
        return view('contract.ContractList',['contracts'=>$contractsObj]);
    }

    public function addContract()
    {
        $contractStatusObj=rentContractStatus::all();
        $contractTariffObj=rentContractTariff::all();
        $contractTypeObj=rentContractType::all();

        return view('contract.addCarContract',['contractStatuses'=>$contractStatusObj,'contractTariffs'=>$contractTariffObj,'contractTypes'=>$contractTypeObj]);
    }



}
