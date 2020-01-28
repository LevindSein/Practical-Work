<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class laporanTagihanController extends Controller
{
    public function show(){
        return view('admin.laporan-tagihan');
    }
}
