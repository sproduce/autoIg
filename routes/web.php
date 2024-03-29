<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReferenceController;
use App\Http\Controllers\DialogController;
use App\Http\Controllers\MotorPoolController;
use App\Http\Controllers\CarDriverController;
use App\Http\Controllers\CarGroupController;
use App\Http\Controllers\CarOwnerController;
use App\Http\Controllers\EventOtherController;

use App\Http\Controllers\EventRentalController;
use App\Http\Controllers\EventFineController;
use App\Http\Controllers\EventTransferController;
use App\Http\Controllers\EventPhotocontrolController;
use App\Http\Controllers\EventCrashController;
use App\Http\Controllers\EventWashController;
use App\Http\Controllers\EventServiceController;


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


Route::get('/dialog/carDriverInfo',[CarDriverController::class,'dialogInfo']);

Route::get('/reference/generation',[ReferenceController::class,'showGenerations']);
Route::get('/dialog/addGeneration',[DialogController::class,'addGeneration']);
Route::get('/dialog/editGeneration',[DialogController::class,'editGeneration']);
Route::post('/reference/generation',[ReferenceController::class,'addGeneration']);
Route::post('/reference/editGeneration',[ReferenceController::class,'editGeneration']);



Route::get('/motorPool/list',[MotorPoolController::class,'show']);
Route::get('/motorPool/listArchive',[MotorPoolController::class,'listArchive']);


Route::get('/motorPool/addCarTo',[MotorPoolController::class,'addCarToDialog']);
Route::get('/motorPool/search',[MotorPoolController::class,'search']);

Route::get('/motorPool/add',[MotorPoolController::class,'addMotorPoolDialog']);
Route::get('/motorPool/edit',[MotorPoolController::class,'editMotorPoolDialog']);

Route::get('/motorPool/carInfo/{id}',[MotorPoolController::class,'carInfo']);
Route::get('/motorPool/carInfoDialog/{id}',[MotorPoolController::class,'carInfoDialog']);
//Route::get('/motorPool/carInfoParent/{id}',[MotorPoolController::class,'carInfoDialog']);

Route::get('/motorPool/editNickname/{id}',[MotorPoolController::class,'editCarNicknameDialog']);
Route::post('/motorPool/editNickname',[MotorPoolController::class,'editCarNickname']);
Route::get('/motorPool/editPrice/{id}',[MotorPoolController::class,'editCarPriceDialog']);
Route::post('/motorPool/editPrice',[MotorPoolController::class,'editCarPrice']);

Route::post('/motorPool/add',[MotorPoolController::class,'add']);





Route::get('/dialog/editEngineType',[DialogController::class,'editEngineType']);
Route::get('/dialog/editType',[DialogController::class,'editType']);
Route::get('/dialog/editTransmissionType',[DialogController::class,'editTransmissionType']);


Route::get('/dialog/addEngineType',function(){
    return view('dialog.Car.addEngineType');
});

Route::get('/dialog/addType',function(){
    return view('dialog.Car.addType');
});

Route::get('/dialog/addTransmissionType',function(){
    return view('dialog.Car.addTransmissionType');
});

Route::post('/reference/addEngineType',[ReferenceController::class,'addCarEngineType']);
Route::post('/reference/addType',[ReferenceController::class,'addCarType']);
Route::post('/reference/addTransmissionType',[ReferenceController::class,'addCarTransmissionType']);





Route::get('/carDriver/search',[CarDriverController::class,'search']);



Route::get('/carDriver/list',[CarDriverController::class,'show']);
Route::get('/carDriver/add', [CarDriverController::class,'addDialog']);
Route::post('/carDriver/add',[CarDriverController::class,'saveCarDriver']);

Route::get('/carDriver/edit',[CarDriverController::class,'editCarDriver']);
Route::post('/carDriver/edit',[CarDriverController::class,'updateCarDriver']);

Route::get('/carGroup/list',[CarGroupController::class,'show']);
Route::get('/carGroup/add',[CarGroupController::class,'addDialog']);
Route::post('/carGroup/add',[CarGroupController::class,'save']);
Route::post('/carGroup/addCar',[CarGroupController::class,'addCarToGroup']);

Route::get('/carGroup/search',[CarGroupController::class,'search']);
Route::get('/carGroup/addCarGroupTo',[CarGroupController::class,'addCarGroupToDialog']);
Route::get('/carGroup/carInCarGroups',[CarGroupController::class,'carInCarGroups']);
Route::get('/carGroup/addCarInCarGroupDialog',[CarGroupController::class,'addCarInCarGroupDialog']);
Route::get('/carGroup/editCarInCarGroupDialog/{carGroupLinkId}',[CarGroupController::class,'editCarInCarGroupDialog']);
Route::post('/carGroup/storeCarInCarGroup',[CarGroupController::class,'storeCarInCarGroup']);



Route::get('/carGroup/fullInfo',[CarGroupController::class,'info']);
Route::get('/carGroup/info',[CarGroupController::class,'DialogInfo']);
Route::get('/carGroup/getCarActualGroup/{carId}/{date}',[CarGroupController::class,'getCarActualGroup']);




Route::get('/carOwner/list',[CarOwnerController::class,'show']);
Route::get('/carOwner/add',[CarOwnerController::class,'addDialog']);
Route::post('/carOwner/add',[CarOwnerController::class,'save']);

Route::get('/carOwner/edit',[CarOwnerController::class,'editDialog']);
Route::post('/carOwner/edit',[CarOwnerController::class,'update']);
Route::get('/carOwner/info',[CarOwnerController::class,'DialogInfo']);

Route::get('/carOwner/searchDialog',[CarOwnerController::class,'searchDialog']);
Route::get('/carOwner/search',[CarOwnerController::class,'search']);


//Route::resource('eventRental', EventRentalController::class);
//Route::resource('eventTransfer', EventTransferController::class);
//Route::resource('eventFine', EventFineController::class);
//Route::resource('eventPhotocontrol', EventPhotocontrolController::class);
//Route::resource('eventCrash', EventCrashController::class);
//Route::resource('eventOther', EventOtherController::class);
//Route::resource('eventWash', EventWashController::class);
//Route::resource('eventService', EventServiceController::class);
