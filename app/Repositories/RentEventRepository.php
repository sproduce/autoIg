<?php

namespace App\Repositories;
use App\Models\rentEvent;
use App\Repositories\Interfaces\RentEventRepositoryInterface;


class RentEventRepository implements RentEventRepositoryInterface
{

    public function getEvents()
    {
        return rentEvent::query()->orderBy('name')->get();
    }

    public function getEvent($id):rentEvent
    {
        return RentEvent::find($id)?? new RentEvent;
    }


    public function addEvent($dataArray)
    {
        return rentEvent::create($dataArray);
    }


    public function updateEvent($id, $dataArray)
    {
        return rentEvent::where('id',$id)->update($dataArray);
    }

    public function delEvent($id)
    {
        // TODO: Implement delEvent() method.
    }

    public function getEventByAction($action):rentEvent
    {
        $action=str_replace('Controller','',$action);

        return rentEvent::where('action',$action)->first();
    }


}

