<?php
namespace App\Services;

use App\Repositories\EventPhotocontrolRepository;
use App\Repositories\Interfaces\TimeSheetRepositoryInterface;
use App\Services\PhotoService;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
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
        $photocontrolObj=$this->eventPhotocontrolRep->addEventPhotocontrol($photocontrolArray);
        $this->photoServ->savePhoto($file,$photocontrolArray['uuid']);
        $dateTime=$dataArray['datePhoto'].' '.$dataArray['timePhoto'];

        $timeSheetData['dateTime']=date("Y-m-d H:i:00",strtotime($dateTime));
        $timeSheetData['eventId']=$dataArray['eventId'];
        $timeSheetData['dataId']=$photocontrolObj->id;
        $timeSheetData['carId']=$dataArray['carId'];
        $timeSheetData['duration']=$dataArray['duration']??1;
        $timeSheetData['mileage']=$dataArray['mileage'];
        $timeSheetData['color']=$dataArray['color'];
        $timeSheetData['contractId']=$dataArray['contractId'];
        $this->timeSheetRep->addTimeSheet($timeSheetData);

    }

    public function getEvents(CarbonPeriod $periodDate,$eventId)
    {
        $eventsObj=$this->eventPhotocontrolRep->getEventPhotocontrols($eventId,$periodDate);
        $eventsObj->each(function ($item, $key) {
            $item->dateTime=Carbon::parse($item->dateTime);
        });
        return $eventsObj;
    }



}
