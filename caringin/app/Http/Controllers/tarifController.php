<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tarif_air;
use App\Tarif_listrik;
use App\Tarif_kebersihan;
use App\Tarif_keamanan;
use App\Tarif_ipk;
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
        return redirect()->back()->with('success','Tarif Tersimpan');
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
        return redirect()->back()->with('success','Tarif Tersimpan');;
    }

    //Tarif Kebersihan
    public function showTKebersihan(){
        $dataset = DB::table('tarif_kebersihan')->get();
        return view('admin.tarif-kebersihan',['dataset'=>$dataset]);
    }
    public function showKebersihan(){
        return view('admin.tambah-kebersihan');
    }
    public function updateKebersihan($id){
        $dataset = DB::table('tarif_kebersihan')->where('ID_TRFKEBERSIHAN',$id)->get();
        return view('admin.update-kebersihan',['dataset'=>$dataset]);
    }
    public function updateStoreB(Request $request, $id){
        DB::table('tarif_kebersihan')->where('ID_TRFKEBERSIHAN', $id)->update([
            'ID_TRFKEBERSIHAN'=>$request->get('kategori'),
            'TRF_KEBERSIHAN'=>$request->get('tarif')
        ]);
        return redirect()->route('showb')->with('success','Tarif Tersimpan');
    }
    public function storekebersihan(Request $request){
        $data = new Tarif_kebersihan([
            'trf_kebersihan'=>$request->get('tarif')
        ]);
        $data->save();
        return redirect()->route('showb')->with('success','Tarif Ditambah');
    }

    //Tarif IPK
    public function showTIpk(){
        $dataset = DB::table('tarif_ipk')->get();
        return view('admin.tarif-ipk',['dataset'=>$dataset]);
    }
    public function showIpk(){
        return view('admin.tambah-ipk');
    }
    public function updateIpk($id){
        $dataset = DB::table('tarif_ipk')->where('ID_TRFIPK',$id)->get();
        return view('admin.update-ipk',['dataset'=>$dataset]);
    }
    public function updateStoreI(Request $request, $id){
        DB::table('tarif_ipk')->where('ID_TRFIPK', $id)->update([
            'ID_TRFIPK'=>$request->get('kategori'),
            'TRF_IPK'=>$request->get('tarif')
        ]);
        return redirect()->route('showi')->with('success','Tarif Tersimpan');
    }
    public function storeipk(Request $request){
        $data = new Tarif_ipk([
            'trf_ipk'=>$request->get('tarif')
        ]);
        $data->save();
        return redirect()->route('showi')->with('success','Tarif Ditambah');
    }

    //Tarif Keamanan
    public function showTKeamanan(){
        $dataset = DB::table('tarif_keamanan')->get();
        return view('admin.tarif-keamanan',['dataset'=>$dataset]);
    }
    public function showKeamanan(){
        return view('admin.tambah-keamanan');
    }
    public function updateKeamanan($id){
        $dataset = DB::table('tarif_keamanan')->where('ID_TRFKEAMANAN',$id)->get();
        return view('admin.update-keamanan',['dataset'=>$dataset]);
    }
    public function updateStoreK(Request $request, $id){
        DB::table('tarif_keamanan')->where('ID_TRFKEAMANAN', $id)->update([
            'ID_TRFKEAMANAN'=>$request->get('kategori'),
            'TRF_KEAMANAN'=>$request->get('tarif')
        ]);
        return redirect()->route('showk')->with('success','Tarif Tersimpan');
    }
    public function storekeamanan(Request $request){
        $data = new Tarif_keamanan([
            'trf_keamanan'=>$request->get('tarif')
        ]);
        $data->save();
        return redirect()->route('showk')->with('success','Tarif Ditambah');
    }
}
