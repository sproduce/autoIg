<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReferenceController;
use App\Http\Controllers\DialogController;
use App\Http\Controllers\MotorPoolController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('adminIndex');
});

Route::get('/reference/brand',[ReferenceController::class,'showBrands']);
Route::get('/reference/delBrand',[ReferenceController::class,'delBrand']);

Route::post('/reference/brand',[ReferenceController::class,'addBrand']);
Route::post('/reference/brands',[ReferenceController::class,'addBrands']);
Route::post('/reference/editBrand',[ReferenceController::class,'editBrand']);

Route::get('/reference/engineTransmissionBody',[ReferenceController::class,'engineTransmissionBody']);




Route::get('/dialog/addBrand',function(){
    return view('dialog.Car.addBrand');
});

Route::get('/dialog/editBrand',[DialogController::class,'editBrand']);



Route::get('/dialog/addBrandGroup',function(){
    return view('dialog.Car.addBrands');
});


Route::get('/reference/model',[ReferenceController::class,'showModels']);
Route::get('/dialog/addModel',[DialogController::class,'addModel']);
Route::get('/dialog/addModelGroup',[DialogController::class,'addModels']);
Route::get('/dialog/editModel',[DialogController::class,'editModel']);
Route::get('/reference/delModel',[ReferenceController::class,'delModel']);
Route::post('/reference/model',[ReferenceController::class,'addModel']);
Route::post('/reference/models',[ReferenceController::class,'addModels']);
Route::post('/reference/editModel',[ReferenceController::class,'editModel']);


Route::get('/dialog/carInfo',[MotorPoolController::class,'dialogCarInfo']);

Route::get('/reference/generation',[ReferenceController::class,'showGenerations']);
Route::get('/dialog/addGeneration',[DialogController::class,'addGeneration']);
Route::get('/dialog/editGeneration',[DialogController::class,'editGeneration']);
Route::post('/reference/generation',[ReferenceController::class,'addGeneration']);
Route::post('/reference/editGeneration',[ReferenceController::class,'editGeneration']);



Route::get('/motorPool/list',[MotorPoolController::class,'show']);

Route::get('/motorPool/add',[DialogController::class,'addMotorPool']);
Route::post('/motorPool/add',[MotorPoolController::class,'add']);




Route::get('/dialog/editEngineType',[DialogController::class,'editEngineType']);
Route::get('/dialog/editType',[DialogController::class,'editType']);
Route::get('/dialog/editTransmissionType',[DialogController::class,'editTransmissionType']);
