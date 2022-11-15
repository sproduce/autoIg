<?php

namespace App\Repositories\Interfaces;


use App\Models\rentEventRental;
use Carbon\CarbonPeriod;
use Carbon\Carbon;


interface EventRentalRepositoryInterface
{
    public function getEventRental($id): rentEventRental;
    public function addEventRental(rentEventRental $rentEventRentalObj): rentEventRental;
    public function getEventRentalsByContract($contractId);

    public function getEventRentalFullInfo($eventId,$dataId);

    public function getEventRentals($eventId,CarbonPeriod $datePeriod);

    public function delEvent(rentEventRental $rentEventRental);
    public function getNearestEvent(Carbon $dateTime,$carId=null);
}
