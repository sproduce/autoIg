<?php
namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;


Class PhotoService
{


    function __construct()
    {

    }

    private function getPathByHash($hash)
    {
        $dir1=substr($hash,0,2);
        $dir2=substr($hash,2,2);
        $path='/'.$dir1.'/'.$dir2;
        return $path;
    }

    private function saveFile(UploadedFile $photo){
        $hash=sha1($photo->get());

        $path=$this->getPathByHash($hash);
        Storage::disk('photo')->makeDirectory($path);
        $extension = $photo->getClientOriginalExtension();
        $photo->storeAs($path,$hash.'.'.$extension,'photo');
    }


    public function savePhoto($fileObj)
    {
        if (is_iterable($fileObj)){
            foreach($fileObj as $file){
                $this->saveFile($file);
            }

        } else {
            $this->saveFile($fileObj);
        }
    }



}
