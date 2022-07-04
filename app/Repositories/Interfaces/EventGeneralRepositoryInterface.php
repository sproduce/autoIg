<?php

namespace App\Repositories\Interfaces;


use App\Models\rentEventGeneral;
use Carbon\CarbonPeriod;

interface EventGeneralRepositoryInterface
{
    public function addEvent(rentEventGeneral $rentEventGeneral): rentEventGeneral;
    public function getEventsByContract($contractId);
    public function getEvent($id): rentEventGeneral;
    public function getEvents($eventId,CarbonPeriod $datePeriod);

    public function getEventFullInfo($eventId,$dataId);
}
