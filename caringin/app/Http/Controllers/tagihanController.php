<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tagihan;
use App\Hari_libur;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Redirector;
use Exception;

class tagihanController extends Controller
{
    public function tagihanNas(){
    try{
        $dataset = DB::table('tempat_usaha')
        ->leftJoin('nasabah','tempat_usaha.ID_NASABAH','=','nasabah.ID_NASABAH')
        ->select('tempat_usaha.ID_TEMPAT','tempat_usaha.KD_KONTROL', 'nasabah.NM_NASABAH','nasabah.NO_KTP','nasabah.NO_NPWP')
        ->get();
    }catch(\Exception $e){
        return view('admin.tagihan-nasabah',['dataset'=>$dataset])->with('error','Kesalahan Sistem');
    }
        return view('admin.tagihan-nasabah',['dataset'=>$dataset]);
    }
    
    public function formtagihan($id){
    try{
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

        $timezone = date_default_timezone_set('Asia/Jakarta');
        $date = date("Y-m-d", time());
        $time = strtotime($date);
        $finalDate = date("Y-m-01", strtotime("+1 month", $time));    
            
        $pernah = DB::table('tagihanku')
        ->select('tagihanku.TGL_TAGIHAN','tagihanku.CREATED_AT')
        ->where('tagihanku.ID_TEMPAT',$id)
        ->orderBy('tagihanku.CREATED_AT', 'desc')
        ->first();

        if($pernah == NULL){
            return view('admin.form-tagihan',['dataset'=>$dataset]);
        }
        else{
            $tgl_pernah = $pernah->TGL_TAGIHAN;
            if($tgl_pernah == $finalDate){
                return redirect()->route('tagihan')->with('warning','Tagihan Sudah Ditambah');
            }
            else{
                return view('admin.form-tagihan',['dataset'=>$dataset]);
            }
        }
    }catch(\Exception $e){
        return redirect()->route('tagihan')->with('error','Kesalahan Sistem');
    }
    }

