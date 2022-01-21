<?php

namespace App\Repositories\Interfaces;


interface EventRentalRepositoryInterface
{
    public function addEventRental($dataArray);
    public function getEventRentalsByContract($contractId);
    public function getEventRental($id);
}
