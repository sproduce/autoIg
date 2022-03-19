<?php

namespace App\Http\Controllers;

use App\Http\Requests\DateSpan;
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

    public function listToPays(ToPaymentRepository $toPaymentRep,DateSpan $dateSpan)
    {
        $dateSpan->validated();
        $periodDate=$dateSpan->getCarbonPeriod();

        $toPaymentsCollect=$toPaymentRep->getToPaymentsByDate($periodDate);
        $grouped = $toPaymentsCollect->groupBy('nickname');
        //$grouped->dump();
        //$toPaymentsCollect->dump();
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

    public function copyToPayClient()
    {
        $validate=$this->request->validate([
            'contractId' => 'required|integer',
            'timeSheetId' => '',
            'sum' => 'required|integer',
            'carId' => 'required|integer',
            'comment' => '',
        ]);

        $this->paymentServ->addToPayment($validate);
        return redirect('/payment/toPay');
    }


}
