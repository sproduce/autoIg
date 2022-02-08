<?php
namespace App\Services;




Class PhotoService
{


    function __construct()
    {

    }

    private function savePhoto($photo){

    }


    public function savePhoto($fileObj)
    {
        if (is_iterable($fileObj)){
            foreach($fileObj as $file){
                $this->savePhoto($file);
            }

        } else {
            $this->savePhoto($fileObj);
        }

    }



}
