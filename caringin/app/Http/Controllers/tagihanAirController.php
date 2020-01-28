<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class tagihanAirController extends Controller
{
    public function show(){
        return view('admin.tagihan-air');
    }
}
