<?php
namespace App\Services;
use App\Repositories\Interfaces\ContractRepositoryInterface;
use Illuminate\Http\Request;

Class ContractService{
    private $contractRep,$request;

    function __construct(ContractRepositoryInterface $contractRep,Request $request)
    {
        $this->contractRep=$contractRep;
        $this->request=$request;
    }

    public function getContracts()
    {
        return $this->contractRep->getContracts();
    }

    public function getContract()
    {

    }

    public function addContract()
    {

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
            'comment'=>''
        ]);
        //var_dump($validate);
        $this->contractRep->addContract($validate);
    }

    public function editContract()
    {

    }


    public function getContractTypes()
    {

    }

    public function addContractType()
    {

    }



}
