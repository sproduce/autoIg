<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrintDocumentController;


Route::get('/document1',[PrintDocumentController::class,'document1']);



