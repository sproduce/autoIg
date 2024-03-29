<?php

use App\Http\Controllers\CarGroupController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReferenceController;
use App\Http\Controllers\MotorPoolController;
use App\Http\Controllers\ContractController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/getModels',[ReferenceController::class,'getModel']);
Route::get('/getGenerations',[ReferenceController::class,'getGeneration']);


Route::get('/getContractInfo/{contractId}',[ContractController::class,'getContractInfo']);



Route::get('/getCarGroups/{carId}',[CarGroupController::class,'getCarGroupsApi']);
Route::get('/getCarActualGroup/{carId}/{date}',[CarGroupController::class,'getCarActualGroup']);


Route::get('/getCarRentFrom/{carId}',[MotorPoolController::class,'getCarRentFrom']);
Route::get('/getCarInfo/{carId}?',[MotorPoolController::class,'getCarInfo']);
Route::get('/getCarFullInfo/{carId}',[MotorPoolController::class,'getCarFullInfo']);
