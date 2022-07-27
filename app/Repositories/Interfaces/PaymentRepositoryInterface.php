<?php

namespace App\Repositories\Interfaces;


use App\Models\rentPayment;
use Carbon\CarbonPeriod;
use App\Http\Requests\Filters;


interface PaymentRepositoryInterface
{
    public function getAccounts();
    public function getAccount($id);

    public function getOperationTypes();
    public function getOperationType($id);

    public function getPayment($id): rentPayment;

    public function getPayments($filtersValue,CarbonPeriod $datePeriod);
    public function getPaymentsAll();
    public function addPayment(rentPayment $paymentmodel): rentPayment;
    public function updatePayment($id,$paymentArray);
    public function delPayment($id);

    public function getPaymentsByContract($contractId);

}
