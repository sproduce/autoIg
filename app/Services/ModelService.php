<?php
namespace App\Services;
use App\Repositories\Interfaces\ModelRepositoryInterface;
use Illuminate\Http\Request;

Class ModelService{

    private $modelRep,$request;


    function __construct(ModelRepositoryInterface $model,Request $request){
        $this->modelRep=$model;
        $this->request=$request;
    }



    public function addModel(){
        $brandId=(int)$this->request->input('brandId');
                $modelName=$this->request->input('modelName');
        if ($brandId&&$modelName){
            $modelObj=$this->modelRep->getModelByName($modelName);
            if (!$modelObj->count()){
                $this->modelRep->saveModel($modelName,$brandId);
            }
        }
    }



    public function addModels(){
        $arrayOfModels=explode("\r\n", ucwords(strtolower($this->request->input('modelsName'))));
        $brandId=(int)$this->request->input('brandId');
        foreach($arrayOfModels as $modelName){
            if($modelName &&$brandId){
                $modelObj=$this->modelRep->getModelByName($modelName);
                if(!$modelObj->count()){
                    $this->modelRep->saveModel($modelName,$brandId);
                }
            }
        }



    }



}
