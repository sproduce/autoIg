<?php
namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Repositories\Interfaces\PhotoRepositoryInterface;




Class PhotoService
{
    private $photoRep;

    function __construct(PhotoRepositoryInterface $photoRep)
    {
        $this->photoRep=$photoRep;
    }

    private function getPathByHash($hash)
    {
        $dir1 = substr($hash,0,2);
        $dir2 = substr($hash,2,2);
        $path = '/'.$dir1.'/'.$dir2;
        return $path;
    }


    private function saveFile(UploadedFile $photo)
    {
        $hash = sha1($photo->get());
        $photoObj = $this->photoRep->getPhotoByHash($hash);
        if (!$photoObj){
            $extension = $photo->getClientOriginalExtension();
            $path = $this->getPathByHash($hash);
            Storage::disk('photo')->makeDirectory($path);
            
            $fileName = $photo->getClientOriginalName();
            $photo->storeAs($path,$hash.'.'.$extension,'photo');
            $fileType = Storage::disk('photo')->mimeType($path.'/'.$hash.'.'.$extension);
            //$photoPath = Storage::disk('photo')->path($path.'/'.$hash.'.'.$extension);
           
            $photoObj = $this->photoRep->addPhoto($hash,$fileName,$extension,$fileType);
        }
        return $photoObj;
    }

    
    private function setFilePath($fileObj)
    {
        $fileName = $this->getPathByHash($fileObj->photo).'/'.$fileObj->photo.'.'.$fileObj->fileExt;
        $fileObj->setFilePath($fileName);
        return $fileObj;
    }
    
    public function getFileContent($fileId) 
    {
        $fileObj = $this->photoRep->getPhoto($fileId);
        $fileObj = $this->setFilePath($fileObj);
        
    }
    
    
    

    public function savePhoto($fileObj,$uuid)
    {
        if (is_iterable($fileObj)){
            foreach($fileObj as $file){
                $photoObj = $this->saveFile($file);
                $this->photoRep->saveLink($photoObj->id,$uuid);
            }
        } else {
            $photoObj = $this->saveFile($fileObj);
            $this->photoRep->saveLink($photoObj->id,$uuid);
        }
    }



    public function getFiles($uuid) 
    {
        $filesObj = $this->photoRep->getFiles($uuid);
        if (isset($filesObj)){
            foreach($filesObj as $file){
                $file = $this->setFilePath($file);
            }
        }
        
        return $filesObj;
    }
    
    
    
    public function getFile($fileId) 
    {
        $fileObj = $this->photoRep->getPhoto($fileId);
        $fileObj = $this->setFilePath($fileObj);
        return $fileObj;
    }
    
    
    
    
    public function deleteFile($uuid,$fileId) 
    {
        $this->photoRep->deleteFile($uuid, $fileId);
    }
    
}
