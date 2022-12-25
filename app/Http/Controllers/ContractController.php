<?php

namespace App\Http\Controllers;

use \App\Http\Requests\Filters;
use App\Http\Requests\ContractRequest;
use App\Http\Requests\DateSpan;
use App\Http\Requests\Payment\ToPaymentRequest;
use App\Http\Requests\Search\SearchContractRequest;
use App\Models\rentContract;
use App\Repositories\Interfaces\PaymentRepositoryInterface;
use App\Services\ContractService;
use App\Services\CarDriverService;
use App\Services\TimeSheetService;

use App\Services\PaymentService;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;



class ContractController extends Controller
{
    private $contractServ,$request,$timeSheetServ;

    function __construct(ContractService $contractServ,Request $request, TimeSheetService $timeSheetServ)
    {
        $this->contractServ = $contractServ;
        $this->timeSheetServ = $timeSheetServ;
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
        $dateFromTo = $dateSpan->validated();
        $periodDate = new CarbonPeriod($dateFromTo['fromDate'],$dateFromTo['toDate']);
        $currentContractFilter = $this->request->validate(['typeId'=>'nullable|integer']);
        $typeId = $currentContractFilter['typeId'] ?? null;
        $contractsCollect = $this->contractServ->getContracts($periodDate,$typeId);

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
        PaymentService $paymentServ
    ){

        $contractPayments = $paymentRep->getPaymentsByContract($contractId);
        //$contractPayments->dd();
        //$contractService = $paymentServ->getToPaymentsByContract($contractId);
        $filterCollect = collect(['contractId' => $contractId]);
        
        $contractService = $this->timeSheetServ->getAllTimeSheets($filterCollect);
        //$contractService->dd();
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


    public function addContractToDialog(Filters\ToPaymentRequest $requestData)
    {
        //$contractsObj = $this->contractServ->getLastContracts($requestData,7);
        return view('dialog.Contract.addContractTo');
    }


    public function search(SearchContractRequest $searchContractObj)
    {
        $contractsObj = $this->contractServ->search($searchContractObj);

        return view('contract.resultSearch',['contracts'=>$contractsObj]);
    }

    public function dialogInfo()
    {
        $validate = $this->request->validate(['contractId'=>'required|integer']);
        $contractObj = $this->contractServ->getContract($validate['contractId']);

        return view('dialog.Contract.FullInfoContract',['contract'=>$contractObj]);
    }

    

    public function getContractInfo($id)
    {
        $contractObj = $this->contractServ->getContract($id);
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

    public function contractInfoDialog($contractId) 
    {
        $contractObj = $this->contractServ->getContract($contractId);

        return view('dialog.Contract.info',['contract'=>$contractObj]);
    
    }
    



//    public function dialogCarContract(ContractRepository $contractRep)
//    {
//        $validate=$this->request->validate(['carId'=>'required|integer']);
//        $contractsObj=$contractRep->getContractsByCarId($validate['carId']);
//
//        return view('dialog.Contract.carContracts',['contractsObj' =>$contractsObj]);
//    }


}
