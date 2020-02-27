<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class laporanController extends Controller
{
    public function showHarian(){
        return view('admin.laporan-harian');
    }
    public function showBulanan(){
        return view('admin.laporan-bulanan');
    }
    public function showTahunan(){
        return view('admin.laporan-tahunan');
    }
    public function showTagihan(){
        return view('admin.laporan-tagihan');
    }
    public function showTunggakan(){
        return view('admin.laporan-tunggakan');
    }
    public function showBongkaran(){
        return view('admin.laporan-bongkaran');
    }
    public function showPenghapusan(){
        return view('admin.laporan-penghapusan');
    }
}
