<?php

namespace App\Repositories;
use App\Repositories\Interfaces\DocumentRepositoryInterface;
use Illuminate\Support\Facades\DB;

use App\Models\rentDocumentPassport;

class DocumentRepository implements DocumentRepositoryInterface
{

    public function getPassport($passportId) 
    {
        return rentDocumentPassport::find($passportId) ?? new rentDocumentPassport;
    }
    
}
