<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tagihan;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Redirector;
use Exception;
use Carbon\Carbon;

class dashboardController extends Controller
{
    public function dashboard(){
        //Tempat Usaha
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

        $now = Carbon::now()->toDateString();
        $thn = date("Y", strtotime($now));
        //REALISASI

        $asalPendapatan = DB::table('tagihanku')
        ->select('THN_TAGIHAN as tahun',
            DB::raw('SUM(REALISASI_AIR) as air'),
            DB::raw('SUM(REALISASI_LISTRIK) as listrik'),
            DB::raw('SUM(REALISASI_IPKEAMANAN) as keamanan'),
            DB::raw('SUM(REALISASI_KEBERSIHAN) as kebersihan')
        )
        ->where('THN_TAGIHAN',$thn)
        ->groupBy('THN_TAGIHAN')
        ->get();

        //Pendapatan
        $jan = $thn."-01";
        $feb = $thn."-02";
        $mar = $thn."-03";
        $apr = $thn."-04";
        $mei = $thn."-05";
        $jun = $thn."-06";
        $jul = $thn."-07";
        $agu = $thn."-08";
        $sep = $thn."-09";
        $okt = $thn."-10";
        $nov = $thn."-11";
        $des = $thn."-12";

        //Jan
        $semua = $this->dapat($jan,$thn);
        $realisasiJan = $semua[0];
        $selisihJan = $semua[1];

        //Feb
        $semua = $this->dapat($feb,$thn);
        $realisasiFeb = $semua[0];
        $selisihFeb = $semua[1];

        //Mar
        $semua = $this->dapat($mar,$thn);
        $realisasiMar = $semua[0];
        $selisihMar = $semua[1];

        //Apr
        $semua = $this->dapat($apr,$thn);
        $realisasiApr = $semua[0];
        $selisihApr = $semua[1];

        //Mei
        $semua = $this->dapat($mei,$thn);
        $realisasiMei = $semua[0];
        $selisihMei = $semua[1];

        //Jun
        $semua = $this->dapat($jun,$thn);
        $realisasiJun = $semua[0];
        $selisihJun = $semua[1];

        //Jul
        $semua = $this->dapat($jul,$thn);
        $realisasiJul = $semua[0];
        $selisihJul = $semua[1];

        //Agu
        $semua = $this->dapat($agu,$thn);
        $realisasiAgu = $semua[0];
        $selisihAgu = $semua[1];

        //Sep
        $semua = $this->dapat($sep,$thn);
        $realisasiSep = $semua[0];
        $selisihSep = $semua[1];

        //Okt
        $semua = $this->dapat($okt,$thn);
        $realisasiOkt = $semua[0];
        $selisihOkt = $semua[1];

        //Nov
        $semua = $this->dapat($nov,$thn);
        $realisasiNov = $semua[0];
        $selisihNov = $semua[1];

        //Des
        $semua = $this->dapat($des,$thn);
        $realisasiDes = $semua[0];
        $selisihDes = $semua[1];

        return view('admin.dashboard',[
            'Listrik'=>$Listrik,'Air'=>$Air,
            'Keamanan'=>$Keamanan,'Kebersihan'=>$Kebersihan,
            'blok'=>$blok,'ttlBlok'=>$ttlBlok,
            'Blokku'=>$Blokku,'asalPendapatan'=>$asalPendapatan,
            'realisasiJan'=>$realisasiJan,'selisihJan'=>$selisihJan,
            'realisasiFeb'=>$realisasiFeb,'selisihFeb'=>$selisihFeb,
            'realisasiMar'=>$realisasiMar,'selisihMar'=>$selisihMar,
            'realisasiApr'=>$realisasiApr,'selisihApr'=>$selisihApr,
            'realisasiMei'=>$realisasiMei,'selisihMei'=>$selisihMei,
            'realisasiJun'=>$realisasiJun,'selisihJun'=>$selisihJun,
            'realisasiJul'=>$realisasiJul,'selisihJul'=>$selisihJul,
            'realisasiAgu'=>$realisasiAgu,'selisihAgu'=>$selisihAgu,
            'realisasiSep'=>$realisasiSep,'selisihSep'=>$selisihSep,
            'realisasiOkt'=>$realisasiOkt,'selisihOkt'=>$selisihOkt,
            'realisasiNov'=>$realisasiNov,'selisihNov'=>$selisihNov,
            'realisasiDes'=>$realisasiDes,'selisihDes'=>$selisihDes
        ]);
    }
    public function dashboardManager(){
        //Tempat Usaha
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

        $now = Carbon::now()->toDateString();
        $thn = date("Y", strtotime($now));
        //REALISASI

        $asalPendapatan = DB::table('tagihanku')
        ->select('THN_TAGIHAN as tahun',
            DB::raw('SUM(REALISASI_AIR) as air'),
            DB::raw('SUM(REALISASI_LISTRIK) as listrik'),
            DB::raw('SUM(REALISASI_IPKEAMANAN) as keamanan'),
            DB::raw('SUM(REALISASI_KEBERSIHAN) as kebersihan')
        )
        ->where('THN_TAGIHAN',$thn)
        ->groupBy('THN_TAGIHAN')
        ->get();

        //Pendapatan
        $jan = $thn."-01";
        $feb = $thn."-02";
        $mar = $thn."-03";
        $apr = $thn."-04";
        $mei = $thn."-05";
        $jun = $thn."-06";
        $jul = $thn."-07";
        $agu = $thn."-08";
        $sep = $thn."-09";
        $okt = $thn."-10";
        $nov = $thn."-11";
        $des = $thn."-12";

        //Jan
        $semua = $this->dapat($jan,$thn);
        $realisasiJan = $semua[0];
        $selisihJan = $semua[1];

        //Feb
        $semua = $this->dapat($feb,$thn);
        $realisasiFeb = $semua[0];
        $selisihFeb = $semua[1];

        //Mar
        $semua = $this->dapat($mar,$thn);
        $realisasiMar = $semua[0];
        $selisihMar = $semua[1];

        //Apr
        $semua = $this->dapat($apr,$thn);
        $realisasiApr = $semua[0];
        $selisihApr = $semua[1];

        //Mei
        $semua = $this->dapat($mei,$thn);
        $realisasiMei = $semua[0];
        $selisihMei = $semua[1];

        //Jun
        $semua = $this->dapat($jun,$thn);
        $realisasiJun = $semua[0];
        $selisihJun = $semua[1];

        //Jul
        $semua = $this->dapat($jul,$thn);
        $realisasiJul = $semua[0];
        $selisihJul = $semua[1];

        //Agu
        $semua = $this->dapat($agu,$thn);
        $realisasiAgu = $semua[0];
        $selisihAgu = $semua[1];

        //Sep
        $semua = $this->dapat($sep,$thn);
        $realisasiSep = $semua[0];
        $selisihSep = $semua[1];

        //Okt
        $semua = $this->dapat($okt,$thn);
        $realisasiOkt = $semua[0];
        $selisihOkt = $semua[1];

        //Nov
        $semua = $this->dapat($nov,$thn);
        $realisasiNov = $semua[0];
        $selisihNov = $semua[1];

        //Des
        $semua = $this->dapat($des,$thn);
        $realisasiDes = $semua[0];
        $selisihDes = $semua[1];

        return view('manajer.dashboard',[
            'Listrik'=>$Listrik,'Air'=>$Air,
            'Keamanan'=>$Keamanan,'Kebersihan'=>$Kebersihan,
            'blok'=>$blok,'ttlBlok'=>$ttlBlok,
            'Blokku'=>$Blokku,'asalPendapatan'=>$asalPendapatan,
            'realisasiJan'=>$realisasiJan,'selisihJan'=>$selisihJan,
            'realisasiFeb'=>$realisasiFeb,'selisihFeb'=>$selisihFeb,
            'realisasiMar'=>$realisasiMar,'selisihMar'=>$selisihMar,
            'realisasiApr'=>$realisasiApr,'selisihApr'=>$selisihApr,
            'realisasiMei'=>$realisasiMei,'selisihMei'=>$selisihMei,
            'realisasiJun'=>$realisasiJun,'selisihJun'=>$selisihJun,
            'realisasiJul'=>$realisasiJul,'selisihJul'=>$selisihJul,
            'realisasiAgu'=>$realisasiAgu,'selisihAgu'=>$selisihAgu,
            'realisasiSep'=>$realisasiSep,'selisihSep'=>$selisihSep,
            'realisasiOkt'=>$realisasiOkt,'selisihOkt'=>$selisihOkt,
            'realisasiNov'=>$realisasiNov,'selisihNov'=>$selisihNov,
            'realisasiDes'=>$realisasiDes,'selisihDes'=>$selisihDes
        ]);
    }

    public function dapat($bln,$thn){
        $dapat = DB::table('tagihanku')
        ->select('THN_TAGIHAN',
            DB::raw('SUM(REALISASI + DENDA) as realisasi'),
            DB::raw('SUM(SELISIH) as selisih')
        )
        ->where([
            ['BLN_TAGIHAN',$bln],
            ['THN_TAGIHAN',$thn]
        ])
        ->groupBy('THN_TAGIHAN')
        ->get();
        $realisasi = 0;
        $selisih = 0;
        foreach($dapat as $d){
            $realisasi = $d->realisasi;
            $selisihJan = $d->selisih;
        }
        $semua = array($realisasi,$selisih);
        return $semua;
    }
}
