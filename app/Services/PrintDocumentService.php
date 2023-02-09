<?php
namespace App\Services;

use App\Repositories\Interfaces\PrintDocumentRepositoryInterface;


Class PrintDocumentService {

    private $printDocumentRep;

    function __construct(PrintDocumentRepositoryInterface $printDocumentRep)
    {
        $this->printDocumentRep = $printDocumentRep;
    }


    public function getPrintDocument($printDocumentId) 
    {
        return $this->printDocumentRep->getPrintDocument($printDocumentId);
    }
    
    

}
