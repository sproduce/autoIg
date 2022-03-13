<?php

namespace App\Repositories\Interfaces;

use Carbon\CarbonPeriod;

interface AdditionalRepositoryInterface
{
    public function getAdditionals();
    public function getAdditionalsByDate(CarbonPeriod $datePeriod);

    public function addAdditional($additionalArray);

}
