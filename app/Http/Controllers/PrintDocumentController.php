<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PrintDocumentService;
use App\Services\PhotoService;
use App\Services\TimeSheetService;
use App\Services\ContractService;
use App\Http\Requests\PrintDocumentRequest;


class PrintDocumentController extends Controller
{
    
    private $request;
    
    function __construct(Request $request)
    {
        $this->request = $request;
    }
    
    public function list() 
    {
        
        $printDocumentObjs = \App\Models\printDocument::all();
        
        return view('printDocument.list',['printDocuments' => $printDocumentObjs]);
    }
    
    
    public function addDialog($printDocumentId = null, PrintDocumentService $printDocumentServ) 
    {
        $printDocumentObj = $printDocumentServ->getPrintDocument($printDocumentId);
        return view('dialog.PrintDocument.add',['printDocument' => $printDocumentObj]);
    }
    
    
    public function store(PrintDocumentRequest $documentRequest,PrintDocumentService $printDocumentServ, PhotoService $photoServ) 
    {
        $printDocumentObj = $printDocumentServ->getPrintDocument($documentRequest->get('id'));
        $printDocumentObj->info = $documentRequest->get('info');
        $printDocumentObj->nickname = $documentRequest->get('nickname');
        $printDocumentObj->save();
        $photoServ->savePhoto($this->request->file('file'), $printDocumentObj->uuid);
        
        return redirect()->back();
    }
    
    
    
    public function printDocumentDialog() 
    {
        $printDocumentObjs = \App\Models\printDocument::all();
        $contractId = $this->request->get('contractId');
        return view('dialog.PrintDocument.select',['printDocuments' => $printDocumentObjs, 'contractId' => $contractId]);
        
    }
    
    
    public function generation($documentId,PrintDocumentService $printDocumentServ) 
    {
        $printDocumentObj = $printDocumentServ->getPrintDocument($documentId);
        //var_dump($this->request->get('value'));
        $fileName = $printDocumentServ->contractPrintDocument($printDocumentObj, $this->request->get('value'));
        
        return response()->download($fileName,$printDocumentObj->nickname.'.docx');
    }
    
    
    public function prepare($documentId,PrintDocumentService $printDocumentServ, ContractService $contractServ) 
    {
        $variable = config('printDocument.variable');
        $printDocumentObj = $printDocumentServ->getPrintDocument($documentId);
        $contractObj = $contractServ->getContract($this->request->get('contractId'));
        $variableArray = $printDocumentServ->contractPrepareDocument($printDocumentObj, $contractObj);
        //$fileName = $printDocumentServ->contractPrintDocument($printDocumentObj, $contractObj);
        return view('printDocument.prepare',['variableArray' => $variableArray,'documentId' => $printDocumentObj->id]);
    }
    
    
     
    public function variableInfoDialog() 
    {
        $variableArray = config('printDocument.variable');
        return view('dialog.PrintDocument.variableInfo',['variableArray' => $variableArray]);
    }
    
    
    public function deleteDocument($printDocumentId,PrintDocumentService $printDocumentServ) 
    {
        $printDocumentObj = $printDocumentServ->getPrintDocument($printDocumentId);
        $printDocumentObj->delete();
        return redirect()->back();
    }
    
    
}
