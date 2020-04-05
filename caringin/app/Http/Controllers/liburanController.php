<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\Hari_libur;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;

class liburanController extends Controller
{
    public function dataLibur(){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "Super Admin"){

        $dataset = DB::table('hari_libur')->get();
        return view('admin.data-libur',['dataset'=>$dataset]);
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }
    
    public function tambahLibur(){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "Super Admin"){

        return view('admin.tambah-libur');
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }

    public function storeLibur(Request $request){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "Super Admin"){

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
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }
}
