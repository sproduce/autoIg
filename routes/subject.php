<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubjectController;


Route::get('/list',[SubjectController::class,'show']);
Route::get('/add',[SubjectController::class,'add']);


Route::get('/edit',[SubjectController::class,'edit']);



Route::post('/add',[SubjectController::class,'save']);

Route::post('/edit',[SubjectController::class,'update']);




