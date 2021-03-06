<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Meteran_air;
use App\Meteran_listrik;
use App\Tempat_usaha;
use App\Nasabah;
use App\Tagihan;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Redirector;
use DateTime;
use DateInterval;
use Exception;
use Illuminate\Support\Facades\Session;

class meteranController extends Controller
{
    //meteran air
    public function updatealatair($id){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "Super Admin"){

    try{
        $dataset = DB::table('meteran_air')->where('ID_MAIR',$id)->get();
    }catch(\Exception $e){
        return view('admin.update-alat-air',['dataset'=>$dataset])->with('error','Kesalahan Sistem');
    }
        return view('admin.update-alat-air',['dataset'=>$dataset]);
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }

    public function storeupdatealatair(Request $request, $id){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "Super Admin"){

        try{
        DB::table('meteran_air')->where('ID_MAIR', $id)->update([
            'NOMTR_AIR'=>$request->get('noalat'),
            'MAKHIR_AIR'=>$request->get('meteranair')
        ]);
    } catch(\Exception $e){
        return redirect()->back()->with('error','Data Gagal Disimpan');
    }
        return redirect()->route('alat')->with('success','Data Tersimpan');
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }

    //meteran listrik
    public function updatealatlistrik($id){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "Super Admin"){

        try{
        $dataset = DB::table('meteran_listrik')->where('ID_MLISTRIK',$id)->get();
    }catch(\Exception $e){
        return view('admin.update-alat-listrik',['dataset'=>$dataset])->with('error','Kesalahan Sistem');
    }
        return view('admin.update-alat-listrik',['dataset'=>$dataset]);
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }

    public function storeupdatealatlistrik(Request $request, $id){
    	if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "Super Admin"){

        try{
        DB::table('meteran_listrik')->where('ID_MLISTRIK', $id)->update([
            'NOMTR_LISTRIK'=>$request->get('noalat'),
            'MAKHIR_LISTRIK'=>$request->get('meteranlistrik')
        ]);
    }catch(\Exception $e){
        return redirect()->back()->with('error','Data Gagal Disimpan');
    }
        return redirect()->route('alat')->with('success','Data Tersimpan');
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }

    public function dataalat(){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "Super Admin"){

        $datasetA = DB::table('meteran_air')->get();
        $datasetL = DB::table('meteran_listrik')->get();
        return view('admin.data-alat',['datasetA'=>$datasetA,'datasetL'=>$datasetL]);
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }

