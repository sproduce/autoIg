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
            $passportObj->uuid = $uuidRequest->get('uuid');
        }
        return view('dialog.Document.addPassport',['passportObj'=>$passportObj]);
    }
    
    
    
    
    public function storePassport(Document\PassportRequest $passportRequest) 
    {
        $passportObj = $this->documentServ->getPassport($passportRequest->get('id'));
        
        
        $passportObj->linkUuid = $passportRequest->get('uuid');
        $passportObj->number = $passportRequest->get('number');
        $passportObj->birthplace = $passportRequest->get('birthplace');
        $passportObj->dateIssued = $passportRequest->get('dateIssued');	
        $passportObj->issuedBy = $passportRequest->get('issuedBy');
        $passportObj->placeResidence = $passportRequest->get('placeResidence');
        $passportObj->dateResidence = $passportRequest->get('dateResidence');
        $passportObj->save();
        
        return  redirect()->back();
    }
    
    
    
    
    
    
    public function addPaymentDialog($uuid) 
    {
        return view('dialog.Document.addPayment');
    }
    
}
