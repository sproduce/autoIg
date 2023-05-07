<?php


namespace App\Repositories\Interfaces;
interface ModelRepositoryInterface
{

    public function saveModel($modelName,$brandId);
    public function getModelByName($modelName,$brandId);
    public function addGeneration($generationArray);
    public function editGeneration($generationArray);
    public function getModels($brandId);
    public function getGenerations($modelId);
    public function getTypes();
    public function getType($id);
    public function addType($typeArray);
    public function editType($typeName);
    public function getEngines();
    public function getEngine($id);
    public function addEngine($engineName);
    public function editEngine($engineArray);
    public function getTransmissions();
    public function getTransmission($id);
    public function addTransmission($transmissionName);
    public function editTransmission($transmissionArray);

}
