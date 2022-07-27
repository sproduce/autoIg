<?php
namespace App\Services;

use App\Http\Requests\DateSpan;
use App\Repositories\Interfaces\CarGroupRepositoryInterface;
use App\Repositories\Interfaces\MotorPoolRepositoryInterface;
use App\Repositories\Interfaces\PaymentRepositoryInterface;
use App\Repositories\Interfaces\SubjectRepositoryInterface;


Class FilterService{

    private $motorPoolRep,$carGroupRep,$paymentRep,$subjectRep;

    function __construct(
        MotorPoolRepositoryInterface $motorPoolRep,
        CarGroupRepositoryInterface $carGroupRep,
        PaymentRepositoryInterface $paymentRep,
        SubjectRepositoryInterface $subjectRep
    ){
        $this->motorPoolRep = $motorPoolRep;
        $this->carGroupRep = $carGroupRep;
        $this->paymentRep = $paymentRep;
        $this->subjectRep = $subjectRep;
    }


    public function getPaymentFilter()
    {
        $motorPools = $this->motorPoolRep->getCars();
        $carGroups = $this->carGroupRep->getCarGroups();
        $accounts = $this->paymentRep->getAccounts();
        $operationTypes = $this->paymentRep->getOperationTypes();
        $subjects = $this->subjectRep->getSubjects();

        $paymentFilters = collect(['filterPossible' =>[
            'motorPools' => $motorPools,
            'carGroups' => $carGroups,
            'accounts' => $accounts,
            'operationTypes' => $operationTypes,
            'subjects' => $subjects,
            ]
        ]);
        return $paymentFilters;
    }


}
