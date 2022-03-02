<?php

namespace App\Repositories\Interfaces;


use Carbon\CarbonPeriod;

interface EventFineRepositoryInterface
{
    public function addEventFine($dataArray);
    public function getEventFinesByContract($contractId);
    public function getEventFine($id);

    public function getEventFines($eventId,CarbonPeriod $datePeriod);

}
