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
    
    
    public function actualPassport($passportId) 
    {
        $passportObj = $this->documentRep->getPassport($passportId);
        $this->documentRep->eraseActualPassport($passportObj->linkUuid);
        $passportObj->actual = 1;
        $passportObj->save();
    }
    
    
    public function actualPayment($paymentId) 
    {
        $paymentObj = $this->documentRep->getPayment($paymentId);
        $this->documentRep->eraseActualPayment($paymentObj->linkUuid);
        $paymentObj->actual = 1;
        $paymentObj->save();
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
    
    
    public function actualEntity($entityId) 
    {
        $entityObj = $this->documentRep->getEntity($entityId);
        $this->documentRep->eraseActualEntity($entityObj->linkUuid);
        $entityObj->actual = 1;
        $entityObj->save();
    }
    
    
    
    public function getLicense($licenseId) 
    {
        $licenseObj = $this->documentRep->getLicense($licenseId);
        return $licenseObj;
    }
    
      public function actualLicense($licenseId) 
    {
        $licenseObj = $this->documentRep->getLicense($licenseId);
        $this->documentRep->eraseActualLicense($licenseObj->linkUuid);
        $licenseObj->actual = 1;
        $licenseObj->save();
    }
    
}