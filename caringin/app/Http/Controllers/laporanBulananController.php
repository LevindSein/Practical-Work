<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class laporanBulananController extends Controller
{
    public function show(){
        return view('admin.laporan-bulanan');
    }
}
