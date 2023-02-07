<?php

namespace App\Http\Controllers;
use App\Services\DocumentService;
use App\Http\Requests\Document;
//use Illuminate\Http\Request;

class DocumentController extends Controller
{
    
    private $documentServ;
    
    function __construct(DocumentService $documentServ)
    {
       $this->documentServ = $documentServ;
    }
   
    
    
    public function addPassportDialog(\App\Http\Requests\UuidRequest $uuidRequest,$passportId = null) 
    {
        $passportObj = $this->documentServ->getPassport($passportId);
        if (!$passportObj->id){
            $passportObj->linkUuid = $uuidRequest->get('uuid');
        }
        return view('dialog.Document.addPassport',['passportObj'=>$passportObj]);
    }
    
    public function actualPassport($passportId) 
    {
        $this->documentServ->actualPassport($passportId);
        return  redirect()->back();
    }
    
    
    public function storePassport(Document\PassportRequest $passportRequest) 
    {
        $passportObj = $this->documentServ->getPassport($passportRequest->get('id'));
        
        
        $passportObj->linkUuid = $passportRequest->get('linkUuid');
        $passportObj->number = $passportRequest->get('number');
        $passportObj->birthplace = $passportRequest->get('birthplace');
        $passportObj->dateIssued = $passportRequest->get('dateIssued');	
        $passportObj->issuedBy = $passportRequest->get('issuedBy');
        $passportObj->placeResidence = $passportRequest->get('placeResidence');
        $passportObj->dateResidence = $passportRequest->get('dateResidence');
        $passportObj->save();
        
        return  redirect()->back();
    }
    
    
    
    public function addLicenseDialog(\App\Http\Requests\UuidRequest $uuidRequest,$licenseId = null) 
    {
        $licenseObj = $this->documentServ->getLicense($licenseId);
        if (!$licenseObj->id){
            $licenseObj->linkUuid = $uuidRequest->get('uuid');
        }
        
        return view('dialog.Document.addLicense',['licenseObj' => $licenseObj]);
    }
    
    
    
    public function actualLicense($licenseId) 
    {
         $this->documentServ->actualLicense($licenseId);
        return  redirect()->back();
    }
    
    
    
    public function storeLicense(Document\LicenseRequest $licenseRequest) 
    {
        $licenseObj = $this->documentServ->getLicense($licenseRequest->get('id'));
        $licenseObj->linkUuid = $licenseRequest->get('linkUuid');
        $licenseObj->number = $licenseRequest->get('number');
        $licenseObj->city = $licenseRequest->get('city');
        $licenseObj->issuedBy = $licenseRequest->get('issuedBy');
        $licenseObj->start = $licenseRequest->get('start');
        $licenseObj->finish = $licenseRequest->get('finish');
        $licenseObj->categories = $licenseRequest->get('categories');
        
        $licenseObj->save();
        return  redirect()->back();
    }
    
    
    
    
     public function storePayment(Document\PaymentRequest $paymentRequest) 
     {
         $paymentObj = $this->documentServ->getPayment($paymentRequest->get('id'));
         
         $paymentObj->linkUuid = $paymentRequest->get('linkUuid');
         $paymentObj->checkingAccount = $paymentRequest->get('checkingAccount');
         $paymentObj->bankName = $paymentRequest->get('bankName');
         $paymentObj->bankInn = $paymentRequest->get('bankInn');
         $paymentObj->bankBik = $paymentRequest->get('bankBik');
         $paymentObj->correspondentAccount = $paymentRequest->get('correspondentAccount');
         $paymentObj->address = $paymentRequest->get('address');
         $paymentObj->name = $paymentRequest->get('name');
         $paymentObj->save();
         return  redirect()->back();
     }
    
    
    public function actualPayment($paymentId) 
    {
        $this->documentServ->actualPayment($paymentId);
        return  redirect()->back();
    }
    
    
    public function addPaymentDialog(\App\Http\Requests\UuidRequest $uuidRequest,$paymentId = null) 
    {
        $paymentObj = $this->documentServ->getPayment($paymentId);
        if (!$paymentObj->id){
            $paymentObj->linkUuid = $uuidRequest->get('uuid');
        }
        return view('dialog.Document.addPayment',['paymentObj' => $paymentObj]);
    }
    
    
    
    public function addEntityDialog(\App\Http\Requests\UuidRequest $uuidRequest,$entityId = null) 
    {
        $entityObj = $this->documentServ->getEntity($entityId);
        if (!$entityObj->id){
            $entityObj->linkUuid = $uuidRequest->get('uuid');
        }
        
        return view('dialog.Document.addEntity',['entityObj' => $entityObj]);
    }
    
    
    public function actualEntity($entityId) 
    {
        $this->documentServ->actualEntity($entityId);
        return  redirect()->back();
    }
    
    
    
    public function storeEntity(Document\EntityRequest $entityRequest) 
    {
        $entityObj = $this->documentServ->getEntity($entityRequest->get('id'));
        
        $entityObj->linkUuid = $entityRequest->get('linkUuid');
        $entityObj->fullName = $entityRequest->get('fullName');
        $entityObj->shortName = $entityRequest->get('shortName');
        $entityObj->englishName = $entityRequest->get('englishName');
        $entityObj->address = $entityRequest->get('address');
        $entityObj->mailingAddress = $entityRequest->get('mailingAddress');
        $entityObj->phone = $entityRequest->get('phone');
        $entityObj->ogrn = $entityRequest->get('ogrn');
        $entityObj->dateReg = $entityRequest->get('dateReg');
        $entityObj->nameReg = $entityRequest->get('nameReg');
        $entityObj->director = $entityRequest->get('director');
        $entityObj->accountant = $entityRequest->get('accountant');
        $entityObj->okved = $entityRequest->get('okved');
        $entityObj->okpo = $entityRequest->get('okpo');
        $entityObj->okato = $entityRequest->get('okato');
        $entityObj->okogu = $entityRequest->get('okogu');
        $entityObj->inn = $entityRequest->get('inn');
        $entityObj->oktmo = $entityRequest->get('oktmo');
        $entityObj->kpp = $entityRequest->get('kpp');
        $entityObj->save();
        return  redirect()->back();
    }
    
}
