<?php

namespace App\Http\Controllers;

use App\Http\Requests\DateSpan;
use App\Repositories\ContractRepository;
use App\Services\ContractService;
use App\Services\MotorPoolService;
use App\Services\CarDriverService;

use Carbon\CarbonPeriod;
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

    public function show(DateSpan $dateSpan)
    {
        $dateFromTo=$dateSpan->validated();
        $periodDate=new CarbonPeriod($dateFromTo['fromDate'],$dateFromTo['toDate']);
        $currentContractFilter=$this->request->validate(['typeId'=>'nullable|integer']);
        $typeId=$currentContractFilter['typeId'] ?? null;
        $contractsCollect=$this->contractServ->getContracts($periodDate,$typeId);
        return view('contract.ContractList', ['contractsCollect' => $contractsCollect,
                                                    'periodDate' => $periodDate]);
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

    public function contractToPay()
    {
        $validate=$this->request->validate(['contractId'=>'required|integer']);
        $contractObj=$this->contractServ->getContract($validate['contractId']);
        return view('contract.toPay',['contractObj'=>$contractObj]);
    }


    public function dialogCarContract(ContractRepository $contractRep)
    {
        $validate=$this->request->validate(['carId'=>'required|integer']);
        $contractsObj=$contractRep->getContractsByCarId($validate['carId']);

        return view('dialog.Contract.carContracts',['contractsObj' =>$contractsObj]);
    }


}
