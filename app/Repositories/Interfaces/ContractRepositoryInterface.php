<?php

namespace App\Repositories\Interfaces;
interface ContractRepositoryInterface
{
public function addContractType();
public function getContractTypes();

public function addContractStatus();
public function getContractStatuses();

public function getTariffs();
public function addTariff();


public function addContract($contractArray);
public function getContracts();



}
