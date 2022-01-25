<?php

namespace App\Repositories\Interfaces;


interface TimeSheetRepositoryInterface
{
    public function getTimeSheets($dateFrom,$dateTo);
    public function getTimeSheetsArray($dateFrom,$dateTo);
    public function getTimeSheetByDate($date);
    public function getTimeSheetById($id);
    public function addTimeSheet($dataArray);
    public function updateTimeSheet($id,$dataArray);
    public function getCarTimeSheetByDate($carId,$date);
}
