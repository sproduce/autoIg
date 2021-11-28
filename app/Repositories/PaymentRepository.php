<?php

namespace App\Repositories;
use App\Models\rentPayment;
use App\Repositories\Interfaces\PaymentRepositoryInterface;
use App\Models\payAccount;
use App\Models\payOperationType;


class PaymentRepository implements PaymentRepositoryInterface
{

    public function getAccount($id)
    {
        return payAccount::find($id);
    }

    public function getAccounts()
    {
        return payAccount::all();
    }

    public function getOperationType($id)
    {
        return payOperationType::find($id);
    }
    public function getOperationTypes()
    {
        return payOperationType::all();
    }

    public function getPayment($id)
    {
        return rentPayment::find($id);
    }

    public function getPayments($start,$finish)
    {

        return rentPayment::where('dateTime','>',$start)->where('dateTime','<=',$finish)->get();
    }

    public function getPaymentsAll()
    {
        return rentPayment::all();
    }


    public function addPayment($paymentArray)
    {
        return rentPayment::create($paymentArray);
    }

    public function updatePayment($id, $paymentArray)
    {
        rentPayment::where('id',$id)->update($paymentArray);
    }

    public function delPayment($id)
    {
        $payment=rentPayment::find($id);
        $payment->delete();
    }

}

