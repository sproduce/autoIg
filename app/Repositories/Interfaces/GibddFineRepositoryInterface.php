<?php

namespace App\Repositories\Interfaces;

use Carbon\CarbonPeriod;
use App\Models\GibddFine;

interface GibddFineRepositoryInterface
{
    public function getActualFines();
    public function getFineByNumber($decreeNumber): GibddFine;
    public function getFinesWithoutOfTimeSheet();

}
