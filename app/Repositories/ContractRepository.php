<?php

namespace App\Repositories;
use App\Http\Requests\Filters;
use App\Http\Requests\Search\SearchContractRequest;
use App\Repositories\Interfaces\ContractRepositoryInterface;
use App\Models\rentContract;
use App\Models\rentContractStatus;
use App\Models\rentContractType;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
        $query = rentContract::query();
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
        $searchCarId = $searchContractObj->get('carId');

        $searchContract = DB::table('rent_contracts')
            ->leftJoin('car_configurations','car_configurations.id','=','rent_contracts.carId')
            ->leftJoin('rent_car_groups','rent_car_groups.id','=','rent_contracts.carGroupId')
            ->join('rent_subjects as subjectFrom','subjectFrom.id','=','rent_contracts.subjectIdFrom')
            ->join('rent_subjects as subjectTo','subjectTo.id','=','rent_contracts.subjectIdTo')
            ->join('rent_contract_statuses','rent_contract_statuses.id','=','rent_contracts.statusId')
            ->select(['rent_contracts.*',
                'subjectFrom.nickname as subjectFromNickname',
                'subjectTo.nickname as subjectToNickname',
                'car_configurations.nickName as carNickName',
                'rent_contract_statuses.name as statusName',
                'rent_car_groups.nickName as carGroupNickName',
                ])
            ->where(function($query) use ($searchText){
                $query->orWhere('subjectFrom.nickName','LIKE','%'.$searchText.'%')
                    ->orWhere('subjectTo.nickName','LIKE','%'.$searchText.'%')
                    ->orWhere('number','LIKE','%'.$searchText.'%');
            });


            if ($searchCarId){
               $searchContract->where('rent_contracts.carId','=',$searchCarId);
            }

        $resultContract = $searchContract->get();
        $resultContract->each(function ($item, $key) {
            if ($item->start) {
                $item->start = Carbon::parse($item->start);
            }
        });
        return  $resultContract;
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

    public function getFilterContracts(Filters\ToPaymentRequest $requestData)
    {
        // TODO: Implement getFilterContracts() method.
    }


    public function getContractFullInfo($contractId)
    {

    }


}
