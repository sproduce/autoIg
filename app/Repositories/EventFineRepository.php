<?php

namespace App\Repositories;
use App\Models\rentEventFine;
use App\Repositories\Interfaces\EventFineRepositoryInterface;


class EventFineRepository implements EventFineRepositoryInterface
{
public function getEventFine($id)
{
    // TODO: Implement getEventRental() method.
}

public function addEventFine($dataArray)
{
  return rentEventFine::create($dataArray);
}
public function getEventFinesByContract($contractId)
{
    // TODO: Implement getEventRentalsByContract() method.
}

}

