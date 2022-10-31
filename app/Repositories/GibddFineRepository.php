<?php

namespace App\Repositories;
use App\Repositories\Interfaces\GibddFineRepositoryInterface;
use App\Models\GibddFine;

class GibddFineRepository implements GibddFineRepositoryInterface
{
    public function getActualFines() 
    {
        $result = GibddFine::where('closed',0)->get();
        return $result;
    }

    
    public function getFineByNumber($decreeNumber): GibddFine
    {
        $result = GibddFine::where('decreeNumber',$decreeNumber)->first();
        return $result ?? new GibddFine();
    }
    
    
}
