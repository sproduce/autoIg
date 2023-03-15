<?php

namespace App\Repositories;

use App\Models\photoLink;
use App\Repositories\Interfaces\PhotoRepositoryInterface;
use App\Models\photo;

class PhotoRepository implements PhotoRepositoryInterface
{
    //private $carConfiguration;
    function __construct(){
      ;
    }

public function getPhotoByHash($hash)
{
    return photo::where('photo',$hash)->first();
}

public function getPhoto($id)
{
    return photo::find($id);
}



public function getFileLink($fileLinkId): photoLink 
{
     return photoLink::find($fileLinkId);
 }



    public function isExistPhoto($hash)
    {
        return photo::where('photo',$hash)->first();
    }

    public function addPhoto($hash,$fileName,$fileExt,$fileType)
    {
        return photo::create(['photo'=>$hash,'fileType'=>$fileType,'fileName'=>$fileName,'fileExt'=>$fileExt]);
    }

    public function saveLink($photoId, $uuid)
    {
        $photoLink = photoLink::create(['linkUuid'=>$uuid,'photoId'=>$photoId]);
        return $photoLink->refresh();
    }

    public function getFiles($uuid) 
    {
        $query = photo::query()->join('photo_links','photo_links.photoId','=','photos.id')
                ->where('photo_links.linkUuid','=',$uuid);
        
        $result = $query->select(['photos.*'])->get();
               
        return $result;
    }
    
    public function deleteFile($uuid,$fileId) 
    {
        photoLink::where('linkUuid',$uuid)->where('photoId',$fileId)->delete();
    }
    
    
    public function deleteFiles($uuid) 
    {
        photoLink::where('linkUuid',$uuid)->delete();
    }
    
    
}
