<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tagihan;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Redirector;
use Exception;
use Carbon\Carbon;

class laporanController extends Controller
{
    public function showHarian(){
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
    public function filterHarian(Request $request){
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
    
    public function showBulanan(){
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
    public function filterBulanan(Request $request){
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

    public function showPemakaian(){
        return view('admin.pemakaian');
    }
    
    public function printRekapAir(){
        return view('admin.print-rekap-pemakaian-air');
    }

    public function printRincianAir(){
        return view('admin.print-rincian-pemakaian-air');
    }

    public function printRekapListrik(){
        return view('admin.print-rekap-pemakaian-listrik');
    }

    public function printRincianListrik(){
        return view('admin.print-rincian-pemakaian-listrik');
    }

    public function printRekapKebersihan(){
        return view('admin.print-rekap-pemakaian-kebersihan');
    }

    public function printRincianKebersihan(){
        return view('admin.print-rincian-pemakaian-kebersihan');
    }

    public function printRekapKeamanan(){
        return view('admin.print-rekap-pemakaian-keamanan');
    }

    public function printRincianKeamanan(){
        return view('admin.print-rincian-pemakaian-keamanan');
    }

    public function showTahunan(){
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
    public function showTagihan(){
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
    
    public function showTunggakan(){
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
            ->select('tarif_air.TRF_DENDA','tarif_listrik.VAR_DENDA','tarif_listrik.DENDA_LEBIH','tagihanku.TTL_LISTRIK','tagihanku.PAKAI_LISTRIK','tagihanku.DENDA')
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
                if($d['STT_DENDA'] == 0){
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
                if($d['STT_DENDA'] ==  0){
                    $total_denda = 2 * $total_denda;
                    DB::table('tagihanku')->where('ID_TAGIHANKU', $id_tagihan)->update([
                        'DENDA_AIR'=>$denda_air,
                        'DENDA_LISTRIK'=>$denda_listrik,
                        'DENDA'=>$total_denda,
                        'STT_DENDA'=>2
                    ]);
                }
                else if($d['STT_DENDA'] == 1){
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
                if($d['STT_DENDA'] ==  0){
                    $total_denda = 3 * $total_denda;
                    DB::table('tagihanku')->where('ID_TAGIHANKU', $id_tagihan)->update([
                        'DENDA_AIR'=>$denda_air,
                        'DENDA_LISTRIK'=>$denda_listrik,
                        'DENDA'=>$total_denda,
                        'STT_DENDA'=>3
                    ]);
                }
                else if($d['STT_DENDA'] == 2){
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
                DB::table('tagihanku')->where('ID_TAGIHANKU', $id_tagihan)->update([
                    'STT_DENDA'=>4
                ]);
            }
        }
    }catch(\Exception $e){
        return view('admin.laporan-tunggakan',['dataset'=>$dataset])->with('error','Kesalahan Sistem');
    }
        return view('admin.laporan-tunggakan',['dataset'=>$dataset]);
    }
    
    public function showBongkaran(){
        $dataset = DB::table('tagihanku')
        ->join('tempat_usaha','tagihanku.ID_TEMPAT','=','tempat_usaha.ID_TEMPAT')
        ->join('nasabah','tempat_usaha.ID_NASABAH','=','nasabah.ID_NASABAH')
        ->join('pemilik','tempat_usaha.ID_PEMILIK','=','pemilik.ID_PEMILIK')
        ->where([['STT_LUNAS',0],['STT_DENDA',4]])
        ->get();
        return view('admin.laporan-bongkaran',['dataset'=>$dataset]);
    }

    public function showPenghapusan(){
        $dataset = DB::table('penghapusan')
        ->join('tempat_usaha','penghapusan.ID_TEMPAT','=','tempat_usaha.ID_TEMPAT')
        ->get();
        return view('admin.laporan-penghapusan',['dataset'=>$dataset]);
    }

    //Kasir
    public function showTagihanKasir(){
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

    //Keuangan
    public function showPenerimaanHarian(){
        $dataset = DB::table('tagihanku')
            ->select('TGL_BAYAR','STT_BAYAR')
            ->groupBy('TGL_BAYAR','STT_BAYAR')
            ->get();
        return view('keuangan.penerimaan-harian',['dataset'=>$dataset]);
    }

    public function printHarianKeuangan($tgl){
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

    public function showPenerimaanBulanan(){
        $dataset = DB::table('tagihanku')
            ->select('BLN_BAYAR','STT_BAYAR')
            ->groupBy('BLN_BAYAR','STT_BAYAR')
            ->get();

        return view('keuangan.penerimaan-bulanan',['dataset'=>$dataset]);
    }

    public function printBulananKeuangan($bln){
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

    public function printRincianKeuangan($bln){
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

    public function printBulananNoKeuangan($bln){
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

    public function printRincianNoKeuangan($bln){
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

    public function showPendapatanTahunan(){
        $dataset = DB::table('tagihanku')
            ->select('THN_TAGIHAN')
            ->groupBy('THN_TAGIHAN')
            ->get();
        return view('keuangan.pendapatan-tahunan',['dataset'=>$dataset]);
    }

    public function printTahunanKeuangan($thn){
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

    //Manajer
    public function showHarianManager(){
        $dataset = DB::table('tagihanku')
        ->select('TGL_BAYAR','STT_BAYAR')
        ->groupBy('TGL_BAYAR','STT_BAYAR')
        ->get();
        return view('manajer.laporan-harian',['dataset'=>$dataset]);
    }
        
    public function showBulananManager(){
        $dataset = DB::table('tagihanku')
        ->select('BLN_BAYAR','STT_BAYAR')
        ->groupBy('BLN_BAYAR','STT_BAYAR')
        ->get();
        return view('manajer.laporan-bulanan',['dataset'=>$dataset]);
    }
    
    public function showTahunanManager(){
        $dataset = DB::table('tagihanku')
        ->select('THN_TAGIHAN')
        ->groupBy('THN_TAGIHAN')
        ->get();
        return view('manajer.laporan-tahunan',['dataset'=>$dataset]);
    }

    public function showPemakaianManager(){
        $dataset = DB::table('tagihanku')
        ->select('BLN_TAGIHAN')
        ->groupBy('BLN_TAGIHAN')
        ->get();
        return view('manajer.pemakaian',['dataset'=>$dataset]);
    }

    public function printHarianManajer($tgl){
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

    public function printTahunanManajer($thn){
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

    public function printRekapAirManajer($bln){
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

    public function printRincianAirManajer($bln){
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

    public function printRekapListrikManajer($bln){
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

    public function printRincianListrikManajer($bln){
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

    public function printRekapKebersihanManajer($bln){
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

    public function printRincianKebersihanManajer($bln){
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

    public function printRekapKeamananManajer($bln){
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

    public function printRincianKeamananManajer($bln){
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

    public function tempatUsahaManager(){
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

    public function showTagihanManager(){
        $dataset = DB::table('tempat_usaha')
        ->leftJoin('nasabah','tempat_usaha.ID_NASABAH','=','nasabah.ID_NASABAH')
        ->leftJoin('pemilik','tempat_usaha.ID_PEMILIK','=','pemilik.ID_PEMILIK')
        ->select('tempat_usaha.ID_TEMPAT','tempat_usaha.KD_KONTROL',
                 'nasabah.NO_ANGGOTA','nasabah.NM_NASABAH','nasabah.NO_KTP',
                 'nasabah.NO_NPWP','nasabah.ID_NASABAH','pemilik.NM_PEMILIK')
       ->get();
        return view('manajer.laporan-tagihan',['dataset'=>$dataset]);
    }
}