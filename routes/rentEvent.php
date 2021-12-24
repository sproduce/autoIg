<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RentEventController;


Route::get('/list',[RentEventController::class,'show']);

Route::get('/edit',[RentEventController::class,'editDialog']);
Route::post('/edit',[RentEventController::class,'update']);

Route::get('/add',[RentEventController::class,'addDialog']);
Route::post('/add',[RentEventController::class,'add']);

