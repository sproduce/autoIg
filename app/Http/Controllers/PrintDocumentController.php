<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrintDocumentController extends Controller
{
    
    public function document1() 
    {
        return view('printDocument.document1');
    }
    
    
}
