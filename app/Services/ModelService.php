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
        echo $brandId;
        $modelName=$this->request->input('modelName');
        if ($brandId&&$modelName){
            $modelObj=$this->modelRep->getModelByName($modelName);
            if (!$modelObj->count()){
                $this->modelRep->saveModel($modelName,$brandId);
            }
        }
    }



    public function addModels(){
        $arrayOfBrands=explode("\r\n", ucwords(strtolower($this->request->input('brandsName'))));
        foreach($arrayOfBrands as $brandName){
            if($brandName){
                $brandObj=$this->brandRep->getBrandByName($brandName);
                if(!$brandObj->count()){
                    $this->brandRep->saveBrand($brandName);
                }
            }
        }



    }



}
