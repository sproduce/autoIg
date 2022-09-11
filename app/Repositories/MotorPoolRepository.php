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
        return carConfiguration::query()->get();
    }

    public function getCarsByGroup($groupId = null)
    {
        $carRequest = carConfiguration::query();
        if ($groupId){
            $carRequest->join('rent_car_group_links','rent_car_group_links.carId','=','car_configurations.id');
            $carRequest->where('rent_car_group_links.groupId','=',$groupId);
        }
        $carResult = $carRequest->get();
        return $carResult;
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
        return carConfiguration::query()
            ->where('nickName','LIKE','%'.$text.'%')
            ->orWhere('regNumber','LIKE','%'.$text.'%')
            ->get();
    }

    public function getCarFullInfo($carId)
    {
        $result =  DB::table('car_configurations')
            ->where('car_configurations.id','=',$carId)
            ->join('car_generations','car_generations.id','=','car_configurations.generationId')
            ->join('car_models','car_models.id','=','car_generations.modelId')
            ->join('car_brands','car_brands.id','=','car_models.brandId')
            ->join('car_transmission_types','car_transmission_types.id','=','car_configurations.transmissionTypeId')
            ->join('car_engine_types','car_engine_types.id','=','car_configurations.engineTypeId')
            ->join('car_types','car_types.id','=','car_configurations.typeId')
            ->join('rent_subjects as rentSubjectOwner','rentSubjectOwner.id','=','car_configurations.subjectIdOwner')
            ->leftjoin('rent_subjects as rentSubjectFrom','rentSubjectFrom.id','=','car_configurations.subjectIdFrom')
            ->select(
                'car_configurations.*',
                'car_generations.name as generationName',
                'car_generations.id as generationId',
                'car_models.id as modelId',
                'car_models.name as modelName',
                'car_brands.id as brandId',
                'car_brands.name as brandName',
                'car_models.brandId',
                'car_engine_types.name as engineTypeName',
                'car_transmission_types.name as transmissionTypeName',
                'car_types.name as typeName',
                'rentSubjectOwner.nickname as subjectOwnerNickname',
                'rentSubjectFrom.nickname as subjectFromNickname',
            )
            ->first();
        return $result;
    }


}
