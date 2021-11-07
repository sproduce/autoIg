<?php

namespace App\Repositories;
use App\Models\carType;
use App\Repositories\Interfaces\ModelRepositoryInterface;
use App\Models\carModel;
use App\Models\carGeneration;
use Illuminate\Support\Facades\DB;

class ModelRepository implements ModelRepositoryInterface
{
    private $carModel;
    function __construct(carModel $carModel){
        $this->carModel=$carModel;
    }



    public function getModelByName($modelName){
        return $this->carModel::where('name',$modelName)->get();
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
     return carGeneration::select('id','name')->where('modelId',$modelId)->get();;
    }


    public function getTypes()
    {
     return carType::select('id','name')->get();
    }
}
