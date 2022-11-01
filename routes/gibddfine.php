<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GibddFineController;


//Route::get('/list',[SubjectController::class,'show']);
//Route::get('/add',[SubjectController::class,'add']);

Route::get('/',[GibddFineController::class,'index']);

Route::get('/mail',[GibddFineController::class,'mail']);

