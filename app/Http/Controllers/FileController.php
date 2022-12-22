<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PhotoService;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    private $fileServ,$request;
    
    function __construct(PhotoService $fileServ,Request $request)
    {
        $this->fileServ = $fileServ;
        $this->request = $request;
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
    
    
    
    public function fileInfoDialog($uuid) 
    {
        $filesObj = $this->fileServ->getFiles($uuid);
        
        return view('dialog.File.info',['filesObj' => $filesObj,'uuid' => $uuid]);
    }
    
    
    
    public function delfiles($uuid,$fileId) 
    {
        
    }
    
    
    public function addFiles($uuid) 
    {
        if ($this->request->file('file')&&$uuid)
        {
            $this->fileServ->savePhoto($this->request->file('file'), $uuid);
        }
        return redirect()->back();
    }
    
    
}
