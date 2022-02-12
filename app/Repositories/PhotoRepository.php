<?php

namespace App\Repositories;

use App\Repositories\Interfaces\PhotoRepositoryInterface;
use App\Models\photo;

class PhotoRepository implements PhotoRepositoryInterface
{
    //private $carConfiguration;
    function __construct(){
      ;
    }


    public function isExistPhoto($hash)
    {
        return photo::where('photo',$hash)->first();
    }

    public function addPhoto($hash)
    {
        return photo::create(['photo'=>$hash]);
    }

}
