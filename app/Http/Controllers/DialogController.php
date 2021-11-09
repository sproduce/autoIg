<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use App\Models\carBrand;
use App\Models\carModel;
use App\Models\carGeneration;
use App\Models\carOwner;
use App\Services\BrandService;
use App\Services\ModelService;

class DialogController extends Controller
{
    public function editBrand(Request $request){
        $brandId=(int)$request->query('brandId');
        $brandObj=carBrand::find($brandId);
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

    public function editGeneration(Request $request)
    {
        $validated = $request->validate(['generationId'=>'required|integer']);
        $generationObj=carGeneration::find($validated['generationId']);
        return view('dialog.Car.editGeneration',['generation'=>$generationObj]);
    }



    public function addMotorPool(BrandService $brandServ,ModelService $modelServ)
    {
        $brandsObj=$brandServ->getBarnds();
        $typesObj=$modelServ->getTypes();
        $ownersObj=carOwner::all();

        return view('dialog.MotorPool.addCar',['brands'=>$brandsObj,'types'=>$typesObj,'owners'=>$ownersObj]);
    }




}
