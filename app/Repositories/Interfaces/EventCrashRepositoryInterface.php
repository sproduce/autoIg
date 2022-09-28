<?php

namespace App\Repositories\Interfaces;


use App\Models\rentEventCrash;
use Carbon\CarbonPeriod;

interface EventCrashRepositoryInterface
{
    public function addEventCrash(rentEventCrash $eventCrash) :rentEventCrash;
    public function getEventCrashByContract($contractId);
    public function getEventCrash($id);
    public function getEventCrashes($eventId,CarbonPeriod $datePeriod);

    public function getEventFullInfo($eventId, $dataId);

    public function delEvent(rentEventCrash $eventCrash);

}
