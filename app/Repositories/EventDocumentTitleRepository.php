<?php

namespace App\Repositories;

use App\Models\rentEventDocumentTitle;
use App\Repositories\Interfaces\EventDocumentTitleRepositoryInterface;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;


class EventDocumentTitleRepository implements EventDocumentTitleRepositoryInterface
{

    public function getEvent($id): rentEventDocumentTitle
    {
        return rentEventDocumentTitle::find($id) ?? new rentEventDocumentTitle();
    }

}

