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

        $validate=$this->request->validate(['start'=>'',
            'finish'=>'',
            'finishFact'=>'',
            'typeId'=>'',
            'driverId'=>'',
            'carId'=>'',
            'statusId'=>'',
            'tarifId'=>'',
            'balance'=>'',
            'deposit'=>'',
            'number'=>'',
            'comment'=>''
        ]);
        var_dump($validate);

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
