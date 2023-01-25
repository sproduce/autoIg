<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentController;


Route::get('/addPassport/{passportId?}',[DocumentController::class,'addPassportDialog']);
Route::get('/addPayment/{paymentId?}',[DocumentController::class,'addPaymentDialog']);
Route::post('/storePassport',[DocumentController::class,'storePassport']);




//Route::get('/carContracts',[ContractController::class,'dialogCarContract']);

