<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContractController;

Route::get('/actualList',[ContractController::class,'showActual']);
Route::get('/completedList',[ContractController::class,'showCompleted']);


Route::get('/add',[ContractController::class,'addContract']);
Route::post('/add',[ContractController::class,'saveContract']);
Route::get('/edit',[ContractController::class,'editContract']);
Route::post('/edit',[ContractController::class,'updateContract']);


Route::get('/addDriver',[ContractController::class,'addDriverDialog']);
Route::get('/addCar',[ContractController::class,'addCarDialog']);
