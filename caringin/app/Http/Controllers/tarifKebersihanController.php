<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class tarifKebersihanController extends Controller
{
    public function show(){
        return view('admin.tarif-kebersihan');
    }
}
