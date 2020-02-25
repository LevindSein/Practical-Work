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

        for($i=0;$i<4;$i++){
            if($i == 0){
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
            }
            else if($i == 1){
                //Kal Listrik
                if($usaha->ID_TRFLISTRIK != Null){
                    $tarif_listrik = DB::table('tarif_listrik')->first();

                    $listrikId = DB::table('jasa_listrik')
                    ->where('jasa_listrik.ID_TEMPAT',$id)
                    ->first();
                    $kalListrik = DB::table('kal_listrik')
                    ->join('jasa_listrik','kal_listrik.ID_JSLISTRIK','=','jasa_listrik.ID_JSLISTRIK')
                    ->where('kal_listrik.ID_JSLISTRIK',$listrikId->ID_JSLISTRIK)
                    ->first();

                    $inputListrik = $request->get('mListrik');
                    $awal_listrik = $kalListrik->AKHIR_LISTRIK;
            
                    if($inputListrik < $kalListrik->AKHIR_LISTRIK)
                    {
                        return redirect()->route('showformtagihan',['id'=>$id])->with('alert-warning','Meter Baru Salah');
                    }
                    else
                    {
                        $pakai = $inputListrik - $awal_listrik;
        
                        $a = round($usaha->DAYA * $tarif_listrik->VAR_STANDAR / 1000);
                        $b_blok1 = $tarif_listrik->VAR_BLOK1 * $a;

                        $b = $pakai - $a;
                        $b_blok2 = $tarif_listrik->VAR_BLOK2 * $b;
                        $b_beban = $usaha->DAYA * $tarif_listrik->VAR_BEBAN;

                        $c = $b_blok1 + $b_blok2 + $b_beban;
                        $rekmin = 53.44 * $usaha->DAYA;

                        if($rekmin > $c){
                            $bpju = ($tarif_listrik->VAR_BPJU / 100) * $rekmin;
                            $b_blok1 = 0;
                            $b_blok2 = 0;
                            $b_beban = 0;
                            $byr_listrik = $bpju + $rekmin;
                            $ppn_listrik = ($tarif_listrik->PPN_LISTRIK / 100) * $byr_listrik;
                            $ttl_listrik = $byr_listrik + $ppn_listrik;
                        }
                        else{
                            $bpju = ($tarif_listrik->VAR_BPJU / 100) * $c;
                            $rekmin = 0;
                            $byr_listrik = $bpju + $b_blok1 + $b_blok2 + $b_beban;
                            $ppn_listrik = ($tarif_listrik->PPN_LISTRIK / 100) * $byr_listrik;
                            $ttl_listrik = $byr_listrik + $ppn_listrik;
                        }
                    }
                    DB::table('kal_listrik')->where('kal_listrik.ID_JSLISTRIK',$listrikId->ID_JSLISTRIK)->update([
                        'AWAL_LISTRIK'=>$awal_listrik,
                        'AKHIR_LISTRIK'=>$inputListrik,
                        'PAKAI'=>$pakai,
                        'BYR_LISTRIK'=>$byr_listrik,
                        'REK_MIN'=>$rekmin,
                        'B_BLOK1'=>$b_blok1,
                        'B_BLOK2'=>$b_blok2,
                        'B_BEBAN'=>$b_beban,
                        'BPJU'=>$bpju,
                        'TTL_LISTRIK'=>$ttl_listrik
                    ]);
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

                    $kebersihanId = DB::table('jasa_kebersihan')
                    ->where('jasa_kebersihan.ID_TEMPAT',$id)
                    ->first();

                    $byr_kebersihan = $tarif_kebersihan * $usaha->JML_ALAMAT;
                }
                DB::table('kal_kebersihan')->where('kal_kebersihan.ID_JSKEBERSIHAN',$kebersihanId->ID_JSKEBERSIHAN)->update([
                    'BYR_KEBERSIHAN'=>$byr_kebersihan
                ]);
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

                    $ipkeamananId = DB::table('jasa_ipkeamanan')
                    ->where('jasa_ipkeamanan.ID_TEMPAT',$id)
                    ->first();

                    $byr_ipk = $tarif_ipk * $usaha->JML_ALAMAT;
                    $byr_keamanan = $tarif_keamanan * $usaha->JML_ALAMAT;
                }
                DB::table('kal_keamanan')->where('kal_keamanan.ID_JSIPKEAMANAN',$ipkeamananId->ID_JSIPKEAMANAN)->update([
                    'BYR_KEAMANAN'=>$byr_keamanan,
                    'BYR_IPK'=>$byr_ipk
                ]);
            }
        }
        return redirect()->route('tagihan');
    }
}
