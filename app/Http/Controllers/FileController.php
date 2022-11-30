<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PhotoService;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    private $fileServ;
    
    function __construct(PhotoService $fileServ)
    {
        $this->fileServ = $fileServ;
    }
    
    public function showFile($fileId) 
    {
       $photoObj = $this->fileServ->getFile($fileId);
       $header = "Content-Type: ".$photoObj->fileType;
       header($header);
       return response()->file(Storage::disk('photo')->path($photoObj->getFilePath()));
    }
    
    
    public function downloadFile($fileId) 
    {
        $photoObj = $this->fileServ->getFile($fileId);
        return response()->download(Storage::disk('photo')->path($photoObj->getFilePath()));
    }
    
}
