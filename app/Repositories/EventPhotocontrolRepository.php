<?php

namespace App\Repositories;
use App\Models\rentEventPhotocontrol;
use App\Repositories\Interfaces\EventPhotocontrolRepositoryInterface;


class EventPhotocontrolRepository implements EventPhotocontrolRepositoryInterface
{
public function getEventPhotocontrol($id)
{
    return rentEventPhotocontrol::find($id)?? new rentEventPhotocontrol;
}

public function addEventPhotocontrol($dataArray)
{
  return rentEventPhotocontrol::create($dataArray);
}
public function getEventPhotocontrolByContract($contractId)
{
    // TODO: Implement getEventRentalsByContract() method.
}

}

