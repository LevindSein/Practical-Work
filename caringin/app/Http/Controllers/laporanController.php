<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tagihan;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Redirector;

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
        $dataset = DB::table('tempat_usaha')
        ->leftJoin('nasabah','tempat_usaha.ID_NASABAH','=','nasabah.ID_NASABAH')
        ->select('tempat_usaha.ID_TEMPAT','tempat_usaha.KD_KONTROL', 'nasabah.NM_NASABAH','nasabah.NO_KTP','nasabah.NO_NPWP','nasabah.ID_NASABAH')
        ->get();
        return view('admin.laporan-tagihan',['dataset'=>$dataset]);
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
