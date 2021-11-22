<?php

namespace App\Repositories\Interfaces;
interface CarDriverRepositoryInterface
{

public function getLastDrivers($kol);
public function getCarDrivers();
public function getCarDriver($id);
public function addCarDriver($carDriverArray);
public function carDriverSearch($text);

public function updateCarDriver($id,$carDriverArray);
public function updateCarDriverContact($driverId,$contactArray);

public function delCarDriver($id);
public function delCarDriverContacts($driverId);


public function getCarDriverContacts($carDriverId);
public function addCarDriverContact($contactArray);

public function getCarDriverRegions();
public function addCarDriverRegion();


}
