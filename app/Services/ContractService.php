<?php
namespace App\Services;
use App\Http\Requests\DateSpan;
use App\Repositories\Interfaces\ContractRepositoryInterface;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

Class ContractService{
    private $contractRep,$request;

    function __construct(ContractRepositoryInterface $contractRep,Request $request)
    {
        $this->contractRep=$contractRep;
        $this->request=$request;
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

    public function addContract()
    {

        $validate=$this->request->validate(['start'=>'required',
            'finish'=>'',
            'finishFact'=>'',
            'typeId'=>'required|integer',
            'driverId'=>'',
            'carId'=>'',
            'statusId'=>'required|integer',
            'tariffId'=>'required|integer',
            'balance'=>'',
            'deposit'=>'',
            'number'=>'required',
            'comment'=>'',
            'sum'=>''
        ]);
        //var_dump($validate);
        $this->contractRep->addContract($validate);
    }

    public function editContract()
    {
        $contract=$this->request->validate(['id'=>'required|integer']);
        $validate=$this->request->validate(['start'=>'required',
            'finish'=>'',
            'finishFact'=>'',
            'typeId'=>'required|integer',
            'driverId'=>'required|integer',
            'carId'=>'required|integer',
            'statusId'=>'required|integer',
            'tariffId'=>'required|integer',
            'balance'=>'',
            'deposit'=>'',
            'number'=>'required',
            'comment'=>'',
            'sum'=>''
        ]);
        $this->contractRep->updateContract( $contract['id'],$validate);
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
                                'tariff'=>$this->contractRep->getContractTariffs()
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
