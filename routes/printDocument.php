<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrintDocumentController;


Route::get('/document1',[PrintDocumentController::class,'document1']);
Route::get('/document2',[PrintDocumentController::class,'document2']);
Route::get('/document3',[PrintDocumentController::class,'document3']);
Route::get('/document4',[PrintDocumentController::class,'document4']);
Route::get('/document5',[PrintDocumentController::class,'document5']);
Route::get('/document6',[PrintDocumentController::class,'document6']);
Route::get('/document7',[PrintDocumentController::class,'document7']);
Route::get('/document8',[PrintDocumentController::class,'document8']);
Route::get('/document9',[PrintDocumentController::class,'document9']);
Route::get('/document10',[PrintDocumentController::class,'document10']);



