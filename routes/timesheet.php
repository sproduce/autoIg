<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TimeSheetController;


Route::get('/list',[TimeSheetController::class,'show']);

Route::get('/info',[TimeSheetController::class,'infoDialog']);

Route::get('/add',[TimeSheetController::class,'addEvent']);
Route::post('/add',[TimeSheetController::class,'add']);

Route::get('/edit',[TimeSheetController::class,'editEventDialog']);
Route::post('/edit',[TimeSheetController::class,'updateTimeSheet']);

Route::get('/car',[TimeSheetController::class,'showCarTimeSheet']);
