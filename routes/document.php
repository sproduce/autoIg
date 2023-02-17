<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentController;


Route::get('/addPassport/{passportId?}',[DocumentController::class,'addPassportDialog']);
Route::get('/addPayment/{paymentId?}',[DocumentController::class,'addPaymentDialog']);
Route::get('/addLicense/{licenseId?}',[DocumentController::class,'addLicenseDialog']);
Route::get('/addEntity/{entityId?}',[DocumentController::class,'addEntityDialog']);
Route::get('/addContact/{contactId?}',[DocumentController::class,'addContactDialog']);


Route::get('/actualPassport/{passportId}',[DocumentController::class,'actualPassport']);
Route::get('/actualPayment/{paymentId}',[DocumentController::class,'actualPayment']);
Route::get('/actualLicense/{licenseId}',[DocumentController::class,'actualLicense']);
Route::get('/actualEntity/{entityId}',[DocumentController::class,'actualEntity']);
Route::get('/actualContact/{entityId}',[DocumentController::class,'actualContact']);




Route::post('/storePassport',[DocumentController::class,'storePassport']);
Route::post('/storePayment',[DocumentController::class,'storePayment']);
Route::post('/storeLicense',[DocumentController::class,'storeLicense']);
Route::post('/storeEntity',[DocumentController::class,'storeEntity']);
Route::post('/storeContact',[DocumentController::class,'storeContact']);




//Route::get('/carContracts',[ContractController::class,'dialogCarContract']);

