<?php

namespace App\Repositories;
use App\Repositories\Interfaces\CarGroupRepositoryInterface;
use App\Models\rentCarGroup;

use App\Models\rentCarGroupLink;
use Illuminate\Support\Carbon;


class CarGroupRepository implements CarGroupRepositoryInterface
{
    public function getCarGroup($id): rentCarGroup
    {
        return rentCarGroup::find($id);
    }

    public function getCarGroups()
    {
        return rentCarGroup::all();
    }

    public function updateCarGroup($id, $groupArray)
    {
        // TODO: Implement updateCarGroup() method.
    }

    public function addCarGroup($groupArray)
    {
        return rentCarGroup::create($groupArray);
    }


    public function delCarGroup($id)
    {
        // TODO: Implement delCarGroup() method.
    }

    public function getCarGroupCars($id)
    {
        // TODO: Implement getCarGroupCars() method.
    }

    public function carGroupInfo($groupId)
    {
        return rentCarGroupLink::where('groupId', $groupId)->get();
    }

    public function addCarToGroup($groupArray)
    {
        return rentCarGroupLink::create($groupArray);
    }

    public function delCarFromGroup($groupId, $carId)
    {
        // TODO: Implement delCarFromGroup() method.
    }


    public function getLastCarGroups($kol)
    {
        return rentCarGroup::take($kol)->orderByDesc('id')->get();
    }


    public function searchCarGroup($text)
    {
        return rentCarGroup::query()
            ->where('name','LIKE','%'.$text.    '%')
            ->orWhere('nickName','LIKE','%'.$text.'%')
            ->get();
    }

    public function getCarGroupsByCar($carId)
    {
        $resultCarGroups = rentCarGroup::query()
            ->join('rent_car_group_links','rent_car_group_links.groupId','=','rent_car_groups.id')
            ->where('rent_car_group_links.carId','=',$carId)
            ->select(
                'rent_car_groups.*',
                'rent_car_group_links.start as linkStart',
                'rent_car_group_links.finish as linkFinish',
            )
            ->get();
        $resultCarGroups->each(function ($item, $key) {
            if ($item->linkStart){
                $item->linkStart = Carbon::parse($item->linkStart);
            }

            if ($item->linkFinish){
                $item->linkFinish = Carbon::parse($item->linkFinish);
            }

        });

        return  $resultCarGroups;
    }


}

