<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DocumentController extends Controller
{
   
    public function addPassportDialog($uuid) 
    {
        return view('dialog.Document.addPassport');
    }
    
    
}
