<?php


namespace App\Repositories\Interfaces;
use App\Models\carConfiguration;

interface MotorPoolRepositoryInterface
{
public function addCar(carConfiguration $carConfiguration): carConfiguration;
public function getCars();
public function getCar($carId):carConfiguration;
public function getLastCars($kol);
public function search($text);
}
