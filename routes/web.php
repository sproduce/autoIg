<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReferenceController;
use App\Http\Controllers\DialogController;
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


Route::get('/dialog/addBrand',function(){
    return view('dialog.Brand.addBrand');
});

Route::get('/dialog/editBrand',[DialogController::class,'editBrand']);



Route::get('/dialog/addBrandGroup',function(){
    return view('dialog.Brand.addBrands');
});
