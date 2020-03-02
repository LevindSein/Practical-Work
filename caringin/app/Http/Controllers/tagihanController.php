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
        ->leftJoin('meteran_air','tempat_usaha.ID_MAIR','=','meteran_air.ID_MAIR')
        ->leftJoin('meteran_listrik','tempat_usaha.ID_MLISTRIK','=','meteran_listrik.ID_MLISTRIK')
        ->leftJoin('tarif_kebersihan','tempat_usaha.ID_TRFKEBERSIHAN','=','tarif_kebersihan.ID_TRFKEBERSIHAN')
        ->leftJoin('tarif_ipk','tempat_usaha.ID_TRFIPK','=','tarif_ipk.ID_TRFIPK')
        ->leftJoin('tarif_keamanan','tempat_usaha.ID_TRFKEAMANAN','=','tarif_keamanan.ID_TRFKEAMANAN')
        ->select('tempat_usaha.ID_TEMPAT','tempat_usaha.KD_KONTROL','tempat_usaha.ID_TRFAIR',
                'meteran_air.MAKHIR_AIR','meteran_listrik.MAKHIR_LISTRIK',
                'tempat_usaha.ID_TRFLISTRIK', 'nasabah.NM_NASABAH',
                'tarif_kebersihan.TRF_KEBERSIHAN','tarif_ipk.TRF_IPK','tarif_keamanan.TRF_KEAMANAN')
        ->where('tempat_usaha.ID_TEMPAT',$id)
        ->get();

        return view('admin.form-tagihan',['dataset'=>$dataset]);
    }

    public function storetagihan(Request $request ,$id){
        $usaha = DB::table('tempat_usaha')->where('tempat_usaha.ID_TEMPAT',$id)->first();

        $meterAirID = DB::table('tempat_usaha')
        ->leftJoin('meteran_air','tempat_usaha.ID_MAIR','=','meteran_air.ID_MAIR')
        ->where('tempat_usaha.ID_TEMPAT',$id)
        ->first();
        $akhirAir = $meterAirID->MAKHIR_AIR;
        $airId = $meterAirID->ID_MAIR;

        $meterListrikID = DB::table('tempat_usaha')
        ->leftJoin('meteran_listrik','tempat_usaha.ID_MLISTRIK','=','meteran_listrik.ID_MLISTRIK')
        ->where('tempat_usaha.ID_TEMPAT',$id)
        ->first();
        $akhirListrik = $meterListrikID->MAKHIR_LISTRIK;
        $listrikId = $meterListrikID->ID_MLISTRIK;

        //ipk keamanan kebersihan
        $tarif_ipk = 0;
        $tarif_keamanan = 0;
        $ttl_ipkeamanan = 0;
        $tarif_kebersihan = 0;
        $ttl_kebersihan = 0;

        //air
        $inputAir = 0;
        $pakai_air = 0;
        $byr_air = 0;
        $byr_pemeliharaan = 0;
        $byr_arkot = 0;
        $byr_beban = 0;
        $ttl_air = 0;

        //listrik
        $inputListrik = 0;
        $pakai = 0;
        $byr_listrik = 0;
        $rekmin = 0;
        $b_blok1 = 0;
        $b_blok2 = 0;
        $b_beban = 0;
        $bpju = 0;
        $ttl_listrik = 0;

        for($i=0;$i<4;$i++){
            if($i == 0){
                 //Kal Air
                if($usaha->ID_TRFAIR != Null){
                    $tarif_air = DB::table('tarif_air')->first();
                    $inputAir = $request->get('mAir');
                    $awal_air = $akhirAir;
                    
                    if($inputAir < $awal_air)
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
                }
            }
            else if($i == 1){
                //Kal Listrik
                if($usaha->ID_TRFLISTRIK != Null){
                    $tarif_listrik = DB::table('tarif_listrik')->first();
                
                    $inputListrik = $request->get('mListrik');
                    $awal_listrik = $akhirListrik;
            
                    if($inputListrik < $akhirListrik)
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

        $ttl_tagihan = $ttl_air + $ttl_listrik + $ttl_ipkeamanan + $ttl_kebersihan;

        //Set Tanggal Tagihan
        $timezone = date_default_timezone_set('Asia/Jakarta');
        $date = date("Y-m-d", time());
        $time = strtotime($date);
        $finalDate = date("Y-m-01", strtotime("+1 month", $time));

        $data = new Tagihan([
            'id_tempat'=>$id,
            'tgl_tagihan'=>$finalDate,
            'stt_bayar'=>0,
            'stt_lunas'=>0,
            'awal_air'=>$akhirAir,
            'akhir_air'=>$inputAir,
            'pakai_air'=>$pakai_air,
            'byr_air'=>$byr_air,
            'byr_pemeliharaan'=>$byr_pemeliharaan,
            'byr_beban'=>$byr_beban,
            'byr_arkot'=>$byr_arkot,
            'ttl_air'=>$ttl_air,
            'awal_listrik'=>$akhirListrik,
            'akhir_listrik'=>$inputListrik,
            'pakai_listrik'=>$pakai,
            'byr_listrik'=>$byr_listrik,
            'rek_min'=>$rekmin,
            'b_blok1'=>$b_blok1,
            'b_blok2'=>$b_blok2,
            'b_beban'=>$b_beban,
            'bpju'=>$bpju,
            'ttl_listrik'=>$ttl_listrik,
            'byr_kebersihan'=>$tarif_kebersihan,
            'ttl_kebersihan'=>$ttl_kebersihan,
            'byr_ipk'=>$tarif_ipk,
            'byr_keamanan'=>$tarif_keamanan,
            'ttl_ipkeamanan'=>$ttl_ipkeamanan,
            'ttl_tagihan'=>$ttl_tagihan
        ]);
        $data->save();

        DB::table('meteran_air')->where('ID_MAIR',$airId)->update([
            'MAKHIR_AIR'=>$inputAir
        ]);
        DB::table('meteran_listrik')->where('ID_MLISTRIK',$listrikId)->update([
            'MAKHIR_LISTRIK'=>$inputListrik
        ]);
        return redirect()->route('tagihan');
    }

    public function dataTagihan($id){
        $dataset = DB::table('tempat_usaha')
        ->leftJoin('nasabah','tempat_usaha.ID_NASABAH','=','nasabah.ID_NASABAH')
        ->select('tempat_usaha.ID_TEMPAT','tempat_usaha.KD_KONTROL','nasabah.NM_NASABAH')
        ->where('tempat_usaha.ID_TEMPAT',$id)
        ->get();

        $dataTagihan = DB::table('tagihanku')
        ->where('tagihanku.ID_TEMPAT',$id)
        ->get();

        return view('admin.data-tagihan',['dataset'=>$dataset,'dataTagihan'=>$dataTagihan]);
    }

    public function bayarTagihan($id){
        $dataset = DB::table('tagihanku')
        ->leftJoin('tempat_usaha','tagihanku.ID_TEMPAT','=','tempat_usaha.ID_TEMPAT')
        ->select('tempat_usaha.KD_KONTROL','tagihanku.TTL_TAGIHAN','tempat_usaha.ID_TEMPAT','tagihanku.ID_TAGIHANKU')
        ->where('ID_TAGIHANKU',$id)
        ->get();
        
        // $usaha = DB::table('tagihanku')->where('ID_TAGIHANKU',$id)->first();
        // $tempatId = $usaha->ID_TEMPAT;
        // $nasabah = DB::table('tempat_usaha')->where('ID_NASABAH',$tempatId)->first();
        // $nasabahId = $nasabah->ID_NASABAH;
        // $nama = DB::table('nasabah')->select('nasabah.NM_NASABAH')->where('ID_NASABAH',$nasabahId)->first();
        // $namaku = $nama->NM_NASABAH;

        return view('admin.update-tagihan',['dataset'=>$dataset]);
    }

    public function storeBayar(Request $request,$id){
        $bayar = $request->get('bayar');

        $dataset = DB::table('tagihanku')->where('ID_TAGIHANKU',$id)->first();

        
        $ttl_listrik = $dataset->TTL_LISTRIK;
        $ttl_air = $dataset->TTL_AIR;
        $ttl_ipkeamanan = $dataset->TTL_IPKEAMANAN;
        $ttl_kebersihan = $dataset->TTL_KEBERSIHAN;
        $ttl_tagihan = $dataset->TTL_TAGIHAN;

        if($bayar >= $ttl_tagihan){
            $sisaTotal = $bayar - $ttl_tagihan;

            DB::table('tagihanku')->where('ID_TAGIHANKU', $id)->update([
                'STT_BAYAR'=>1,
                'STT_LUNAS'=>1,
                'REALISASI_AIR'=>$ttl_air,
                'SELISIH_AIR'=>0,
                'REALISASI_LISTRIK'=>$ttl_listrik,
                'SELISIH_LISTRIK'=>0,
                'REALISASI_IPKEAMANAN'=>$ttl_ipkeamanan,
                'SELISIH_IPKEAMANAN'=>0,
                'REALISASI_KEBERSIHAN'=>$ttl_kebersihan,
                'SELISIH_KEBERSIHAN'=>0,
                'REALISASI'=>$ttl_tagihan,
                'SELISIH'=>0
            ]);
        }
        else{
            return redirect()->route('bayartagihan',['id'=>$id])->with('alert-warning','Pembayaran Tidak Dapat Dilakukan');
        }

        return redirect()->route('lapTagihan');
    }
}
