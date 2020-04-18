<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tagihan;
use App\Hari_libur;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Redirector;
use Carbon\Carbon;
use DateTime;
use DateInterval;
use Exception;
use Illuminate\Support\Facades\Session;

class tagihanController extends Controller
{
    //Admin Biasa
    public function tagihanNasAdmin(){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "admin"){
        $dataset = DB::table('tempat_usaha')
        ->leftJoin('nasabah','tempat_usaha.ID_NASABAH','=','nasabah.ID_NASABAH')
        ->select('tempat_usaha.ID_USER','tempat_usaha.ID_TEMPAT','tempat_usaha.KD_KONTROL', 'nasabah.NM_NASABAH','nasabah.NO_KTP','nasabah.NO_NPWP','nasabah.NO_ANGGOTA',
        'tempat_usaha.ID_TRFAIR','tempat_usaha.ID_TRFLISTRIK','tempat_usaha.ID_TRFKEBERSIHAN','tempat_usaha.ID_TRFKEAMANAN','tempat_usaha.ID_TRFIPK')
        ->where('tempat_usaha.ID_USER',Session::get('id_user'))
        ->get();
        return view('normal.tagihan-nasabah',['dataset'=>$dataset]);
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }

    public function formtagihanAdmin($id){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "admin"){
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
            ->select('tagihanku.TGL_TAGIHAN','tagihanku.CREATED_AT','tagihanku.KET')
            ->where('tagihanku.ID_TEMPAT',$id)
            ->orderBy('tagihanku.CREATED_AT', 'desc')
            ->first();
    
            if($pernah == NULL){
                return view('normal.form-tagihan',['dataset'=>$dataset]);
            }
            else{
                $tgl_pernah = $pernah->TGL_TAGIHAN;
                if($tgl_pernah == $finalDate && $pernah->KET == NULL){
                    return redirect()->route('tagihanAdmin')->with('warning','Tagihan Sudah Ditambah');
                }
                else{
                    return view('normal.form-tagihan',['dataset'=>$dataset]);
                }
            }
        }catch(\Exception $e){
            return redirect()->route('tagihanAdmin')->with('error','Kesalahan Sistem');
        }
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
        }

    public function storetagihanAdmin(Request $request ,$id){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "admin"){
        try{
            $usaha = DB::table('tempat_usaha')->where('tempat_usaha.ID_TEMPAT',$id)->first();
            $dayaListrik = $usaha->DAYA;
            $id_nasabah = $usaha->ID_NASABAH;
            $id_pemilik = $usaha->ID_PEMILIK;
            $blok = $usaha->BLOK;
    
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
            $ttl_ipkeamanan = 0;
            $tarif_kebersihan = NULL;
            $ttl_kebersihan = 0;
    
            //air
            $inputAir = NULL;
            $pakai_air = NULL;
            $byr_air = NULL;
            $byr_pemeliharaan = NULL;
            $byr_arkot = NULL;
            $byr_beban = NULL;
            $ttl_air = 0;
    
            //listrik
            $inputListrik = NULL;
            $pakai = NULL;
            $byr_listrik = NULL;
            $rekmin = NULL;
            $b_blok1 = NULL;
            $b_blok2 = NULL;
            $b_beban = NULL;
            $bpju = NULL;
            $ttl_listrik = 0;
    
            for($i=0;$i<4;$i++){
                if($i == 0){
                     //Kal Air
                    if($usaha->ID_TRFAIR != Null){
                        $tarif_air = DB::table('tarif_air')->first();
                        $expInputAir = explode(",",$request->get('mAir'));
                        $inputAir = "";
                        for($m=0;$m<count($expInputAir);$m++){
                            $inputAir = $inputAir.$expInputAir[$m];
                        }
                        $awal_air = $akhirAir;
                        
                        if($inputAir < $awal_air)
                        {
                            return redirect()->route('showformtagihanAdmin',['id'=>$id])->with('warning','Meter Baru Salah');
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
                    
                        $expInputListrik = explode(",",$request->get('mListrik'));
                        $inputListrik = "";
                        for($k=0;$k<count($expInputListrik);$k++){
                            $inputListrik = $inputListrik.$expInputListrik[$k];
                        }
                        $awal_listrik = $akhirListrik;
                
                        if($inputListrik < $akhirListrik)
                        {
                            return redirect()->route('showformtagihanAdmin',['id'=>$id])->with('warning','Meter Baru Salah');
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
    
            //Store Data Ke Database
            $data = new Tagihan([
                'id_tempat'=>$id,
                'id_pemilik'=>$id_pemilik,
                'id_nasabah'=>$id_nasabah,
                'blok_tempat'=>$blok,
                'tgl_tagihan'=>$finalDate,
                'expired'=>$tgl_exp,
                'bln_tagihan'=>$bln,
                'thn_tagihan'=>$thn,
                'stt_lunas'=>0,
                'stt_bayar'=>0,
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
            return redirect()->route('showformtagihanAdmin',['id'=>$id])->with('error','Tagihan Gagal Ditambah');
        }
            return redirect()->route('tagihanAdmin')->with('success','Tagihan Ditambah');
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
        }
    //End Admin Biasa
    

    //Super Admin
    public function otoritas(){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "Super Admin"){

        $blok = DB::table('tempat_usaha')
        ->select('BLOK',DB::raw('count(*) as ttl_Blok'))
        ->groupBy('BLOK')
        ->get();

        $ttlBlok = $blok->count();
        return view('admin.otoritas',['ttlBlok'=>$ttlBlok,'blok'=>$blok]);
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }

    public function storeOtoritas(Request $request){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "Super Admin"){
        
        try{
        $blok = DB::table('tempat_usaha')
        ->select('BLOK',DB::raw('count(*) as ttl_Blok'))
        ->groupBy('BLOK')
        ->get();

        $ttlBlok = $blok->count();
        
        for($i=0;$i<$ttlBlok;$i++){
            $bloks=$blok[$i];
            $user=$request->get('userId')[$i];
            DB::table('tempat_usaha')
                ->where('BLOK',$bloks->BLOK)
                ->update([
                    'ID_USER'=>$request->get('userId')[$i]
                ]);
        }
        return redirect()->route('otoritas')->with('success','Otorisasi Tagihan Selesai');
        }catch(\Exception $e){
            return redirect()->route('otoritas')->with('error','Otorisasi Tagihan Gagal');
        }
        }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }

    public function tagihanNas(){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "Super Admin"){

        $dataset = DB::table('tempat_usaha')
        ->leftJoin('nasabah','tempat_usaha.ID_NASABAH','=','nasabah.ID_NASABAH')
        ->select('tempat_usaha.ID_TEMPAT','tempat_usaha.KD_KONTROL', 'nasabah.NM_NASABAH','nasabah.NO_KTP','nasabah.NO_NPWP','nasabah.NO_ANGGOTA',
        'tempat_usaha.ID_TRFAIR','tempat_usaha.ID_TRFLISTRIK','tempat_usaha.ID_TRFKEBERSIHAN','tempat_usaha.ID_TRFKEAMANAN','tempat_usaha.ID_TRFIPK')
        ->get();
        return view('admin.tagihan-nasabah',['dataset'=>$dataset]);
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }

    public function formtagihan($id){
    	if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "Super Admin"){

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
        ->select('tagihanku.TGL_TAGIHAN','tagihanku.CREATED_AT','tagihanku.KET')
        ->where('tagihanku.ID_TEMPAT',$id)
        ->orderBy('tagihanku.CREATED_AT', 'desc')
        ->first();

        if($pernah == NULL){
            return view('admin.form-tagihan',['dataset'=>$dataset]);
        }
        else{
            $tgl_pernah = $pernah->TGL_TAGIHAN;
            if($tgl_pernah == $finalDate && $pernah->KET == NULL){
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

    public function storetagihan(Request $request ,$id){
    	if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "Super Admin"){

        try{
        $usaha = DB::table('tempat_usaha')->where('tempat_usaha.ID_TEMPAT',$id)->first();
        $dayaListrik = $usaha->DAYA;
        $id_nasabah = $usaha->ID_NASABAH;
        $id_pemilik = $usaha->ID_PEMILIK;
        $blok = $usaha->BLOK;

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
        $ttl_ipkeamanan = 0;
        $tarif_kebersihan = NULL;
        $ttl_kebersihan = 0;

        //air
        $inputAir = NULL;
        $pakai_air = NULL;
        $byr_air = NULL;
        $byr_pemeliharaan = NULL;
        $byr_arkot = NULL;
        $byr_beban = NULL;
        $ttl_air = 0;

        //listrik
        $inputListrik = NULL;
        $pakai = NULL;
        $byr_listrik = NULL;
        $rekmin = NULL;
        $b_blok1 = NULL;
        $b_blok2 = NULL;
        $b_beban = NULL;
        $bpju = NULL;
        $ttl_listrik = 0;

        for($i=0;$i<4;$i++){
            if($i == 0){
                 //Kal Air
                if($usaha->ID_TRFAIR != Null){
                    $tarif_air = DB::table('tarif_air')->first();
                    $expInputAir = explode(",",$request->get('mAir'));
                    $inputAir = "";
                    for($m=0;$m<count($expInputAir);$m++){
                        $inputAir = $inputAir.$expInputAir[$m];
                    }
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
                
                    $expInputListrik = explode(",",$request->get('mListrik'));
                    $inputListrik = "";
                    for($k=0;$k<count($expInputListrik);$k++){
                        $inputListrik = $inputListrik.$expInputListrik[$k];
                    }
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

        //Store Data Ke Database
        $data = new Tagihan([
            'id_tempat'=>$id,
            'id_pemilik'=>$id_pemilik,
            'id_nasabah'=>$id_nasabah,
            'blok_tempat'=>$blok,
            'tgl_tagihan'=>$finalDate,
            'expired'=>$tgl_exp,
            'bln_tagihan'=>$bln,
            'thn_tagihan'=>$thn,
            'stt_lunas'=>0,
            'stt_bayar'=>0,
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
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }

    public function dataTagihan($id){
    	if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "Super Admin"){

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
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }

    public function printTagihan(){
    	if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "Super Admin"){

        try{
        $dataset = DB::table('tagihanku')
        ->join('tempat_usaha','tagihanku.ID_TEMPAT','=','tempat_usaha.ID_TEMPAT')
        ->join('nasabah','tempat_usaha.ID_NASABAH','=','nasabah.ID_NASABAH')
        ->select('tempat_usaha.KD_KONTROL','tagihanku.SELISIH',
                 'tagihanku.ID_TAGIHANKU','nasabah.NM_NASABAH',
                 'tagihanku.PAKAI_AIR','tagihanku.PAKAI_LISTRIK',
                 'tagihanku.SELISIH_AIR','tagihanku.SELISIH_LISTRIK','tagihanku.DENDA_LISTRIK','tagihanku.DENDA_AIR',
                 'tagihanku.SELISIH_IPKEAMANAN','tagihanku.SELISIH_KEBERSIHAN',
                 'tagihanku.TGL_TAGIHAN','tagihanku.KET')
        ->where('STT_LUNAS',0)
        ->get();
    }catch(\Exception $e){
        return view('admin.print-tagihan',['dataset'=>$dataset])->with('error','Kesalahan Sistem');
    }
        return view('admin.print-tagihan',['dataset'=>$dataset]);
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }

    //Kasir
    public function dataTagihanKasir($id){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "kasir"){    
            $dataset = DB::table('tempat_usaha')
            ->leftJoin('nasabah','tempat_usaha.ID_NASABAH','=','nasabah.ID_NASABAH')
            ->select('tempat_usaha.ID_TEMPAT','tempat_usaha.KD_KONTROL','nasabah.NM_NASABAH')
            ->where('tempat_usaha.ID_TEMPAT',$id)
            ->get();
    
            $dataTagihan = DB::table('tagihanku')
            ->where('tagihanku.ID_TEMPAT',$id)
            ->get();
        return view('kasir.data-tagihan',['dataset'=>$dataset,'dataTagihan'=>$dataTagihan]);
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }

    public function dataTagihanKasirAll($id){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "kasir"){
            $dataset = DB::table('nasabah')
            ->where('ID_NASABAH',$id)
            ->first();
    
            $dataTagihan = DB::table('tagihanku')
            ->leftJoin('tempat_usaha','tagihanku.ID_TEMPAT','=','tempat_usaha.ID_TEMPAT')
            ->where('tagihanku.ID_NASABAH',$id)
            ->get();
        return view('kasir.all-tagihan',['dataset'=>$dataset,'dataTagihan'=>$dataTagihan]);
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }

    public function bayarTagihanKasir($id){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "kasir"){
        try{ 
            $dataset = DB::table('tagihanku')
            ->join('tempat_usaha','tagihanku.ID_TEMPAT','=','tempat_usaha.ID_TEMPAT')
            ->join('nasabah','tempat_usaha.ID_NASABAH','=','nasabah.ID_NASABAH')
            ->select('tempat_usaha.KD_KONTROL','tempat_usaha.STT_CICIL',
            'tagihanku.TTL_TAGIHAN','tagihanku.SELISIH','tagihanku.DENDA','tempat_usaha.ID_TEMPAT',
            'tagihanku.ID_TAGIHANKU','nasabah.NM_NASABAH','tagihanku.REALISASI',
            'tagihanku.SELISIH_AIR','tagihanku.DENDA_AIR',
            'tagihanku.SELISIH_LISTRIK','tagihanku.DENDA_LISTRIK',
            'tagihanku.SELISIH_IPKEAMANAN','tagihanku.SELISIH_KEBERSIHAN')
            ->where('ID_TAGIHANKU',$id)
            ->get();
    
            $check = DB::table('tagihanku')
            ->join('tempat_usaha','tagihanku.ID_TEMPAT','=','tempat_usaha.ID_TEMPAT')
            ->join('nasabah','tempat_usaha.ID_NASABAH','=','nasabah.ID_NASABAH')
            ->select(
                DB::raw('(tagihanku.TTL_TAGIHAN + tagihanku.DENDA) as total'),
                'tagihanku.REALISASI','nasabah.ID_NASABAH','tagihanku.STT_LUNAS','tagihanku.ID_TEMPAT')
            ->where('ID_TAGIHANKU',$id)
            ->first();
    
            $bayar = $check->REALISASI;
            $tagihan = $check->total;
            $idNas = $check->ID_NASABAH;
    
            //Kalau Tagihan Sudah Lunas
            if($check->STT_LUNAS == 1){
                return redirect()->route('lapTagihanKasir')->with('info','Tagihan Sudah Dibayar');
            }
    
        //Apabila Tagihan Sebelumnya Belum Terbayar
            // $idTempat = $check->ID_TEMPAT;
            // $belum = DB::table('tagihanku')
            // ->where([['ID_TEMPAT',$idTempat],['STT_LUNAS',0]])
            // ->get();
    
            // $recTotal = $belum->count();
            // for($i=0;$i<$recTotal;$i++){
            //     if($i > 0){
            //         if($belum[$i]->ID_TAGIHANKU == $id){
            //             if($belum[$i-1] != null){
            //                 return redirect()->route('lapTagihanKasir')->with('info','Tagihan Sebelumnya Belum Terbayar');
            //             }
            //         }
            //     }
            // }
    
        }catch(\Eception $e){
            return redirect()->route('lapTagihanKasir')->with('error','Kesalahan Sistem');
        }
            return view('kasir.update-tagihan',['dataset'=>$dataset]);
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }
    
        public function storeBayarKasir(Request $request,$id,$real){
            if(!Session::get('login')){
                return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
            }
            else{
                if(Session::get('role') == "kasir"){
            try{
            $username = Session::get('username');

            $user = DB::table('user')
            ->where('NAMA_USER',$username)
            ->first();
            $id_user = $user->ID_USER;

            $timezone = date_default_timezone_set('Asia/Jakarta');
            $date = date("Y-m-d", time());
            $bln = date("Y-m", strtotime($date));
 
            $expReal = explode(",",$real);
            $realisasi = "";
            for($k=0;$k<count($expReal);$k++){
                $realisasi = $realisasi.$expReal[$k];
            }
            $check = DB::table('tagihanku')
            ->select('tagihanku.ID_TEMPAT')
            ->where('ID_TAGIHANKU',$id)
            ->first();
            $id_tempat = $check->ID_TEMPAT;

            $status = DB::table('tempat_usaha')
            ->select('STT_CICIL')
            ->where('ID_TEMPAT',$id_tempat)
            ->first();

            $dataset = DB::table('tagihanku')->where('ID_TAGIHANKU',$id)->first();

            //Cek Status Cicil Tempat Usaha
            if($status->STT_CICIL == 0){ //apabila tidak boleh mencicil, maka bayaran lunas
                $ttl_tagihan = $dataset->TTL_TAGIHAN + $dataset->DENDA;
                $selisih = 0;
                $ttl_listrik = $dataset->TTL_LISTRIK + $dataset->DENDA_LISTRIK;
                $sel_listrik = 0;
                $ttl_air = $dataset->TTL_AIR + $dataset->DENDA_AIR;
                $sel_air = 0;
                $ttl_ipkeamanan = $dataset->TTL_IPKEAMANAN;
                $sel_aman = 0;
                $ttl_kebersihan = $dataset->TTL_KEBERSIHAN;
                $sel_bersih = 0;
                $stt_lunas = 1;
                $stt_bayar = 1;
            }
            else{ //bila boleh mencicil
                if($realisasi >= ($dataset->SELISIH_LISTRIK+$dataset->DENDA_LISTRIK)+
                                 ($dataset->SELISIH_AIR+$dataset->DENDA_AIR)+($dataset->SELISIH_IPKEAMANAN)+
                                 ($dataset->SELISIH_KEBERSIHAN)){ //kondisi realisasi lebih dari tagihan, maka lunas
                    $ttl_tagihan = $dataset->TTL_TAGIHAN + $dataset->DENDA;
                    $selisih = 0;
                    $ttl_listrik = $dataset->TTL_LISTRIK + $dataset->DENDA_LISTRIK;
                    $sel_listrik = 0;
                    $ttl_air = $dataset->TTL_AIR + $dataset->DENDA_AIR;
                    $sel_air = 0;
                    $ttl_ipkeamanan = $dataset->TTL_IPKEAMANAN;
                    $sel_aman = 0;
                    $ttl_kebersihan = $dataset->TTL_KEBERSIHAN;
                    $sel_bersih = 0;
                    $stt_lunas = 1;
                    $stt_bayar = 1;
                }
                else if($realisasi < ($dataset->SELISIH_LISTRIK+$dataset->DENDA_LISTRIK)+
                                      ($dataset->SELISIH_AIR+$dataset->DENDA_AIR)+($dataset->SELISIH_IPKEAMANAN)+
                                      ($dataset->SELISIH_KEBERSIHAN) && $realisasi > 0){ //kondisi realisasi kurang dari tagihan maka dilakukan
                    //Kebersihan
                    if($realisasi >= $dataset->SELISIH_KEBERSIHAN){
                        $sisa = $realisasi - $dataset->SELISIH_KEBERSIHAN; //ada sisa
                        $ttl_kebersihan = $dataset->SELISIH_KEBERSIHAN;
                        $sel_bersih = 0;
                    }
                    else{
                        $ttl_kebersihan = $realisasi;
                        $sel_bersih = $dataset->SELISIH_KEBERSIHAN - $realisasi;
                        $sisa = 0; //sisa 0
                    }
                    $sisa_kebersihan = $sisa;
                    //Keamanan
                    if($sisa_kebersihan >= $dataset->SELISIH_IPKEAMANAN){
                        $sisa = $sisa_kebersihan - $dataset->SELISIH_IPKEAMANAN; //ada sisa
                        $ttl_ipkeamanan = $dataset->SELISIH_IPKEAMANAN;
                        $sel_aman = 0;
                    }
                    else{
                        $ttl_ipkeamanan = $sisa_kebersihan;
                        $sel_aman = $dataset->SELISIH_IPKEAMANAN - $sisa_kebersihan;
                        $sisa = 0; //sisa 0
                    }
                    $sisa_keamanan = $sisa;
                    //Air
                    if($sisa_keamanan >= ($dataset->SELISIH_AIR+$dataset->DENDA_AIR)){
                        $sisa = $sisa_keamanan - ($dataset->SELISIH_AIR+$dataset->DENDA_AIR); //ada sisa
                        $ttl_air = $dataset->SELISIH_AIR + $dataset->DENDA_AIR;
                        $sel_air = 0;
                    }
                    else{
                        $ttl_air = $sisa_keamanan;
                        $sel_air = ($dataset->SELISIH_AIR+$dataset->DENDA_AIR) - $sisa_keamanan;
                        $sisa = 0; //sisa 0
                    }
                    $sisa_air = $sisa;
                    //Listrik
                    if($sisa_air >= ($dataset->SELISIH_LISTRIK+$dataset->DENDA_LISTRIK)){
                        $sisa = $sisa_air - ($dataset->SELISIH_LISTRIK+$dataset->DENDA_LISTRIK); //ada sisa
                        $ttl_listrik = $dataset->SELISIH_LISTRIK + $dataset->DENDA_LISTRIK;
                        $sel_listrik = 0;
                    }
                    else{
                        $ttl_listrik = $sisa_air;
                        $sel_listrik = ($dataset->SELISIH_LISTRIK+$dataset->DENDA_LISTRIK) - $sisa_air;
                        $sisa = 0; //sisa 0
                    }
                    $stt_bayar = 1;
                    $stt_lunas = 0;
                    $ttl_tagihan = $ttl_listrik + $ttl_air + $ttl_ipkeamanan + $ttl_kebersihan;
                    $selisih = $sel_listrik + $sel_air + $sel_aman + $sel_bersih;
                }
                
                else{
                    return redirect()->route('bayartagihanKasir',['id'=>$id])->with('error',' Pembayaran Gagal');
                }
            }
            DB::table('tagihanku')->where('ID_TAGIHANKU', $id)->update([
                'ID_USER'=>$id_user,
                'TGL_BAYAR'=>$date,
                'BLN_BAYAR'=>$bln,
                'STT_LUNAS'=>$stt_lunas,
                'STT_BAYAR'=>$stt_bayar,
                'REALISASI_AIR'=>$ttl_air,
                'SELISIH_AIR'=>$sel_air,
                'REALISASI_LISTRIK'=>$ttl_listrik,
                'SELISIH_LISTRIK'=>$sel_listrik,
                'REALISASI_IPKEAMANAN'=>$ttl_ipkeamanan,
                'SELISIH_IPKEAMANAN'=>$sel_aman,
                'REALISASI_KEBERSIHAN'=>$ttl_kebersihan,
                'SELISIH_KEBERSIHAN'=>$sel_bersih,
                'REALISASI'=>$ttl_tagihan,
                'SELISIH'=>$selisih
            ]);
        } catch(\Exception $e){
            return redirect()->route('bayartagihanKasir',['id'=>$id])->with('error','Pembayaran Gagal');
        }

        return redirect()->route('lapTagihanKasir')->with('success','Pembayaran Dilakukan');
        }
        else{
            abort(403, 'Oops! Access Forbidden');
        }
    }
    }

    public function checkout(Request $request, $id){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "kasir"){
        switch ($request->get('button')) {
            case "Checkout":
            $dataku = DB::table('nasabah')
            ->where('ID_NASABAH',$id)
            ->first();

            if($request->get('check') != null){
                $ids = $request->get('check');
                $dataset = DB::table('tagihanku')
                ->select(
                DB::raw('SUM(SELISIH_AIR) as ttlAir'),
                DB::raw('SUM(DENDA_AIR) as dendaAir'),
                DB::raw('SUM(SELISIH_LISTRIK) as ttlListrik'),
                DB::raw('SUM(DENDA_LISTRIK) as dendaListrik'),
                DB::raw('SUM(SELISIH_IPKEAMANAN) as ttlIpkeamanan'),
                DB::raw('SUM(SELISIH_KEBERSIHAN) as ttlKebersihan'),
                DB::raw('SUM(SELISIH) as ttlTagihan'))
                ->where([
                    ['ID_NASABAH',$id],
                    ['STT_LUNAS', 0],
                    ['STT_BAYAR', 0]
                ])
                ->whereIn('ID_TAGIHANKU',$ids)
                ->get();
            }
            else{
                $dataset = DB::table('tagihanku')
                ->select(
                DB::raw('SUM(SELISIH_AIR) as ttlAir'),
                DB::raw('SUM(DENDA_AIR) as dendaAir'),
                DB::raw('SUM(SELISIH_LISTRIK) as ttlListrik'),
                DB::raw('SUM(DENDA_LISTRIK) as dendaListrik'),
                DB::raw('SUM(SELISIH_IPKEAMANAN) as ttlIpkeamanan'),
                DB::raw('SUM(SELISIH_KEBERSIHAN) as ttlKebersihan'),
                DB::raw('SUM(SELISIH) as ttlTagihan'))
                ->where([
                    ['ID_NASABAH',$id],
                    ['STT_LUNAS', 0],
                    ['STT_BAYAR', 0]
                ])
                ->get();

                $id_data = DB::table('tagihanku')
                ->select('ID_TAGIHANKU')
                ->where([
                    ['ID_NASABAH',$id],
                    ['STT_LUNAS', 0],
                    ['STT_BAYAR', 0]
                ])
                ->get();
                $ids = array();
                $x = 0;
                foreach($id_data as $id){                
                    $idku = $id->ID_TAGIHANKU;
                    $ids[$x] = $idku; 
                    $x++;
                }
            }
            return view('kasir.checkout',['dataku'=>$dataku,'dataset'=>$dataset,'ids'=>$ids]);
            break;
        }
        }
        else{
            abort(403, 'Oops! Access Forbidden');
        }
    }
    }

    public function printFaktur(Request $request, $id){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "kasir"){
        $ids = $request->get('bayar');
        foreach($ids as $id){
            $id_exp = explode(",",$id);
        }

        $dataset = DB::table('tagihanku')
                ->leftJoin('tempat_usaha','tagihanku.ID_TEMPAT','=','tempat_usaha.ID_TEMPAT')
                ->leftJoin('nasabah','tagihanku.ID_NASABAH','=','nasabah.ID_NASABAH')
                ->select('tagihanku.ID_TAGIHANKU',
                         'nasabah.NM_NASABAH','nasabah.NO_ANGGOTA','tagihanku.TGL_TAGIHAN',
                         'tagihanku.SELISIH_AIR','tagihanku.DENDA_AIR','tempat_usaha.KD_KONTROL',
                         'tagihanku.SELISIH_LISTRIK','tagihanku.DENDA_LISTRIK','tagihanku.SELISIH_IPKEAMANAN','tagihanku.SELISIH',
                         'tagihanku.SELISIH_KEBERSIHAN')
                ->where([
                    ['tagihanku.STT_LUNAS', 0],
                    ['tagihanku.STT_BAYAR', 0]
                ])
                ->whereIn('tagihanku.ID_TAGIHANKU',$id_exp)
                ->get();
        
        $dataku = DB::table('tagihanku')
        ->leftJoin('nasabah','tagihanku.ID_NASABAH','=','nasabah.ID_NASABAH')
        ->select('nasabah.NM_NASABAH','nasabah.NO_ANGGOTA')
        ->where([
            ['tagihanku.STT_LUNAS', 0],
            ['tagihanku.STT_BAYAR', 0]
        ])
        ->where('tagihanku.ID_TAGIHANKU',$id_exp[0])
        ->first();

        return view('kasir.print-faktur',['dataku'=>$dataku,'dataset'=>$dataset,'id_exp'=>$id_exp]);
        }
        else{
            abort(403, 'Oops! Access Forbidden');
        }
    }
    }

    public function storeCheckout(Request $request,$ids){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "kasir"){
        try{
        $username = Session::get('username');

        $user = DB::table('user')
        ->where('NAMA_USER',$username)
        ->first();
        $id_user = $user->ID_USER;

        $id_exp = explode(",",$ids);

        $timezone = date_default_timezone_set('Asia/Jakarta');
        $date = date("Y-m-d", time());
        $bln = date("Y-m", strtotime($date));

        $d = DB::table('tagihanku')
        ->whereIn('ID_TAGIHANKU', $id_exp)
        ->get();
        
        foreach($d as $data){
            DB::table('tagihanku')
            ->where('ID_TAGIHANKU', $data->ID_TAGIHANKU)
            ->update([
                'ID_USER'=>$id_user,
                'TGL_BAYAR'=>$date,
                'BLN_BAYAR'=>$bln,
                'STT_LUNAS'=>1,
                'STT_BAYAR'=>1,
                'REALISASI_AIR'=>$data->TTL_AIR + $data->DENDA_AIR,
                'SELISIH_AIR'=>0,
                'REALISASI_LISTRIK'=>$data->TTL_LISTRIK + $data->DENDA_LISTRIK,
                'SELISIH_LISTRIK'=>0,
                'REALISASI_IPKEAMANAN'=>$data->TTL_IPKEAMANAN,
                'SELISIH_IPKEAMANAN'=>0,
                'REALISASI_KEBERSIHAN'=>$data->TTL_KEBERSIHAN,
                'SELISIH_KEBERSIHAN'=>0,
                'REALISASI'=>$data->TTL_AIR + $data->DENDA_AIR + $data->TTL_LISTRIK + $data->DENDA_LISTRIK + $data->TTL_IPKEAMANAN + $data->TTL_KEBERSIHAN,
                'SELISIH'=>0
            ]);    
        }
    }catch(\Exception $e){
        return redirect()->back()->with('error','Pembayaran Gagal');
    }
        return redirect()->route('lapTagihanKasir')->with('success','Pembayaran Dilakukan');
        }
        else{
            abort(403, 'Oops! Access Forbidden');
        }
    }
    }

    public function printStrukKasir(Request $request,$id){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "kasir"){
        $expReal = explode(",",$request->get('realisasi'));
        $realisasi = "";
        for($m=0;$m<count($expReal);$m++){
            $realisasi = $realisasi.$expReal[$m];
        }

        $dataset = DB::table('tagihanku')
        ->leftJoin('tempat_usaha','tagihanku.ID_TEMPAT','=','tempat_usaha.ID_TEMPAT')
        ->leftJoin('nasabah','tempat_usaha.ID_NASABAH','=','nasabah.ID_NASABAH')
        ->where('ID_TAGIHANKU',$id)
        ->first();

        return view('kasir.print-struk',['dataset'=>$dataset,'realisasi'=>$realisasi]);
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }

    public function penerimaan(){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "kasir"){
        $dataset = DB::table('tagihanku')
            ->select('TGL_BAYAR','STT_BAYAR')
            ->groupBy('TGL_BAYAR','STT_BAYAR')
            ->get();

        return view('kasir.penerimaan',['dataset'=>$dataset]);
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }

    public function printPenerimaan($tgl){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "kasir"){
        $username = Session::get('username');
        $user = DB::table('user')
        ->where('NAMA_USER',$username)
        ->first();

        $id_user = $user->ID_USER;
        
        $dataset = DB::table('tagihanku')
        ->leftJoin('tempat_usaha','tagihanku.ID_TEMPAT','=','tempat_usaha.ID_TEMPAT')
        ->leftJoin('nasabah','tagihanku.ID_NASABAH','=','nasabah.ID_NASABAH')
        ->where([
            ['tagihanku.ID_USER',$id_user],
            ['tagihanku.TGL_BAYAR',$tgl],
            ['tagihanku.STT_BAYAR', 1]
        ])
        ->get();

        $tanggal = DB::table('tagihanku')
            ->select('tagihanku.TGL_BAYAR')
            ->where('tagihanku.TGL_BAYAR',$tgl)
            ->first();

        return view('kasir.print-harian',['dataset'=>$dataset,'tanggal'=>$tanggal,'user'=>$user]);
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }
    //ENDKASIR

    //Manager
    public function dataTagihanManager($id){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "manajer"){
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
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
        }
        
    //EndManager
}
