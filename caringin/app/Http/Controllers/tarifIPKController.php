<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class tarifIPKController extends Controller
{
    public function show(){
        return view('admin.tarif-ipk');
    }
}
