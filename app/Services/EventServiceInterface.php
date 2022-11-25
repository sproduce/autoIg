<?php
namespace App\Services;


use Carbon\CarbonPeriod;
use Carbon\Carbon;
use App\Models\timeSheet;


interface EventServiceInterface
{
    public function index(CarbonPeriod $datePeriod);

    public function getAdditionalViewDataArray();

    public function getEventModel($modelId = null);

    public function store($dataCollection = null): timeSheet;

    public function destroy($dataId);

    public function getViews();

    public function getEventInfo($dataId = null);
    
    public function getNearestEvent(Carbon $dateTime,$carId);

    
}
