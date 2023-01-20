<?php
namespace App\Services;
use App\Repositories\Interfaces\DocumentRepositoryInterface;

Class DocumentService{

    private $documentRep;

    function __construct(DocumentRepositoryInterface $documentRep)
    {
        $this->documentRep = $documentRep;
    }

    
    
    public function getPassport($uuid) 
    {
        
    }
    
    
    

}
