<?php

namespace App\Repositories\Interfaces;


interface EventCrushRepositoryInterface
{
    public function addEventCrush($dataArray);
    public function getEventCrushByContract($contractId);
    public function getEventCrush($id);
}
