<?php
namespace App\Services;

use App\Http\Requests\Filters;
use App\Http\Requests\ContractRequest;
use App\Http\Requests\Payment\ToPaymentRequest;
use App\Http\Requests\Search\SearchContractRequest;
use App\Models\rentContract;
use App\Models\toPayment;
use App\Repositories\Interfaces\ContractRepositoryInterface;
use App\Repositories\Interfaces\PaymentRepositoryInterface;
use App\Repositories\Interfaces\ToPaymentRepositoryInterface;
use Carbon\CarbonPeriod;


Class ContractService{
    private $contractRep,$toPaymentRep,$paymentRep,$contractModel,$toPaymentModel;

    function __construct(
        ContractRepositoryInterface $contractRep,
        ToPaymentRepositoryInterface $toPaymentRep,
        rentContract $contractModel,
        toPayment $toPaymentModel,
        PaymentRepositoryInterface $paymentRep
    ){
        $this->contractRep = $contractRep;
        $this->toPaymentRep = $toPaymentRep;
        $this->contractModel = $contractModel;
        $this->toPaymentModel = $toPaymentModel;
        $this->paymentRep = $paymentRep;
    }

    public function getContracts(CarbonPeriod $periodDate,$typeId)
    {
            if ($typeId){
                $currentTypeObj = $this->contractRep->getContractType($typeId);
            } else {
                $currentTypeObj = $this->contractRep->getContractTypeFirst();
            }

            $contractTypesObj = $this->contractRep->getContractTypes();
            $contractsObj = $this->contractRep->getContracts($currentTypeObj->id);

            $contractsObj->each(function ($item,$key){
                $contractToPayments = $this->toPaymentRep->getToPaymentsParentByContract($item->id);
                $item->balance = 0;
                $item->depositBalance = 0;
                foreach($contractToPayments as $toPayment){
                    if ($toPayment->eventsId !=config('rentEvent.eventDeposit')){
                        $item->balance += $toPayment->paymentsPaymentSum - $toPayment->paymentsSum;
                    } else {
                        $item->depositBalance += $toPayment->paymentsPaymentSum;
                    }
                }
                
                
//                $contractToPaymentSum = $contractToPayments->sum('paymentsSum');
//
//                $contractPayments = $this->paymentRep->getPaymentsByContract($item->id);
//                $contractPaymentSum = $contractPayments->sum('payment');
//                
//                $item->balance = $contractPaymentSum - $contractToPaymentSum;
                
            });


            $contractsCollect = collect(['contractTypes'=>$contractTypesObj,'contracts'=>$contractsObj,'currentContractType'=>$currentTypeObj]);
        return $contractsCollect;
    }

    public function getContract($id): rentContract
    {
        return $this->contractRep->getContract($id);
    }

    public function addContract(ContractRequest $contractData)
    {
        if ($contractData->get('id')){
            $this->contractModel = $this->contractModel->find($contractData->get('id'));
        }

        $this->contractModel->start = $contractData->get('start');
        $this->contractModel->finish = $contractData->get('finish');
        $this->contractModel->finishFact = $contractData->get('finishFact');
        $this->contractModel->number = $contractData->get('number');
        $this->contractModel->comment = $contractData->get('comment');
        $this->contractModel->typeId = $contractData->get('typeId');
        $this->contractModel->carGroupId = $contractData->get('carGroupId');
        $this->contractModel->carId = $contractData->get('carId');
        $this->contractModel->statusId = $contractData->get('statusId');
        $this->contractModel->price = $contractData->get('price');
        $this->contractModel->subjectIdFrom = $contractData->get('subjectIdFrom');
        $this->contractModel->subjectIdTo = $contractData->get('subjectIdTo');

        $this->contractModel->save();
        return $this->contractModel;
    }


    public function getContractTypes()
    {
        return $this->contractRep->getContractTypes();
    }

    public function addContractType()
    {

    }

    public function getContractDirectory()
    {
    $orderCollection = collect([
        'type' => $this->contractRep->getContractTypes(),
        'status' => $this->contractRep->getContractStatuses(),
    ]);

    return $orderCollection;
    }


    public function getLastContracts(Filters\ToPaymentRequest $requestData,$kol)
    {
        return $this->contractRep->getLastContracts($kol);
    }


    public function  addContractToPayment(ToPaymentRequest $toPayment)
    {
        $this->toPaymentModel->sum = $toPayment->get('sum');
        $this->toPaymentModel->contractId = $toPayment->get('contractId');
        $this->toPaymentModel->comment = $toPayment->get('comment');
        $this->toPaymentRep->addToPayment($this->toPaymentModel);
    }


    public function search(SearchContractRequest $searchContractObj)
    {
        return $this->contractRep->search($searchContractObj);
    }


    public function getContractByTimeSheet($timesheet)
    {

    }


    public function contractPriceReCount($contractId)
    {

    }


    function getContractByCarIdDate($carId,$date) 
    {
        
    }
    
    
    
}
