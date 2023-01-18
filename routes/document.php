<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentController;


Route::get('/addPassport/{linkUuid}',[DocumentController::class,'addPassportDialog']);
//Route::post('/addAdditional',[ContractController::class,'addContractAdditional']);
//Route::get('/carContracts',[ContractController::class,'dialogCarContract']);

