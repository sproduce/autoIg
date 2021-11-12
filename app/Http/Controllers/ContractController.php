<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ContractService;

class ContractController extends Controller
{
    public function show(ContractService $contractServ)
    {
        $contractsObj=$contractServ->getContracts();
        return view('contract.ContractList',['contracts'=>$contractsObj]);
    }
}
