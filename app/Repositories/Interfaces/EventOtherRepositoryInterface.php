<?php

namespace App\Repositories\Interfaces;


use Carbon\CarbonPeriod;

interface EventOtherRepositoryInterface
{
    public function addEvent($dataArray);
    public function getEventsByContract($contractId);
    public function getEvent($id);
    public function getEvents($eventId,CarbonPeriod $datePeriod);

}
