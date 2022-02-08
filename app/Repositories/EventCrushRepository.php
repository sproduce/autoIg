<?php

namespace App\Repositories;
use App\Models\rentEventCrush;
use App\Repositories\Interfaces\EventCrushRepositoryInterface;


class EventCrushRepository implements EventCrushRepositoryInterface
{
public function getEventCrush($id)
{
    return rentEventCrush::find($id)?? new rentEventCrush;
}

public function addEventCrush($dataArray)
{
  return rentEventCrush::create($dataArray);
}
public function getEventCrushByContract($contractId)
{
    // TODO: Implement getEventRentalsByContract() method.
}

}

