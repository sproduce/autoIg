<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContractIdRequest;
use App\Http\Requests\ContractRequest;
use App\Http\Requests\DateSpan;
use App\Http\Requests\Payment\ToPaymentRequest;
use App\Http\Requests\Search\SearchContractRequest;
use App\Models\rentContract;
use App\Repositories\ContractRepository;
use App\Repositories\Interfaces\CarGroupRepositoryInterface;
use App\Repositories\Interfaces\PaymentRepositoryInterface;
use App\Repositories\Interfaces\TimeSheetRepositoryInterface;
use App\Repositories\Interfaces\ToPaymentRepositoryInterface;
use App\Repositories\ToPaymentRepository;
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
        $this->request = $request;
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


    public function addContract(rentContract $rentContractObj)
    {
        $directory = $this->contractServ->getContractDirectory();
        $rentContractObj->toAddForm = 1;
        return view('contract.CarContract',[
            'directoryObj' => $directory,
            'rentContractObj' => $rentContractObj,
        ]);
    }



    public function editContract($id)
    {
        $directory = $this->contractServ->getContractDirectory();
        $rentContractObj = $this->contractServ->getContract($id);


        return view('contract.CarContract',[
            'directoryObj' => $directory,
            'rentContractObj' => $rentContractObj,
        ]);
    }



    public function addDriverDialog(CarDriverService $carDriverServ)
    {
        $carDriversObj=$carDriverServ->getLastDrivers(5);

        return view('dialog.Contract.addDriverContract',['carDrivers'=>$carDriversObj]);
    }


    public function contractFullInfo($contractId,
        PaymentRepositoryInterface $paymentRep,
        ToPaymentRepositoryInterface $toPaymentRep
    ){

        $contractPayments = $paymentRep->getPaymentsByContract($contractId);
        $contractService = $toPaymentRep->getToPaymentsByContract($contractId);
        $contractObj = $this->contractServ->getContract($contractId);
        return view('contract.ContractFullInfo',[
            'contractPayments' => $contractPayments,
            'rentContractObj' => $contractObj,
            'contractService' => $contractService,
        ]);
    }


    public function saveContract(ContractRequest $contractRequest)
    {
        $this->contractServ->addContract($contractRequest);
        if ($contractRequest->get('toAddForm')){
            return  redirect()->back();
        } else {
            return redirect('/contract/list');
        }

    }


    public function addContractToDialog()
    {
        $contractsObj = $this->contractServ->getLastContracts(7);
        return view('dialog.Contract.addContractTo',['contractsObj' => $contractsObj]);
    }


    public function search(SearchContractRequest $searchContractObj)
    {
        $contractsObj = $this->contractServ->search($searchContractObj);

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

//    public function contractToPay()
//    {
//        $validate=$this->request->validate(['contractId'=>'required|integer']);
//        $contractObj=$this->contractServ->getContract($validate['contractId']);
//        return view('contract.toPay',['contractObj'=>$contractObj]);
//    }


    public function addContractAdditionalDialog($contractId)
    {
        return view('dialog.Contract.addContractAdditional',['contractId'=>$contractId]);
    }

    public function addContractAdditional(ToPaymentRequest $toPayment)
    {
        $this->contractServ->addContractToPayment($toPayment);
        return  redirect()->back();
    }




//    public function dialogCarContract(ContractRepository $contractRep)
//    {
//        $validate=$this->request->validate(['carId'=>'required|integer']);
//        $contractsObj=$contractRep->getContractsByCarId($validate['carId']);
//
//        return view('dialog.Contract.carContracts',['contractsObj' =>$contractsObj]);
//    }


}
