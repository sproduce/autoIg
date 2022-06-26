<?php
namespace App\Services;



use Carbon\CarbonPeriod;

interface EventServiceInterface
{
    public function index(CarbonPeriod $datePeriod);

    public function getAdditionalViewDataArray();

    public function getEventModel($modelId = null);

    public function store();

    public function getViews();


}
