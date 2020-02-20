<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Nasabah;
use App\Jasa_air;
use App\Jasa_listrik;
use App\Jasa_ipkeamanan;
use App\Jasa_kebersihan;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Redirector;

class nasabahController extends Controller
{
    //Nasabah
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

    //Tempat Usaha
    public function showtempatusaha(){
        $dataset = DB::table('tempat_usaha')
        ->leftJoin('nasabah','tempat_usaha.ID_NASABAH','=','nasabah.ID_NASABAH')
        ->leftJoin('tarif_air','tempat_usaha.ID_TRFAIR','=','tarif_air.ID_TRFAIR')
        ->leftJoin('tarif_listrik','tempat_usaha.ID_TRFLISTRIK','=','tarif_listrik.ID_TRFLISTRIK')
        ->leftJoin('tarif_ipk','tempat_usaha.ID_TRFIPK','=','tarif_ipk.ID_TRFIPK')
        ->leftJoin('tarif_keamanan','tempat_usaha.ID_TRFKEAMANAN','=','tarif_keamanan.ID_TRFKEAMANAN')
        ->leftJoin('tarif_kebersihan','tempat_usaha.ID_TRFKEBERSIHAN','=','tarif_kebersihan.ID_TRFKEBERSIHAN')
        ->select('tarif_ipk.ID_TRFIPK','tarif_keamanan.ID_TRFKEAMANAN','tarif_kebersihan.ID_TRFKEBERSIHAN','tarif_air.ID_TRFAIR','tarif_listrik.ID_TRFLISTRIK',
            'tempat_usaha.KD_KONTROL', 'nasabah.NM_NASABAH', 
            'tarif_ipk.TRF_IPK','tarif_keamanan.TRF_KEAMANAN','tarif_kebersihan.TRF_KEBERSIHAN',
            'tempat_usaha.NO_ALAMAT','tempat_usaha.JML_ALAMAT','tempat_usaha.BENTUK_USAHA',
            'tempat_usaha.NOMTR_AIR','tempat_usaha.NOMTR_LISTRIK', 'tempat_usaha.ID_TEMPAT','tempat_usaha.TGL_TEMPAT')
        ->get();

        $datasets = json_decode($dataset, true);
        foreach($datasets as $data){
            if($data['ID_TRFAIR'] != null){
                $data_air = DB::table('jasa_air')->where('ID_TEMPAT',$data['ID_TEMPAT'])->get();
                if($data_air->isEmpty()){
                    $insert_air = new Jasa_air([
                        'id_tempat'=>$data['ID_TEMPAT'],
                        'tgl_jsair'=>$data['TGL_TEMPAT']
                    ]);
                    $insert_air->save();
                }
            }
            if($data['ID_TRFLISTRIK'] != null){
                $data_listrik = DB::table('jasa_listrik')->where('ID_TEMPAT',$data['ID_TEMPAT'])->get();
                if($data_listrik->isEmpty()){
                    $insert_listrik = new Jasa_listrik([
                        'id_tempat'=>$data['ID_TEMPAT'],
                        'tgl_jslistrik'=>$data['TGL_TEMPAT']
                    ]);
                    $insert_listrik->save();
                }
            }
            if($data['ID_TRFKEBERSIHAN'] != null){
                $data_kebersihan = DB::table('jasa_kebersihan')->where('ID_TEMPAT',$data['ID_TEMPAT'])->get();
                if($data_kebersihan->isEmpty()){
                    $insert_kebersihan = new Jasa_kebersihan([
                        'id_tempat'=>$data['ID_TEMPAT'],
                        'tgl_jskebersihan'=>$data['TGL_TEMPAT']
                    ]);
                    $insert_kebersihan->save();
                }
            }
            if($data['ID_TRFIPK'] != null){
                $data_keamanan = DB::table('jasa_ipkeamanan')->where('ID_TEMPAT',$data['ID_TEMPAT'])->get();
                if($data_keamanan->isEmpty()){
                    $insert_keamanan = new Jasa_ipkeamanan([
                        'id_tempat'=>$data['ID_TEMPAT'],
                        'tgl_jsipkeamanan'=>$data['TGL_TEMPAT']
                    ]);
                    $insert_keamanan->save();
                }
            }
        }

        $dataJasaAir = DB::table('jasa_air')
        ->join('tempat_usaha','tempat_usaha.ID_TEMPAT','=','jasa_air.ID_TEMPAT')
        ->join('nasabah','tempat_usaha.ID_NASABAH','=','nasabah.ID_NASABAH')
        ->select('jasa_air.TGL_JSAIR','tempat_usaha.KD_KONTROL','nasabah.NM_NASABAH','tempat_usaha.NOMTR_AIR','tempat_usaha.BENTUK_USAHA')
        ->get();
        $dataJasaListrik = DB::table('jasa_listrik')
        ->join('tempat_usaha','tempat_usaha.ID_TEMPAT','=','jasa_listrik.ID_TEMPAT')
        ->join('nasabah','tempat_usaha.ID_NASABAH','=','nasabah.ID_NASABAH')
        ->select('jasa_listrik.TGL_JSLISTRIK','tempat_usaha.KD_KONTROL','nasabah.NM_NASABAH','tempat_usaha.NOMTR_LISTRIK','tempat_usaha.BENTUK_USAHA')
        ->get();
        $dataJasaKebersihan = DB::table('jasa_kebersihan')
        ->join('tempat_usaha','tempat_usaha.ID_TEMPAT','=','jasa_kebersihan.ID_TEMPAT')
        ->join('nasabah','tempat_usaha.ID_NASABAH','=','nasabah.ID_NASABAH')
        ->join('tarif_kebersihan','tempat_usaha.ID_TRFKEBERSIHAN','=','tarif_kebersihan.ID_TRFKEBERSIHAN')
        ->select('jasa_kebersihan.TGL_JSKEBERSIHAN','tempat_usaha.KD_KONTROL','nasabah.NM_NASABAH','tarif_kebersihan.TRF_KEBERSIHAN','tempat_usaha.BENTUK_USAHA')
        ->get();
        $dataJasaKeamanan = DB::table('jasa_ipkeamanan')
        ->join('tempat_usaha','tempat_usaha.ID_TEMPAT','=','jasa_ipkeamanan.ID_TEMPAT')
        ->join('nasabah','tempat_usaha.ID_NASABAH','=','nasabah.ID_NASABAH')
        ->join('tarif_ipk','tempat_usaha.ID_TRFIPK','=','tarif_ipk.ID_TRFIPK')
        ->join('tarif_keamanan','tempat_usaha.ID_TRFKEAMANAN','=','tarif_keamanan.ID_TRFKEAMANAN')
        ->select('jasa_ipkeamanan.TGL_JSIPKEAMANAN','tempat_usaha.KD_KONTROL','nasabah.NM_NASABAH','tarif_ipk.TRF_IPK','tarif_keamanan.TRF_KEAMANAN','tempat_usaha.BENTUK_USAHA')
        ->get();

        return view('admin.tempat-usaha',['dataset'=>$dataset,'dataJasaAir'=>$dataJasaAir,'dataJasaListrik'=>$dataJasaListrik,'dataJasaKebersihan'=>$dataJasaKebersihan,'dataJasaKeamanan'=>$dataJasaKeamanan]);


    }
    public function showformtempat(){
        return view('admin.tambah-tempat');
    }
    public function updateTempat(){
        return view('admin.update-tempat');
    }
}
