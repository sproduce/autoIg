<?php

namespace App\Http\Controllers;

use App\Http\Requests\DateSpan;
use App\Repositories\ContractRepository;
use App\Services\ContractAdditionalService;
use Illuminate\Http\Request;

class ContractAdditionalController extends Controller
{
    private $request,$additioonalServ;

    public function __construct(Request $request,ContractAdditionalService $additioonalServ)
    {
        $this->request=$request;
        $this->additioonalServ=$additioonalServ;
    }

    public function show(DateSpan $dateSpan)
    {
        $dateSpan->validated();
        $periodDate=$dateSpan->getCarbonPeriod();
        $additionalsObj = $this->additioonalServ->getAdditionals($periodDate);
        return view('contract.ContractAdditionalList',['periodDate' => $periodDate,
            'additionals' => $additionalsObj]);
    }



    public function addContractAdditionalDialog(ContractRepository $contractRep)
    {
        $validate = $this->request->validate(['toPayId'=>'required|integer']);
        $additionalFullInfo = $this->additioonalServ->getAdditionalFullInfo($validate['toPayId']);
        $contractsObj = $contractRep->getContractsByCarId($additionalFullInfo->carId);

        return view('contract.AddContractAdditional',['additionalFullInfo' => $additionalFullInfo,
            'contractsObj' => $contractsObj,
        ]);
    }


    public function addContractAdditional(ContractRepository $contractRep)
    {
        $validate = $this->request->validate(['toPayId'=>'required|integer']);
        $additionalFullInfo = $this->additioonalServ->getAdditionalFullInfo($validate['toPayId']);
        $contractsObj = $contractRep->getContractsByCarId($additionalFullInfo->carId);

        return view('contract.AddContractAdditional',['additionalFullInfo' => $additionalFullInfo,
            'contractsObj' => $contractsObj,
            ]);
    }

    public function storeContractAdditional()
    {

    }


    public function contractAdditional()
    {
        return view('contract.ContractAdditional');
    }



}
