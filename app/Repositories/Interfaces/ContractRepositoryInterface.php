<?php

namespace App\Repositories\Interfaces;
interface ContractRepositoryInterface
{
public function addContractType();
public function getContractTypes();

public function addContractStatus();
public function getContractStatuses();

public function getContractTariffs();
public function addContractTariff();


public function addContract($contractArray);
public function getContracts();
public function getContract($id);
public function updateContract($contractId,$dataArray);

public function getLastContracts($kol);

public function search($text);


}
