<?php

namespace App\Repositories;

use App\Models\toPayment;
use App\Repositories\Interfaces\ToPaymentRepositoryInterface;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;


class ToPaymentRepository implements ToPaymentRepositoryInterface
{

    public function getToPaymentsByContract($contractId)
    {
        return toPayment::query()->where('contractId',$contractId)->get();
    }

    public function getToPayment($toPaymentId)
    {
        return toPayment::find($toPaymentId);
    }


    public function getToPaymentsByDate(CarbonPeriod $datePeriod)
    {
        $startDate=$datePeriod->getStartDate()->format('Y-m-d');
        $finishDate=$datePeriod->getEndDate()->addDay(1)->format('Y-m-d');

    }

    public function addToPayment($toPaymentArray)
    {
        return toPayment::create($toPaymentArray);
    }
    public function updateToPayment($id,$toPaymentArray)
    {
        toPayment::where('id',$id)->update($toPaymentArray);
    }
    public function delToPayment($toPaymentId)
    {
        $toPayment=toPayment::find($toPaymentId);
        $toPayment->delete();
    }

    public function getToPayments()
    {
        return toPayment::all();
    }
}

