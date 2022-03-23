<?php

namespace App\Repositories\Interfaces;


use Carbon\CarbonPeriod;

interface EventRentalRepositoryInterface
{
    public function addEventRental($dataArray);
    public function getEventRentalsByContract($contractId);
    public function getEventRental($id);

    public function getEventRentalFullInfo($eventId,$eventRentalId);

    public function getEventRentals($eventId,CarbonPeriod $datePeriod);
}
