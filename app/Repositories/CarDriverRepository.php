<?php

namespace App\Repositories;
use App\Repositories\Interfaces\CarDriverRepositoryInterface;
use Illuminate\Support\Facades\DB;
use App\Models\rentCarDriver;
use App\Models\rentCarDriverContact;
use App\Models\rentCarDriverRegion;

class CarDriverRepository implements CarDriverRepositoryInterface
{
    public function getCarDrivers()
    {
        return rentCarDriver::all();
    }

    public function addCarDriver($carDriverArray)
    {
        return rentCarDriver::create($carDriverArray);
    }
    public function getCarDriver($id)
    {
        return rentCarDriver::find($id)??new rentCarDriver();
    }

    public function addCarDriverContact($contactArray)
    {
        return rentCarDriverContact::create($contactArray);
    }
    public function getCarDriverContacts($carDriverId)
    {
        // TODO: Implement getCarDriverContacts() method.
    }


    public function getCarDriverRegions()
    {
        return rentCarDriverRegion::all();
    }

    public function addCarDriverRegion()
    {
        // TODO: Implement addCarDriverRegion() method.
    }

    public function getLastDrivers($kol)
    {
        return rentCarDriver::take($kol)->orderByDesc('id')->get();

    }

    public function carDriverSearch($text)
    {

        return rentCarDriver::query()->where('name','LIKE','%'.$text.'%')
            ->orWhere('surname','LIKE','%'.$text.'%')
            ->orWhereHas('contacts',function($q) use ($text){
                return $q->where('phone','LIKE','%'.$text.'%');
            })
            ->take(5)
            ->get();
    }


    public function updateCarDriver($id,$carDriverArray)
    {

        rentCarDriver::where('id',$id)->update($carDriverArray);
    }
    public function updateCarDriverContact($driverId,$contactArray)
    {
        // TODO: Implement updateCarDriverContact() method.
    }

    public function delCarDriverContacts($driverId)
    {
        // TODO: Implement delCarDriverContacts() method.
    }

    public function delCarDriver($id)
    {
        rentCarDriver::destroy($id);
    }


}
