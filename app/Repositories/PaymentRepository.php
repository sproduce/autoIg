<?php

namespace App\Repositories;
use App\Models\rentCarGroup;
use App\Models\rentPayment;
use App\Models\toPayment;
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
        $resultOperationTypes = payOperationType::orderBy('name')->get();

        return $resultOperationTypes;
    }

    public function getPayment($id): rentPayment
    {
        return rentPayment::find($id) ?? new rentPayment();
    }

    public function getPayments($validateFilter)
    {
        $start = $validateFilter['filterStart'];
        $finish = $validateFilter['filterFinish'];
        $finish = date('Y-m-d', strtotime($finish . ' +1 day'));
        $query = rentPayment::query();

        if ($validateFilter['typeId']){
            $query->where('payOperationTypeId','=',$validateFilter['typeId']);
        }

        if ($validateFilter['accountId']){
            $query->where('payAccountId','=',$validateFilter['accountId']);
        }

        return $query->where('dateTime','>',$start)->where('dateTime','<',$finish)->orderByDesc('dateTime')->orderByDesc('id')->get();
    }

    public function getPaymentsAll()
    {
        return rentPayment::all();
    }


    public function addPayment(rentPayment $paymentModel): rentPayment
    {
        $paymentModel->save();
        return $paymentModel;
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

    public function getPaymentsByContract($contractId)
    {
        return rentPayment::where('contractId',$contractId)->orderByDesc('dateTime')->get();
    }


}

