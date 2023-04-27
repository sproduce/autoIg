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
       $header[0] = "Content-Type: ".$photoObj->fileType;
       $header[1] = "Content-Disposition: inline; filename= \"".$photoObj->fileName."\"";
       //echo $photoObj->fileName();
       //exit();
       //header($header);
       return response()->file(Storage::disk('photo')->path($photoObj->getFilePath()),$header);
    }
    
    
    public function downloadFile($fileId) 
    {
        $photoObj = $this->fileServ->getFile($fileId);
        
        return response()->download(Storage::disk('photo')->path($photoObj->getFilePath()),$photoObj->fileName);
    }
    
    
    
    public function downloadFileLink($fileLinkId) 
    {
        $fileLinkObj = $this->fileServ->getFileLink($fileLinkId);
        $photoObj = $this->fileServ->getFile($fileLinkObj->photoId);
        
        return response()->download(Storage::disk('photo')->path($photoObj->getFilePath()),$photoObj->fileName);
    }
    
    
    
    public function fileInfoDialog($uuid) 
    {
        $filesObj = $this->fileServ->getFiles($uuid);
        
        return view('dialog.File.info',['filesObj' => $filesObj,'uuid' => $uuid]);
    }
    
    
    
    public function delfile($uuid,$fileId) 
    {
        
        $this->fileServ->deleteFile($uuid, $fileId);
        
        return redirect()->back();
    }
    
    
    public function addFiles($uuid) 
    {
        if ($this->request->file('file')&&$uuid)
        {
            $this->fileServ->savePhoto($this->request->file('file'), $uuid);
        }
        return redirect()->back();
    }
    
    
    public function notUsedFileList()
    {
        ;
    }
    
    
    
    
    
    
}
