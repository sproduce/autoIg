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

public function addCar($carInfoArray)
{
    $car=new carConfiguration;
    $car->generationId=$carInfoArray['generationId'];
    $car->typeId=$carInfoArray['typeId'];
    $car->ownerId=$carInfoArray['ownerId'];
    $car->displacement=$carInfoArray['displacement'];
    $car->hp=$carInfoArray['hp'];
    $car->regNumber=$carInfoArray['regNumber'];
    $car->vin=$carInfoArray['vin'];
    $car->engineTypeId=$carInfoArray['engineTypeId'];
    $car->transmissionTypeId=$carInfoArray['transmissionTypeId'];
    $car->nickName=$carInfoArray['nickName'];
    $car->color=$carInfoArray['color'];
    $car->year=$carInfoArray['year'];
    $car->dateStart=$carInfoArray['dateStart'];
    $car->dateFinish=$carInfoArray['dateFinish'];
    $car->comment=$carInfoArray['comment'];

    //var_dump($carInfoArray);
    $car->save();


}

public function getCars()
{
    return carConfiguration::all();
}

public function getCar($carId):carConfiguration
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
