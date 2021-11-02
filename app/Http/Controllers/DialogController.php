<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\carBrand;


class DialogController extends Controller
{
    public function editBrand(Request $request){
        $brandId=(int)$request->query('brandId');
        //var_dump($brandId);
        $brandObj=carBrand::find($brandId);
        //var_dump($brandObj);
        //echo "Asdasd";
        //return view('reference.brandList',['brands'=>$brandsObj]);
        return view('dialog.Car.editBrand',['brand'=>$brandObj]);
    }

    public function addModel(Request $request)
    {
        $brandId=(int)$request->query('brandId');
        $brandObj=carBrand::find($brandId);
        return view('dialog.Car.addModel',['brand'=>$brandObj]);
    }



}
