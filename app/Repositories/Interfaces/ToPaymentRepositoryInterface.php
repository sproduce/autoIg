<?php

namespace App\Repositories\Interfaces;




use Carbon\CarbonPeriod;
use Illuminate\Support\Collection;


interface ToPaymentRepositoryInterface
{
    public function getToPaymentsByDate(CarbonPeriod $datePeriod);
    public function getToPaymentsByContract($contractId): Collection;
    public function getToPayment($toPaymentId);
    public function getToPayments();

    public function updateToPayment($id,$toPaymentArray);
    public function addToPayment($toPaymentArray);
    public function delToPayment($toPaymentId);

}
