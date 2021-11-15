<?php

namespace App\Repositories\Interfaces;
interface CarDriverRepositoryInterface
{

public function getLastDrivers($kol);
public function getCarDrivers();
public function getCarDriver($id);
public function addCarDriver($carDriverArray);

public function getCarDriverContacts($carDriverId);
public function addCarDriverContact($contactArray);

public function getCarDriverRegions();
public function addCarDriverRegion();


}
