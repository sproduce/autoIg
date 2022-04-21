<?php

namespace App\Repositories;
use App\Models\rentEventCrash;
use App\Repositories\Interfaces\EventOtherRepositoryInterface;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;


class EventOtherRepository implements EventOtherRepositoryInterface
{


    public function addEvent($dataArray)
    {
        // TODO: Implement addEvent() method.
    }

    public function getEventsByContract($contractId)
    {
        // TODO: Implement getEventsByContract() method.
    }

    public function getEvent($id)
    {
        // TODO: Implement getEvent() method.
    }

    public function getEvents($eventId, CarbonPeriod $datePeriod)
    {
        // TODO: Implement getEvents() method.
    }
}

