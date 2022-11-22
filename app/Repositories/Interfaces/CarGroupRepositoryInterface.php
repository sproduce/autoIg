<?php

namespace App\Repositories\Interfaces;
use App\Models\rentCarGroup;
use App\Models\rentCarGroupLink;


interface CarGroupRepositoryInterface
{

    public function getCarGroups();
    public function getLastCarGroups($kol);
    public function getCarGroup($id): rentCarGroup;
    public function addCarGroup($groupArray);
    public function updateCarGroup($id,$groupArray);
    public function delCarGroup($id);
    public function getCarGroupCars($id);

    public function carGroupInfo($groupId);
    public function addCarToGroup($groupArray);
    public function delCarFromGroup($groupId,$carId);

    public function searchCarGroup($text);

    public function getCarGroupsByCar($carId);

    public function getCarGroupLink($carGroupLinkId = null): rentCarGroupLink;
    public function storeCarGroupLink(rentCarGroupLink $rentCarGroupObj): rentCarGroupLink;
    
    
}
