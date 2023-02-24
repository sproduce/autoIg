<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubjectController;


Route::get('/list',[SubjectController::class,'show']);
Route::get('/add',[SubjectController::class,'add']);


Route::get('/edit',[SubjectController::class,'edit']);
Route::post('/add',[SubjectController::class,'save']);

Route::get('/addContact/{id}',[SubjectController::class,'addContact']);
Route::post('/addContact',[SubjectController::class,'saveContact']);
Route::get('/fullInfoDialog/{id}',[SubjectController::class,'fullInfoDialog']);
Route::get('/subjectInfo/{id}',[SubjectController::class,'fullInfoDialog']);
Route::get('/fullInfo/{id}',[SubjectController::class,'fullInfo']);



Route::get('/addSubjectTo/{parameter}',[SubjectController::class,'addSubjectToDialog']);
Route::get('/search',[SubjectController::class,'search']);


