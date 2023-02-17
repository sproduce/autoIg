<?php

namespace App\Repositories\Interfaces;

use App\Models\rentDocumentPassport;
use App\Models\rentDocumentPayment;
use App\Models\rentDocumentLicense;
use App\Models\rentDocumentEntity;
use App\Models\rentDocumentContact;

interface DocumentRepositoryInterface
{
    
    public function getPassport($passportId): rentDocumentPassport;
    public function eraseActualPassport($linkUuid);
    
    public function getPayment($paymentId): rentDocumentPayment;
    public function eraseActualPayment($linkUuid);
    
    public function getLicense($licenseId): rentDocumentLicense;
    public function eraseActualLicense($linkUuid);
    
    public function getEntity($entityId): rentDocumentEntity;
    public function eraseActualEntity($linkUuid);

    public function getContact($contactId): rentDocumentContact;
    public function eraseActualContact($linkUuid);
    
}
