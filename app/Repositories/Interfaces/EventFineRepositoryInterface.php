<?php

namespace App\Repositories\Interfaces;


use App\Models\rentEventFine;
use Carbon\CarbonPeriod;

interface EventFineRepositoryInterface
{
    public function addEventFine($dataArray);
    public function getEventFinesByContract($contractId);
    public function getEventFine($id): rentEventFine;

    public function getEventFines($eventId,CarbonPeriod $datePeriod);

    public function delEventFine(rentEventFine $eventFineObj);
}
