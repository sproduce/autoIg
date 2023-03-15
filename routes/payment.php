<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;


route::get('/list',[PaymentController::class,'show']);
route::get('/add/{paymentId?}',[PaymentController::class,'addDialog']);
route::post('/add',[PaymentController::class,'add']);


route::get('/edit/{paymentId}',[PaymentController::class,'edit']);

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
Route::get('/allocatePaymentErase/{paymentId}',[PaymentController::class,'allocatePaymentErase']);
Route::get('/allocateToPaymentErase/{toPaymentId}',[PaymentController::class,'allocateToPaymentErase']);

Route::post('/allocatePayment',[PaymentController::class,'saveAllocatePayment']);


Route::get('/info/{paymentId}',[PaymentController::class,'paymentFullInfo']);
Route::get('/toPaymentInfo/{paymentId}',[PaymentController::class,'toPaymentFullInfo']);


Route::get('/addBetweenAccounts',[PaymentController::class,'addBetweenAccounts']);
Route::post('/storeBetweenAccounts',[PaymentController::class,'storeBetweenAccounts']);
