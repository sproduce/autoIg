<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PrintDocumentService;
use App\Services\PhotoService;
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
    
    
    public function document10() 
    {
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('/var/www/crm/storage/app/test.docx');
        
        $variables = $templateProcessor->getVariables();
        var_dump($variables);
        $templateProcessor->setValue('brand','testBrand');   
        $templateProcessor->setValue('model','testModel');   
        
        $templateProcessor->setValue('model1','testModel'); 
        
        
        $templateProcessor->saveAs('/tmp/list.docx');
        echo "test";
        //return view('printDocument.document10');
        
    }
}
