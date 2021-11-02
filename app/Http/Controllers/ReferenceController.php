<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\carBrand;

use App\Services\BrandService;
use App\Services\ModelService;


class ReferenceController extends Controller
{
    private $brandServ;
    public function __construct(){
        //$this->brandServ=$brandServ;

    }


    public function showBrands(BrandService $brandServ){
        $brandsObj=$brandServ->getBrandByLetter();

        return view('reference.brandList',['brands'=>$brandsObj]);
    }

    public function addBrand(BrandService $brandServ): \Illuminate\Http\RedirectResponse
    {
        $brandServ->addBrand();
        return redirect()->back();
    }

    public function addBrands(BrandService $brandServ){
        $brandServ->addBrands();
        return redirect()->back();
    }

    public function delBrand(Request $request){

        $brandId=(int)$request->query('brandId');
        carBrand::destroy($brandId);
        return redirect()->back();
    }

    public function editBrand(Request $request){
        $brandId=(int)$request->input('brandId');
        if ($brandId) {
            $brandObj=carBrand::find($brandId);
            $brandObj->name=$request->input('brandName');
            $brandObj->save();
        }







        return redirect()->back();
    }


    public function showModels(Request $request){
        $brandId=(int)$request->input('brandId');
        $brandObj=carBrand::find($brandId);
        return view('reference.modelList',['brand'=>$brandObj]);
    }


    public function addModel(ModelService $modelServ)
    {
        $modelServ->addModel();
        return redirect()->back();
    }
    public function addModels()
    {

    }

    public function editModel()
    {

    }

    public function delModel()
    {

    }


}
