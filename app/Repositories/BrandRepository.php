<?php

namespace App\Repositories;
use App\Repositories\Interfaces\BrandRepositoryInterface;
use App\Models\carBrand;
use Illuminate\Support\Facades\DB;

class BrandRepository implements BrandRepositoryInterface
{
    private $carBrand;
    function __construct(carBrand $carBrand){
        $this->carBrand=$carBrand;
    }


    public function getBrandByLetter($letter){

        return DB::table('car_brands')->where('name','LIKE',$letter.'%')
            ->get();
    }

    public function getBrandByName($brandName){

        return $this->carBrand::where('name',$brandName)->get();
    }


        public function getBrands()
        {
            return $this->carBrand::orderBy('name')->get();
        }



    public function saveBrand($brandName){
        //$carBrand=new carBrand();
        $result=carBrand::create([
            'name' => $brandName
        ]);
        //$this->carBrand->name=$brandName;
        //$this->carBrand->save();
    }

}
