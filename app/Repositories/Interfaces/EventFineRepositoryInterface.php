<?php

namespace App\Repositories\Interfaces;


interface EventFineRepositoryInterface
{
    public function addEventFine($dataArray);
    public function getEventFinesByContract($contractId);
    public function getEventFine($id);
}
