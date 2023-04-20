<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;


Route::get('/list',[ReportController::class,'list']);
Route::get('/group',[ReportController::class,'group']);



