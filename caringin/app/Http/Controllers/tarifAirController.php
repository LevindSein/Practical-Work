<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class tarifAirController extends Controller
{
    public function show(){
        return view('admin.tarif-air');
    }
}
