<?php
namespace App\Services;
use App\Repositories\Interfaces\GibddFineRepositoryInterface;
use App\Models\GibddFine;

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


    
    public function getFinesWithoutOfTimeSheet() 
    {
        return $this->gibddFineRep->getFinesWithOutOfTimeSheet();
    }
    
    
    
    public function setFinesPaid() 
    {
        $this->gibddFineRep->setFinesPaid();
    }
    
    
    public function getFineByNumber($decreeNumber): GibddFine 
    {
        return $this->gibddFineRep->getFineByNumber($decreeNumber);
    }
    
}
