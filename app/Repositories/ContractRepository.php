<?php

namespace App\Repositories;
use App\Repositories\Interfaces\ContractRepositoryInterface;
use App\Models\rentContract;
use App\Models\rentContractStatus;
use App\Models\rentContractTariff;
use App\Models\rentContractType;

class ContractRepository implements ContractRepositoryInterface
{

    public function addContractStatus()
    {
    // TODO: Implement addContractStatus() method.
    }

    public function getContractStatuses()
    {
       return rentContractStatus::all();

    }


    public function addContractType()
    {
        // TODO: Implement addContractType() method.
    }

    public function getContractTypes()
    {
        return rentContractType::all();
    }

    public function getContracts($typeId=null)
    {
        $query=rentContract::query();
        if($typeId){
            $query->where('typeId',$typeId);
        }
        return $query->get()->sortByDesc('start');
    }
    public function addContract($contractArray)
    {
        return rentContract::create($contractArray);
    }

    public function getContract($id)
    {

        return rentContract::find($id) ?? new rentContract();
    }


    public function getContractTariffs()
    {
        return rentContractTariff::all();
    }


    public function addContractTariff()
    {
        // TODO: Implement addTariff() method.
    }


    public function updateContract($contractId, $dataArray)
    {
        rentContract::where('id',$contractId)->update($dataArray);
    }


    public function getLastContracts($kol)
    {
        return rentContract::take($kol)->orderByDesc('id')->get();
    }

    public function search($text)
    {
        return rentContract::query()->where('number','LIKE','%'.$text.'%')->get();
    }

    public function getContractTypeFirst()
    {
       return rentContractType::first();
    }

    public function getContractType($typeId)
    {
        return rentContractType::find($typeId);
    }


}
