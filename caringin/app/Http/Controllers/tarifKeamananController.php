<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class tarifKeamananController extends Controller
{
    public function show(){
        return view('admin.tarif-keamanan');
    }
}
