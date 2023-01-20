<?php

namespace App\Http\Controllers;
use App\Services\DocumentService;
//use Illuminate\Http\Request;

class DocumentController extends Controller
{
    
    private $documentServ;
    
    function __construct(DocumentService $documentServ)
    {
       $this->documentServ = $documentServ;
    }
   
    
    
    
    
    
    public function addPassportDialog($uuid) 
    {
        
        
        return view('dialog.Document.addPassport',['filesObj' => $filesObj,'uuid' => $uuid]);
    }
    
    
    
    
    
    
    
    
    public function addPaymentDialog($uuid) 
    {
        return view('dialog.Document.addPayment');
    }
    
}
