<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tagihan;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Redirector;

class tagihanController extends Controller
{
    public function tagihanNas(){
        $dataset = DB::table('tempat_usaha')
        ->leftJoin('nasabah','tempat_usaha.ID_NASABAH','=','nasabah.ID_NASABAH')
        ->select('tempat_usaha.ID_TEMPAT','tempat_usaha.KD_KONTROL', 'nasabah.NM_NASABAH','nasabah.NO_KTP','nasabah.NO_NPWP')
        ->get();
        return view('admin.tagihan-nasabah',['dataset'=>$dataset]);
    }
    
    public function formtagihan($id){
        $dataset = DB::table('tempat_usaha')
        ->leftJoin('nasabah','tempat_usaha.ID_NASABAH','=','nasabah.ID_NASABAH')
        ->leftJoin('tarif_kebersihan','tempat_usaha.ID_TRFKEBERSIHAN','=','tarif_kebersihan.ID_TRFKEBERSIHAN')
        ->leftJoin('tarif_ipk','tempat_usaha.ID_TRFIPK','=','tarif_ipk.ID_TRFIPK')
        ->leftJoin('tarif_keamanan','tempat_usaha.ID_TRFKEAMANAN','=','tarif_keamanan.ID_TRFKEAMANAN')
        ->select('tempat_usaha.ID_TEMPAT','tempat_usaha.KD_KONTROL','tempat_usaha.ID_TRFAIR',
                'tempat_usaha.ID_TRFLISTRIK', 'nasabah.NM_NASABAH',
                'tarif_kebersihan.TRF_KEBERSIHAN','tarif_ipk.TRF_IPK','tarif_keamanan.TRF_KEAMANAN')
        ->where('tempat_usaha.ID_TEMPAT',$id)
        ->get();

        return view('admin.form-tagihan',['dataset'=>$dataset]);
    }

    public function storetagihan(Request $request ,$id){
        $usaha = DB::table('tempat_usaha')->where('tempat_usaha.ID_TEMPAT',$id)->first();

        $tarif_kebersihan = 0;
        $ttl_kebersihan = 0;

        for($i=0;$i<4;$i++){
            if($i == 0){
                 //Kal Air
                if($usaha->ID_TRFAIR != Null){
                }
            }
            else if($i == 1){
                //Kal Listrik
                if($usaha->ID_TRFLISTRIK != Null){
                }
            }
            else if($i == 2){
                //Kal Kebersihan
                if($usaha->ID_TRFKEBERSIHAN != Null){
                    $tarif = DB::table('tempat_usaha')
                    ->leftJoin('tarif_kebersihan','tempat_usaha.ID_TRFKEBERSIHAN','=','tarif_kebersihan.ID_TRFKEBERSIHAN')
                    ->where('tempat_usaha.ID_TEMPAT',$id)
                    ->select('tarif_kebersihan.TRF_KEBERSIHAN')
                    ->first();

                    $tarif_kebersihan = $tarif->TRF_KEBERSIHAN;
                    $ttl_kebersihan = $tarif_kebersihan * $usaha->JML_ALAMAT;
                }
            }
            else{
                //Kal IPK Keamanan
                if($usaha->ID_TRFIPK != Null && $usaha->ID_TRFKEAMANAN != Null){
                    $tipk = DB::table('tempat_usaha')
                    ->leftJoin('tarif_ipk','tempat_usaha.ID_TRFIPK','=','tarif_ipk.ID_TRFIPK')
                    ->where('tempat_usaha.ID_TEMPAT',$id)
                    ->select('tarif_ipk.TRF_IPK')
                    ->first();
                    $tkeamanan = DB::table('tempat_usaha')
                    ->leftJoin('tarif_keamanan','tempat_usaha.ID_TRFKEAMANAN','=','tarif_keamanan.ID_TRFKEAMANAN')
                    ->where('tempat_usaha.ID_TEMPAT',$id)
                    ->select('tarif_keamanan.TRF_KEAMANAN')
                    ->first();

                    $tarif_ipk = $tipk->TRF_IPK;
                    $tarif_keamanan = $tkeamanan->TRF_KEAMANAN;

                    $byr_ipk = $tarif_ipk * $usaha->JML_ALAMAT;
                    $byr_keamanan = $tarif_keamanan * $usaha->JML_ALAMAT;
                    $ttl_ipkeamanan = $byr_ipk + $byr_keamanan;
                }
            }
        }

        $data = new Tagihan([
            'id_tempat'=>$id,
            'stt_bayar'=>0,
            'byr_kebersihan'=>$tarif_kebersihan,
            'ttl_kebersihan'=>$ttl_kebersihan,
            'byr_ipk'=>$tarif_ipk,
            'byr_keamanan'=>$tarif_keamanan,
            'ttl_ipkeamanan'=>$ttl_ipkeamanan
        ]);
        $data->save();
        return redirect()->route('tagihan');
    }

    public function dataTagihan(){
        return view('admin.data-tagihan');
    }

    public function bayarTagihan(){
        return view('admin.update-tagihan');
    }
}
