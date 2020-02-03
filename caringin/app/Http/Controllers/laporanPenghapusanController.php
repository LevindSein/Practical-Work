<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class laporanPenghapusanController extends Controller
{
    public function show(){
        return view('admin.laporan-penghapusan');
    }
}
