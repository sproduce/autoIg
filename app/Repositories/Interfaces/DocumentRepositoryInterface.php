<?php

namespace App\Repositories\Interfaces;

use App\Models\rentDocumentPassport;
use App\Models\rentDocumentPayment;
use App\Models\rentDocumentLicense;
use App\Models\rentDocumentEntity;

interface DocumentRepositoryInterface
{
    
    public function getPassport($passportId): rentDocumentPassport;
    public function getPayment($paymentId): rentDocumentPayment;
    public function getLicense($licenseId): rentDocumentLicense;
    public function getEntity($entityId): rentDocumentEntity;

    
}
