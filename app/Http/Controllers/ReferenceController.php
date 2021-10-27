<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\carBrand;

class ReferenceController extends Controller
{
    public function showBrands(){
        return view('reference.brandList',['brands'=>carBrand::all()]);
    }
}
