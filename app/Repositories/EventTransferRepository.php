<?php

namespace App\Repositories;
use App\Models\rentEventTransfer;
use App\Repositories\Interfaces\EventTransferRepositoryInterface;


class EventTransferRepository implements EventTransferRepositoryInterface
{
public function getEventTransfer($id)
{
    // TODO: Implement getEventRental() method.
}

public function addEventTransfer($dataArray)
{
  return rentEventTransfer::create($dataArray);
}
public function getEventTransferByContract($contractId)
{
    // TODO: Implement getEventRentalsByContract() method.
}

}

