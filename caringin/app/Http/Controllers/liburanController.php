<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\Hari_libur;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Redirector;

class liburanController extends Controller
{
    public function dataLibur(){
    try{
        $dataset = DB::table('hari_libur')->get();
    }catch(\Exception $e){
        return view('admin.data-libur',['dataset'=>$dataset])->with('error','Kesalahan Sistem');
    }
        return view('admin.data-libur',['dataset'=>$dataset]);
    }
    
    public function tambahLibur(){
        return view('admin.tambah-libur');
    }

    public function storeLibur(Request $request){
        try {
            $data = new Hari_libur([
                'tgl_hari'=>$request->get('libur'),
                'ket_hari'=>$request->get('ket')
            ]);
            $data->save();
        }
        catch(\Exception $e){
            return redirect('tambahlibur')->with('error','Tanggal Gagal Ditambah');
        }
        return redirect('showdatalibur')->with('success','Tanggal Ditambah');
    }
}
