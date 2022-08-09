<?php

namespace App\Repositories\Interfaces;

use App\Models\rentEventDocumentInsurance;
use Carbon\CarbonPeriod;

interface EventDocumentInsuranceRepositoryInterface
{
    public function getEvent($id): rentEventDocumentInsurance;
}
