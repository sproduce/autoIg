<?php

namespace App\Repositories;
use App\Repositories\Interfaces\ModelRepositoryInterface;
use App\Models\carModel;
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
        //$carModel=new carModel();
        $this->carModel->BrandId=$brandId;
        $this->carModel->name=$modelName;
        $this->carModel->save();
    }



}
