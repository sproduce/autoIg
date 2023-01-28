<?php

namespace App\Repositories;
use App\Repositories\Interfaces\DocumentRepositoryInterface;

use App\Models\rentDocumentPassport;
use App\Models\rentDocumentPayment;

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
    
}
