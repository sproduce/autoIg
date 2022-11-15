<?php
namespace App\Services;

use App\Models\rentEvent;

use Carbon\CarbonPeriod;
use Carbon\Carbon;
interface EventServiceInterface
{
    public function index(CarbonPeriod $datePeriod);

    public function getAdditionalViewDataArray();

    public function getEventModel($modelId = null);

    public function store($dataCollection = null);

    public function destroy($dataId);

    public function getViews();

    public function getEventInfo($dataId = null);
    
    public function getNearestEvent(Carbon $dateTime,$carId);

    
}
