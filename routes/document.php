<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentController;


Route::get('/addPassport/{passportId?}',[DocumentController::class,'addPassportDialog']);
Route::get('/addPayment/{paymentId?}',[DocumentController::class,'addPaymentDialog']);
Route::get('/addLicense/{licenseId?}',[DocumentController::class,'addLicenseDialog']);
Route::get('/addEntity/{entityId?}',[DocumentController::class,'addEntityDialog']);


Route::post('/storePassport',[DocumentController::class,'storePassport']);
Route::post('/storePayment',[DocumentController::class,'storePayment']);
Route::post('/storeLicense',[DocumentController::class,'storeLicense']);
Route::post('/storeEntity',[DocumentController::class,'storeEntity']);




//Route::get('/carContracts',[ContractController::class,'dialogCarContract']);