    public function formalat(){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "Super Admin"){

        return view('admin.tambah-alat');
            }
        else{
            abort(403, 'Oops! Access Forbidden');
        }
    }
    }
    
    public function storealat(Request $request){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "Super Admin"){

        try{    
        $radio = $request->get('alat');
        if($radio == "A"){
            $noalat = strtoupper($request->get('noalat'));
            $dataA = new Meteran_air([
                'nomtr_air'=>$noalat,
                'makhir_air'=>$request->get('meteran')
            ]);
            $dataA->save();
        }
        else{
            $noalat = strtoupper($request->get('noalat'));
            $dataL = new Meteran_listrik([
                'nomtr_listrik'=>$noalat,
                'makhir_listrik'=>$request->get('meteran')
            ]);
            $dataL->save();
        }
    }catch(\Exception $e){
        return redirect()->back()->with('error','Data Gagal Ditambah');
    }
        return redirect('dataalat')->with('success','Data Ditambah');
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }

    public function gantialat(){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "Super Admin"){

        $dataset = DB::table('tempat_usaha')
        ->leftJoin('nasabah','tempat_usaha.ID_NASABAH','=','nasabah.ID_NASABAH')
        ->leftJoin('meteran_air','tempat_usaha.ID_MAIR','=','meteran_air.ID_MAIR')
        ->leftJoin('meteran_listrik','tempat_usaha.ID_MLISTRIK','=','meteran_listrik.ID_MLISTRIK')
        ->select(
            'tempat_usaha.KD_KONTROL', 'nasabah.NM_NASABAH',
            'meteran_air.NOMTR_AIR','meteran_listrik.NOMTR_LISTRIK',
            'meteran_air.ID_MAIR','meteran_listrik.ID_MLISTRIK', 
            'tempat_usaha.ID_TEMPAT')
        ->get();
        return view('admin.ganti-alat',['dataset'=>$dataset]);
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }

    public function updategantialatair($id){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "Super Admin"){

        $dataset = DB::table('tempat_usaha')
        ->leftJoin('nasabah','tempat_usaha.ID_NASABAH','=','nasabah.ID_NASABAH')
        ->leftJoin('meteran_air','tempat_usaha.ID_MAIR','=','meteran_air.ID_MAIR')
        ->select(
            'tempat_usaha.KD_KONTROL', 'nasabah.NM_NASABAH',
            'meteran_air.NOMTR_AIR',
            'meteran_air.ID_MAIR', 
            'tempat_usaha.ID_TEMPAT')
        ->where('ID_TEMPAT',$id)
        ->get();
        
        return view('admin.update-ganti-air',['dataset'=>$dataset]);
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }

    public function add_months($months, DateTime $dateObject) 
    {
        $next = new DateTime($dateObject->format('Y-m-d'));
        $next->modify('last day of +'.$months.' month');

        if($dateObject->format('d') > $next->format('d')) {
            return $dateObject->diff($next);
        } else {
            return new DateInterval('P'.$months.'M');
        }
    }

    public function endCycle($d1, $months)
    {
        $date = new DateTime($d1);
        $newDate = $date->add($this->add_months($months, $date));
        $dateReturned = $newDate->format('Y-m-01'); 

        return $dateReturned;
    }

    public function storegantialatair(Request $request,$id){
    	if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "Super Admin"){

        try{
        $id_mair = $request->get('idMBaru');

        DB::table('tempat_usaha')->where('ID_TEMPAT', $id)->update([
            'ID_MAIR'=>$id_mair
        ]);

        //Set Tanggal Tagihan
        date_default_timezone_set('Asia/Jakarta');
        $date = date("Y-m-d", time());
        $nMonths = 1;
        $finalDate = $this->endCycle($date, $nMonths);
        $time = strtotime($finalDate);
        $expired = date("Y-m-14", strtotime("+1 month", $time));
        $bln = date("Y-m", strtotime($finalDate));
        $thn = date("Y", strtotime($finalDate));

        //Cek Libur
        $tgl_exp = $expired;
        $i = 0;
        do{
            $tgl_exp = date("Y-m-d", strtotime($tgl_exp.'+1 day'));
            $libur = DB::table('hari_libur')
            ->where('hari_libur.TGL_HARI',$tgl_exp)
            ->select('TGL_HARI')
            ->first();
            $i++;
        } while($libur != null);
        
        $air = DB::table('tarif_air')->first();
        $ttl_air = $air->PASANG_AIR;

        $dataku = DB::table('tempat_usaha')
        ->where('ID_TEMPAT',$id)
        ->first();
        $blok = $dataku->BLOK;

        $data = new Tagihan([
            'id_tempat'=>$id,
            'id_pemilik'=>$dataku->ID_PEMILIK,
            'id_nasabah'=>$dataku->ID_NASABAH,
            'blok_tempat'=>$blok,
            'tgl_tagihan'=>$finalDate,
            'expired'=>$tgl_exp,
            'bln_tagihan'=>$bln,
            'thn_tagihan'=>$thn,
            'stt_lunas'=>0,
            'stt_bayar'=>0,
            'ttl_air'=>$ttl_air,
            'realisasi_air'=>0,
            'selisih_air'=>$ttl_air,
            'denda_air'=>0,
            'ttl_tagihan'=>$ttl_air,
            'realisasi'=>0,
            'selisih'=>$ttl_air,
            'denda'=>0,
            'stt_denda'=>0,
            'ket'=>"Pasang Baru Alat Air"
        ]);
        $data->save();
    }catch(\Exception $e){
        return redirect()->route('ganti')->with('error','Kesalahan Sistem');
    }
        return redirect()->route('ganti')->with('success','Alat Ukur Diganti');
        }
        else{
            abort(403, 'Oops! Access Forbidden');
        }
    }
    }

    public function updategantialatlistrik($id){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "Super Admin"){

        $dataset = DB::table('tempat_usaha')
        ->leftJoin('nasabah','tempat_usaha.ID_NASABAH','=','nasabah.ID_NASABAH')
        ->leftJoin('meteran_listrik','tempat_usaha.ID_MLISTRIK','=','meteran_listrik.ID_MLISTRIK')
        ->select(
            'tempat_usaha.KD_KONTROL', 'nasabah.NM_NASABAH',
            'meteran_listrik.NOMTR_LISTRIK',
            'meteran_listrik.ID_MLISTRIK', 
            'tempat_usaha.ID_TEMPAT')
        ->where('ID_TEMPAT',$id)
        ->get();
        
        return view('admin.update-ganti-listrik',['dataset'=>$dataset]);
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }
    public function storegantialatlistrik(Request $request,$id){
    	if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "Super Admin"){

        try{
        $id_mlistrik = $request->get('idMBaru');
        $daya = $request->get('daya');

        DB::table('tempat_usaha')->where('ID_TEMPAT', $id)->update([
            'ID_MLISTRIK'=>$id_mlistrik,
            'DAYA'=>$daya
        ]);

        //Set Tanggal Tagihan
        date_default_timezone_set('Asia/Jakarta');
        $date = date("Y-m-d", time());
        $nMonths = 1;
        $finalDate = $this->endCycle($date, $nMonths);
        $time = strtotime($finalDate);
        $expired = date("Y-m-14", strtotime("+1 month", $time));
        $bln = date("Y-m", strtotime($finalDate));
        $thn = date("Y", strtotime($finalDate));

        //Cek Libur
        $tgl_exp = $expired;
        $i = 0;
        do{
            $tgl_exp = date("Y-m-d", strtotime($tgl_exp.'+1 day'));
            $libur = DB::table('hari_libur')
            ->where('hari_libur.TGL_HARI',$tgl_exp)
            ->select('TGL_HARI')
            ->first();
            $i++;
        } while($libur != null);
        
        $listrik = DB::table('tarif_listrik')->first();
        $ttl_listrik = $listrik->PASANG_LISTRIK;

        $dataku = DB::table('tempat_usaha')
        ->where('ID_TEMPAT',$id)
        ->first();
        $blok = $dataku->BLOK;


        $data = new Tagihan([
            'id_tempat'=>$id,
            'id_pemilik'=>$dataku->ID_PEMILIK,
            'id_nasabah'=>$dataku->ID_NASABAH,
            'blok_tempat'=>$blok,
            'tgl_tagihan'=>$finalDate,
            'expired'=>$tgl_exp,
            'bln_tagihan'=>$bln,
            'thn_tagihan'=>$thn,
            'stt_lunas'=>0,
            'stt_bayar'=>0,
            'ttl_listrik'=>$ttl_listrik,
            'realisasi_listrik'=>0,
            'selisih_listrik'=>$ttl_listrik,
            'denda_listrik'=>0,
            'ttl_tagihan'=>$ttl_listrik,
            'realisasi'=>0,
            'selisih'=>$ttl_listrik,
            'denda'=>0,
            'stt_denda'=>0,
            'ket'=>"Pasang Baru Alat Listrik"
        ]);
        $data->save();
    }catch(\Exception $e){
        return redirect()->route('ganti')->with('error','Kesalahan Sistem');
    }
        return redirect()->route('ganti')->with('success','Alat Ukur Diganti');
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }

    public function printform(){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "Super Admin"){

        $dataset = DB::table('tempat_usaha')
        ->join('nasabah','tempat_usaha.ID_NASABAH','=','nasabah.ID_NASABAH')
        ->join('meteran_air','tempat_usaha.ID_MAIR','=','meteran_air.ID_MAIR')
        ->join('meteran_listrik','tempat_usaha.ID_MLISTRIK','=','meteran_listrik.ID_MLISTRIK')
        ->get();
        return view('admin.print-form',['dataset'=>$dataset]);
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }
}