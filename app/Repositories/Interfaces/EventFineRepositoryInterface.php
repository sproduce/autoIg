<?php

namespace App\Repositories\Interfaces;


use App\Models\rentEventFine;
use Carbon\CarbonPeriod;

interface EventFineRepositoryInterface
{
    public function addEvent(rentEventFine $rentEventFine): rentEventFine;
    public function getEventsByContract($contractId);
    public function getEvent($id): rentEventFine;

    public function getEvents($eventId,CarbonPeriod $datePeriod);

    public function delEvent(rentEventFine $eventFineObj);


    public function getEventFullInfo($eventId,$dataId);
}
