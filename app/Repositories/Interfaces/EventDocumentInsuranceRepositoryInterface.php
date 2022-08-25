<?php

namespace App\Repositories\Interfaces;

use App\Models\rentEventDocumentInsurance;
use Carbon\CarbonPeriod;

interface EventDocumentInsuranceRepositoryInterface
{
    public function getEvent($id): rentEventDocumentInsurance;
    public function addEvent(rentEventDocumentInsurance $rentEventDocumentInsurance): rentEventDocumentInsurance;
    public function getEventFullInfo($eventId,$dataId);
    public function getEvents($eventId,CarbonPeriod $datePeriod);
    public function delEvent(rentEventDocumentInsurance $rentEventDocumentInsurance);
}
