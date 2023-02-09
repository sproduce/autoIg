<?php

namespace App\Repositories;

use App\Repositories\Interfaces\PrintDocumentRepositoryInterface;
use Illuminate\Support\Facades\DB;
use App\Models\printDocument;



class PrintDocumentRepository implements PrintDocumentRepositoryInterface
{
   
    public function getPrintDocument($id): printDocument
    {
        return printDocument::find($id) ?? new printDocument();
    }
    
    
    
}
