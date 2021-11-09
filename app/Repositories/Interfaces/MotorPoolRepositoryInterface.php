<?php


namespace App\Repositories\Interfaces;
interface MotorPoolRepositoryInterface
{
public function addCar($carInfoArray);
public function getCars();
public function getCar($carId);
}
