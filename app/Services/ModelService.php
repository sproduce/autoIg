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



    public function addModels()
    {
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

    public function addGeneration()
    {

        $validated = $this->request->validate([
            'name'=>'required|alpha_dash',
            'modelId' => 'required|integer',
            'start'=>'required|integer|min:1990|max:'.date('Y'),
            'finish'=>''
        ]);
        $this->modelRep->addGeneration($validated);
    }



    public function editGeneration()
    {
        $validated = $this->request->validate([
            'id'=>'required|integer',
            'name'=>'required|alpha_dash',
            'start'=>'required|integer|min:1990|max:'.date('Y'),
            'finish'=>''
        ]);
        $this->modelRep->editGeneration($validated);


    }

    public function getModels()
    {
        $validated=$this->request->validate(['brandId'=>'required|integer']);
        $modelObj=$this->modelRep->getModels($validated['brandId']);
        return $modelObj;
    }


    public function getGenerations()
    {
        $validated=$this->request->validate(['modelId'=>'required|integer']);
        $generationObj=$this->modelRep->getGenerations($validated['modelId']);
        return $generationObj;
    }

    public function getTypes()
    {
        $typesObj['body']=$this->modelRep->getTypes();
        $typesObj['engine']=$this->modelRep->getEngines();
        $typesObj['transmission']=$this->modelRep->getTransmissions();
        return $typesObj;
    }


    public function getType()
    {
        $typeId=$this->request->validate(['typeId'=>'required|integer']);
        return $this->modelRep->getType($typeId['typeId']);
    }

    public function getEngineType()
    {
        $engineId=$this->request->validate(['engineId'=>'required|integer']);
        return $this->modelRep->getEngine($engineId['engineId']);
    }

    public function getTransmissionType()
    {
        $transmissionId=$this->request->validate(['transmissionId'=>'required|integer']);
        return $this->modelRep->getTransmission($transmissionId['transmissionId']);
    }


    public function addCarType()
    {
        $validated = $this->request->validate([
            'name'=>''
        ]);
        $this->modelRep->addType($validated['name']);
    }

    public function addCarEngineType()
    {
        $validated = $this->request->validate([
            'name'=>''
        ]);
        $this->modelRep->addEngine($validated['name']);
    }

    public function addCarTransmissionType()
    {
        $validated = $this->request->validate([
            'name'=>''
        ]);
        $this->modelRep->addTransmission($validated['name']);
    }


    

}
