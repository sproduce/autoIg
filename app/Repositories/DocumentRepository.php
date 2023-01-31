<?php

namespace App\Repositories;
use App\Repositories\Interfaces\DocumentRepositoryInterface;

use App\Models\rentDocumentPassport;
use App\Models\rentDocumentPayment;
use App\Models\rentDocumentLicense;



class DocumentRepository implements DocumentRepositoryInterface
{

    public function getPassport($passportId): rentDocumentPassport
    {
        return rentDocumentPassport::find($passportId) ?? new rentDocumentPassport;
    }
    
    public function getPayment($paymentId): rentDocumentPayment
    {
        return rentDocumentPayment::find($paymentId) ?? new rentDocumentPayment;
    }
    
    public function getLicense($licenseId): rentDocumentLicense
    {
        return rentDocumentLicense::find($licenseId) ?? new rentDocumentLicense;
    }
    
    
}
