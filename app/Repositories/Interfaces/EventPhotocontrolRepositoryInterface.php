<?php

namespace App\Repositories\Interfaces;


use Carbon\CarbonPeriod;

interface EventPhotocontrolRepositoryInterface
{
    public function addEventPhotocontrol($dataArray);
    public function getEventPhotocontrolByContract($contractId);
    public function getEventPhotocontrol($id);
    public function getEventPhotocontrols($eventId,CarbonPeriod $datePeriod);
}
