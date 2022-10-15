<?php

namespace App\Repositories;
use App\Models\rentCarGroup;
use App\Models\rentPayment;
use App\Models\toPayment;
use App\Http\Requests\Filters;
use App\Repositories\Interfaces\PaymentRepositoryInterface;
use App\Models\payAccount;
use App\Models\payOperationType;
use Carbon\CarbonPeriod;


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

    public function getPayments($filtersValue,CarbonPeriod $datePeriod)
    {
        $query = rentPayment::select('rent_payments.*','rent_car_groups.nickName')->leftJoin('rent_car_groups','rent_car_groups.id','=','rent_payments.carGroupId');
        $startDate = $datePeriod->getStartDate()->format('Y-m-d');
        $finishDate = $datePeriod->getEndDate()->addDay(1)->format('Y-m-d');

        if ($filtersValue['operationTypeId']){
            $query->where('payOperationTypeId','=',$filtersValue['operationTypeId']);
        }

        if ($filtersValue['accountId']){
            $query->where('payAccountId','=',$filtersValue['accountId']);
        }

        if ($filtersValue['carId']){
            $query->where('carId','=',$filtersValue['carId']);
        }

        if ($filtersValue['carGroupId']) {
            $query->where('carGroupId', '=', $filtersValue['carGroupId']);
        }

        if ($filtersValue['subjectId']) {
            $query->where('subjectId', '=', $filtersValue['subjectId']);
        }

        $query->where('dateTime','>',$startDate)->where('dateTime','<',$finishDate)->orderByDesc('dateTime')->orderByDesc('id');

        $resultPayments = $query->get();

        return $resultPayments;
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
        $payment = rentPayment::find($id);
        $payment->delete();
    }

    public function getPaymentsByContract($contractId)
    {
        return rentPayment::where('contractId',$contractId)->select('rent_payments.*')->selectRaw('rent_payments.payment-rent_payments.balance as remaind')->orderBy('dateTime')->get();
    }


    public function contractPriceReCount($contractId): int
    {
        return rentPayment::sum('payment')->where('contractId','=',$contractId);
    }

}

