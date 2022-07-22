<?php
namespace App\Services;
use App\Http\Requests\CopyToPayRequest;
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
        if (!$paymentModel->id) {
            $paymentModel->balance = $paymentModel->payment;
            $this->paymentRep->addPayment($paymentModel);
            $paymentModel->pid = $paymentModel->id;
        }
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

    public function getPayment($paymentId): rentPayment
    {
        return $this->paymentRep->getPayment($paymentId);
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


    public function copyToPayment(CopyToPayRequest $copyToPayRequest)
    {
        $toPaymentObj = $this->toPaymentRep->getToPayment($copyToPayRequest->get('toPaymentId'));
        $newToPayment = $toPaymentObj->replicate();
        $newToPayment->contractId = $copyToPayRequest->get('contractId');
        $newToPayment->sum = $copyToPayRequest->get('sum');
        $newToPayment->comment = $copyToPayRequest->get('comment');
        $this->toPaymentRep->addToPayment($newToPayment);

    }


    public function addToPayment($dataArray)
    {

        $dataArray['sum'] = abs($dataArray['sum'])*-1;
        $this->toPaymentRep->addToPayment($dataArray);
    }


    public function getToPaymentsByPayment(rentPayment $rentPayment)
    {
        $toPaymentsObj = $this->toPaymentRep->getToPaymentsByAllocatePayment($rentPayment);

        return $toPaymentsObj;
    }



    public function saveAllocatePayment($toPaymentIdArray,$toPaymentSumArray,$paymentId)
    {
        //exit();
        $toPaymentObjArray = array();
        $paymentObj = $this->paymentRep->getPayment($paymentId);
        $maxPay = array_sum($toPaymentSumArray);

        if (abs($maxPay) <= abs($paymentObj->balance) && $maxPay * $paymentObj->balance >= 0){

            foreach($toPaymentIdArray as $key => $toPayment){
                $toPaymentObj = $this->toPaymentRep->getToPayment($toPayment);
                echo $toPaymentObj->sum."  ".$toPaymentSumArray[$key];
                if (abs($toPaymentObj->sum) > abs($toPaymentSumArray[$key]) && $toPaymentObj->sum * $toPaymentSumArray[$key] >0){
                    $newToPayment = $toPaymentObj->replicate();
                    $newToPayment->sum = $toPaymentSumArray[$key];
                    $newToPayment->paymentSum = $toPaymentSumArray[$key];
                    $newToPayment->paymentId = $paymentId;
                    $toPaymentObj->paymentSum = $toPaymentObj->paymentSum + $toPaymentSumArray[$key];
                    $toPaymentObjArray[] = $toPaymentObj;
                    $toPaymentObjArray[] = $newToPayment;
                }

                if ($toPaymentObj->sum == $toPaymentSumArray[$key]) {
                    $toPaymentObj->paymentId = $paymentId;
                    $toPaymentObj->paymentSum = $toPaymentObj->sum;
                    $toPaymentObjArray[] = $toPaymentObj;
                }
            }

               foreach($toPaymentObjArray as $toPaymentObj){
                   $this->toPaymentRep->addToPayment($toPaymentObj);
               }

            $paymentObj->balance = $paymentObj->balance - $maxPay;
            $this->paymentRep->addPayment($paymentObj);
        }


    }

//        $allocateSum=0;
//        foreach($toPaymentArray as $toPayment)
//        {
//            $toPaymentObj = $this->toPaymentRep->getToPayment($toPayment);
//            $toPaymentObj->paymentId = $paymentObj->id;
//            $this->toPaymentRep->addToPayment($toPaymentObj);
//            $allocateSum = $allocateSum+$toPaymentObj->sum;
//        }
//        $paymentObj->balance = $paymentObj->balance-$allocateSum;
//        $this->paymentRep->addPayment($paymentObj);



    public function allocatePaymentErase($paymentId)
    {
        $paymentObj = $this->paymentRep->getPayment($paymentId);
        $paymentObj->balance = $paymentObj->payment;
        $this->paymentRep->addPayment($paymentObj);

        $toPayments = $this->toPaymentRep->getToPaymentsByPayment($paymentObj);
        foreach ($toPayments as $toPayment){
            $parentToPayment = $this->toPaymentRep->getToPayment($toPayment->pId);
            $parentToPayment->paymentSum -= $toPayment->paymentSum;
            $parentToPayment->paymentId = null;
            $this->toPaymentRep->addToPayment($parentToPayment);
            if ($toPayment->id != $toPayment->pId){
                $this->toPaymentRep->delToPayment($toPayment);
            }
        }






    }




}
