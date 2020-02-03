<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class dataTagihanController extends Controller
{
    public function show(){
        return view('admin.data-tagihan');
    }
}
