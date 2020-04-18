<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tagihan;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Redirector;
use Exception;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class laporanController extends Controller
{
    public function showHarian(){
    	if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "Super Admin"){

        try{
        $dataset = DB::table('tagihanku')
        ->join('tempat_usaha','tagihanku.ID_TEMPAT','=','tempat_usaha.ID_TEMPAT')
        ->join('nasabah','tempat_usaha.ID_NASABAH','=','nasabah.ID_NASABAH')
        ->where('STT_LUNAS',1)
        ->get();
    }catch(\Exception $e){
        return view('admin.laporan-harian',['dataset'=>$dataset])->with('error','Kesalahan Sistem');
    }
        return view('admin.laporan-harian',['dataset'=>$dataset]);
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }
    public function filterHarian(Request $request){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "Super Admin"){

        try{
        $from = $request->get('dari');
        $to = $request->get('sampai');
        $dataset = DB::table('tagihanku')
        ->join('tempat_usaha','tagihanku.ID_TEMPAT','=','tempat_usaha.ID_TEMPAT')
        ->join('nasabah','tempat_usaha.ID_NASABAH','=','nasabah.ID_NASABAH')
        ->whereBetween('TGL_TAGIHAN',[$from,$to])
        ->where('STT_LUNAS',1)
        ->get();
    }catch(\Exception $e){
        return view('admin.laporan-harian',['dataset'=>$dataset])->with('error','Kesalahan Sistem');
    }
        return view('admin.laporan-harian',['dataset'=>$dataset]);
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }
    
    public function showBulanan(){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "Super Admin"){

        try{
        $dataset = DB::table('tagihanku')
        ->join('tempat_usaha','tagihanku.ID_TEMPAT','=','tempat_usaha.ID_TEMPAT')
        ->join('nasabah','tempat_usaha.ID_NASABAH','=','nasabah.ID_NASABAH')
        ->get();
    }catch(\Exception $e){
        return view('admin.laporan-bulanan',['dataset'=>$dataset])->with('error','Kesalahan Sistem');
    }
        return view('admin.laporan-bulanan',['dataset'=>$dataset]);
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }
    public function filterBulanan(Request $request){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "Super Admin"){

        try{
        $filter = $request->get('filterbln');

        $dataset = DB::table('tagihanku')
        ->join('tempat_usaha','tagihanku.ID_TEMPAT','=','tempat_usaha.ID_TEMPAT')
        ->join('nasabah','tempat_usaha.ID_NASABAH','=','nasabah.ID_NASABAH')
        ->where('BLN_TAGIHAN',$filter)
        ->get();
    }catch(\Exception $e){
        return view('admin.laporan-bulanan',['dataset'=>$dataset])->with('error','Kesalahan Sistem');
    }
        return view('admin.laporan-bulanan',['dataset'=>$dataset]);
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }

    public function showPemakaian(){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "Super Admin"){

        $dataset = DB::table('tagihanku')
        ->select('BLN_TAGIHAN')
        ->groupBy('BLN_TAGIHAN')
        ->get();
        return view('admin.pemakaian',['dataset'=>$dataset]);
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }
    
    public function printRekapAir($bln){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "Super Admin"){

        $dataset = DB::table('tagihanku')
        ->select('tagihanku.BLOK_TEMPAT',
            DB::raw('SUM(tagihanku.PAKAI_AIR) as pakaiAir'),
            DB::raw('SUM(tagihanku.BYR_AIR) as bAir'),
            DB::raw('SUM(tagihanku.BYR_BEBAN) as bBeban'),
            DB::raw('SUM(tagihanku.BYR_PEMELIHARAAN) as bPemeliharaan'),
            DB::raw('SUM(tagihanku.BYR_ARKOT) as bArkot'),
            DB::raw('SUM(tagihanku.TTL_AIR + tagihanku.DENDA_AIR) as tagihan'),
            DB::raw('SUM(tagihanku.REALISASI_AIR) as realisasi'),
            DB::raw('SUM(tagihanku.SELISIH_AIR) as selisih')
        )
        ->where('tagihanku.BLN_TAGIHAN',$bln)
        ->groupBy('tagihanku.BLOK_TEMPAT')
        ->get();

        $data = DB::table('tagihanku')
        ->select('BLN_TAGIHAN')
        ->where('BLN_TAGIHAN',$bln)
        ->first();
        return view('admin.print-rekap-pemakaian-air',['dataset'=>$dataset,'data'=>$data]);
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }

    public function printRincianAir($bln){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "Super Admin"){

        $data = DB::table('tagihanku')
        ->select('BLN_TAGIHAN')
        ->where('BLN_TAGIHAN',$bln)
        ->first();

        $blok = DB::table('tagihanku')
        ->select('BLOK_TEMPAT',DB::raw('count(*) as ttl_Blok'))
        ->where('BLN_TAGIHAN',$bln)
        ->groupBy('BLOK_TEMPAT')
        ->get();

        $ttlBlok = count($blok);
        return view('admin.print-rincian-pemakaian-air',['data'=>$data,'blok'=>$blok,'ttlBlok'=>$ttlBlok,'bln'=>$bln]);
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }

    public function printRekapListrik($bln){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "Super Admin"){

        $dataset = DB::table('tagihanku')
        ->select('tagihanku.BLOK_TEMPAT',
            DB::raw('SUM(tagihanku.DAYA_LISTRIK) as daya'),
            DB::raw('SUM(tagihanku.PAKAI_LISTRIK) as pakaiListrik'),
            DB::raw('SUM(tagihanku.B_BEBAN) as bBeban'),
            DB::raw('SUM(tagihanku.BPJU) as bpju'),
            DB::raw('SUM(tagihanku.TTL_LISTRIK + tagihanku.DENDA_LISTRIK) as tagihan'),
            DB::raw('SUM(tagihanku.REALISASI_LISTRIK) as realisasi'),
            DB::raw('SUM(tagihanku.SELISIH_LISTRIK) as selisih')
        )
        ->where('tagihanku.BLN_TAGIHAN',$bln)
        ->groupBy('tagihanku.BLOK_TEMPAT')
        ->get();

        $data = DB::table('tagihanku')
        ->select('BLN_TAGIHAN')
        ->where('BLN_TAGIHAN',$bln)
        ->first();

        return view('admin.print-rekap-pemakaian-listrik',['dataset'=>$dataset,'data'=>$data]);
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }

    public function printRincianListrik($bln){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "Super Admin"){

                $data = DB::table('tagihanku')
                ->select('BLN_TAGIHAN')
                ->where('BLN_TAGIHAN',$bln)
                ->first();
        
                $blok = DB::table('tagihanku')
                ->select('BLOK_TEMPAT',DB::raw('count(*) as ttl_Blok'))
                ->where('BLN_TAGIHAN',$bln)
                ->groupBy('BLOK_TEMPAT')
                ->get();
        
                $ttlBlok = count($blok);
                return view('admin.print-rincian-pemakaian-listrik',['data'=>$data,'blok'=>$blok,'ttlBlok'=>$ttlBlok,'bln'=>$bln]);
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }

    public function printRekapKebersihan($bln){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "Super Admin"){

        $dataset = DB::table('tagihanku')
        ->leftJoin('tempat_usaha','tagihanku.ID_TEMPAT','=','tempat_usaha.ID_TEMPAT')
        ->select('tagihanku.BLOK_TEMPAT',
            DB::raw('SUM(tagihanku.TTL_KEBERSIHAN) as tagihan'),
            DB::raw('SUM(tempat_usaha.JML_ALAMAT) as alamat'),
            DB::raw('SUM(tagihanku.REALISASI_KEBERSIHAN) as realisasi'),
            DB::raw('SUM(tagihanku.SELISIH_KEBERSIHAN) as selisih')
        )
        ->where('tagihanku.BLN_TAGIHAN',$bln)
        ->groupBy('tagihanku.BLOK_TEMPAT')
        ->get();

        $data = DB::table('tagihanku')
        ->select('BLN_TAGIHAN')
        ->where('BLN_TAGIHAN',$bln)
        ->first();
        return view('admin.print-rekap-pemakaian-kebersihan',['dataset'=>$dataset,'data'=>$data]);
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }

    public function printRincianKebersihan($bln){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "Super Admin"){

        $dataset = DB::table('tagihanku')
        ->leftJoin('tempat_usaha','tagihanku.ID_TEMPAT','=','tempat_usaha.ID_TEMPAT')
        ->leftJoin('nasabah','tagihanku.ID_NASABAH','=','nasabah.ID_NASABAH')
        ->where('tagihanku.BLN_TAGIHAN',$bln)
        ->get();

        $data = DB::table('tagihanku')
        ->select('BLN_TAGIHAN')
        ->where('BLN_TAGIHAN',$bln)
        ->first();
        return view('admin.print-rincian-pemakaian-kebersihan',['dataset'=>$dataset,'data'=>$data]);
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }

    public function printRekapKeamanan($bln){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "Super Admin"){

        $dataset = DB::table('tagihanku')
        ->leftJoin('tempat_usaha','tagihanku.ID_TEMPAT','=','tempat_usaha.ID_TEMPAT')
        ->select('tagihanku.BLOK_TEMPAT',
            DB::raw('SUM(tagihanku.TTL_IPKEAMANAN) as tagihan'),
            DB::raw('SUM(tempat_usaha.JML_ALAMAT) as alamat'),
            DB::raw('SUM(tagihanku.REALISASI_IPKEAMANAN) as realisasi'),
            DB::raw('SUM(tagihanku.SELISIH_IPKEAMANAN) as selisih')
        )
        ->where('tagihanku.BLN_TAGIHAN',$bln)
        ->groupBy('tagihanku.BLOK_TEMPAT')
        ->get();

        $data = DB::table('tagihanku')
        ->select('BLN_TAGIHAN')
        ->where('BLN_TAGIHAN',$bln)
        ->first();
        return view('admin.print-rekap-pemakaian-keamanan',['dataset'=>$dataset,'data'=>$data]);
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }

    public function printRincianKeamanan($bln){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "Super Admin"){

        $dataset = DB::table('tagihanku')
        ->leftJoin('tempat_usaha','tagihanku.ID_TEMPAT','=','tempat_usaha.ID_TEMPAT')
        ->leftJoin('nasabah','tagihanku.ID_NASABAH','=','nasabah.ID_NASABAH')
        ->where('tagihanku.BLN_TAGIHAN',$bln)
        ->get();

        $data = DB::table('tagihanku')
        ->select('BLN_TAGIHAN')
        ->where('BLN_TAGIHAN',$bln)
        ->first();
        return view('admin.print-rincian-pemakaian-keamanan',['dataset'=>$dataset,'data'=>$data]);
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }

    public function showTahunan(){
    	if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "Super Admin"){

        try{
        //AIR
        $dataA = DB::table('tagihanku')
        ->select('BLN_TAGIHAN',
            DB::raw('SUM(PAKAI_AIR) as pakaiAir'),
            DB::raw('SUM(BYR_AIR) as byrAir'),
            DB::raw('SUM(BYR_BEBAN) as byrBeban'),
            DB::raw('SUM(BYR_PEMELIHARAAN) as byrPemeliharaan'),
            DB::raw('SUM(BYR_ARKOT) as byrArkot'),
            DB::raw('SUM(TTL_AIR) as ttlAir'),
            DB::raw('SUM(REALISASI_AIR) as realisasiAir'),
            DB::raw('SUM(SELISIH_AIR) as selisihAir'),
            DB::raw('SUM(DENDA_AIR) as dendaAir'))
        ->groupBy('BLN_TAGIHAN')
        ->get();

        //LISTRIK
        $dataL = DB::table('tagihanku')
        ->select('BLN_TAGIHAN',
            DB::raw('SUM(PAKAI_LISTRIK) as pakaiListrik'),
            DB::raw('SUM(REK_MIN) as rekmin'),
            DB::raw('SUM(B_BLOK1) as bBlok1'),
            DB::raw('SUM(B_BLOK2) as bBlok2'),
            DB::raw('SUM(B_BEBAN) as bBeban'),
            DB::raw('SUM(BPJU) as bpju'),
            DB::raw('SUM(TTL_LISTRIK) as ttlListrik'),
            DB::raw('SUM(REALISASI_LISTRIK) as realisasiListrik'),
            DB::raw('SUM(SELISIH_LISTRIK) as selisihListrik'),
            DB::raw('SUM(DENDA_LISTRIK) as dendaListrik'))
        ->groupBy('BLN_TAGIHAN')
        ->get();

        //KEAMANAN
        $dataK = DB::table('tagihanku')
        ->select('BLN_TAGIHAN',
            DB::raw('SUM(TTL_IPKEAMANAN) as ttlIpkeamanan'),
            DB::raw('SUM(REALISASI_IPKEAMANAN) as realisasiIpkeamanan'),
            DB::raw('SUM(SELISIH_IPKEAMANAN) as selisihIpkeamanan'))
        ->groupBy('BLN_TAGIHAN')
        ->get();
        
        //KEBERSIHAN
        $dataB = DB::table('tagihanku')
        ->select('BLN_TAGIHAN',
            DB::raw('SUM(TTL_KEBERSIHAN) as ttlKebersihan'),
            DB::raw('SUM(REALISASI_KEBERSIHAN) as realisasiKebersihan'),
            DB::raw('SUM(SELISIH_KEBERSIHAN) as selisihKebersihan'))
        ->groupBy('BLN_TAGIHAN')
        ->get();
    }catch(\Exception $e){
        return view('admin.laporan-tahunan',['dataA'=>$dataA,'dataL'=>$dataL,'dataK'=>$dataK,'dataB'=>$dataB])->with('error','Kesalahan Sistem');
    }
        return view('admin.laporan-tahunan',['dataA'=>$dataA,'dataL'=>$dataL,'dataK'=>$dataK,'dataB'=>$dataB]);
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }
    public function showTagihan(){
    	if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "Super Admin"){

        try{
        $dataset = DB::table('tempat_usaha')
        ->leftJoin('nasabah','tempat_usaha.ID_NASABAH','=','nasabah.ID_NASABAH')
        ->leftJoin('pemilik','tempat_usaha.ID_PEMILIK','=','pemilik.ID_PEMILIK')
        ->select('tempat_usaha.ID_TEMPAT','tempat_usaha.KD_KONTROL', 
                 'nasabah.NM_NASABAH','nasabah.NO_ANGGOTA','nasabah.NO_KTP',
                 'nasabah.NO_NPWP','nasabah.ID_NASABAH','pemilik.NM_PEMILIK')
        ->get();
    }catch(\Exception $e){
        return view('admin.laporan-tagihan',['dataset'=>$dataset])->with('error','Kesalahan Sistem');
    }
        return view('admin.laporan-tagihan',['dataset'=>$dataset]);
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }
    
    public function showTunggakan(){
    	if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "Super Admin"){

        try{
        $dataset = DB::table('tagihanku')
        ->join('tempat_usaha','tagihanku.ID_TEMPAT','=','tempat_usaha.ID_TEMPAT')
        ->join('nasabah','tempat_usaha.ID_NASABAH','=','nasabah.ID_NASABAH')
        ->join('pemilik','tempat_usaha.ID_PEMILIK','=','pemilik.ID_PEMILIK')
        ->where('STT_LUNAS',0)
        ->get();
        $now = Carbon::now()->toDateString();

        $nunggak = json_decode($dataset,true);
        foreach($nunggak as $d){
            //Set Expired tagihan
            $exp1 = $d['EXPIRED'];
            $exp2 = Carbon::createFromFormat('Y-m-d',$d['EXPIRED'])->add(1,'month')->toDateString();
            $exp3 = Carbon::createFromFormat('Y-m-d',$d['EXPIRED'])->add(2,'month')->toDateString();
            $exp4 = Carbon::createFromFormat('Y-m-d',$d['EXPIRED'])->add(3,'month')->toDateString();
            
            //Ambil Id Tagihannya
            $id_tagihan = $d['ID_TAGIHANKU'];

            //Ambil Id Tempat dari tagihan
            $tagihan = DB::table('tagihanku')
            ->leftJoin('tempat_usaha','tagihanku.ID_TEMPAT','=','tempat_usaha.ID_TEMPAT')
            ->leftJoin('tarif_air','tempat_usaha.ID_TRFAIR','=','tarif_air.ID_TRFAIR')
            ->leftJoin('tarif_listrik','tempat_usaha.ID_TRFLISTRIK','=','tarif_listrik.ID_TRFLISTRIK')
            ->select('tarif_air.TRF_DENDA',
            'tarif_listrik.VAR_DENDA',
            'tarif_listrik.DENDA_LEBIH',
            'tagihanku.TTL_LISTRIK',
            'tagihanku.PAKAI_LISTRIK',
            'tagihanku.DENDA')
            ->where('ID_TAGIHANKU',$id_tagihan)
            ->get();

            //Ambil Tarif Denda Fasilitas
            foreach($tagihan as $data){
                $denda_seb = $data->DENDA;
                $denda_air = $data->TRF_DENDA;
                if($data->PAKAI_LISTRIK > 4400){
                    $denda_listrik = $data->TTL_LISTRIK * ($data->DENDA_LEBIH / 100);
                }
                else{
                    $denda_listrik = $data->VAR_DENDA;
                }
                $total_dnd = $denda_air + $denda_listrik;
                $total_denda = round($total_dnd);
            }

            if($now > $exp1 && $now <= $exp2){
                //Denda 1 Bulan
                if($d['STT_DENDA'] == 0 && $d['BONGKAR'] != 1){
                    DB::table('tagihanku')->where('ID_TAGIHANKU', $id_tagihan)->update([
                        'DENDA_AIR'=>$denda_air,
                        'DENDA_LISTRIK'=>$denda_listrik,
                        'DENDA'=>$total_denda,
                        'STT_DENDA'=>1
                    ]);
                }
            }
            else if ($now > $exp2 && $now <= $exp3){
                //Kena Denda 2 Bulan
                if($d['STT_DENDA'] ==  0 && $d['BONGKAR'] != 1){
                    $total_denda = 2 * $total_denda;
                    DB::table('tagihanku')->where('ID_TAGIHANKU', $id_tagihan)->update([
                        'DENDA_AIR'=>$denda_air,
                        'DENDA_LISTRIK'=>$denda_listrik,
                        'DENDA'=>$total_denda,
                        'STT_DENDA'=>2
                    ]);
                }
                else if($d['STT_DENDA'] == 1 && $d['BONGKAR'] != 1){
                    $total_denda = $total_denda + $denda_seb;
                    DB::table('tagihanku')->where('ID_TAGIHANKU', $id_tagihan)->update([
                        'DENDA_AIR'=>$denda_air,
                        'DENDA_LISTRIK'=>$denda_listrik,
                        'DENDA'=>$total_denda,
                        'STT_DENDA'=>2
                    ]);
                }
            }
            else if ($now > $exp3 && $now <= $exp4){
                //kena Denda 3 Bulan
                if($d['STT_DENDA'] ==  0 && $d['BONGKAR'] != 1){
                    $total_denda = 3 * $total_denda;
                    DB::table('tagihanku')->where('ID_TAGIHANKU', $id_tagihan)->update([
                        'DENDA_AIR'=>$denda_air,
                        'DENDA_LISTRIK'=>$denda_listrik,
                        'DENDA'=>$total_denda,
                        'STT_DENDA'=>3
                    ]);
                }
                else if($d['STT_DENDA'] == 2 && $d['BONGKAR'] != 1){
                    $total_denda = $total_denda + $denda_seb;
                    DB::table('tagihanku')->where('ID_TAGIHANKU', $id_tagihan)->update([
                        'DENDA_AIR'=>$denda_air,
                        'DENDA_LISTRIK'=>$denda_listrik,
                        'DENDA'=>$total_denda,
                        'STT_DENDA'=>3
                    ]);
                }
            }
            else if($now > $exp4){
                if($d['BONGKAR'] != 1){
                    DB::table('tagihanku')->where('ID_TAGIHANKU', $id_tagihan)->update([
                        'STT_DENDA'=>4
                    ]);
                }
            }
        }
    }catch(\Exception $e){
        return view('admin.laporan-tunggakan',['dataset'=>$dataset])->with('error','Kesalahan Sistem');
    }
        return view('admin.laporan-tunggakan',['dataset'=>$dataset]);
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }
    
    public function showBongkaran(){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "Super Admin"){

        $dataset = DB::table('tagihanku')
        ->join('tempat_usaha','tagihanku.ID_TEMPAT','=','tempat_usaha.ID_TEMPAT')
        ->join('nasabah','tempat_usaha.ID_NASABAH','=','nasabah.ID_NASABAH')
        ->join('pemilik','tempat_usaha.ID_PEMILIK','=','pemilik.ID_PEMILIK')
        ->where([['STT_LUNAS',0],['STT_DENDA','>=',3]])
        ->get();

        return view('admin.laporan-bongkaran',['dataset'=>$dataset]);
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }

    public function bongkarAlat($id,$selAir,$selListrik,$selKeamanan,$selKebersihan,$denAir,$denListrik){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "Super Admin"){

        if($selAir == 0){
            $air = 1;
        }
        else{
            $air = NULL;
        }
        if($selListrik == 0){
            $listrik = 1;
        }
        else{
            $listrik = NULL;
        }
        
        DB::table('tempat_usaha')
        ->where('ID_TEMPAT', $id)
        ->update([
            'ID_TRFAIR'=>$air,
            'ID_TRFLISTRIK'=>$listrik,
        ]);

        DB::table('tagihanku')
        ->where([
            ['ID_TEMPAT', $id],
            ['STT_DENDA',4]
        ])
        ->update([
            'STT_DENDA'=>0,
            'BONGKAR'=>1
        ]);

        if($selAir != 0 && $selListrik != 0){
            return redirect()->route('bongkaran')->with('success','Alat Listrik dan Alat Air di Bongkar');
        }
        elseif($selAir == 0){
            return redirect()->route('bongkaran')->with('success','Alat Listrik di Bongkar');
        }
        else{
            return redirect()->route('bongkaran')->with('success','Alat di Bongkar');
        }
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }

    public function printPeringatan(Request $request,$id,$selAir,$selListrik,$selKeamanan,$selKebersihan,$denAir,$denListrik,$exp,$tglTagihan){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "Super Admin"){

        $tempat = DB::table('tempat_usaha')
        ->join('meteran_listrik','tempat_usaha.ID_MLISTRIK','=','meteran_listrik.ID_MLISTRIK')
        ->join('nasabah','tempat_usaha.ID_NASABAH','=','nasabah.ID_NASABAH')
        ->where('ID_TEMPAT',$id)
        ->first();

        $now = Carbon::now()->toDateString();
        $exp4 = Carbon::createFromFormat('Y-m-d',$exp)->add(3,'month')->toDateString();
        $expired = date("d M Y", strtotime($exp4));
        $tgl_tagihan = date("M Y", strtotime($tglTagihan));
        $tanggal = date("d", strtotime($now));
        $bulan = date("M", strtotime($now));
        $tahun = date("Y", strtotime($now));

        $nama = $tempat->NM_NASABAH;
        $alamat = $tempat->KD_KONTROL;
        $jmltagihan = "Rp. ".number_format($selAir + $denAir + $selListrik + $denListrik + $selKeamanan + $selKebersihan);
        $norekening = $tempat->NOMTR_LISTRIK;
        $periode = $tgl_tagihan;
        $tglbatas = $expired;
        $tanggal = $tanggal;
        $bulan = $bulan;
        $tahun = $tahun;

        $document = file_get_contents("css/SP.rtf");
        
        $document = str_replace("#NAMA", $nama, $document);
        $document = str_replace("#ALAMAT", $alamat, $document);
        $document = str_replace("#JMLTAGIHAN", $jmltagihan, $document);
        $document = str_replace("#NOREKENING", $norekening, $document);
        $document = str_replace("#PERIODE", $periode, $document);
        $document = str_replace("#TGLBATAS", $tglbatas, $document);
        $document = str_replace("#TANGGAL", $tanggal, $document);
        $document = str_replace("#BULAN", $bulan, $document);
        $document = str_replace("#TAHUN", $tahun, $document);

        header("Content-type: application/msword");
        header("Content-disposition: attachment; filename=surat_peringatan.doc");
        echo $document;
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }

    public function showPenghapusan(){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "Super Admin"){

        $dataset = DB::table('penghapusan')
        ->join('tempat_usaha','penghapusan.ID_TEMPAT','=','tempat_usaha.ID_TEMPAT')
        ->get();
        return view('admin.laporan-penghapusan',['dataset'=>$dataset]);
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }

    //Kasir
    public function showTagihanKasir(){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "kasir"){

        try{
            $dataset = DB::table('tempat_usaha')
            ->leftJoin('nasabah','tempat_usaha.ID_NASABAH','=','nasabah.ID_NASABAH')
            ->leftJoin('pemilik','tempat_usaha.ID_PEMILIK','=','pemilik.ID_PEMILIK')
            ->select('tempat_usaha.ID_TEMPAT','tempat_usaha.KD_KONTROL', 'nasabah.NM_NASABAH','nasabah.NO_ANGGOTA',
            'nasabah.NO_KTP','nasabah.NO_NPWP','nasabah.ID_NASABAH','pemilik.NM_PEMILIK','pemilik.ID_PEMILIK')
            ->get();

            $datanas = DB::table('nasabah')->get();
        }catch(\Exception $e){
            return view('kasir.tagihan',['dataset'=>$dataset,'datanas'=>$datanas])->with('error','Kesalahan Sistem');
        }
            return view('kasir.tagihan',['dataset'=>$dataset,'datanas'=>$datanas]);
        }
        else{
            abort(403, 'Oops! Access Forbidden');
        }
    }
    }
    //Keuangan
    public function showPenerimaanHarian(){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "keuangan"){
                $dataset = DB::table('tagihanku')
                ->select('TGL_BAYAR','STT_BAYAR')
                ->groupBy('TGL_BAYAR','STT_BAYAR')
                ->get();
                return view('keuangan.penerimaan-harian',['dataset'=>$dataset]);
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }

    public function printHarianKeuangan($tgl){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "keuangan"){
        $dataset = DB::table('tagihanku')
        ->leftJoin('user','tagihanku.ID_USER','=','user.ID_USER')
        ->select('user.NAMA_USER',
            DB::raw('SUM(tagihanku.REALISASI_LISTRIK - tagihanku.DENDA_LISTRIK) as Listrik'),
            DB::raw('SUM(tagihanku.REALISASI_AIR - tagihanku.DENDA_AIR) as Air'),
            DB::raw('SUM(tagihanku.REALISASI_IPKEAMANAN) as Keamanan'),
            DB::raw('SUM(tagihanku.REALISASI_KEBERSIHAN) as Kebersihan'),
            DB::raw('SUM(tagihanku.DENDA_LISTRIK) as DendaListrik'),
            DB::raw('SUM(tagihanku.DENDA_AIR) as DendaAir'),
            DB::raw('SUM(tagihanku.REALISASI) as Realisasi')
        )
        ->groupBy('user.NAMA_USER')
        ->where('tagihanku.TGL_BAYAR',$tgl)
        ->get();

        $data = DB::table('tagihanku')
        ->select('TGL_BAYAR')
        ->where('TGL_BAYAR',$tgl)
        ->first();
        return view('keuangan.print-harian',['dataset'=>$dataset,'data'=>$data]);
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }

    public function showPenerimaanBulanan(){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "keuangan"){
        $dataset = DB::table('tagihanku')
            ->select('BLN_BAYAR','STT_BAYAR')
            ->groupBy('BLN_BAYAR','STT_BAYAR')
            ->get();

        return view('keuangan.penerimaan-bulanan',['dataset'=>$dataset]);
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }

    public function printBulananKeuangan($bln){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "keuangan"){
        $dataset = DB::table('tagihanku')
        ->select(
            DB::raw('SUM(REALISASI_LISTRIK) as Listrik'),
            DB::raw('SUM(REALISASI_KEBERSIHAN) as Kebersihan')
        )
        ->where('BLN_BAYAR',$bln)
        ->get();

        $data = DB::table('tagihanku')
            ->select('BLN_BAYAR')
            ->where('BLN_BAYAR',$bln)
            ->first();
        return view('keuangan.print-bulanan',['dataset'=>$dataset,'data'=>$data]);
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }

    public function printRincianKeuangan($bln){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "keuangan"){
        $dataset = DB::table('tagihanku')
        ->select('TGL_BAYAR',
            DB::raw('SUM(REALISASI_LISTRIK) as Listrik'),
            DB::raw('SUM(REALISASI_KEBERSIHAN) as Kebersihan')
        )
        ->where('BLN_BAYAR',$bln)
        ->groupBy('TGL_BAYAR')
        ->get();

        $data = DB::table('tagihanku')
            ->select('BLN_BAYAR')
            ->where('BLN_BAYAR',$bln)
            ->first();
        return view('keuangan.print-rincian-bulanan',['dataset'=>$dataset,'data'=>$data]);
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }

    public function printBulananNoKeuangan($bln){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "keuangan"){
        $dataset = DB::table('tagihanku')
        ->select(
            DB::raw('SUM(REALISASI_AIR) as Air'),
            DB::raw('SUM(REALISASI_IPKEAMANAN) as Keamanan')
        )
        ->where('BLN_BAYAR',$bln)
        ->get();

        $data = DB::table('tagihanku')
            ->select('BLN_BAYAR')
            ->where('BLN_BAYAR',$bln)
            ->first();
        return view('keuangan.print-bulanan-no',['dataset'=>$dataset,'data'=>$data]);
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }

    public function printRincianNoKeuangan($bln){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "keuangan"){
        $dataset = DB::table('tagihanku')
        ->select('TGL_BAYAR',
            DB::raw('SUM(REALISASI_AIR) as Air'),
            DB::raw('SUM(REALISASI_IPKEAMANAN) as Keamanan')
        )
        ->where('BLN_BAYAR',$bln)
        ->groupby('TGL_BAYAR')
        ->get();

        $data = DB::table('tagihanku')
            ->select('BLN_BAYAR')
            ->where('BLN_BAYAR',$bln)
            ->first();

        return view('keuangan.print-rincian-bulanan-no',['dataset'=>$dataset,'data'=>$data]);
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }

    public function showPendapatanTahunan(){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "keuangan"){
        $dataset = DB::table('tagihanku')
            ->select('THN_TAGIHAN')
            ->groupBy('THN_TAGIHAN')
            ->get();
        return view('keuangan.pendapatan-tahunan',['dataset'=>$dataset]);
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }

    public function printTahunanKeuangan($thn){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "keuangan"){
        $dataset = DB::table('tagihanku')
        ->select('BLN_TAGIHAN',
            DB::raw('SUM(TTL_TAGIHAN) as Total'),
            DB::raw('SUM(REALISASI_LISTRIK) as Listrik'),
            DB::raw('SUM(REALISASI_KEBERSIHAN) as Kebersihan'),
            DB::raw('SUM(REALISASI_AIR) as Air'),
            DB::raw('SUM(REALISASI_IPKEAMANAN) as Keamanan'),
            DB::raw('SUM(SELISIH_LISTRIK) as selListrik'),
            DB::raw('SUM(SELISIH_KEBERSIHAN) as selKebersihan'),
            DB::raw('SUM(SELISIH_AIR) as selAir'),
            DB::raw('SUM(SELISIH_IPKEAMANAN) as selKeamanan'),
            DB::raw('SUM(REALISASI) as Realisasi'),
            DB::raw('SUM(SELISIH) as Selisih')
        )
        ->where('THN_TAGIHAN',$thn)
        ->groupBy('BLN_TAGIHAN')
        ->get();
        
        $data = DB::table('tagihanku')
            ->select('THN_TAGIHAN','BLN_TAGIHAN')
            ->where('THN_TAGIHAN',$thn)
            ->first();

        return view('keuangan.print-tahunan',['dataset'=>$dataset,'data'=>$data]);
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }

    //Manajer
    public function showHarianManager(){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "manajer"){
        $dataset = DB::table('tagihanku')
        ->select('TGL_BAYAR','STT_BAYAR')
        ->groupBy('TGL_BAYAR','STT_BAYAR')
        ->get();
        return view('manajer.laporan-harian',['dataset'=>$dataset]);
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }
        
    public function showBulananManager(){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "manajer"){
        $dataset = DB::table('tagihanku')
        ->select('BLN_BAYAR','STT_BAYAR')
        ->groupBy('BLN_BAYAR','STT_BAYAR')
        ->get();
        return view('manajer.laporan-bulanan',['dataset'=>$dataset]);
        }
        else{
            abort(403, 'Oops! Access Forbidden');
        }
    }
    }
    
    public function showTahunanManager(){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "manajer"){
        $dataset = DB::table('tagihanku')
        ->select('THN_TAGIHAN')
        ->groupBy('THN_TAGIHAN')
        ->get();
        return view('manajer.laporan-tahunan',['dataset'=>$dataset]);
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }

    public function rekapTunggakanManager(){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "manajer"){
        $dataset = DB::table('tagihanku')
        ->select('THN_TAGIHAN')
        ->groupBy('THN_TAGIHAN')
        ->get();
        return view('manajer.rekap-tunggakan',['dataset'=>$dataset]);
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }

    public function printTunggakanManajer($thn){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "manajer"){
        $dataset = DB::table('tagihanku')
        ->select('BLN_TAGIHAN',
            DB::raw('SUM(REALISASI_LISTRIK) as Listrik'),
            DB::raw('SUM(REALISASI_KEBERSIHAN) as Kebersihan'),
            DB::raw('SUM(REALISASI_AIR) as Air'),
            DB::raw('SUM(REALISASI_IPKEAMANAN) as Keamanan'),
            DB::raw('SUM(SELISIH_LISTRIK) as selListrik'),
            DB::raw('SUM(SELISIH_KEBERSIHAN) as selKebersihan'),
            DB::raw('SUM(SELISIH_AIR) as selAir'),
            DB::raw('SUM(SELISIH_IPKEAMANAN) as selKeamanan'),
            DB::raw('SUM(SELISIH) as Selisih'),
            DB::raw('SUM(REALISASI) as Realisasi')
        )
        ->where('THN_TAGIHAN',$thn)
        ->groupBy('BLN_TAGIHAN')
        ->get();
        
        $data = DB::table('tagihanku')
            ->select('THN_TAGIHAN','BLN_TAGIHAN')
            ->where('THN_TAGIHAN',$thn)
            ->first();
        
        return view('manajer.print-tunggakan',['dataset'=>$dataset,'data'=>$data]);
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }

    public function showPemakaianManager(){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "manajer"){
        $dataset = DB::table('tagihanku')
        ->select('BLN_TAGIHAN')
        ->groupBy('BLN_TAGIHAN')
        ->get();
        return view('manajer.pemakaian',['dataset'=>$dataset]);
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }

    public function printHarianManajer($tgl){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "manajer"){
        $dataset = DB::table('tagihanku')
        ->leftJoin('user','tagihanku.ID_USER','=','user.ID_USER')
        ->select('user.NAMA_USER',
            DB::raw('SUM(tagihanku.REALISASI_LISTRIK - tagihanku.DENDA_LISTRIK) as Listrik'),
            DB::raw('SUM(tagihanku.REALISASI_AIR - tagihanku.DENDA_AIR) as Air'),
            DB::raw('SUM(tagihanku.REALISASI_IPKEAMANAN) as Keamanan'),
            DB::raw('SUM(tagihanku.REALISASI_KEBERSIHAN) as Kebersihan'),
            DB::raw('SUM(tagihanku.DENDA_LISTRIK) as DendaListrik'),
            DB::raw('SUM(tagihanku.DENDA_AIR) as DendaAir'),
            DB::raw('SUM(tagihanku.REALISASI) as Realisasi')
        )
        ->groupBy('user.NAMA_USER')
        ->where('tagihanku.TGL_BAYAR',$tgl)
        ->get();

        $data = DB::table('tagihanku')
        ->select('TGL_BAYAR')
        ->where('TGL_BAYAR',$tgl)
        ->first();
        return view('manajer.print-harian',['dataset'=>$dataset,'data'=>$data]);
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }

    public function printBulananManajer($bln){
        $dataset = DB::table('tagihanku')
        ->select(
            DB::raw('SUM(REALISASI_LISTRIK) as Listrik'),
            DB::raw('SUM(REALISASI_KEBERSIHAN) as Kebersihan'),
            DB::raw('SUM(REALISASI_AIR) as Air'),
            DB::raw('SUM(REALISASI_IPKEAMANAN) as Keamanan')
        )
        ->where('BLN_BAYAR',$bln)
        ->get();

        $data = DB::table('tagihanku')
            ->select('BLN_BAYAR')
            ->where('BLN_BAYAR',$bln)
            ->first();
        return view('manajer.print-bulanan',['dataset'=>$dataset,'data'=>$data]);
    }
    
    public function printRincianManajer($bln){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "manajer"){
        $dataset = DB::table('tagihanku')
        ->select('TGL_BAYAR',
            DB::raw('SUM(REALISASI_LISTRIK) as Listrik'),
            DB::raw('SUM(REALISASI_KEBERSIHAN) as Kebersihan'),
            DB::raw('SUM(REALISASI_AIR) as Air'),
            DB::raw('SUM(REALISASI_IPKEAMANAN) as Keamanan')
        )
        ->where('BLN_BAYAR',$bln)
        ->groupBy('TGL_BAYAR')
        ->get();

        $data = DB::table('tagihanku')
            ->select('BLN_BAYAR')
            ->where('BLN_BAYAR',$bln)
            ->first();
        return view('manajer.print-rincian-bulanan',['dataset'=>$dataset,'data'=>$data]);
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }

    public function printTahunanManajer($thn){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "manajer"){
        $dataset = DB::table('tagihanku')
        ->select('BLN_TAGIHAN',
            DB::raw('SUM(TTL_TAGIHAN) as Total'),
            DB::raw('SUM(REALISASI_LISTRIK) as Listrik'),
            DB::raw('SUM(REALISASI_KEBERSIHAN) as Kebersihan'),
            DB::raw('SUM(REALISASI_AIR) as Air'),
            DB::raw('SUM(REALISASI_IPKEAMANAN) as Keamanan'),
            DB::raw('SUM(SELISIH_LISTRIK) as selListrik'),
            DB::raw('SUM(SELISIH_KEBERSIHAN) as selKebersihan'),
            DB::raw('SUM(SELISIH_AIR) as selAir'),
            DB::raw('SUM(SELISIH_IPKEAMANAN) as selKeamanan'),
            DB::raw('SUM(REALISASI) as Realisasi'),
            DB::raw('SUM(SELISIH) as Selisih')
        )
        ->where('THN_TAGIHAN',$thn)
        ->groupBy('BLN_TAGIHAN')
        ->get();
        
        $data = DB::table('tagihanku')
            ->select('THN_TAGIHAN','BLN_TAGIHAN')
            ->where('THN_TAGIHAN',$thn)
            ->first();
        
        return view('manajer.print-tahunan',['dataset'=>$dataset,'data'=>$data]);
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }

    public function printRekapAirManajer($bln){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "manajer"){
        $dataset = DB::table('tagihanku')
        ->select('tagihanku.BLOK_TEMPAT',
            DB::raw('SUM(tagihanku.PAKAI_AIR) as pakaiAir'),
            DB::raw('SUM(tagihanku.BYR_BEBAN) as bBeban'),
            DB::raw('SUM(tagihanku.BYR_PEMELIHARAAN) as bPemeliharaan'),
            DB::raw('SUM(tagihanku.BYR_ARKOT) as bArkot'),
            DB::raw('SUM(tagihanku.TTL_AIR + tagihanku.DENDA_AIR) as tagihan'),
            DB::raw('SUM(tagihanku.REALISASI_AIR) as realisasi'),
            DB::raw('SUM(tagihanku.SELISIH_AIR) as selisih')
        )
        ->where('tagihanku.BLN_TAGIHAN',$bln)
        ->groupBy('tagihanku.BLOK_TEMPAT')
        ->get();

        $data = DB::table('tagihanku')
        ->select('BLN_TAGIHAN')
        ->where('BLN_TAGIHAN',$bln)
        ->first();
        return view('manajer.print-rekap-pemakaian-air',['dataset'=>$dataset,'data'=>$data]);
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }

    public function printRincianAirManajer($bln){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "manajer"){
        $dataset = DB::table('tagihanku')
        ->leftJoin('tempat_usaha','tagihanku.ID_TEMPAT','=','tempat_usaha.ID_TEMPAT')
        ->leftJoin('nasabah','tagihanku.ID_NASABAH','=','nasabah.ID_NASABAH')
        ->where('tagihanku.BLN_TAGIHAN',$bln)
        ->get();

        $data = DB::table('tagihanku')
        ->select('BLN_TAGIHAN')
        ->where('BLN_TAGIHAN',$bln)
        ->first();
        return view('manajer.print-rincian-pemakaian-air',['dataset'=>$dataset,'data'=>$data]);
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }

    public function printRekapListrikManajer($bln){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "manajer"){
        $dataset = DB::table('tagihanku')
        ->select('tagihanku.BLOK_TEMPAT',
            DB::raw('SUM(tagihanku.DAYA_LISTRIK) as daya'),
            DB::raw('SUM(tagihanku.PAKAI_LISTRIK) as pakaiListrik'),
            DB::raw('SUM(tagihanku.B_BEBAN) as bBeban'),
            DB::raw('SUM(tagihanku.BPJU) as bpju'),
            DB::raw('SUM(tagihanku.TTL_LISTRIK + tagihanku.DENDA_LISTRIK) as tagihan'),
            DB::raw('SUM(tagihanku.REALISASI_LISTRIK) as realisasi'),
            DB::raw('SUM(tagihanku.SELISIH_LISTRIK) as selisih')
        )
        ->where('tagihanku.BLN_TAGIHAN',$bln)
        ->groupBy('tagihanku.BLOK_TEMPAT')
        ->get();

        $data = DB::table('tagihanku')
        ->select('BLN_TAGIHAN')
        ->where('BLN_TAGIHAN',$bln)
        ->first();

        return view('manajer.print-rekap-pemakaian-listrik',['dataset'=>$dataset,'data'=>$data]);
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }

    public function printRincianListrikManajer($bln){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "manajer"){
        $dataset = DB::table('tagihanku')
        ->leftJoin('tempat_usaha','tagihanku.ID_TEMPAT','=','tempat_usaha.ID_TEMPAT')
        ->leftJoin('nasabah','tagihanku.ID_NASABAH','=','nasabah.ID_NASABAH')
        ->where('tagihanku.BLN_TAGIHAN',$bln)
        ->get();

        $data = DB::table('tagihanku')
        ->select('BLN_TAGIHAN')
        ->where('BLN_TAGIHAN',$bln)
        ->first();
        return view('manajer.print-rincian-pemakaian-listrik',['dataset'=>$dataset,'data'=>$data]);
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }

    public function printRekapKebersihanManajer($bln){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "manajer"){
        $dataset = DB::table('tagihanku')
        ->leftJoin('tempat_usaha','tagihanku.ID_TEMPAT','=','tempat_usaha.ID_TEMPAT')
        ->select('tagihanku.BLOK_TEMPAT',
            DB::raw('SUM(tagihanku.TTL_KEBERSIHAN) as tagihan'),
            DB::raw('SUM(tempat_usaha.JML_ALAMAT) as alamat'),
            DB::raw('SUM(tagihanku.REALISASI_KEBERSIHAN) as realisasi'),
            DB::raw('SUM(tagihanku.SELISIH_KEBERSIHAN) as selisih')
        )
        ->where('tagihanku.BLN_TAGIHAN',$bln)
        ->groupBy('tagihanku.BLOK_TEMPAT')
        ->get();

        $data = DB::table('tagihanku')
        ->select('BLN_TAGIHAN')
        ->where('BLN_TAGIHAN',$bln)
        ->first();
        return view('manajer.print-rekap-pemakaian-kebersihan',['dataset'=>$dataset,'data'=>$data]);
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }

    public function printRincianKebersihanManajer($bln){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "manajer"){
        $dataset = DB::table('tagihanku')
        ->leftJoin('tempat_usaha','tagihanku.ID_TEMPAT','=','tempat_usaha.ID_TEMPAT')
        ->leftJoin('nasabah','tagihanku.ID_NASABAH','=','nasabah.ID_NASABAH')
        ->where('tagihanku.BLN_TAGIHAN',$bln)
        ->get();

        $data = DB::table('tagihanku')
        ->select('BLN_TAGIHAN')
        ->where('BLN_TAGIHAN',$bln)
        ->first();
        return view('manajer.print-rincian-pemakaian-kebersihan',['dataset'=>$dataset,'data'=>$data]);
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }

    public function printRekapKeamananManajer($bln){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "manajer"){
        $dataset = DB::table('tagihanku')
        ->leftJoin('tempat_usaha','tagihanku.ID_TEMPAT','=','tempat_usaha.ID_TEMPAT')
        ->select('tagihanku.BLOK_TEMPAT',
            DB::raw('SUM(tagihanku.TTL_IPKEAMANAN) as tagihan'),
            DB::raw('SUM(tempat_usaha.JML_ALAMAT) as alamat'),
            DB::raw('SUM(tagihanku.REALISASI_IPKEAMANAN) as realisasi'),
            DB::raw('SUM(tagihanku.SELISIH_IPKEAMANAN) as selisih')
        )
        ->where('tagihanku.BLN_TAGIHAN',$bln)
        ->groupBy('tagihanku.BLOK_TEMPAT')
        ->get();

        $data = DB::table('tagihanku')
        ->select('BLN_TAGIHAN')
        ->where('BLN_TAGIHAN',$bln)
        ->first();
        return view('manajer.print-rekap-pemakaian-keamanan',['dataset'=>$dataset,'data'=>$data]);
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }

    public function printRincianKeamananManajer($bln){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "manajer"){
        $dataset = DB::table('tagihanku')
        ->leftJoin('tempat_usaha','tagihanku.ID_TEMPAT','=','tempat_usaha.ID_TEMPAT')
        ->leftJoin('nasabah','tagihanku.ID_NASABAH','=','nasabah.ID_NASABAH')
        ->where('tagihanku.BLN_TAGIHAN',$bln)
        ->get();

        $data = DB::table('tagihanku')
        ->select('BLN_TAGIHAN')
        ->where('BLN_TAGIHAN',$bln)
        ->first();
        return view('manajer.print-rincian-pemakaian-keamanan',['dataset'=>$dataset,'data'=>$data]);
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }

    public function tempatUsahaManager(){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "manajer"){
        $blok = DB::table('tempat_usaha')
        ->select('BLOK',DB::raw('count(*) as ttl_Blok'))
        ->groupBy('BLOK')
        ->get();

        $ttlBlok = $blok->count();
        $Listrik = array();
        $Air = array();
        $Keamanan = array();
        $Kebersihan = array();
        $Blokku = array();

        for($i=0; $i<$ttlBlok; $i++){
            $bloks=$blok[$i];
            $blokku = DB::table('tempat_usaha')
                ->where('BLOK',$bloks->BLOK)
                ->count();
            $listrik = DB::table('tempat_usaha')
                ->where([['ID_TRFLISTRIK','!=', NULL],['BLOK',$bloks->BLOK]])
                ->count();
            $air = DB::table('tempat_usaha')
                ->where([['ID_TRFAIR','!=', NULL],['BLOK',$bloks->BLOK]])
                ->count();
            $keamanan = DB::table('tempat_usaha')
                    ->where([['ID_TRFKEAMANAN','!=', NULL],['BLOK',$bloks->BLOK]])
                    ->count();
            $kebersihan = DB::table('tempat_usaha')
                    ->where([['ID_TRFKEBERSIHAN','!=', NULL],['BLOK',$bloks->BLOK]])
                    ->count();
            $Listrik[$i] = $listrik;
            $Air[$i] = $air;
            $Keamanan[$i] = $keamanan;
            $Kebersihan[$i] = $kebersihan;
            $Blokku[$i] = $blokku;
        }

        return view('manajer.tempat-usaha',[
            'Listrik'=>$Listrik,'Air'=>$Air,'Keamanan'=>$Keamanan,'Kebersihan'=>$Kebersihan,'blok'=>$blok,
            'ttlBlok'=>$ttlBlok,'Blokku'=>$Blokku
        ]);
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }

    public function printTempatManajer(){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "manajer"){
        $blok = DB::table('tempat_usaha')
        ->select('BLOK',DB::raw('count(*) as ttl_Blok'))
        ->groupBy('BLOK')
        ->get();

        $ttlBlok = $blok->count();
        $Listrik = array();
        $Air = array();
        $Keamanan = array();
        $Kebersihan = array();
        $Blokku = array();

        for($i=0; $i<$ttlBlok; $i++){
            $bloks=$blok[$i];
            $blokku = DB::table('tempat_usaha')
                ->where('BLOK',$bloks->BLOK)
                ->count();
            $listrik = DB::table('tempat_usaha')
                ->where([['ID_TRFLISTRIK','!=', NULL],['BLOK',$bloks->BLOK]])
                ->count();
            $air = DB::table('tempat_usaha')
                ->where([['ID_TRFAIR','!=', NULL],['BLOK',$bloks->BLOK]])
                ->count();
            $keamanan = DB::table('tempat_usaha')
                    ->where([['ID_TRFKEAMANAN','!=', NULL],['BLOK',$bloks->BLOK]])
                    ->count();
            $kebersihan = DB::table('tempat_usaha')
                    ->where([['ID_TRFKEBERSIHAN','!=', NULL],['BLOK',$bloks->BLOK]])
                    ->count();
            $Listrik[$i] = $listrik;
            $Air[$i] = $air;
            $Keamanan[$i] = $keamanan;
            $Kebersihan[$i] = $kebersihan;
            $Blokku[$i] = $blokku;
        }

        return view('manajer.print-tempat',[
            'Listrik'=>$Listrik,'Air'=>$Air,'Keamanan'=>$Keamanan,'Kebersihan'=>$Kebersihan,'blok'=>$blok,
            'ttlBlok'=>$ttlBlok,'Blokku'=>$Blokku
        ]);
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }

    public function showTagihanManager(){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "manajer"){
        $dataset = DB::table('tempat_usaha')
        ->leftJoin('nasabah','tempat_usaha.ID_NASABAH','=','nasabah.ID_NASABAH')
        ->leftJoin('pemilik','tempat_usaha.ID_PEMILIK','=','pemilik.ID_PEMILIK')
        ->select('tempat_usaha.ID_TEMPAT','tempat_usaha.KD_KONTROL',
                 'nasabah.NO_ANGGOTA','nasabah.NM_NASABAH','nasabah.NO_KTP',
                 'nasabah.NO_NPWP','nasabah.ID_NASABAH','pemilik.NM_PEMILIK')
       ->get();
        return view('manajer.laporan-tagihan',['dataset'=>$dataset]);
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }

    public function rincianTunggakan(){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "manajer"){
        $dataset = DB::table('tagihanku')
        ->leftJoin('nasabah','tagihanku.ID_NASABAH','=','nasabah.ID_NASABAH')
        ->leftJoin('tempat_usaha','tagihanku.ID_TEMPAT','=','tempat_usaha.ID_TEMPAT')
        ->where('STT_LUNAS',0)
        ->get();

        return view('manajer.rincian-tunggakan',['dataset'=>$dataset]);
                }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }

    public function bongkaranManager(){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "manajer"){
        $dataset = DB::table('tagihanku')
        ->leftJoin('tempat_usaha','tagihanku.ID_TEMPAT','=','tempat_usaha.ID_TEMPAT')
        ->leftJoin('nasabah','tagihanku.ID_NASABAH','=','nasabah.ID_NASABAH')
        ->where([['STT_LUNAS',0],['STT_DENDA','>=',3]])
        ->get();

        return view('manajer.bongkaran',['dataset'=>$dataset]);
                }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }

    public function printBongkaranManajer(){
        $blok = DB::table('tempat_usaha')
        ->select('BLOK',DB::raw('count(*) as ttl_Blok'))
        ->groupBy('BLOK')
        ->get();

        $ttlBlok = $blok->count();
        $Bulan3 = array();
        $Bulan4 = array();
        $Blokku = array();

        for($i=0; $i<$ttlBlok; $i++){
            $bloks=$blok[$i];
            $blokku = DB::table('tempat_usaha')
                ->where('BLOK',$bloks->BLOK)
                ->count();
            $bulan3 = DB::table('tagihanku')
                ->where([['STT_DENDA',3],['BLOK_TEMPAT',$bloks->BLOK]])
                ->count();
            $bulan4 = DB::table('tagihanku')
                ->where([['STT_DENDA','>=', 4],['BLOK_TEMPAT',$bloks->BLOK]])
                ->count();
            $Bulan3[$i] = $bulan3;
            $Bulan4[$i] = $bulan4;
            $Blokku[$i] = $blokku;
        }

        return view('manajer.print-bongkaran',[
            'Bulan3'=>$Bulan3,'Bulan4'=>$Bulan4,'blok'=>$blok,
            'ttlBlok'=>$ttlBlok,'Blokku'=>$Blokku
        ]);
    }
}