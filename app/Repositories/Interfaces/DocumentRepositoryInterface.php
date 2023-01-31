<?php

namespace App\Repositories\Interfaces;

use App\Models\rentDocumentPassport;
use App\Models\rentDocumentPayment;
use App\Models\rentDocumentLicense;


interface DocumentRepositoryInterface
{
    
    public function getPassport($passportId): rentDocumentPassport;
    public function getPayment($paymentId): rentDocumentPayment;
    public function getLicense($licenseId): rentDocumentLicense;
    
    
}
