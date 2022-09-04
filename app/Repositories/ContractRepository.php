<?php

namespace App\Repositories;
use App\Http\Requests\Search\SearchContractRequest;
use App\Repositories\Interfaces\ContractRepositoryInterface;
use App\Models\rentContract;
use App\Models\rentContractStatus;
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

    public function getContract($id):rentContract
    {
        return rentContract::find($id) ?? new rentContract;
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

    public function search(SearchContractRequest $searchContractObj)
    {
        $searchText = $searchContractObj->get('searchText');
        return rentContract::query()->where('number','LIKE','%'.$searchText.'%')->get();
    }

    public function getContractTypeFirst()
    {
       return rentContractType::first();
    }

    public function getContractType($typeId)
    {
        return rentContractType::find($typeId);
    }


    public function getContractsByCarId($carId)
    {
        return rentContract::query()->where('carId',$carId)->whereNull('finishFact')->get();
    }

    public function getContractByTimeSheet($timeSheetId)
    {
        //return rentContract::query()->
    }


}
