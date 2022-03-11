<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContractAdditionalController;

route::get('/list',[ContractAdditionalController::class,'show']);
route::get('/contractAdditional',[ContractAdditionalController::class,'contractAdditional']);
