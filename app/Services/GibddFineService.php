<?php
namespace App\Services;
use App\Repositories\Interfaces\GibddFineRepositoryInterface;


Class GibddFineService{

    private $gibddFineRep;


    function __construct(GibddFineRepositoryInterface $gibddFineRep)
    {
       $this->gibddFineRep = $gibddFineRep;
    }

    public function getActualFines() 
    {
        return $this->gibddFineRep->getActualFines();
    }



}
