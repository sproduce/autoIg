<?php

namespace App\Repositories;

use App\Repositories\Interfaces\ModelRepositoryInterface;
use App\Models\carModel;
use App\Models\carGeneration;
use App\Models\carType;
use App\Models\carEngineType;
use App\Models\carTransmissionType;
use Illuminate\Support\Facades\DB;

class ModelRepository implements ModelRepositoryInterface
{
    private $carModel;
    function __construct(carModel $carModel){
        $this->carModel=$carModel;
    }



    public function getModelByName($modelName,$brandId){
        return $this->carModel::where('name',$modelName)->where('brandId',$brandId)->get();
    }


    public function saveModel($modelName,$brandId){
        $result=carModel::create([
            'name' => $modelName,
            'brandId'=>$brandId
        ]);
    }


    public function addGeneration($generationArray)
    {
        $result=carGeneration::create(
            $generationArray
        );
    }

    public function editGeneration($generationArray)
    {
        $carGeneration=carGeneration::find($generationArray['id']);
        $carGeneration->name=$generationArray['name'];
        $carGeneration->start=$generationArray['start'];
        $carGeneration->finish=$generationArray['finish'];
        $carGeneration->save();
    }


    public function getModels($brandId)
    {
        return carModel::select('id','name')->where('brandId',$brandId)->orderBy('name')->get();
    }


    public function getGenerations($modelId)
    {
     return carGeneration::select('id','name','start','finish')->where('modelId',$modelId)->get();;
    }


    public function getTypes()
    {
        return carType::all();
    }

    public function getType($id)
    {
        return carType::find($id);
    }

    public function addType($typeName)
    {
        $carType=new carType();
        $carType->name=$typeName;
        $carType->save();
    }

    public function editType($typeArray)
    {
        // TODO: Implement editType() method.
    }

    public function getEngines()
    {
        return carEngineType::all();
    }

    public function getEngine($id)
    {
        return carEngineType::find($id);
    }
    public function addEngine($engineName)
    {
        $carEngine=new carEngineType();
        $carEngine->name=$engineName;
        $carEngine->save();
    }
    public function editEngine($engineArray)
    {
        // TODO: Implement editEngine() method.
    }

    public function getTransmissions()
    {
        return carTransmissionType::all();
    }

    public function getTransmission($id)
    {
        return carTransmissionType::find($id);
    }

    public function addTransmission($transmissionName)
    {
        $carTransmission=new carTransmissionType();
        $carTransmission->name=$transmissionName;
        $carTransmission->save();
    }

    public function editTransmission($transmissionArray)
    {
        // TODO: Implement editTransmission() method.
    }
}
