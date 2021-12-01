<?php

namespace App\Repositories;
use App\Repositories\Interfaces\CarGroupRepositoryInterface;
use App\Models\rentCarGroup;


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
        // TODO: Implement addCarGroup() method.
    }


    public function delCarGroup($id)
    {
        // TODO: Implement delCarGroup() method.
    }

    public function getCarGroupCars($id)
    {
        // TODO: Implement getCarGroupCars() method.
    }

}

