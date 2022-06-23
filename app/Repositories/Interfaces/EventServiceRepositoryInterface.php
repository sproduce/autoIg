<?php

namespace App\Repositories\Interfaces;


use App\Models\rentEventService;
use Carbon\CarbonPeriod;

interface EventServiceRepositoryInterface
{
    public function addEvent($dataArray);
    public function getEventsByContract($contractId);
    public function getEvent($id): rentEventService;
    public function getEvents($eventId,CarbonPeriod $datePeriod);

}
