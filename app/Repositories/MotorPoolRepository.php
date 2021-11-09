<?php

namespace App\Repositories;

use App\Repositories\Interfaces\MotorPoolRepositoryInterface;
use Illuminate\Support\Facades\DB;
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
    //var_dump($carInfoArray);
    $car->save();


}

public function getCars()
{
    return carConfiguration::all();
}

public function getCar($carId)
{
    return carConfiguration::find($carId);
}


}
