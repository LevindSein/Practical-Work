<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class tagihanKeamananController extends Controller
{
    public function index(){
        return view('admin.tagihan-keamanan');
    }
}
