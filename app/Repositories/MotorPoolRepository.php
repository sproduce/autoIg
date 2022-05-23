<?php

namespace App\Repositories;

use App\Repositories\Interfaces\MotorPoolRepositoryInterface;
use App\Models\carConfiguration;
use Illuminate\Support\Facades\DB;


class MotorPoolRepository implements MotorPoolRepositoryInterface
{
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

    public function getCarFullInfo($carId)
    {
        $result =  DB::table('car_configurations')
            ->where('car_configurations.id','=',$carId)
            ->join('car_generations','car_generations.id','=','car_configurations.generationId')
            ->join('car_models','car_models.id','=','car_generations.modelId')
            ->join('car_brands','car_brands.id','=','car_models.brandId')
            ->select(
                'car_configurations.*',
                'car_generations.modelId',
                'car_generations.name as generationName',
                'car_generations.id as generationId',
                'car_models.id as modelId',
                'car_models.name as modelName',
                'car_brands.id as brandId',
                'car_brands.name as brandName',
                'car_models.brandId')
            ->first();
        return $result;
    }


}
