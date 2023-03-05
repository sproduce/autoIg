<?php

namespace App\Repositories\Interfaces;


use Carbon\CarbonPeriod;

interface EventPhotocontrolRepositoryInterface
{
    public function addEvent($photocontrolModel);
    public function getEventPhotocontrolByContract($contractId);
    public function getEvent($id);
    public function getEventPhotocontrols($eventId,CarbonPeriod $datePeriod);
    public function getEventFullInfo($eventId, $filter);
}
