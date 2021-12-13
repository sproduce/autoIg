<?php

namespace App\Repositories;
use App\Repositories\Interfaces\CarOwnerRepositoryInterface;
use Illuminate\Support\Facades\DB;
use App\Models\carOwner;

class CarOwnerRepository implements CarOwnerRepositoryInterface
{
    public function getCarOwner($id)
    {
        return carOwner::find($id);
    }
    public function getCarOwners()
    {
        return carOwner::all();
    }
    public function getLastOwners($kol)
    {
        return carOwner::take($kol)->orderByDesc('id')->get();
    }

    public function carOwnerSearch($text)
    {
        return carOwner::query()->where('name','LIKE','%'.$text.'%')
            ->orWhere('nickname','LIKE','%'.$text.'%')
            ->take(5)
            ->get();
    }

    public function updateCarOwner($id, $carOwnerArray)
    {
        carOwner::where('id',$id)->update($carOwnerArray);
    }
    public function delCarOwner($id)
    {
        // TODO: Implement delCarOwner() method.
    }

    public function addCarOwner($carOwnerArray)
    {
        carOwner::create($carOwnerArray);
    }

}
