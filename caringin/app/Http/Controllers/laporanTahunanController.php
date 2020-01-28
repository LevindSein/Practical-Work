<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class laporanTahunanController extends Controller
{
    public function show(){
        return view('admin.laporan-tahunan');
    }
}
