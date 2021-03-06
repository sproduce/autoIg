<?php
namespace App\Services;

use App\Http\Requests\MotorPoolRequest;

use App\Models\carConfiguration;
use App\Http\Requests\Search\SearchCarRequest;
use App\Repositories\Interfaces\MotorPoolRepositoryInterface;
use Illuminate\Support\Str;

Class MotorPoolService{

    private $motorPoolRep,$carConfiguration;


    function __construct(MotorPoolRepositoryInterface $motorPoolRep,carConfiguration $carConfiguretion)
    {
        $this->carConfiguration = $carConfiguretion;
        $this->motorPoolRep = $motorPoolRep;
    }


    public function getCars()
    {
        return $this->motorPoolRep->getCars();
    }


    public function getCar($carId): carConfiguration
    {
        return $this->motorPoolRep->getCar($carId);
    }


    public function getCarFullInfo($carId)
    {
        return $this->motorPoolRep->getCarFullInfo($carId);
    }



    public function getLastCars($kol)
    {
        return $this->motorPoolRep->getLastCars($kol);
    }


    public function addCar(MotorPoolRequest $motorPoolRequest)
    {
        if ($motorPoolRequest->get('id')){
            $this->carConfiguration = $this->motorPoolRep->getCar($motorPoolRequest->get('id'));
        }

        $this->carConfiguration->generationId = $motorPoolRequest->get('generationId');
        $this->carConfiguration->typeId = $motorPoolRequest->get('typeId');
        $this->carConfiguration->engineTypeId = $motorPoolRequest->get('engineTypeId');
        $this->carConfiguration->transmissionTypeId = $motorPoolRequest->get('transmissionTypeId');
        $this->carConfiguration->year = $motorPoolRequest->get('year');
        $this->carConfiguration->displacement = $motorPoolRequest->get('displacement');
        $this->carConfiguration->hp = $motorPoolRequest->get('hp');
        $this->carConfiguration->regNumber = $motorPoolRequest->get('regNumber');
        $this->carConfiguration->uuid = $motorPoolRequest->get('uuid') ?? Str::uuid();
        $this->carConfiguration->vin = $motorPoolRequest->get('vin');
        $this->carConfiguration->color = $motorPoolRequest->get('color');
        $this->carConfiguration->nickName = $motorPoolRequest->get('nickName');
        $this->carConfiguration->nickName = $motorPoolRequest->get('nickName');
        $this->carConfiguration->subjectIdOwner = $motorPoolRequest->get('subjectIdOwner');
        $this->carConfiguration->subjectIdFrom = $motorPoolRequest->get('subjectIdFrom');
        $this->carConfiguration->dateStart = $motorPoolRequest->get('dateStart');
        $this->carConfiguration->dateFinish = $motorPoolRequest->get('dateFinish');
        $this->carConfiguration->comment = $motorPoolRequest->get('comment');

        $this->motorPoolRep->addCar($this->carConfiguration);
    }


    public function del()
    {


    }

    public function search(SearchCarRequest $searchTextObj)
    {
        return $this->motorPoolRep->search($searchTextObj->get('searchText'));
    }


}
