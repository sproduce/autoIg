<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrintDocumentController extends Controller
{
    
    public function document1() 
    {
        return view('printDocument.document1');
    }
    
    public function document2() 
    {
        return view('printDocument.document2');
    }
    public function document3() 
    {
        return view('printDocument.document3');
    }
    public function document4() 
    {
        return view('printDocument.document4');
    }
    public function document5() 
    {
        return view('printDocument.document5');
    }
    public function document6() 
    {
        return view('printDocument.document6');
    }
    public function document7() 
    {
        return view('printDocument.document7');
    }
    public function document8() 
    {
        return view('printDocument.document8');
    }
    public function document9() 
    {
        return view('printDocument.document9');
    }
    
    
    
    public function document10() 
    {
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('test.docx');
        
        $templateProcessor->setValue('brand','testBrand');   
        $templateProcessor->setValue('model','testModel');   
        
        $templateProcessor->setValue('model1','testModel'); 
        
        
        $templateProcessor->saveAs('/tmp/list.docx');
        echo "test";
        //return view('printDocument.document10');
        
    }
}
