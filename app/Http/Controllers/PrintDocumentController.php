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
        if ($this->request->file('file')){
            $photoServ->deleteFiles($printDocumentObj->uuid);
            $photoServ->savePhoto($this->request->file('file'), $printDocumentObj->uuid);
        }
            
        
        return redirect()->back();
    }
    
    
    
    public function printDocumentDialog() 
    {
        $printDocumentObjs = \App\Models\printDocument::all();
        $contractId = $this->request->get('contractId');
        return view('dialog.PrintDocument.select',['printDocuments' => $printDocumentObjs, 'contractId' => $contractId]);
        
    }
    
    
    public function generation($documentId,PrintDocumentService $printDocumentServ,PhotoService $photoServ, ContractService $contractServ) 
    {
        
        $printDocumentObj = $printDocumentServ->getPrintDocument($documentId);
        //var_dump($this->request->get('value'));
        $fileName = $printDocumentServ->contractPrintDocument($printDocumentObj, $this->request->get('value'));
        $contractObj = $contractServ->getContract($this->request->get('contractId'));
        $newFileName = $contractObj->start->format('d-m-y').$printDocumentObj->nickname.$contractObj->subjectTo->surname.$contractObj->car->nickName.'.docx';
        
        $fileObj = new \Illuminate\Http\UploadedFile($fileName, $newFileName,"application/vnd.openxmlformats-officedocument.wordprocessingml.document",null,true);
//        var_dump($fileObj);
//        exit();
//        echo $fileObj->get();
        $photoServ->savePhoto($fileObj, $contractObj->uuid);
        return response()->download($fileName,$newFileName);
    }
    
    
    public function prepare($documentId,PrintDocumentService $printDocumentServ, ContractService $contractServ) 
    {
        $variableConfig = config('printDocument.variable');
        $printDocumentObj = $printDocumentServ->getPrintDocument($documentId);
        $contractObj = $contractServ->getContract($this->request->get('contractId'));
        $variableArray = $printDocumentServ->contractPrepareDocument($printDocumentObj, $contractObj);
        //$fileName = $printDocumentServ->contractPrintDocument($printDocumentObj, $contractObj);
        return view('printDocument.prepare',[
            'variableArray' => $variableArray,
            'documentId' => $printDocumentObj->id,
            'contractId' => $contractObj->id,
            'variableConfig' => $variableConfig,
            
                ]);
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
