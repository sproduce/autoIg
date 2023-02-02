<?php
namespace App\Services;
use App\Repositories\Interfaces\DocumentRepositoryInterface;

Class DocumentService{

    private $documentRep;

    function __construct(DocumentRepositoryInterface $documentRep)
    {
        $this->documentRep = $documentRep;
    }

    
    
    public function getPassport($passportId) 
    {
        $passportObj = $this->documentRep->getPassport($passportId);
        return $passportObj;
    }
    
    
    public function getPayment($paymentId) 
    {
        $paymentObj = $this->documentRep->getPayment($paymentId);
        return $paymentObj;
    }
    
    
    public function getEntity($entityId) 
    {
        $entityObj = $this->documentRep->getEntity($entityId);
        return $entityObj;
    }
    
    public function getLicense($licenseId) 
    {
        $licenseObj = $this->documentRep->getLicense($licenseId);
        return $licenseObj;
    }
    
    
    
}