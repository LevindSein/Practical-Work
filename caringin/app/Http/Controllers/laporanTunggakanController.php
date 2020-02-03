<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class laporanTunggakanController extends Controller
{
    public function show(){
        return view('admin.laporan-tunggakan');
    }
}
