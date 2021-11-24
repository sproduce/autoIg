<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;



route::get('/list',[PaymentController::class,'show']);
route::get('/add',[PaymentController::class,'addDialog']);
route::post('/add',[PaymentController::class,'add']);


route::get('/edit',[PaymentController::class,'edit']);
route::post('/edit',[PaymentController::class,'update']);
route::get('/delete',[PaymentController::class,'delete']);
