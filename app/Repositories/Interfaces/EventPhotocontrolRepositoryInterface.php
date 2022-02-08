<?php

namespace App\Repositories\Interfaces;


interface EventPhotocontrolRepositoryInterface
{
    public function addEventPhotocontrol($dataArray);
    public function getEventPhotocontrolByContract($contractId);
    public function getEventPhotocontrol($id);
}
