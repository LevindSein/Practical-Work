<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class tagihanController extends Controller
{
    public function tagihanNas(){
        $dataset = DB::table('tempat_usaha')
        ->leftJoin('nasabah','tempat_usaha.ID_NASABAH','=','nasabah.ID_NASABAH')
        ->select('tempat_usaha.ID_TEMPAT','tempat_usaha.KD_KONTROL', 'nasabah.NM_NASABAH')
        ->get();
        return view('admin.tagihan-nasabah',['dataset'=>$dataset]);
    }
    
    public function formtagihan($id){
        $dataset = DB::table('tempat_usaha')
        ->leftJoin('nasabah','tempat_usaha.ID_NASABAH','=','nasabah.ID_NASABAH')
        ->select('tempat_usaha.ID_TEMPAT','tempat_usaha.KD_KONTROL','tempat_usaha.ID_TRFAIR','tempat_usaha.ID_TRFLISTRIK', 'nasabah.NM_NASABAH')
        ->where('tempat_usaha.ID_TEMPAT',$id)
        ->get();

        return view('admin.form-tagihan',['dataset'=>$dataset]);
    }

    public function storetagihan(Request $request ,$id){
        $usaha = DB::table('tempat_usaha')->where('tempat_usaha.ID_TEMPAT',$id)->first();

        //Kal Air
        if($usaha->ID_TRFAIR != Null){
            $tarif_air = DB::table('tarif_air')->first();

            $airId = DB::table('jasa_air')
            ->where('jasa_air.ID_TEMPAT',$id)
            ->first();
            $kalAir = DB::table('kal_air')
            ->join('jasa_air','kal_air.ID_JSAIR','=','jasa_air.ID_JSAIR')
            ->where('kal_air.ID_JSAIR',$airId->ID_JSAIR)
            ->first();

            $inputAir = $request->get('mAir');
            $awal_air = $kalAir->AKHIR_AIR;

            if($inputAir < $kalAir->AKHIR_AIR)
            {
                return redirect()->route('showformtagihan',['id'=>$id])->with('alert-warning','Meter Baru Salah');
            }
            else
            {                
                $pakai_air = $inputAir - $awal_air;
                if($pakai_air > 10){
                    $a = 10 * $tarif_air->TRF_AIR1;
                    $b = ($pakai_air - 10) * $tarif_air->TRF_AIR2;
                    $byr_air = $a + $b;
                    
                    $byr_pemeliharaan = $tarif_air->TRF_PEMELIHARAAN;
                    $byr_beban = $tarif_air->TRF_BEBAN;
                    $byr_arkot = ($tarif_air->TRF_ARKOT / 100) * $byr_air;
                    
                    $c = ($byr_air + $byr_pemeliharaan + $byr_beban + $byr_arkot) * ($tarif_air->PPN_AIR / 100);

                    $ttl_air = $byr_air + $byr_pemeliharaan + $byr_beban + $byr_arkot + $c;
                }
                else{
                    $byr_air = $pakai_air * $tarif_air->TRF_AIR1;

                    $byr_pemeliharaan = $tarif_air->TRF_PEMELIHARAAN;
                    $byr_beban = $tarif_air->TRF_BEBAN;
                    $byr_arkot = ($tarif_air->TRF_ARKOT / 100) * $byr_air;
                    
                    $c = ($byr_air + $byr_pemeliharaan + $byr_beban + $byr_arkot) * ($tarif_air->PPN_AIR / 100);

                    $ttl_air = $byr_air + $byr_pemeliharaan + $byr_beban + $byr_arkot + $c;
                }
            }
            DB::table('kal_air')->where('kal_air.ID_JSAIR',$airId->ID_JSAIR)->update([
                'AWAL_AIR'=>$awal_air,
                'AKHIR_AIR'=>$inputAir,
                'PAKAI_AIR'=>$pakai_air,
                'BYR_AIR'=>$byr_air,
                'BYR_PEMELIHARAAN'=>$byr_pemeliharaan,
                'BYR_BEBAN'=>$byr_beban,
                'BYR_ARKOT'=>$byr_arkot,
                'TTL_AIR'=>$ttl_air
            ]);
        }

        //Kal Listrik
        if($usaha->ID_TRFLISTRIK != Null){
            $tarif_listrik = DB::table('tarif_listrik')->first();
        }

        //Kal Kebersihan
        if($usaha->ID_TRFKEBERSIHAN != Null){
            $tarif_kebersihan = DB::table('tempat_usaha')
            ->leftJoin('tarif_kebersihan','tempat_usaha.ID_TRFKEBERSIHAN','=','tarif_kebersihan.ID_TRFKEBERSIHAN')
            ->where('tempat_usaha.ID_TEMPAT',$id)
            ->select('tarif_kebersihan.TRF_KEBERSIHAN')
            ->first();
        }

        //Kal IPK Keamanan
        if($usaha->ID_TRFIPK != Null && $usaha->ID_TRFKEAMANAN != Null){
            $tarif_ipk = DB::table('tempat_usaha')
            ->leftJoin('tarif_ipk','tempat_usaha.ID_TRFIPK','=','tarif_ipk.ID_TRFIPK')
            ->where('tempat_usaha.ID_TEMPAT',$id)
            ->select('tarif_ipk.TRF_IPK')
            ->first();
            $tarif_keamanan = DB::table('tempat_usaha')
            ->leftJoin('tarif_keamanan','tempat_usaha.ID_TRFKEAMANAN','=','tarif_keamanan.ID_TRFKEAMANAN')
            ->where('tempat_usaha.ID_TEMPAT',$id)
            ->select('tarif_keamanan.TRF_KEAMANAN')
            ->first();
        }

        return redirect()->route('tagihan');
    }
}
