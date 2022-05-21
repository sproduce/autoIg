<?php

namespace App\Repositories;

use App\Repositories\Interfaces\MotorPoolRepositoryInterface;
use App\Models\carConfiguration;


class MotorPoolRepository implements MotorPoolRepositoryInterface
{
    //private $carConfiguration;
    function __construct(){
      ;
    }

    public function addCar(carConfiguration $carConfiguration): carConfiguration
    {
        $carConfiguration->save();
        return $carConfiguration;
    }

    public function getCars()
    {
        return carConfiguration::all();
    }

    public function getCar($carId): carConfiguration
    {
        return carConfiguration::find($carId) ?? new carConfiguration;
    }


public function getLastCars($kol)
{
    return carConfiguration::take($kol)->orderByDesc('id')->get();
}


public function search($text)
{
    return carConfiguration::query()->where('nickName','LIKE','%'.$text.'%')->orWhere('regNumber','LIKE','%'.$text.'%')->get();
}


}
