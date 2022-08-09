<?php

namespace App\Repositories;

use App\Models\rentEventDocumentInsurance;
use App\Repositories\Interfaces\EventDocumentInsuranceRepositoryInterface;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;


class EventDocumentInsuranceRepository implements EventDocumentInsuranceRepositoryInterface
{

    public function getEvent($id): rentEventDocumentInsurance
    {
        return rentEventDocumentInsurance::find($id) ?? new rentEventDocumentInsurance;
    }

}

