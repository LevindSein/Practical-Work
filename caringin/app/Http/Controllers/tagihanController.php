<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class tagihanController extends Controller
{
    public function tagihanAir(){
        return view('admin.tagihan-air');
    }
    public function tagihanListrik(){
        return view('admin.tagihan-listrik');
    }
}
