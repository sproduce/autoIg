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


    public function getBrandByLetter(){
        $letter=$this->request->query('letter','A');

        $result=$this->brandRep->getBrandByLetter($letter);
    }




    public function addBrand(){

    }

}
