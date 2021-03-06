<?php

namespace App\Repositories\Interfaces;


use App\Models\rentEventOther;
use Carbon\CarbonPeriod;

interface EventOtherRepositoryInterface
{
    public function addEvent(rentEventOther $rentEventOther): rentEventOther;
    public function getEventsByContract($contractId);
    public function getEvent($id): rentEventOther;
    public function getEvents($eventId,CarbonPeriod $datePeriod);

    public function getEventFullInfo($eventId,$dataId);

    public function delEvent(rentEventOther $rentEventOther);
}
