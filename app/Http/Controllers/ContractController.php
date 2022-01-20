<?php

namespace App\Http\Controllers;

use App\Services\ContractService;
use App\Services\MotorPoolService;
use App\Services\CarDriverService;

use Illuminate\Http\Request;



class ContractController extends Controller
{
    private $contractServ,$request;

    function __construct(ContractService $contractServ,Request $request)
    {
        $this->contractServ = $contractServ;
        $this->request=$request;
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

    public function show()
    {
        $contractsCollect=$this->contractServ->getContracts();
        return view('contract.ContractList', ['contractsCollect' => $contractsCollect]);
    }



    public function showContractTypes()
    {
        $contractTypesObj = $this->contractServ->getContractTypes();
        return view('contract.ContractTypeList', ['contractTypes' => $contractTypesObj]);
    }


    public function addContract(MotorPoolService $motorPoolServ,CarDriverService $carDriverServ)
    {
        $directory=$this->contractServ->getContractDirectory();
        $validated = $this->request->validate(['carId' => 'integer']);
        $carId=$validated['carId']??0;
        $carObj=$motorPoolServ->getCar($carId);

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
        return redirect('/contract/list');
    }

    public function updateContract()
    {
        $this->contractServ->editContract();
        return redirect('/contract/list');
    }


    public function editContract()
    {
        $validate=$this->request->validate(['contractId'=>'required|integer']);
        $contractObj=$this->contractServ->getContract($validate['contractId']);
        $directoryObj=$this->contractServ->getContractDirectory();
        return view('contract.editCarContract',['contract'=>$contractObj,'directory'=>$directoryObj]);
    }


    public function search()
    {
        $contractsObj=$this->contractServ->search();
        return view('contract.resultSearch',['contracts'=>$contractsObj]);
    }

    public function dialogInfo()
    {
        $validate=$this->request->validate(['contractId'=>'required|integer']);
        $contractObj=$this->contractServ->getContract($validate['contractId']);

        return view('dialog.Contract.FullInfoContract',['contract'=>$contractObj]);
    }


    public function getContractInfo($id)
    {
        $contractObj=$this->contractServ->getContract($id);
        return response()->json($contractObj);
    }


}
