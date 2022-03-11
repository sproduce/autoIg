<?php

namespace App\Http\Controllers;

use App\Http\Requests\DateSpan;
use Illuminate\Http\Request;

class ContractAdditionalController extends Controller
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request=$request;
    }

    public function show(DateSpan $dateSpan)
    {
        $dateSpan->validated();
        $periodDate=$dateSpan->getCarbonPeriod();
       return view('contract.ContractAdditionalList',['periodDate' => $periodDate]);
    }


    public function contractAdditional()
    {
        return view('contract.ContractAdditional');
    }



}
