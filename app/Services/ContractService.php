<?php
namespace App\Services;
use App\Http\Requests\ContractRequest;
use App\Http\Requests\Payment\ToPaymentRequest;
use App\Models\rentContract;
use App\Models\toPayment;
use App\Repositories\Interfaces\ContractRepositoryInterface;
use Carbon\CarbonPeriod;


Class ContractService{
    private $contractRep,$contractModel,$toPaymentModel;

    function __construct(ContractRepositoryInterface $contractRep,rentContract $contractModel,toPayment $toPaymentModel)
    {
        $this->contractRep = $contractRep;
        $this->contractModel = $contractModel;
        $this->toPaymentModel = $toPaymentModel;
    }

    public function getContracts(CarbonPeriod $periodDate,$typeId)
    {
            if ($typeId){
                $currentTypeObj=$this->contractRep->getContractType($typeId);
            } else {
                $currentTypeObj=$this->contractRep->getContractTypeFirst();
            }

            $contractTypesObj=$this->contractRep->getContractTypes();
            $contractsObj=$this->contractRep->getContracts($currentTypeObj->id);

            $contractsCollect=collect(['contractTypes'=>$contractTypesObj,'contracts'=>$contractsObj,'currentContractType'=>$currentTypeObj]);
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
    $orderCollection=collect([
        'type'=>$this->contractRep->getContractTypes(),
        'status'=>$this->contractRep->getContractStatuses(),
    ]);

    return $orderCollection;
    }


    public function getLastContracts($kol)
    {
        return $this->contractRep->getLastContracts($kol);
    }


    public function  addContractToPayment(ToPaymentRequest $toPayment)
    {
        $this->toPaymentModel->sum = $toPayment->get('sum');
        $this->toPaymentModel->comment = $toPayment->get('comment');

    }


}
