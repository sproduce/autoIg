<?php

namespace App\Repositories\Interfaces;




use Carbon\CarbonPeriod;

interface ToPaymentRepositoryInterface
{
    public function getToPaymentsByDate(CarbonPeriod $datePeriod);
    public function getToPaymentsByContract($contractId);
    public function getToPayment($toPaymentId);

    public function updateToPayment($id,$toPaymentArray);
    public function addToPayment($toPaymentArray);
    public function delToPayment($toPaymentId);

}
