<?php

namespace App\Repositories\Interfaces;


use App\Models\rentEvent;

interface RentEventRepositoryInterface
{
    public function getEvents();
    public function getEvent($id):rentEvent;
    public function addEvent($dataArray);
    public function updateEvent($id,$dataArray);
    public function delEvent($id);
    public function getEventByAction($action):rentEvent;
}
