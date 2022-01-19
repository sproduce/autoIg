<?php

namespace App\Repositories;
use App\Models\rentEvent;
use App\Repositories\Interfaces\RentEventRepositoryInterface;


class RentEventRepository implements RentEventRepositoryInterface
{

    public function getEvents()
    {
        return rentEvent::all();
    }

    public function getEvent($id)
    {
        return RentEvent::find($id);
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

    public function getEventByAction($action)
    {
        $action=str_replace('Controller','',$action);
        return rentEvent::query()->where('action',$action)->first();
    }


}

