<?php

namespace App\Repositories;
use App\Repositories\Interfaces\GibddFineRepositoryInterface;
use App\Models\GibddFine;

class GibddFineRepository implements GibddFineRepositoryInterface
{
    public function getActualFines() 
    {
        $result = GibddFine::get();
        return $result;
    }

    
    public function getFineByNumber($decreeNumber): GibddFine
    {
        $result = GibddFine::where('decreeNumber',$decreeNumber)->first();
        
        return $result ?? new GibddFine();
    }
    
    
    
    public function getFinesWithoutOfTimeSheet() 
    {
        $result = GibddFine::whereNull('timeSheetId')->whereNotNull('sts')->whereNotNull('dateTimeFine')->orderBy('id')->get();
        return $result;
    }
    
    
    
    
    public function setFinesPaid() 
    {
        GibddFine::query()->where('closed','=',0)->update(['closed' => 1]);
    }
    
}
