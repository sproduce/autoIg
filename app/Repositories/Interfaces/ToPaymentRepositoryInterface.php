<?php

namespace App\Repositories\Interfaces;




use App\Models\toPayment;
use Carbon\CarbonPeriod;
use Illuminate\Support\Collection;


interface ToPaymentRepositoryInterface
{
    public function getToPaymentsByDate(CarbonPeriod $datePeriod);
    public function getToPaymentsByContract($contractId): Collection;

    public function getToPaymentsByOperationType();
    public function getToPayment($toPaymentId): toPayment;
    public function getToPayments();

    public function updateToPayment($id,$toPaymentArray);
    public function addToPayment(toPayment $toPaymentObj): toPayment;
    public function delToPayment($toPaymentId);

    public function getToPaymentsByContractAndOperationType($contractId,$operationTypeId);

}
