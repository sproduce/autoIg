<?php

namespace App\Http\Controllers;

use App\Http\Requests\DateSpan;
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


    public function contractAdditional()
    {
        return view('contract.ContractAdditional');
    }



}
