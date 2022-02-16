<?php

namespace App\Repositories;
use App\Models\rentEventCrash;
use App\Repositories\Interfaces\EventCrashRepositoryInterface;


class EventCrashRepository implements EventCrashRepositoryInterface
{
public function getEventCrash($id)
{
    return rentEventCrash::find($id)?? new rentEventCrash;
}

public function addEventCrash($dataArray)
{
  return rentEventCrash::create($dataArray);
}


public function getEventCrashByContract($contractId)
{
    // TODO: Implement getEventRentalsByContract() method.
}




}

