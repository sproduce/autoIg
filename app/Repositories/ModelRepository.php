<?php

namespace App\Repositories;
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


}
