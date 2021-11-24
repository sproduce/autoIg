<?php

namespace App\Http\Controllers;

use App\Services\PaymentService;


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
        return view('payment.paymentList',['payments'=>$paymentsObj]);
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


}
