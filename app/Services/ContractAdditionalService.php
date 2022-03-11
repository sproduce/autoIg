<?php
namespace App\Services;
use App\Http\Requests\DateSpan;
use App\Repositories\Interfaces\ContractRepositoryInterface;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

Class ContractAdditionalService{
    private $request;

    function __construct(Request $request)
    {
        $this->request=$request;
    }


}
