<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tarif_air;
use App\Tarif_listrik;
use Illuminate\Support\Facades\DB;

class tarifController extends Controller
{
    //Tarif Air
    public function showTAir(){
        $dataset = DB::table('tarif_air')->get();
        return view('admin.tarif-air',['dataset'=>$dataset]);
    }
    public function updateStoreA(Request $request, $id){
        DB::table('tarif_air')->where('ID_TRFAIR', $id)->update([
            'TRF_AIR1'=>$request->get('tarif1'),
            'TRF_AIR2'=>$request->get('tarif2'),
            'TRF_PEMELIHARAAN'=>$request->get('tarifpemeliharaan'),
            'TRF_BEBAN'=>$request->get('tarifbeban'),
            'TRF_ARKOT'=>$request->get('tarifarkot'),
            'TRF_DENDA'=>$request->get('tarifdenda'),
            'PPN_AIR'=>$request->get('ppnair')
        ]);
        return redirect()->back()->with('alert-success','Data Tersimpan');
    }

    //Tarif Listrik
    public function showTListrik(){
        $dataset = DB::table('tarif_listrik')->get();
        return view('admin.tarif-listrik',['dataset'=>$dataset]);
    }
    public function updateStoreL(Request $request, $id){
        DB::table('tarif_listrik')->where('ID_TRFLISTRIK', $id)->update([
            'VAR_BEBAN'=>$request->get('tarifbeban'),
            'VAR_BLOK1'=>$request->get('tarifblok1'),
            'VAR_BLOK2'=>$request->get('tarifblok2'),
            'VAR_STANDAR'=>$request->get('tarifstandar'),
            'VAR_BPJU'=>$request->get('tarifbpju'),
            'VAR_DENDA'=>$request->get('tarifdenda'),
            'PPN_LISTRIK'=>$request->get('ppnlistrik')
        ]);
        return redirect()->back()->with('alert-success','Data Tersimpan');;
    }

    public function showTIpk(){
        return view('admin.tarif-ipk');
    }
    public function showTKeamanan(){
        return view('admin.tarif-keamanan');
    }
    public function showTKebersihan(){
        return view('admin.tarif-kebersihan');
    }
}
