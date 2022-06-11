<?php
namespace App\Services;
use App\Models\rentPayment;
use App\Repositories\ContractRepository;
use App\Repositories\Interfaces\ContractRepositoryInterface;
use App\Repositories\Interfaces\MotorPoolRepositoryInterface;
use App\Repositories\Interfaces\PaymentRepositoryInterface;
use App\Repositories\Interfaces\ToPaymentRepositoryInterface;
use App\Repositories\ToPaymentRepository;
use Illuminate\Http\Request;

Class PaymentService{
    private $paymentRep,$request,$toPaymentRep,$contractRep;

    function __construct(
        Request $request,
        PaymentRepositoryInterface $paymentRep,
        ToPaymentRepositoryInterface $toPaymentRep,
        ContractRepositoryInterface $contractRep
    )
    {
        $this->toPaymentRep=$toPaymentRep;
        $this->contractRep=$contractRep;
        $this->paymentRep=$paymentRep;
        $this->request=$request;
    }

    public function getAccounts()
    {
        return $this->paymentRep->getAccounts();
    }

    public function getOperationTypes()
    {
        return $this->paymentRep->getOperationTypes();
    }

    public function getPaymentGuide()
    {
        $accountsObj = $this->paymentRep->getAccounts();
        $operationTypesObj = $this->paymentRep->getOperationTypes();
        $paymentGuide = collect(['accounts'=>$accountsObj,'operationTypes'=>$operationTypesObj]);

        return $paymentGuide;
    }

    public function addPayment(rentPayment $paymentModel)
    {
        $paymentModel->balance = $paymentModel->payment;
        $this->paymentRep->addPayment($paymentModel);

        $paymentModel->pid = $paymentModel->id;
        $this->paymentRep->addPayment($paymentModel);

    }

    public function getPayments()
    {
        $validateFilter=$this->request->validate(['filterStart'=>'date','filterFinish'=>'date','typeId'=>'','accountId'=>'']);
        $validateFilter['typeId']=$validateFilter['typeId']??0;
        $validateFilter['accountId']=$validateFilter['accountId']??0;
        if (!(isset($validateFilter['filterStart'])&&isset($validateFilter['filterFinish']))){
            $date = new \DateTime();
            $validateFilter['filterFinish']=$date->format('Y-m-d');
            $date->modify('-1 month');
            $validateFilter['filterStart']=$date->format('Y-m-d');
        }


        $payments=$this->paymentRep->getPayments($validateFilter);

        $paymentsObj=collect(['filters'=>$validateFilter,
                                'payments'=>$payments,
                            'types'=>$this->paymentRep->getOperationTypes(),
                            'accounts'=>$this->paymentRep->getAccounts()
            ]);
        return $paymentsObj;

    }

    public function getPayment($payment): rentPayment
    {
        return $this->paymentRep->getPayment($payment);
    }


    public function updatePayment()
    {
        $validate=$this->request->validate(['dateTime'=>'required',
            'payment'=>'required|integer',
            'comm'=>'required|integer',
            'payAccountId'=>'required|integer',
            'payOperationTypeId'=>'required|integer',
            'name'=>'',
            'carId'=>'',
            'carGroupId'=>'',
            'finished'=>'',
            'pid'=>'integer',
            'comment'=>'',
            'contractId'=>''
        ]);
        $validateId=$this->request->validate(['id'=>'required|integer']);

        $this->paymentRep->updatePayment($validateId['id'],$validate);
    }

    public function deletePayment()
    {
        $validateId=$this->request->validate(['paymentId'=>'required|integer']);
        $this->paymentRep->delPayment($validateId['paymentId']);
    }


    public function getPaymentsByContract()
    {
        $validateId=$this->request->validate(['contractId'=>'required|integer']);
        return $this->paymentRep->getPaymentsByContract($validateId['contractId']);
    }


    public function getInfoToPayment($toPaymentId,MotorPoolRepositoryInterface $motorPool)
    {
        $toPaymentObj = $this->toPaymentRep->getToPayment($toPaymentId);
        $toPaymentObj->sum = abs($toPaymentObj->sum);
        $contractsObj = $this->contractRep->getContractsByCarId($toPaymentObj->carId);
        $carObj = $motorPool->getCar($toPaymentObj->carId);
        $toPayDataCol = collect([
            'car' => $carObj,
            'contracts' => $contractsObj,
            'toPayment' => $toPaymentObj]);
        return $toPayDataCol;
    }


    public function addToPayment($dataArray)
    {
        $dataArray['sum'] = abs($dataArray['sum'])*-1;
        $this->toPaymentRep->addToPayment($dataArray);
    }


    public function getToPaymentsByPayment(rentPayment $rentPayment)
    {
        $toPaymentsObj = $this->toPaymentRep->getToPaymentsByContractAndOperationType($rentPayment->contractId,$rentPayment->payOperationTypeId);


        return $toPaymentsObj;
    }



}
