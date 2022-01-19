<?php

namespace App\Repositories\Interfaces;


interface RentEventRepositoryInterface
{
    public function getEvents();
    public function getEvent($id);
    public function addEvent($dataArray);
    public function updateEvent($id,$dataArray);
    public function delEvent($id);
    public function getEventByAction($action);
}
