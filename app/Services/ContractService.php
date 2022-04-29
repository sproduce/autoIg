<?php
namespace App\Services;
use App\Http\Requests\ContractRequest;
use App\Http\Requests\DateSpan;
use App\Models\rentContract;
use App\Repositories\Interfaces\ContractRepositoryInterface;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

Class ContractService{
    private $contractRep,$contractModel;

    function __construct(ContractRepositoryInterface $contractRep,rentContract $contractModel)
    {
        $this->contractRep = $contractRep;
        $this->contractModel = $contractModel;
    }

    public function getContracts(CarbonPeriod $periodDate,$typeId)
    {
            if ($typeId){
                $currentTypeObj=$this->contractRep->getContractType($typeId);
            } else {
                $currentTypeObj=$this->contractRep->getContractTypeFirst();
            }

            $contractTypesObj=$this->contractRep->getContractTypes();
            $contractsObj=$this->contractRep->getContracts($currentTypeObj->id);

            $contractsCollect=collect(['contractTypes'=>$contractTypesObj,'contracts'=>$contractsObj,'currentContractType'=>$currentTypeObj]);
        return $contractsCollect;
    }

    public function getContract($id)
    {
        return $this->contractRep->getContract($id);
    }

    public function addContract(ContractRequest $contractData)
    {

        $this->contractModel->start =$contractData->get('start');
        $this->contractModel->finish =$contractData->get('finish');
        $this->contractModel->finishFact =$contractData->get('finishFact');
        $this->contractModel->number =$contractData->get('number');
        $this->contractModel->comment =$contractData->get('comment');
        $this->contractModel->typeId =$contractData->get('typeId');
        $this->contractModel->driverId = $contractData->get('driverId');
        $this->contractModel->carId = $contractData->get('carId');
        $this->contractModel->statusId = $contractData->get('statusId');
        $this->contractModel->balance = $contractData->get('balance');
        $this->contractModel->deposit = $contractData->get('deposit');
        $this->contractModel->sum = $contractData->get('sum');
        $this->contractModel->price = $contractData->get('price');
        $this->contractModel->save();
    }

    public function editContract()
    {
//        $contract=$this->request->validate(['id'=>'required|integer']);
//        $validate=$this->request->validate(['start'=>'required',
//            'finish'=>'',
//            'finishFact'=>'',
//            'typeId'=>'required|integer',
//            'driverId'=>'required|integer',
//            'carId'=>'required|integer',
//            'statusId'=>'required|integer',
//            'tariffId'=>'required|integer',
//            'balance'=>'',
//            'deposit'=>'',
//            'number'=>'required',
//            'comment'=>'',
//            'sum'=>''
//        ]);
//        $this->contractRep->updateContract( $contract['id'],$validate);
    }


    public function getContractTypes()
    {
        return $this->contractRep->getContractTypes();
    }

    public function addContractType()
    {

    }

    public function getContractDirectory()
    {
    $orderCollection=collect(['type'=>$this->contractRep->getContractTypes(),
                              'status'=>$this->contractRep->getContractStatuses(),
                ]);

    return $orderCollection;
    }


    public function getLastContracts($kol)
    {
        return $this->contractRep->getLastContracts($kol);
    }


    public function search()
    {
        $searchText=$this->request->validate(['contractText'=>'']);
        return $this->contractRep->search($searchText['contractText']);
    }


}
