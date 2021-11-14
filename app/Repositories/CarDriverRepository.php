<?php

namespace App\Repositories;
use App\Repositories\Interfaces\CarDriverRepositoryInterface;
use Illuminate\Support\Facades\DB;
use App\Models\rentCarDriver;
use App\Models\rentCarDriverContact;

class CarDriverRepository implements CarDriverRepositoryInterface
{
    public function getCarDrivers()
    {
        return rentCarDriver::all();
    }

    public function addCarDriver($carDriverArray)
    {
        return rentCarDriver::create($carDriverArray);
    }
    public function getCarDriver($id)
    {
        // TODO: Implement getCarDriver() method.
    }

    public function addCarDriverContact($contactArray)
    {
        return rentCarDriverContact::create($contactArray);
    }
    public function getCarDriverContacts($carDriverId)
    {
        // TODO: Implement getCarDriverContacts() method.
    }


}
