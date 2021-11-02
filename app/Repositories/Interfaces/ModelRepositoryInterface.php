<?php


namespace App\Repositories\Interfaces;
interface ModelRepositoryInterface
{

    public function saveModel($modelName,$brandId);
    public function getModelByName($modelName);


}
