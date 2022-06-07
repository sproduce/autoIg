<?php

namespace App\Repositories\Interfaces;


use App\Models\rentPayment;

interface PaymentRepositoryInterface
{
    public function getAccounts();
    public function getAccount($id);

    public function getOperationTypes();
    public function getOperationType($id);

    public function getPayment($id):rentPayment;
    public function getPayments($validateFilter);
    public function getPaymentsAll();
    public function addPayment(rentPayment $paymentmodel): rentPayment;
    public function updatePayment($id,$paymentArray);
    public function delPayment($id);

    public function getPaymentsByContract($contractId);

}
