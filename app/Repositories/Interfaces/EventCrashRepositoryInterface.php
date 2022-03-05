<?php

namespace App\Repositories\Interfaces;


use Carbon\CarbonPeriod;

interface EventCrashRepositoryInterface
{
    public function addEventCrash($dataArray);
    public function getEventCrashByContract($contractId);
    public function getEventCrash($id);
    public function getEventCrashes($eventId,CarbonPeriod $datePeriod);
}
