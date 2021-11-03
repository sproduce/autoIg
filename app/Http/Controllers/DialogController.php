<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\carBrand;
use App\Models\carModel;

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

    public function addModels(Request $request){
        $brandId=(int)$request->query('brandId');
        $brandObj=carBrand::find($brandId);
        return view('dialog.Car.addModels',['brand'=>$brandObj]);
    }


    public function editModel(Request $request)
    {
        $modelId=(int)$request->query('modelId');
        $modelObj=carModel::find($modelId);
        return view('dialog.Car.editModel',['model'=>$modelObj]);
    }



    public function addGeneration(Request $request)
    {
        $modelId=(int)$request->query('modelId');
        $modelObj=carModel::find($modelId);
        return view('dialog.Car.addGeneration',['model'=>$modelObj]);
    }


}
