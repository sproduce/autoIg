<?php

namespace App\Repositories\Interfaces;

use App\Models\rentEventDocumentTitle;
use Carbon\CarbonPeriod;

interface EventDocumentTitleRepositoryInterface
{

    public function getEvent($id): rentEventDocumentTitle;
}
