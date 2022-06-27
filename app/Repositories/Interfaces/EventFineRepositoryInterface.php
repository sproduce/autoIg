<?php

namespace App\Repositories\Interfaces;


use App\Models\rentEventFine;
use Carbon\CarbonPeriod;

interface EventFineRepositoryInterface
{
    public function addEventFine(rentEventFine $rentEventFine): rentEventFine;
    public function getEventFinesByContract($contractId);
    public function getEventFine($id): rentEventFine;

    public function getEventFines($eventId,CarbonPeriod $datePeriod);

    public function delEventFine(rentEventFine $eventFineObj);


    public function getEventFullInfo($eventId,$dataId);
}
