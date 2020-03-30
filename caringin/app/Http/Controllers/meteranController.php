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
use Exception;

class meteranController extends Controller
{
    //meteran air
    public function updatealatair($id){
    try{
        $dataset = DB::table('meteran_air')->where('ID_MAIR',$id)->get();
    }catch(\Exception $e){
        return view('admin.update-alat-air',['dataset'=>$dataset])->with('error','Kesalahan Sistem');
    }
        return view('admin.update-alat-air',['dataset'=>$dataset]);
    }
    public function storeupdatealatair(Request $request, $id){
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

    //meteran listrik
    public function updatealatlistrik($id){
    try{
        $dataset = DB::table('meteran_listrik')->where('ID_MLISTRIK',$id)->get();
    }catch(\Exception $e){
        return view('admin.update-alat-listrik',['dataset'=>$dataset])->with('error','Kesalahan Sistem');
    }
        return view('admin.update-alat-listrik',['dataset'=>$dataset]);
    }
    public function storeupdatealatlistrik(Request $request, $id){
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

    public function dataalat(){
    try{
        $datasetA = DB::table('meteran_air')->get();
        $datasetL = DB::table('meteran_listrik')->get();
    }catch(\Exception $e){
        return view('admin.data-alat',['datasetA'=>$datasetA,'datasetL'=>$datasetL])->with('error','Kesalahan Sistem');
    }
        return view('admin.data-alat',['datasetA'=>$datasetA,'datasetL'=>$datasetL]);
    }

    public function formalat(){
        return view('admin.tambah-alat');
    }
    
    public function storealat(Request $request){
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

    public function gantialat(){
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

    public function updategantialatair($id){
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
    public function storegantialatair(Request $request,$id){
    try{
        $id_mair = $request->get('idMBaru');

        DB::table('tempat_usaha')->where('ID_TEMPAT', $id)->update([
            'ID_MAIR'=>$id_mair
        ]);

        //Set Tanggal Tagihan
        $timezone = date_default_timezone_set('Asia/Jakarta');
        $date = date("Y-m-d", time());
        $time = strtotime($date);
        $finalDate = date("Y-m-01", strtotime("+1 month", $time));
        $bln = date("Y-m", strtotime($finalDate));
        $expired = date("Y-m-14", strtotime("+2 month", $time));

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

        $data = new Tagihan([
            'id_tempat'=>$id,
            'id_pemilik'=>$dataku->ID_PEMILIK,
            'id_nasabah'=>$dataku->ID_NASABAH,
            'tgl_tagihan'=>$finalDate,
            'expired'=>$tgl_exp,
            'bln_tagihan'=>$bln,
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
            'ket'=>"Pasang Baru Alat Air"
        ]);
        $data->save();
    }catch(\Exception $e){
        return redirect()->route('ganti')->with('error','Kesalahan Sistem');
    }
        return redirect()->route('ganti')->with('success','Alat Ukur Diganti');
    }

    public function updategantialatlistrik($id){
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
    public function storegantialatlistrik(Request $request,$id){
    try{
        $id_mlistrik = $request->get('idMBaru');
        $daya = $request->get('daya');

        DB::table('tempat_usaha')->where('ID_TEMPAT', $id)->update([
            'ID_MLISTRIK'=>$id_mlistrik,
            'DAYA'=>$daya
        ]);

        //Set Tanggal Tagihan
        $timezone = date_default_timezone_set('Asia/Jakarta');
        $date = date("Y-m-d", time());
        $time = strtotime($date);
        $finalDate = date("Y-m-01", strtotime("+1 month", $time));
        $bln = date("Y-m", strtotime($finalDate));
        $expired = date("Y-m-14", strtotime("+2 month", $time));

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

        $data = new Tagihan([
            'id_tempat'=>$id,
            'id_pemilik'=>$dataku->ID_PEMILIK,
            'id_nasabah'=>$dataku->ID_NASABAH,
            'tgl_tagihan'=>$finalDate,
            'expired'=>$tgl_exp,
            'bln_tagihan'=>$bln,
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
            'ket'=>"Pasang Baru Alat Listrik"
        ]);
        $data->save();
    }catch(\Exception $e){
        return redirect()->route('ganti')->with('error','Kesalahan Sistem');
    }
        return redirect()->route('ganti')->with('success','Alat Ukur Diganti');
    }

    public function printform(){
    try{
        $dataAir = DB::table('jasa_air')
        ->join('tempat_usaha','tempat_usaha.ID_TEMPAT','=','jasa_air.ID_TEMPAT')
        ->join('nasabah','tempat_usaha.ID_NASABAH','=','nasabah.ID_NASABAH')
        ->join('meteran_air','tempat_usaha.ID_MAIR','=','meteran_air.ID_MAIR')
        ->select('tempat_usaha.KD_KONTROL','nasabah.NM_NASABAH','meteran_air.NOMTR_AIR','meteran_air.MAKHIR_AIR','tempat_usaha.NO_ALAMAT')
        ->get();
        $dataListrik = DB::table('jasa_listrik')
        ->join('tempat_usaha','tempat_usaha.ID_TEMPAT','=','jasa_listrik.ID_TEMPAT')
        ->join('nasabah','tempat_usaha.ID_NASABAH','=','nasabah.ID_NASABAH')
        ->join('meteran_listrik','tempat_usaha.ID_MLISTRIK','=','meteran_listrik.ID_MLISTRIK')
        ->select('tempat_usaha.KD_KONTROL','nasabah.NM_NASABAH','meteran_listrik.NOMTR_LISTRIK','meteran_listrik.MAKHIR_LISTRIK','tempat_usaha.NO_ALAMAT')
        ->get();
    } catch(\Exception $e){
        return view('admin.print-form',['dataAir'=>$dataAir,'dataListrik'=>$dataListrik])->with('error','Kesalahan SIstem');
    }
        return view('admin.print-form',['dataAir'=>$dataAir,'dataListrik'=>$dataListrik]);
    }
}