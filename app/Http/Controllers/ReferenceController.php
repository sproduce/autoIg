<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\carBrand;
use App\Services\BrandService;


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

    public function delBrand(){

        $brandId=(int)$request->query('brandId');
       // $brandObj=carBrand::find($brandId);
        //$brandObj->delete();
        carBrand::destroy($brandId);
        return redirect()->back();
    }

    public function editBrand(Request $request){
        $brandId=(int)$request->input('brandId');
        if($brandId){
            $brandObj=carBrand::find($brandId);
            $brandObj->name=$request->input('brandName');
            $brandObj->save();
        }

        //var_dump($brandObj);


        return redirect()->back();
    }



}
