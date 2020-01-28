<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class tagihanListrikController extends Controller
{
    public function show(){
        return view('admin.tagihan-listrik');
    }
}
