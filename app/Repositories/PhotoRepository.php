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

    public function addPhoto($hash,$fileType)
    {
        return photo::create(['photo'=>$hash,'fileType'=>$fileType]);
    }

    public function saveLink($photoId, $uuid)
    {
        photoLink::create(['linkUuid'=>$uuid,'photoId'=>$photoId]);
    }

}
