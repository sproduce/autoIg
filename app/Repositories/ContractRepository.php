<?php

namespace App\Repositories;
use App\Repositories\Interfaces\ContractRepositoryInterface;
use App\Models\rentContract;


class ContractRepository implements ContractRepositoryInterface
{

    public function addContractStatus()
    {
    // TODO: Implement addContractStatus() method.
    }

    public function getContractStatuses()
    {
        // TODO: Implement getContractStatuses() method.
    }


    public function addContractType()
    {
        // TODO: Implement addContractType() method.
    }

    public function getContractTypes()
    {
        // TODO: Implement getContractTypes() method.
    }

    public function getContracts()
    {
        return rentContract::all()->sortByDesc('start');
    }
    public function addContract($contractArray)
    {
        return rentContract::create($contractArray);
    }

    public function getContract($id)
    {

        return rentContract::find($id) ?? new rentContract();
    }


    public function getTariffs()
    {
        // TODO: Implement getTariffs() method.
    }


    public function addTariff()
    {
        // TODO: Implement addTariff() method.
    }

}
