<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RentEventController;


Route::get('/list',[RentEventController::class,'list']);
Route::get('/test',[RentEventController::class,'test']);

Route::get('/edit',[RentEventController::class,'editDialog']);
Route::post('/edit',[RentEventController::class,'update']);

Route::get('/add',[RentEventController::class,'addDialog']);
Route::post('/add',[RentEventController::class,'add']);


Route::get('{eventId}',[RentEventController::class,'index']);
Route::get('{eventId}/create',[RentEventController::class,'create']);
Route::post('{eventId}',[RentEventController::class,'store']);

Route::get('{eventId}/{dataId}/edit',[RentEventController::class,'edit']);
Route::get('{eventId}/{dataId}/destroy',[RentEventController::class,'destroy']);
Route::get('{eventId}/{dataId}',[RentEventController::class,'show']);


