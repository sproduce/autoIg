<?php
namespace App\Services;
use App\Repositories\Interfaces\BrandRepositoryInterface;
use Illuminate\Http\Request;


Class BrandService{

    private $brandRep,$request;


    function __construct(BrandRepositoryInterface $Brand,Request $request){
        $this->brandRep=$Brand;
        $this->request=$request;
    }


    public function getBarnds()
    {

        return $this->brandRep->getBrands();
    }



    public function getBrandByLetter(){
        $letter=$this->request->query('letter','A');


        return $this->brandRep->getBrandByLetter($letter);
    }




    public function addBrand(){
        $brandName=$this->request->input('brandName');
        if($brandName){
            $brandObj=$this->brandRep->getBrandByName($brandName);
            if(!$brandObj->count()){
                $this->brandRep->saveBrand($brandName);
            }
        }

    }

    public function addBrands(){
        $arrayOfBrands=explode("\r\n", ucwords(strtolower($this->request->input('brandsName'))));
        foreach($arrayOfBrands as $brandName){
            if($brandName){
                $brandObj=$this->brandRep->getBrandByName($brandName);
                if(!$brandObj->count()){
                    $this->brandRep->saveBrand($brandName);
                }
            }
        }



    }



}
