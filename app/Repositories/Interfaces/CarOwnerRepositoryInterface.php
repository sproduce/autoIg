<?php

namespace App\Repositories\Interfaces;
interface CarOwnerRepositoryInterface
{

public function getLastOwners($kol);
public function getCarOwners();
public function getCarOwner($id);
public function addCarOwner($carOwnerArray);
public function carOwnerSearch($text);
public function updateCarOwner($id,$carDriverArray);
public function delCarOwner($id);

}
