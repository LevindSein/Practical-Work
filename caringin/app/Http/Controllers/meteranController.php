<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Meteran_air;
use App\Meteran_listrik;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Redirector;

class meteranController extends Controller
{
    //meteran air
    public function dataalatair(){
        $dataset = DB::table('meteran_air')->get();
        return view('admin.data-alat-air',['dataset'=>$dataset]);
    }
    public function formalatair(){
        return view('admin.tambah-alat-air');
    }
    public function storealatair(Request $request){
        $data = new Meteran_air([
            'nomtr_air'=>$request->get('noalat'),
            'makhir_air'=>$request->get('meteranair')
        ]);
        $data->save();
        return redirect('dataalatair')->with('alert-success','Data Tersimpan');
    }
    public function updatealatair($id){
        $dataset = DB::table('meteran_air')->where('ID_MAIR',$id)->get();
        return view('admin.update-alat-air',['dataset'=>$dataset]);
    }
    public function storeupdatealatair(Request $request, $id){
        DB::table('meteran_air')->where('ID_MAIR', $id)->update([
            'NOMTR_AIR'=>$request->get('noalat'),
            'MAKHIR_AIR'=>$request->get('meteranair')
        ]);
        return redirect()->route('alatair');
    }

    //meteran listrik
    public function dataalatlistrik(){
        $dataset = DB::table('meteran_listrik')->get();
        return view('admin.data-alat-listrik',['dataset'=>$dataset]);
    }
    public function formalatlistrik(){
        return view('admin.tambah-alat-listrik');
    }
    public function storealatlistrik(Request $request){
        $dataL = new Meteran_listrik([
            'nomtr_listrik'=>$request->get('noalat'),
            'makhir_listrik'=>$request->get('meteranlistrik')
        ]);
        $dataL->save();
        return redirect('dataalatlistrik')->with('alert-success','Data Tersimpan');
    }
    public function updatealatlistrik($id){
        $dataset = DB::table('meteran_listrik')->where('ID_MLISTRIK',$id)->get();
        return view('admin.update-alat-listrik',['dataset'=>$dataset]);
    }
    public function storeupdatealatlistrik(Request $request, $id){
        DB::table('meteran_listrik')->where('ID_MLISTRIK', $id)->update([
            'NOMTR_LISTRIK'=>$request->get('noalat'),
            'MAKHIR_LISTRIK'=>$request->get('meteranlistrik')
        ]);
        return redirect()->route('alatlistrik');
    }
}