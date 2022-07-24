<?php

namespace App\Http\Controllers;

use App\Http\Requests\AllocatePaymentRequest;
use App\Http\Requests\CopyToPayRequest;
use App\Http\Requests\DateSpan;
use App\Http\Requests\PaymentRequest;
use App\Http\Requests\Filters\ToPaymentRequest;
use App\Models\rentPayment;
use App\Repositories\Interfaces\MotorPoolRepositoryInterface;
use App\Repositories\ToPaymentRepository;
use App\Services\ContractService;
use App\Services\PaymentService;
use App\Services\MotorPoolService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    private $paymentServ,$request;

    function __construct(Request $request,PaymentService $paymentServ)
    {
        $this->request=$request;
        $this->paymentServ = $paymentServ;
    }


    public function show()
    {
        $paymentsObj = $this->paymentServ->getPayments();
        return view('payment.paymentList',['paymentsObj'=>$paymentsObj]);
    }

    public function addDialog()
    {
        $paymentObj = new rentPayment();

        $paymentGuideObj=$this->paymentServ->getPaymentGuide();
        return view('payment.addPayment',['paymentGuide' => $paymentGuideObj ,'paymentObj' => $paymentObj]);
    }

    public function edit($paymentId)
    {
        $paymentGuideObj = $this->paymentServ->getPaymentGuide();
        $paymentObj = $this->paymentServ->getPayment($paymentId);
        return view('payment.addPayment',['paymentGuide' => $paymentGuideObj ,'paymentObj' => $paymentObj]);
    }

    public function add(PaymentRequest $paymentReq)
    {
        $paymentModel = $this->paymentServ->getPayment($paymentReq->get('id'));
        $paymentModel->dateTime = $paymentReq->get('dateTime');
        $paymentModel->payment = $paymentReq->get('payment');
        $paymentModel->comm = $paymentReq->get('comm');
        $paymentModel->payAccountId = $paymentReq->get('payAccountId');
        $paymentModel->payOperationTypeId = $paymentReq->get('payOperationTypeId');
        $paymentModel->contractId = $paymentReq->get('contractId');
        $paymentModel->subjectId = $paymentReq->get('subjectId');
        $paymentModel->carId = $paymentReq->get('carId');
        $paymentModel->carGroupId = $paymentReq->get('carGroupId');
        $paymentModel->contractId = $paymentReq->get('contractId');

        $this->paymentServ->addPayment($paymentModel);

        if ($paymentReq->get('isNext')){
            return  redirect()->back();
        } else {
            return redirect('/payment/list');
        }

    }


    public function delete()
    {
        $this->paymentServ->deletePayment();
        return redirect('/payment/list');
    }


    public function addCarDialog(MotorPoolService $motorPoolServ)
    {
        $carsObj=$motorPoolServ->getLastCars(7);
        return view('dialog.Payment.addCar',['cars'=>$carsObj]);
    }

    public function addCarGroupDialog()
    {

    }


    public function addContractDialog(ContractService $contractServ)
    {
        $contractsObj=$contractServ->getLastContracts(7);
        return view('dialog.Payment.addContract',['contracts'=>$contractsObj]);
    }



    public function listByContract()
    {
        $paymentsObj = $this->paymentServ->getPaymentsByContract();
        return view('payment.paymentByContractList',['payments'=>$paymentsObj]);
    }




    public function listToPays(DateSpan $dateSpan,ToPaymentRequest $toPaymentFilter)
    {
        $periodDate = $dateSpan->getCarbonPeriod();

        $toPaymentsCollect = $this->paymentServ->getToPayments($periodDate);


        return view('payment.toPay',[
            'toPayments' => $toPaymentsCollect,
            'periodDate' => $periodDate,
        ]);
    }


    public function copyToPayClientDialog(MotorPoolRepositoryInterface $motorPoolRep)
    {
        $validate=$this->request->validate(['toPayId'=>'required|integer']);
        $toPayDataCol = $this->paymentServ->getInfoToPayment($validate['toPayId'],$motorPoolRep);
        //$toPayDataCol->dump();
        return view('dialog.Payment.copyToPayClient',['toPayDataCol' => $toPayDataCol]);
    }

    public function addToPayDialog(MotorPoolRepositoryInterface $motorPoolRep)
    {
        $validate=$this->request->validate(['carId'=>'required|integer']);
        $carObj=$motorPoolRep->getCar($validate['carId']);
        return view('dialog.Payment.addToPay',['carObj' => $carObj]);
    }

    public function addToPay()
    {
        $validate=$this->request->validate([
            'sum' => 'required|integer',
            'carId' => 'required|integer',
            'comment' => '',
        ]);

        $validate['timeSheetId']=null;

        $this->paymentServ->addToPayment($validate);
        return redirect('/payment/toPay');
    }

    public function copyToPayClient(CopyToPayRequest $copyToPayRequest)
    {

        $this->paymentServ->copyToPayment($copyToPayRequest);

        return redirect('/payment/toPay');
    }


    public function allocatePayment($paymentId)
    {
        $paymentObj = $this->paymentServ->getPayment($paymentId);
        $toPaymentsObj = $this->paymentServ->getToPaymentsByPayment($paymentObj);
        //$toPaymentsObj->dd();
        return view('payment.allocatePayment',[
            'paymentObj' => $paymentObj,
            'toPaymentsObj' =>$toPaymentsObj,
            ]);
    }


    public function saveAllocatePayment(AllocatePaymentRequest $allocatePaymentRequest)
    {
        $toPaymentIdArray = $allocatePaymentRequest->get('toPaymentId');
        $toPaymentSumArray = $allocatePaymentRequest->get('toPaymentSum');
        $paymentId = $allocatePaymentRequest->get('paymentId');
        $this->paymentServ->saveAllocatePayment($toPaymentIdArray,$toPaymentSumArray,$paymentId);
        return  redirect()->back();
    }


    public function allocatePaymentErase($paymentId)
    {
        $this->paymentServ->allocatePaymentErase($paymentId);
        return  redirect()->back();
    }


}
