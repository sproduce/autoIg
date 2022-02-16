<?php

namespace App\Repositories\Interfaces;


interface EventCrashRepositoryInterface
{
    public function addEventCrash($dataArray);
    public function getEventCrashByContract($contractId);
    public function getEventCrash($id);
}
