<?php

namespace App\Repositories\Interfaces;

use App\Models\rentEventDocumentTitle;
use Carbon\CarbonPeriod;

interface EventDocumentTitleRepositoryInterface
{

    public function getEvent($id): rentEventDocumentTitle;
    public function addEvent(rentEventDocumentTitle $rentEventDocumentTitle): rentEventDocumentTitle;
    public function getEventFullInfo($eventId,$dataId);
    public function getEvents($eventId,CarbonPeriod $datePeriod);
    public function delEvent(rentEventDocumentTitle $rentEventDocumentTitle);
}
