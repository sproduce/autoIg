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


    private function saveFile(UploadedFile $photo){
        $hash = sha1($photo->get());
        $photoObj = $this->photoRep->getPhotoByHash($hash);
        if (!$photoObj){
            $path = $this->getPathByHash($hash);
            Storage::disk('photo')->makeDirectory($path);
            $extension = $photo->getClientOriginalExtension();
            $fileName = $photo->getClientOriginalName();
            $photo->storeAs($path,$hash.'.'.$extension,'photo');
            $fileType = Storage::disk('photo')->mimeType($path.'/'.$hash.'.'.$extension);
            //$photoPath = Storage::disk('photo')->path($path.'/'.$hash.'.'.$extension);
           
            $photoObj = $this->photoRep->addPhoto($hash,$fileName,$fileType);
        }
    return $photoObj;
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
        
    }
    
    
    
}
