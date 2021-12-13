<?php

namespace App\Http\Controllers;

use App\Services\ContractService;
use App\Services\PaymentService;
use App\Services\MotorPoolService;

class PaymentController extends Controller
{
    private $paymentServ;

    function __construct(PaymentService $paymentServ)
    {
        $this->paymentServ = $paymentServ;
    }


    public function show()
    {
        $paymentsObj=$this->paymentServ->getPayments();
        return view('payment.paymentList',['paymentsObj'=>$paymentsObj]);
    }

    public function addDialog()
    {

        $paymentGuideObj=$this->paymentServ->getPaymentGuide();
        return view('payment.addPayment',['paymentGuide'=>$paymentGuideObj]);
    }


    public function add()
    {
        $this->paymentServ->addPayment();

        return redirect('/payment/list');
    }


    public function edit()
    {
        $paymentGuideObj=$this->paymentServ->getPaymentGuide();
        $payment=$this->paymentServ->getPayment();
        return view('payment.editPayment',['paymentGuide'=>$paymentGuideObj,'payment'=>$payment]);
    }

    public function update()
    {
        $this->paymentServ->updatePayment();
        return redirect('/payment/list');
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
        $paymentsObj=$this->paymentServ->getPaymentsByContract();
        return view('payment.paymentByContractList',['payments'=>$paymentsObj]);
    }



}
