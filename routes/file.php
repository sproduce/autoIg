<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileController;


//Route::get('/list',[SubjectController::class,'show']);
//Route::get('/add',[SubjectController::class,'add']);

//Route::get('/show/{id}',[FileController::class,'showFile']);
Route::get('/show/{id}',[FileController::class,'downloadFile']);
Route::get('/download/{id}',[FileController::class,'downloadFile']);


Route::get('/downloadLink/{linkId}',[FileController::class,'downloadFileLink']);
Route::get('/fileInfoDialog/{uuid}',[FileController::class,'fileInfoDialog']);
Route::post('/addFiles/{uuid}',[FileController::class,'addFiles']);
Route::get('/deleteFile/{uuid}/{photoId}',[FileController::class,'delfile']);
Route::get('/notUsedFileList',[FileController::class,'notUsedFileList']);




