<?php

namespace App\Repositories\Interfaces;

use App\Models\rentDocumentPassport;
use App\Models\rentDocumentPayment;


interface DocumentRepositoryInterface
{
    
    public function getPassport($passportId): rentDocumentPassport;
    public function getPayment($paymentId): rentDocumentPayment;
    
    
    
}
