<?php
namespace App\Services;

use App\Repositories\EventPhotocontrolRepository;
use App\Repositories\Interfaces\TimeSheetRepositoryInterface;
use App\Services\PhotoService;
use Illuminate\Support\Str;


Class EventPhotocontrolService{
    private $timeSheetRep,$photoServ,$eventPhotocontrolRep;

    function __construct(EventPhotocontrolRepository $eventPhotocontrolRep,TimeSheetRepositoryInterface $timeSheetRep,PhotoService $photoServ)
    {
        $this->eventPhotocontrolRep=$eventPhotocontrolRep;
        $this->timeSheetRep=$timeSheetRep;
        $this->photoServ=$photoServ;
    }


    public function addEvent($file,$dataArray)
    {

        $photocontrolArray['uuid']=Str::uuid();
        $photocontrolArray['comment']=$dataArray['comment'];
        $this->eventPhotocontrolRep->addEventPhotocontrol($photocontrolArray);
//        $eventPhotocontrolObj=$this->photo


    }





}
