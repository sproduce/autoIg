<?php
namespace App\Services;
use App\Repositories\Interfaces\PaymentRepositoryInterface;
use Illuminate\Http\Request;

Class PaymentService{
    private $paymentRep,$request;

    function __construct(PaymentRepositoryInterface $paymentRep,Request $request)
    {
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
        $accountsObj=$this->paymentRep->getAccounts();
        $operationTypesObj=$this->paymentRep->getOperationTypes();
        $paymentGuide=collect(['accounts'=>$accountsObj,'operationTypes'=>$operationTypesObj]);

        return $paymentGuide;
    }

    public function addPayment()
    {
        $validate=$this->request->validate(['dateTime'=>'required',
            'payment'=>'required|integer',
            'comm'=>'required|integer',
            'payAccountId'=>'required|integer',
            'payOperationTypeId'=>'required|integer',
            'name'=>'',
            'carId'=>'',
            'finished'=>'',
            'pid'=>'integer',
            'comment'=>'',
            'contractId'=>''
        ]);
        var_dump($validate);
        $validate['pid']=$validate['pid'] ?? 0;

        $this->paymentRep->addPayment($validate);
    }

    public function getPayments()
    {
        $validateDate=$this->request->validate(['filterStart'=>'date','filterFinish'=>'date','typeId'=>'','accountId'=>'']);
        $validateDate['typeId']=$validateDate['typeId']??0;
        $validateDate['accountId']=$validateDate['accountId']??0;
        if (!(isset($validateDate['filterStart'])&&isset($validateDate['filterFinish']))){
            $date = new \DateTime();
            $validateDate['filterFinish']=$date->format('Y-m-d');
            $date->modify('-1 month');
            $validateDate['filterStart']=$date->format('Y-m-d');
        }


        $payments=$this->paymentRep->getPayments($validateDate['filterStart'],$validateDate['filterFinish']);
        $paymentsObj=collect(['filters'=>$validateDate,
                                'payments'=>$payments,
                            'types'=>$this->paymentRep->getOperationTypes(),
                            'accounts'=>$this->paymentRep->getAccounts()
            ]);
        return $paymentsObj;

    }

    public function getPayment()
    {
        $validate=$this->request->validate(['paymentId'=>'required|integer']);
        return $this->paymentRep->getPayment($validate['paymentId']);
    }


    public function updatePayment()
    {
        $validate=$this->request->validate(['dateTime'=>'required',
            'payment'=>'required|integer',
            'comm'=>'required|integer',
            'payAccountId'=>'required|integer',
            'payOperationTypeId'=>'required|integer',
            'name'=>'']);
        $validateId=$this->request->validate(['id'=>'required|integer']);

        $this->paymentRep->updatePayment($validateId['id'],$validate);
    }

    public function deletePayment()
    {
        $validateId=$this->request->validate(['paymentId'=>'required|integer']);
        $this->paymentRep->delPayment($validateId['paymentId']);
    }




}
