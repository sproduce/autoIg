<?php

namespace App\Repositories\Interfaces;


interface PaymentRepositoryInterface
{
    public function getAccounts();
    public function getAccount($id);

    public function getOperationTypes();
    public function getOperationType($id);

    public function getPayment($id);
    public function getPayments($start,$finish);
    public function getPaymentsAll();
    public function addPayment($paymentArray);
    public function updatePayment($id,$paymentArray);
    public function delPayment($id);

}
