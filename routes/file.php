<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileController;


//Route::get('/list',[SubjectController::class,'show']);
//Route::get('/add',[SubjectController::class,'add']);

Route::get('/show/{id}',[FileController::class,'showFile']);
Route::get('/download/{id}',[FileController::class,'downloadFile']);

