<?php
namespace App\Services;
use App\Repositories\Interfaces\ContractRepositoryInterface;
use Illuminate\Http\Request;

Class ContractService{
    private $contractRep;

    function __construct(ContractRepositoryInterface $contractRep)
    {
        $this->contractRep=$contractRep;
    }

    public function getContracts()
    {
        return $this->contractRep->getContracts();
    }

    public function getContract()
    {

    }

    public function addCOntract()
    {

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
