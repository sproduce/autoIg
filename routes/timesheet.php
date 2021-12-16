<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TimeSheetController;


Route::get('/list',[TimeSheetController::class,'show']);

