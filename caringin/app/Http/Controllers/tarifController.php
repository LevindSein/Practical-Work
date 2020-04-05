<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tarif_air;
use App\Tarif_listrik;
use App\Tarif_kebersihan;
use App\Tarif_keamanan;
use App\Tarif_ipk;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class tarifController extends Controller
{
    //Tarif Air
    public function showTAir(){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "Super Admin"){

        $dataset = DB::table('tarif_air')->get();
        return view('admin.tarif-air',['dataset'=>$dataset]);
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }
    public function updateStoreA(Request $request, $id){
    	if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "Super Admin"){

        try{
        DB::table('tarif_air')->where('ID_TRFAIR', $id)->update([
            'TRF_AIR1'=>$request->get('tarif1'),
            'TRF_AIR2'=>$request->get('tarif2'),
            'TRF_PEMELIHARAAN'=>$request->get('tarifpemeliharaan'),
            'TRF_BEBAN'=>$request->get('tarifbeban'),
            'TRF_ARKOT'=>$request->get('tarifarkot'),
            'TRF_DENDA'=>$request->get('tarifdenda'),
            'PPN_AIR'=>$request->get('ppnair'),
            'PASANG_AIR'=>$request->get('pasangair')
        ]);
    } catch(\Exception $e){
        return redirect()->back()->with('error','Tarif Gagal Disimpan');
    }
        return redirect()->back()->with('success','Tarif Tersimpan');
        }
        else{
            abort(403, 'Oops! Access Forbidden');
        }
    }
    }

    //Tarif Listrik
    public function showTListrik(){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "Super Admin"){

        $dataset = DB::table('tarif_listrik')->get();
        return view('admin.tarif-listrik',['dataset'=>$dataset]);
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }
    public function updateStoreL(Request $request, $id){
    	if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "Super Admin"){

        try{
        DB::table('tarif_listrik')->where('ID_TRFLISTRIK', $id)->update([
            'VAR_BEBAN'=>$request->get('tarifbeban'),
            'VAR_BLOK1'=>$request->get('tarifblok1'),
            'VAR_BLOK2'=>$request->get('tarifblok2'),
            'VAR_STANDAR'=>$request->get('tarifstandar'),
            'VAR_BPJU'=>$request->get('tarifbpju'),
            'VAR_DENDA'=>$request->get('tarifdenda'),
            'DENDA_LEBIH'=>$request->get('dendalebih'),
            'PPN_LISTRIK'=>$request->get('ppnlistrik'),
            'PASANG_LISTRIK'=>$request->get('pasanglistrik')
        ]);
    }catch(\Exception $e){
        return redirect()->back()->with('error','Tarif Gagal Disimpan');
    }
        return redirect()->back()->with('success','Tarif Tersimpan');
        }
        else{
            abort(403, 'Oops! Access Forbidden');
        }
    }
    }

    //Tarif Kebersihan
    public function showTKebersihan(){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "Super Admin"){

        $dataset = DB::table('tarif_kebersihan')->get();
        return view('admin.tarif-kebersihan',['dataset'=>$dataset]);
        }
        else{
            abort(403, 'Oops! Access Forbidden');
        }
    }
    }
    public function showKebersihan(){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "Super Admin"){

        return view('admin.tambah-kebersihan');
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }
    public function updateKebersihan($id){
    	if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "Super Admin"){

        try{
        $dataset = DB::table('tarif_kebersihan')->where('ID_TRFKEBERSIHAN',$id)->get();
    }catch(\Exception $e){
        return view('admin.update-kebersihan',['dataset'=>$dataset])->with('error','Kesalahan Sistem');
    }
        return view('admin.update-kebersihan',['dataset'=>$dataset]);
        }
        else{
            abort(403, 'Oops! Access Forbidden');
        }
    }
    }
    public function updateStoreB(Request $request, $id){
    	if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "Super Admin"){

        try{
        DB::table('tarif_kebersihan')->where('ID_TRFKEBERSIHAN', $id)->update([
            'ID_TRFKEBERSIHAN'=>$request->get('kategori'),
            'TRF_KEBERSIHAN'=>$request->get('tarif')
        ]);
    }catch(\Exception $e){
        return redirect()->back()->with('error','Tarif Gagal Disimpan');
    }
        return redirect()->route('showb')->with('success','Tarif Tersimpan');
        }
        else{
            abort(403, 'Oops! Access Forbidden');
        }
    }
    }
    
    public function storekebersihan(Request $request){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "Super Admin"){

        try{    
        $data = new Tarif_kebersihan([
            'trf_kebersihan'=>$request->get('tarif')
        ]);
        $data->save();
    } catch(\Exception $e){
        return redirect()->route('tambahkebersihan')->with('error','Tarif Gagal Ditambah');
    }
        return redirect()->route('showb')->with('success','Tarif Ditambah');
        }
        else{
            abort(403, 'Oops! Access Forbidden');
        }
    }
    }

    //Tarif IPK
    public function showTIpk(){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "Super Admin"){

        try{
        $dataset = DB::table('tarif_ipk')->get();
    }catch(\Exception $e){
        return view('admin.tarif-ipk',['dataset'=>$dataset])->with('error','Kesalahan Sistem');
    }
        return view('admin.tarif-ipk',['dataset'=>$dataset]);
        }
        else{
            abort(403, 'Oops! Access Forbidden');
        }
    }
    }
    public function showIpk(){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "Super Admin"){

        return view('admin.tambah-ipk');
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }
    public function updateIpk($id){
    	if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "Super Admin"){

        try{
        $dataset = DB::table('tarif_ipk')->where('ID_TRFIPK',$id)->get();
    } catch(\Exception $e){
        return view('admin.update-ipk',['dataset'=>$dataset])->with('error','Kesalahan Sistem');
    }
        return view('admin.update-ipk',['dataset'=>$dataset]);
        }
        else{
            abort(403, 'Oops! Access Forbidden');
        }
    }
    }
    
    public function updateStoreI(Request $request, $id){
    	if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "Super Admin"){

        try{
        DB::table('tarif_ipk')->where('ID_TRFIPK', $id)->update([
            'ID_TRFIPK'=>$request->get('kategori'),
            'TRF_IPK'=>$request->get('tarif')
        ]);
    }catch(\Exception $e){
        return redirect()->back()->with('error','Tarif Gagal Disimpan');
    }
        return redirect()->route('showi')->with('success','Tarif Tersimpan');
        }
        else{
            abort(403, 'Oops! Access Forbidden');
        }
    }
    }
    public function storeipk(Request $request){
    	if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "Super Admin"){

        try{
        $data = new Tarif_ipk([
            'trf_ipk'=>$request->get('tarif')
        ]);
        $data->save();
    }catch(\Exception $e){
        return redirect()->route('tambahipk')->with('error','Tarif Gagal Ditambah');
    }
        return redirect()->route('showi')->with('success','Tarif Ditambah');
        }
        else{
            abort(403, 'Oops! Access Forbidden');
        }
    }
    }

    //Tarif Keamanan
    public function showTKeamanan(){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "Super Admin"){

        try{
        $dataset = DB::table('tarif_keamanan')->get();
    }catch(\Exception $e){
        return view('admin.tarif-keamanan',['dataset'=>$dataset])->with('error','Kesalahan Sistem');
    }
        return view('admin.tarif-keamanan',['dataset'=>$dataset]);
        }
        else{
            abort(403, 'Oops! Access Forbidden');
        }
    }
    }
    
    public function showKeamanan(){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "Super Admin"){

        return view('admin.tambah-keamanan');
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }
    
    public function updateKeamanan($id){
    	if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "Super Admin"){

        try{
        $dataset = DB::table('tarif_keamanan')->where('ID_TRFKEAMANAN',$id)->get();
    }catch(\Exception $e){
        return view('admin.update-keamanan',['dataset'=>$dataset])->with('error','Kesalahan Sistem');
    }
        return view('admin.update-keamanan',['dataset'=>$dataset]);
        }
        else{
            abort(403, 'Oops! Access Forbidden');
        }
    }
    }
    public function updateStoreK(Request $request, $id){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "Super Admin"){

        try{
        DB::table('tarif_keamanan')->where('ID_TRFKEAMANAN', $id)->update([
            'ID_TRFKEAMANAN'=>$request->get('kategori'),
            'TRF_KEAMANAN'=>$request->get('tarif')
        ]);
    }catch(\Exception $e){
        return redirect()->back()->with('error','Tarif Gagal Disimpan');
    }
        return redirect()->route('showk')->with('success','Tarif Tersimpan');
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }

    public function storekeamanan(Request $request){
    	if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "Super Admin"){

        try{
        $data = new Tarif_keamanan([
            'trf_keamanan'=>$request->get('tarif')
        ]);
        $data->save();
    }catch(\Exception $e){
        return redirect()->route('tambahkeamanan')->with('error','Tarif Gagal Ditambah');
    }
        return redirect()->route('showk')->with('success','Tarif Ditambah');
        }
        else{
            abort(403, 'Oops! Access Forbidden');
        }
    }
    }
}