    public function storetagihan(Request $request ,$id){
    try{
        $usaha = DB::table('tempat_usaha')->where('tempat_usaha.ID_TEMPAT',$id)->first();
        $dayaListrik = $usaha->DAYA;

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
        $tarif_ipk = NULL;
        $tarif_keamanan = NULL;
        $ttl_ipkeamanan = NULL;
        $tarif_kebersihan = NULL;
        $ttl_kebersihan = NULL;

        //air
        $inputAir = NULL;
        $pakai_air = NULL;
        $byr_air = NULL;
        $byr_pemeliharaan = NULL;
        $byr_arkot = NULL;
        $byr_beban = NULL;
        $ttl_air = NULL;

        //listrik
        $inputListrik = NULL;
        $pakai = NULL;
        $byr_listrik = NULL;
        $rekmin = NULL;
        $b_blok1 = NULL;
        $b_blok2 = NULL;
        $b_beban = NULL;
        $bpju = NULL;
        $ttl_listrik = NULL;

        for($i=0;$i<4;$i++){
            if($i == 0){
                 //Kal Air
                if($usaha->ID_TRFAIR != Null){
                    $tarif_air = DB::table('tarif_air')->first();
                    $inputAir = $request->get('mAir');
                    $awal_air = $akhirAir;
                    
                    if($inputAir < $awal_air)
                    {
                        return redirect()->route('showformtagihan',['id'=>$id])->with('warning','Meter Baru Salah');
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
                        return redirect()->route('showformtagihan',['id'=>$id])->with('warning','Meter Baru Salah');
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

        //Store Data Ke Database
        $data = new Tagihan([
            'id_tempat'=>$id,
            'tgl_tagihan'=>$finalDate,
            'expired'=>$tgl_exp,
            'bln_tagihan'=>$bln,
            'stt_lunas'=>0,
            'awal_air'=>$akhirAir,
            'akhir_air'=>$inputAir,
            'pakai_air'=>$pakai_air,
            'byr_air'=>$byr_air,
            'byr_pemeliharaan'=>$byr_pemeliharaan,
            'byr_beban'=>$byr_beban,
            'byr_arkot'=>$byr_arkot,
            'ttl_air'=>$ttl_air,
            'realisasi_air'=>0,
            'selisih_air'=>$ttl_air,
            'denda_air'=>0,
            'daya_listrik'=>$dayaListrik,
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
            'realisasi_listrik'=>0,
            'selisih_listrik'=>$ttl_listrik,
            'denda_listrik'=>0,
            'byr_kebersihan'=>$tarif_kebersihan,
            'ttl_kebersihan'=>$ttl_kebersihan,
            'realisasi_kebersihan'=>0,
            'selisih_kebersihan'=>$ttl_kebersihan,
            'byr_ipk'=>$tarif_ipk,
            'byr_keamanan'=>$tarif_keamanan,
            'ttl_ipkeamanan'=>$ttl_ipkeamanan,
            'realisasi_ipkeamanan'=>0,
            'selisih_ipkeamanan'=>$ttl_ipkeamanan,
            'ttl_tagihan'=>$ttl_tagihan,
            'realisasi'=>0,
            'selisih'=>$ttl_tagihan,
            'denda'=>0,
            'stt_denda'=>0
        ]);
        $data->save();

        DB::table('meteran_air')->where('ID_MAIR',$airId)->update([
            'MAKHIR_AIR'=>$inputAir
        ]);
        DB::table('meteran_listrik')->where('ID_MLISTRIK',$listrikId)->update([
            'MAKHIR_LISTRIK'=>$inputListrik
        ]);
    } catch(\Exception $e){
        return redirect()->route('showformtagihan',['id'=>$id])->with('error','Tagihan Gagal Ditambah');
    }
        return redirect()->route('tagihan')->with('success','Tagihan Ditambah');
    }

    public function dataTagihan($id){
    try{
        $dataset = DB::table('tempat_usaha')
        ->leftJoin('nasabah','tempat_usaha.ID_NASABAH','=','nasabah.ID_NASABAH')
        ->select('tempat_usaha.ID_TEMPAT','tempat_usaha.KD_KONTROL','nasabah.NM_NASABAH')
        ->where('tempat_usaha.ID_TEMPAT',$id)
        ->get();

        $dataTagihan = DB::table('tagihanku')
        ->where('tagihanku.ID_TEMPAT',$id)
        ->get();
    }catch(\Exception $e){
        return view('admin.data-tagihan',['dataset'=>$dataset,'dataTagihan'=>$dataTagihan])->with('error','Kesalahan Sistem');
    }
        return view('admin.data-tagihan',['dataset'=>$dataset,'dataTagihan'=>$dataTagihan]);
    }

    public function bayarTagihan($id){
    try{
        $dataset = DB::table('tagihanku')
        ->join('tempat_usaha','tagihanku.ID_TEMPAT','=','tempat_usaha.ID_TEMPAT')
        ->join('nasabah','tempat_usaha.ID_NASABAH','=','nasabah.ID_NASABAH')
        ->select('tempat_usaha.KD_KONTROL','tagihanku.TTL_TAGIHAN','tagihanku.DENDA','tempat_usaha.ID_TEMPAT',
        'tagihanku.ID_TAGIHANKU','nasabah.NM_NASABAH','tagihanku.REALISASI')
        ->where('ID_TAGIHANKU',$id)
        ->get();

        $check = DB::table('tagihanku')
        ->join('tempat_usaha','tagihanku.ID_TEMPAT','=','tempat_usaha.ID_TEMPAT')
        ->join('nasabah','tempat_usaha.ID_NASABAH','=','nasabah.ID_NASABAH')
        ->select(
            DB::raw('(tagihanku.TTL_TAGIHAN + tagihanku.DENDA) as total'),
            'tagihanku.REALISASI','nasabah.ID_NASABAH','tagihanku.ID_TEMPAT')
        ->where('ID_TAGIHANKU',$id)
        ->first();

        $bayar = $check->REALISASI;
        $tagihan = $check->total;
        $idNas = $check->ID_NASABAH;

        //Kalau Tagihan Sudah Dibayar
        if($bayar >= $tagihan){
            return redirect()->route('lapTagihan')->with('info','Tagihan Sudah Dibayar');
        }

        //Apabila Tagihan Sebelumnya Belum Terbayar
        $idTempat = $check->ID_TEMPAT;
        $belum = DB::table('tagihanku')
        ->where([['ID_TEMPAT',$idTempat],['STT_LUNAS',0]])
        ->get();

        $recTotal = $belum->count();
        for($i=0;$i<$recTotal;$i++){
            if($i > 0){
                if($belum[$i]->ID_TAGIHANKU == $id){
                    if($belum[$i-1] != null){
                        return redirect()->route('lapTagihan')->with('info','Tagihan Sebelumnya Belum Terbayar');
                    }
                }
            }
        }

    }catch(\Eception $e){
        return redirect()->route('lapTagihan')->with('error','Kesalahan Sistem');
    }
        return view('admin.update-tagihan',['dataset'=>$dataset]);
    }

    public function storeBayar(Request $request,$id){
    try{
        $timezone = date_default_timezone_set('Asia/Jakarta');
        $date = date("Y-m-d", time());

        $dataset = DB::table('tagihanku')->where('ID_TAGIHANKU',$id)->first();

        $ttl_tagihan = $dataset->TTL_TAGIHAN + $dataset->DENDA; 
        $ttl_listrik = $dataset->TTL_LISTRIK + $dataset->DENDA_LISTRIK;
        $ttl_air = $dataset->TTL_AIR + $dataset->DENDA_AIR;
        $ttl_ipkeamanan = $dataset->TTL_IPKEAMANAN;
        $ttl_kebersihan = $dataset->TTL_KEBERSIHAN;
        
        DB::table('tagihanku')->where('ID_TAGIHANKU', $id)->update([
            'TGL_BAYAR'=>$date,
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
    } catch(\Exception $e){
        return redirect()->route('bayartagihan',['id'=>$id])->with('error','Pembayaran Gagal');
    }
        return redirect()->route('lapTagihan')->with('success','Pembayaran Dilakukan');
    }

    public function printTagihan(){
    try{
        //Set Tanggal Tagihan
        $timezone = date_default_timezone_set('Asia/Jakarta');
        $date = date("Y-m-d", time());
        $time = strtotime($date);
        $finalDate = date("Y-m-01", strtotime("+1 month", $time));

        $dataset = DB::table('tagihanku')
        ->join('tempat_usaha','tagihanku.ID_TEMPAT','=','tempat_usaha.ID_TEMPAT')
        ->join('nasabah','tempat_usaha.ID_NASABAH','=','nasabah.ID_NASABAH')
        ->select('tempat_usaha.KD_KONTROL','tagihanku.TTL_TAGIHAN',
                 'tagihanku.ID_TAGIHANKU','nasabah.NM_NASABAH',
                 'tagihanku.PAKAI_AIR','tagihanku.PAKAI_LISTRIK',
                 'tagihanku.TTL_AIR','tagihanku.TTL_LISTRIK',
                 'tagihanku.TTL_IPKEAMANAN','tagihanku.TTL_KEBERSIHAN',
                 'tagihanku.TGL_TAGIHAN')
        ->where('TGL_TAGIHAN',$finalDate)
        ->get();
    }catch(\Exception $e){
        return view('admin.print-tagihan',['dataset'=>$dataset])->with('error','Kesalahan Sistem');
    }
        return view('admin.print-tagihan',['dataset'=>$dataset]);
    }

    //Kasir
    public function dataTagihanKasir($id){
        try{
            $dataset = DB::table('tempat_usaha')
            ->leftJoin('nasabah','tempat_usaha.ID_NASABAH','=','nasabah.ID_NASABAH')
            ->select('tempat_usaha.ID_TEMPAT','tempat_usaha.KD_KONTROL','nasabah.NM_NASABAH')
            ->where('tempat_usaha.ID_TEMPAT',$id)
            ->get();
    
            $dataTagihan = DB::table('tagihanku')
            ->where('tagihanku.ID_TEMPAT',$id)
            ->get();
        }catch(\Exception $e){
            return view('kasir.data-tagihan',['dataset'=>$dataset,'dataTagihan'=>$dataTagihan])->with('error','Kesalahan Sistem');
        }
        return view('kasir.data-tagihan',['dataset'=>$dataset,'dataTagihan'=>$dataTagihan]);
    }

    public function bayarTagihanKasir($id){
        try{
            $dataset = DB::table('tagihanku')
            ->join('tempat_usaha','tagihanku.ID_TEMPAT','=','tempat_usaha.ID_TEMPAT')
            ->join('nasabah','tempat_usaha.ID_NASABAH','=','nasabah.ID_NASABAH')
            ->select('tempat_usaha.KD_KONTROL','tagihanku.TTL_TAGIHAN','tagihanku.DENDA','tempat_usaha.ID_TEMPAT',
            'tagihanku.ID_TAGIHANKU','nasabah.NM_NASABAH','tagihanku.REALISASI')
            ->where('ID_TAGIHANKU',$id)
            ->get();
    
            $check = DB::table('tagihanku')
            ->join('tempat_usaha','tagihanku.ID_TEMPAT','=','tempat_usaha.ID_TEMPAT')
            ->join('nasabah','tempat_usaha.ID_NASABAH','=','nasabah.ID_NASABAH')
            ->select(
                DB::raw('(tagihanku.TTL_TAGIHAN + tagihanku.DENDA) as total'),
                'tagihanku.REALISASI','nasabah.ID_NASABAH','tagihanku.ID_TEMPAT')
            ->where('ID_TAGIHANKU',$id)
            ->first();
    
            $bayar = $check->REALISASI;
            $tagihan = $check->total;
            $idNas = $check->ID_NASABAH;
    
            //Kalau Tagihan Sudah Dibayar
            if($bayar >= $tagihan){
                return redirect()->route('lapTagihanKasir')->with('info','Tagihan Sudah Dibayar');
            }
    
            //Apabila Tagihan Sebelumnya Belum Terbayar
            $idTempat = $check->ID_TEMPAT;
            $belum = DB::table('tagihanku')
            ->where([['ID_TEMPAT',$idTempat],['STT_LUNAS',0]])
            ->get();
    
            $recTotal = $belum->count();
            for($i=0;$i<$recTotal;$i++){
                if($i > 0){
                    if($belum[$i]->ID_TAGIHANKU == $id){
                        if($belum[$i-1] != null){
                            return redirect()->route('lapTagihanKasir')->with('info','Tagihan Sebelumnya Belum Terbayar');
                        }
                    }
                }
            }
    
        }catch(\Eception $e){
            return redirect()->route('lapTagihanKasir')->with('error','Kesalahan Sistem');
        }
            return view('kasir.update-tagihan',['dataset'=>$dataset]);
        }
    
        public function storeBayarKasir(Request $request,$id){
        try{
            $timezone = date_default_timezone_set('Asia/Jakarta');
            $date = date("Y-m-d", time());
    
            $dataset = DB::table('tagihanku')->where('ID_TAGIHANKU',$id)->first();
    
            $ttl_tagihan = $dataset->TTL_TAGIHAN + $dataset->DENDA; 
            $ttl_listrik = $dataset->TTL_LISTRIK + $dataset->DENDA_LISTRIK;
            $ttl_air = $dataset->TTL_AIR + $dataset->DENDA_AIR;
            $ttl_ipkeamanan = $dataset->TTL_IPKEAMANAN;
            $ttl_kebersihan = $dataset->TTL_KEBERSIHAN;
            
            DB::table('tagihanku')->where('ID_TAGIHANKU', $id)->update([
                'TGL_BAYAR'=>$date,
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
        } catch(\Exception $e){
            return redirect()->route('bayartagihanKasir',['id'=>$id])->with('error','Pembayaran Gagal');
        }
        return redirect()->route('lapTagihanKasir')->with('success','Pembayaran Dilakukan');
    }

    public function printStrukKasir($id){
        $dataset = DB::table('tagihanku')
        ->leftJoin('tempat_usaha','tagihanku.ID_TEMPAT','=','tempat_usaha.ID_TEMPAT')
        ->leftJoin('nasabah','tempat_usaha.ID_NASABAH','=','nasabah.ID_NASABAH')
        ->where('ID_TAGIHANKU',$id)
        ->get();

        return view('kasir.print-struk',['dataset'=>$dataset]);
    }
    //ENDKASIR

    //Manager
    public function dataTagihanManager($id){
        try{
            $dataset = DB::table('tempat_usaha')
            ->leftJoin('nasabah','tempat_usaha.ID_NASABAH','=','nasabah.ID_NASABAH')
            ->select('tempat_usaha.ID_TEMPAT','tempat_usaha.KD_KONTROL','nasabah.NM_NASABAH')
            ->where('tempat_usaha.ID_TEMPAT',$id)
            ->get();
    
            $dataTagihan = DB::table('tagihanku')
            ->where('tagihanku.ID_TEMPAT',$id)
            ->get();
        }catch(\Exception $e){
            return view('manajer.data-tagihan',['dataset'=>$dataset,'dataTagihan'=>$dataTagihan])->with('error','Kesalahan Sistem');
        }
            return view('manajer.data-tagihan',['dataset'=>$dataset,'dataTagihan'=>$dataTagihan]);
        }
    //EndManager
}
