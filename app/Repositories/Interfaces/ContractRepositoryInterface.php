<?php

namespace App\Repositories\Interfaces;
use App\Http\Requests\Search\SearchContractRequest;
use App\Models\rentContract;
use \App\Http\Requests\Filters;

interface ContractRepositoryInterface
{
    public function addContractType();
    public function getContractTypes();
    public function getContractType($typeId);
    public function getContractTypeFirst();


    public function addContractStatus();
    public function getContractStatuses();

    public function addContractTariff();


    public function addContract($contractArray);
    public function getContracts($typeId);
    public function getContract($id): rentContract;
    public function updateContract($contractId,$dataArray);

    public function getLastContracts($kol);


    public function search(SearchContractRequest $searchContractObj);

    public function getContractsByCarId($carId);

    public function getContractFullInfo($contractId);

    public function updateActualContractPrice();

    public function getContractPaymentSum($contractId);

    public function getContractToPaymentSum($contractId);
    
    public function getContractByCarIdDate($carId,$date);

    
}
