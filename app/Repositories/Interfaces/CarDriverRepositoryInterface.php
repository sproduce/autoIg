<?php

namespace App\Repositories\Interfaces;
interface CarDriverRepositoryInterface
{

public function getCarDrivers();
public function getCarDriver($id);
public function addCarDriver($carDriverArray);

public function getCarDriverContacts($carDriverId);
public function addCarDriverContact($contactArray);

}
