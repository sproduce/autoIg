<?php

namespace App\Repositories\Interfaces;

use App\Models\printDocument;

interface PrintDocumentRepositoryInterface
{

    public function getPrintDocument($printDocumentId): printDocument;

    
    
    
}
