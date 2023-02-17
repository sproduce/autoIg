<?php

namespace App\Repositories;
use App\Repositories\Interfaces\DocumentRepositoryInterface;

use App\Models\rentDocumentPassport;
use App\Models\rentDocumentPayment;
use App\Models\rentDocumentLicense;
use App\Models\rentDocumentEntity;
use App\Models\rentDocumentContact;


class DocumentRepository implements DocumentRepositoryInterface
{

    public function getPassport($passportId): rentDocumentPassport
    {
        return rentDocumentPassport::find($passportId) ?? new rentDocumentPassport;
    }
    
    
    public function eraseActualPassport($linkUuid)
    {
        rentDocumentPassport::where('linkUuid',$linkUuid)->update(['actual' => null]);
    }
    
    
    
    public function getPayment($paymentId): rentDocumentPayment
    {
        return rentDocumentPayment::find($paymentId) ?? new rentDocumentPayment;
    }
    
    public function eraseActualPayment($linkUuid)
    {
        rentDocumentPayment::where('linkUuid',$linkUuid)->update(['actual' => null]);
    }
    
    
    
    public function getLicense($licenseId): rentDocumentLicense
    {
        return rentDocumentLicense::find($licenseId) ?? new rentDocumentLicense;
    }
    
    public function eraseActualLicense($linkUuid)
    {
        rentDocumentLicense::where('linkUuid',$linkUuid)->update(['actual' => null]);
    }
    
    
    
    public function getEntity($entityId): rentDocumentEntity
    {
        return rentDocumentEntity::find($entityId) ?? new rentDocumentEntity;
    }
    
    public function eraseActualEntity($linkUuid)
    {
        rentDocumentEntity::where('linkUuid',$linkUuid)->update(['actual' => null]);
    }
    
    
    
    
    public function getContact($contactId): rentDocumentContact
    {
        return rentDocumentContact::find($contactId) ?? new rentDocumentContact;
    }
    
    
    
    public function eraseActualContact($linkUuid)
    {
        rentDocumentContact::where('linkUuid',$linkUuid)->update(['actual' => null]);
    }
    
}
