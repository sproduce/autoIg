<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubjectController;


Route::get('/list',[SubjectController::class,'show']);
Route::get('/add',[SubjectController::class,'add']);


Route::get('/edit',[SubjectController::class,'edit']);
Route::post('/add',[SubjectController::class,'save']);

Route::get('/addContact/{id}',[SubjectController::class,'addContact']);
Route::post('/addContact',[SubjectController::class,'saveContact']);
Route::get('/fullInfo/{id}',[SubjectController::class,'fullInfo']);
Route::get('/addSubjectTo',[SubjectController::class,'addSubjectToDialog']);



