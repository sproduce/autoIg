<?php

namespace App\Repositories\Interfaces;




use App\Models\rentPayment;
use App\Models\toPayment;
use Carbon\CarbonPeriod;
use Illuminate\Support\Collection;


interface ToPaymentRepositoryInterface
{
    public function getToPaymentsByDate(CarbonPeriod $datePeriod);
    public function getToPaymentsByContract($contractId): Collection;
    public function getAllocateToPaymentSum(rentPayment $paymentObj);

    public function delAllocateToPayment(rentPayment $paymentObj);


    public function getToPaymentsByOperationType();
    public function getToPayment($toPaymentId): toPayment;

    public function getToPaymentByTimeSheet($timeSheetId): toPayment;
    public function getToPayments();

    public function addToPayment(toPayment $toPaymentObj): toPayment;

    public function delToPayment(toPayment $toPayment);

    public function getToPaymentsByAllocatePayment(rentPayment $rentPayment);

    public function delChildToPayment(toPayment $toPayment);


    public function getToPaymentsParentByPayment(rentPayment $paymentObj);

    public function getToPaymentsByPayment(rentPayment $paymentObj);
}
