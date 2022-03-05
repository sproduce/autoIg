<?php

namespace App\Repositories\Interfaces;


use Carbon\CarbonPeriod;

interface EventTransferRepositoryInterface
{
    public function addEventTransfer($dataArray);
    public function getEventTransferByContract($contractId);
    public function getEventTransfer($id);

    public function getEventTransfers($eventId,CarbonPeriod $datePeriod);
}
