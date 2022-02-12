<?php
namespace App\Services;

use App\Repositories\Interfaces\TimeSheetRepositoryInterface;
use App\Services\PhotoService;

Class EventPhotocontrolService{
    private $timeSheetRep;

    function __construct(TimeSheetRepositoryInterface $timeSheetRep,PhotoService $photoServ)
    {
        $this->timeSheetRep=$timeSheetRep;
    }


    public function addEvent($dataArray)
    {



    }





}
