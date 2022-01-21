<?php

namespace App\Repositories;
use App\Models\rentEventRental;
use App\Repositories\Interfaces\EventRentalRepositoryInterface;


class EventRentalRepository implements EventRentalRepositoryInterface
{
public function getEventRental($id)
{
    // TODO: Implement getEventRental() method.
}

public function addEventRental($dataArray)
{
  return rentEventRental::create($dataArray);
}
public function getEventRentalsByContract($contractId)
{
    // TODO: Implement getEventRentalsByContract() method.
}

}

