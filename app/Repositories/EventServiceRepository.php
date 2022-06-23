<?php

namespace App\Repositories;

use App\Models\rentEventService;
use App\Repositories\Interfaces\EventServiceRepositoryInterface;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;


class EventServiceRepository implements EventServiceRepositoryInterface
{


    public function addEvent($dataArray)
    {
        // TODO: Implement addEvent() method.
    }

    public function getEventsByContract($contractId)
    {
        // TODO: Implement getEventsByContract() method.
    }

    public function getEvent($id): rentEventService
    {
        return new rentEventService();
    }

    public function getEvents($eventId, CarbonPeriod $datePeriod)
    {

    }
}

