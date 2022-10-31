<?php

namespace App\Http\Controllers;
use App\Services\GibddFineService;

class GibddFineController extends Controller
{
    private $gibddFineServ;
    
    public function __construct(GibddFineService $gibddFineServ)
    {
        $this->gibddFineServ = $gibddFineServ;
    }
    
    
    public function index() 
    {
        $finesObj = $this->gibddFineServ->getActualFines();
        return view('gibddFine.listAll',['finesObj' => $finesObj]);
    }
    
    
    
    
    
}
