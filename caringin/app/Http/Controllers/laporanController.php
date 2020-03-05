<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tagihan;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Redirector;

class laporanController extends Controller
{
    public function showHarian(){
        $dataset = DB::table('tagihanku')
        ->join('tempat_usaha','tagihanku.ID_TEMPAT','=','tempat_usaha.ID_TEMPAT')
        ->join('nasabah','tempat_usaha.ID_NASABAH','=','nasabah.ID_NASABAH')
        ->where('STT_BAYAR',1)
        ->get();

        return view('admin.laporan-harian',['dataset'=>$dataset]);
    }
    public function filterHarian(Request $request){
        $from = $request->get('dari');
        $to = $request->get('sampai');
        $dataset = DB::table('tagihanku')
        ->join('tempat_usaha','tagihanku.ID_TEMPAT','=','tempat_usaha.ID_TEMPAT')
        ->join('nasabah','tempat_usaha.ID_NASABAH','=','nasabah.ID_NASABAH')
        ->whereBetween('TGL_TAGIHAN',[$from,$to])
        ->where('STT_BAYAR',1)
        ->get();

        return view('admin.laporan-harian',['dataset'=>$dataset]);
    }
    
    public function showBulanan(){
        $dataset = DB::table('tagihanku')
        ->join('tempat_usaha','tagihanku.ID_TEMPAT','=','tempat_usaha.ID_TEMPAT')
        ->join('nasabah','tempat_usaha.ID_NASABAH','=','nasabah.ID_NASABAH')
        ->get();
        return view('admin.laporan-bulanan',['dataset'=>$dataset]);
    }
    public function filterBulanan(Request $request){
        $filter = $request->get('filterbln');

        $dataset = DB::table('tagihanku')
        ->join('tempat_usaha','tagihanku.ID_TEMPAT','=','tempat_usaha.ID_TEMPAT')
        ->join('nasabah','tempat_usaha.ID_NASABAH','=','nasabah.ID_NASABAH')
        ->where('BLN_TAGIHAN',$filter)
        ->get();
        return view('admin.laporan-bulanan',['dataset'=>$dataset]);
    }

    public function showTahunan(){
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
            DB::raw('SUM(SELISIH_AIR) as selisihAir'),)
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
            DB::raw('SUM(SELISIH_LISTRIK) as selisihListrik'))
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

        return view('admin.laporan-tahunan',['dataA'=>$dataA,'dataL'=>$dataL,'dataK'=>$dataK,'dataB'=>$dataB]);
    }
    public function showTagihan(){
        $dataset = DB::table('tempat_usaha')
        ->leftJoin('nasabah','tempat_usaha.ID_NASABAH','=','nasabah.ID_NASABAH')
        ->select('tempat_usaha.ID_TEMPAT','tempat_usaha.KD_KONTROL', 'nasabah.NM_NASABAH','nasabah.NO_KTP','nasabah.NO_NPWP','nasabah.ID_NASABAH')
        ->get();
        return view('admin.laporan-tagihan',['dataset'=>$dataset]);
    }
    public function showTunggakan(){
        return view('admin.laporan-tunggakan');
    }
    public function showBongkaran(){
        return view('admin.laporan-bongkaran');
    }
    public function showPenghapusan(){
        return view('admin.laporan-penghapusan');
    }
}
