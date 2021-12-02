<?php

namespace App\Repositories\Interfaces;
interface CarGroupRepositoryInterface
{

    public function getCarGroups();

    public function getCarGroup($id);
    public function addCarGroup($groupArray);
    public function updateCarGroup($id,$groupArray);
    public function delCarGroup($id);
    public function getCarGroupCars($id);

    public function carGroupInfo($groupId);
    public function addCarToGroup($groupArray);
    public function delCarFromGroup($groupId,$carId);



}
