<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Nasabah;
use App\Jasa_air;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Redirector;

class nasabahController extends Controller
{
    public function showdata(){
        $dataset = DB::table('nasabah')->get();
        return view('admin.data-nasabah',['dataset'=>$dataset]);
    }
    public function showform(){
        return view('admin.tambah-nasabah');
    }
    public function store(Request $request){
        $data = new Nasabah([
            'nm_nasabah'=>$request->get('nama'),
            'no_ktp'=>$request->get('ktp'),
            'no_npwp'=>$request->get('npwp'),
            'no_tlp'=>$request->get('telpon')
        ]);
        $data->save();
        return redirect('showformnasabah')->with('alert-success','Data Tersimpan');
    }
    public function updateNasabah($id){
        $dataset = DB::table('nasabah')->where('ID_NASABAH',$id)->get();
        return view('admin.update-nasabah',['dataset'=>$dataset]);
    }
    public function updateStore(Request $request, $id){
        DB::table('nasabah')->where('ID_NASABAH', $id)->update([
            'NM_NASABAH'=>$request->get('nama'),
            'NO_KTP'=>$request->get('ktp'),
            'NO_NPWP'=>$request->get('npwp'),
            'NO_TLP'=>$request->get('telpon')
        ]);
        return redirect()->route('show');
    }
    public function showtempatusaha(){
        return view('admin.tempat-usaha');
    }
    public function showformtempat(){
        return view('admin.tambah-tempat');
    }
    public function updateTempat(){
        return view('admin.update-tempat');
    }
}
