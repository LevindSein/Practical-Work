<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class tagihanController extends Controller
{
    public function formtagihan(){
        return view('admin.form-tagihan');
    }
    public function tagihanNas(){
        return view('admin.tagihan-nasabah');
    }
}
