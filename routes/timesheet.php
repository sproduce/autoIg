<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TimeSheetController;


Route::get('/list',[TimeSheetController::class,'show']);

Route::get('/listByEvent',[TimeSheetController::class,'listByEvent']);



Route::get('/info',[TimeSheetController::class,'infoDialog']);

Route::get('/add',[TimeSheetController::class,'addEvent']);
Route::post('/add',[TimeSheetController::class,'add']);

Route::get('/edit',[TimeSheetController::class,'editEventDialog']);
Route::post('/edit',[TimeSheetController::class,'updateTimeSheet']);

Route::get('/car',[TimeSheetController::class,'showCarTimeSheet']);
Route::get('/days',[TimeSheetController::class,'showDaysTimeSheet']);
Route::get('/contract',[TimeSheetController::class,'showContractTimeSheet']);

Route::get('/listByEvent',[TimeSheetController::class,'listByEvent']);


Route::get('/carContracts',[TimeSheetController::class,'carContractDialog']);
Route::post('/addContract',[TimeSheetController::class,'addContractTimeSheet']);
