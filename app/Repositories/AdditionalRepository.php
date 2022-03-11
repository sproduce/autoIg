<?php

namespace App\Repositories;

use App\Models\rentAdditional;
use App\Models\toPayment;
use App\Repositories\Interfaces\AdditionalRepositoryInterface;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class AdditionalRepository implements AdditionalRepositoryInterface
{


    public function getAdditionals()
    {
        return rentAdditional::all();
    }
    public function getAdditionalsByDate(CarbonPeriod $datePeriod)
    {
        $additionalsCollection=DB::table('rent_additionals')
            ->join('time_sheets','time_sheets.id','=','rent_additionals.timeSheetId')
            ->get();
        return $additionalsCollection;
    }

    public function addAdditional()
    {
        // TODO: Implement addAdditional() method.
    }

}

