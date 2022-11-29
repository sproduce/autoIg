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
    // TODO: Implement getPhoto() method.
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
        photoLink::create(['linkUuid'=>$uuid,'photoId'=>$photoId]);
    }

    public function getFiles($uuid) 
    {
        $query = photo::query()->join('photo_links','photo_links.photoId','=','photos.id')
                ->where('photo_links.linkUuid','=',$uuid);
        
        $result = $query->get();
               
        return $result;
    }
    
    
}
