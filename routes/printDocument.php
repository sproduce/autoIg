<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrintDocumentController;


Route::get('/list',[PrintDocumentController::class,'list']);
Route::get('/add/{printDocumentId?}',[PrintDocumentController::class,'addDialog']);
Route::post('/add',[PrintDocumentController::class,'store']);


Route::get('/document10',[PrintDocumentController::class,'document10']);



