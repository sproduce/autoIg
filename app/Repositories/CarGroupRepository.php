<?php

namespace App\Repositories;
use App\Repositories\Interfaces\CarGroupRepositoryInterface;
use App\Models\rentCarGroup;

use App\Models\rentCarGroupLink;


class CarGroupRepository implements CarGroupRepositoryInterface
{
    public function getCarGroup($id)
    {
        // TODO: Implement getCarGroup() method.
    }

    public function getCarGroups()
    {
        return rentCarGroup::all();
    }

    public function updateCarGroup($id, $groupArray)
    {
        // TODO: Implement updateCarGroup() method.
    }

    public function addCarGroup($groupArray)
    {
        return rentCarGroup::create($groupArray);
    }


    public function delCarGroup($id)
    {
        // TODO: Implement delCarGroup() method.
    }

    public function getCarGroupCars($id)
    {
        // TODO: Implement getCarGroupCars() method.
    }

    public function carGroupInfo($groupId)
    {
        return rentCarGroupLink::where('groupId', $groupId);
    }

    public function addCarToGroup($groupArray)
    {
        return rentCarGroupLink::create($groupArray);
    }

    public function delCarFromGroup($groupId, $carId)
    {
        // TODO: Implement delCarFromGroup() method.
    }


}

