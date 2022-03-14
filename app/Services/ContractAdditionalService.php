<?php
namespace App\Services;


use App\Repositories\AdditionalRepository;
use Carbon\CarbonPeriod;


Class ContractAdditionalService{
    private $additionalRep;

    function __construct(AdditionalRepository $additionalRep)
    {
        $this->additionalRep=$additionalRep;
    }


    public function getAdditionals(CarbonPeriod $datePeriod)
    {
        $additionalsObj = $this->additionalRep->getAdditionalsByDate($datePeriod);
        //$additionalsObj->dd();
        return $additionalsObj;
    }


}
