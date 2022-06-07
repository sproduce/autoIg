<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;



route::get('/list',[PaymentController::class,'show']);
route::get('/add',[PaymentController::class,'addDialog']);
route::post('/add',[PaymentController::class,'add']);


route::get('/edit',[PaymentController::class,'edit']);
route::post('/edit',[PaymentController::class,'update']);
route::get('/delete',[PaymentController::class,'delete']);



Route::get('/addCar',[PaymentController::class,'addCarDialog']);
Route::get('/addCarGroup',[PaymentController::class,'addCarGroupDialog']);
Route::get('/addContract',[PaymentController::class,'addContractDialog']);

Route::get('/listByContract',[PaymentController::class,'listByContract']);
Route::get('/toPay',[PaymentController::class,'listToPays']);


Route::get('/copyToPayClientDialog',[PaymentController::class,'copyToPayClientDialog']);
Route::post('/copyToPayClient',[PaymentController::class,'copyToPayClient']);

Route::get('/addToPay',[PaymentController::class,'addToPayDialog']);
Route::post('/addToPay',[PaymentController::class,'addToPay']);


Route::get('/allocatePayment/{paymentId}',[PaymentController::class,'allocatePayment']);
