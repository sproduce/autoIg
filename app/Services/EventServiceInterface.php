<?php
namespace App\Services;



use Carbon\CarbonPeriod;

interface EventServiceInterface
{
    public function index(CarbonPeriod $datePeriod);

    //public function store(Req);

    public function getAdditionalViewDataArray();

    public function getEventModel($modelId = null);

    public function getRequestRules();

    public function store($dataArray);

    public function getViews();


}
