<?php

namespace App\Repositories;
use App\Repositories\Interfaces\ModelRepositoryInterface;
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
    var_dump($carInfoArray);
}

}
