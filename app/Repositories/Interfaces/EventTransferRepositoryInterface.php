<?php

namespace App\Repositories\Interfaces;


interface EventTransferRepositoryInterface
{
    public function addEventTransfer($dataArray);
    public function getEventTransferByContract($contractId);
    public function getEventTransfer($id);
}
