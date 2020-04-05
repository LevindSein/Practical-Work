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
            DB::raw('SUM(REALISASI_KEBERSIHAN) as kebersihan'),
            DB::raw('SUM(SELISIH_AIR) as selair'),
            DB::raw('SUM(SELISIH_LISTRIK) as sellistrik'),
            DB::raw('SUM(SELISIH_IPKEAMANAN) as selkeamanan'),
            DB::raw('SUM(SELISIH_KEBERSIHAN) as selkebersihan')
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

        $reaAkum = array();

        //Jan
        $semua = $this->dapat($jan,$thn);
        $realisasiJan = $semua[0];
        $selisihJan = $semua[1];
        $tagihanJan = $semua[2];
        $reaAkum[0] = $realisasiJan;
        $selAkum[0] = $selisihJan;

        //Feb
        $semua = $this->dapat($feb,$thn);
        $realisasiFeb = $semua[0];
        $selisihFeb = $semua[1];
        $tagihanFeb = $semua[2];
        $reaAkum[1] = $realisasiFeb + $reaAkum[0];
        $selAkum[1] = $selisihFeb + $selAkum[0];

        //Mar
        $semua = $this->dapat($mar,$thn);
        $realisasiMar = $semua[0];
        $selisihMar = $semua[1];
        $tagihanMar = $semua[2];
        $reaAkum[2] = $realisasiMar + $reaAkum[1];
        $selAkum[2] = $selisihMar + $selAkum[1];

        //Apr
        $semua = $this->dapat($apr,$thn);
        $realisasiApr = $semua[0];
        $selisihApr = $semua[1];
        $tagihanApr = $semua[2];
        $reaAkum[3] = $realisasiApr + $reaAkum[2];
        $selAkum[3] = $selisihApr + $selAkum[2];

        //Mei
        $semua = $this->dapat($mei,$thn);
        $realisasiMei = $semua[0];
        $selisihMei = $semua[1];
        $tagihanMei = $semua[2];
        $reaAkum[4] = $realisasiMei + $reaAkum[3];
        $selAkum[4] = $selisihMei + $selAkum[3];

        //Jun
        $semua = $this->dapat($jun,$thn);
        $realisasiJun = $semua[0];
        $selisihJun = $semua[1];
        $tagihanJun = $semua[2];
        $reaAkum[5] = $realisasiJun + $reaAkum[4];
        $selAkum[5] = $selisihJun + $selAkum[4];

        //Jul
        $semua = $this->dapat($jul,$thn);
        $realisasiJul = $semua[0];
        $selisihJul = $semua[1];
        $tagihanJul = $semua[2];
        $reaAkum[6] = $realisasiJul + $reaAkum[5];
        $selAkum[6] = $selisihJul + $selAkum[5];

        //Agu
        $semua = $this->dapat($agu,$thn);
        $realisasiAgu = $semua[0];
        $selisihAgu = $semua[1];
        $tagihanAgu = $semua[2];
        $reaAkum[7] = $realisasiAgu + $reaAkum[6];
        $selAkum[7] = $selisihAgu + $selAkum[6];

        //Sep
        $semua = $this->dapat($sep,$thn);
        $realisasiSep = $semua[0];
        $selisihSep = $semua[1];
        $tagihanSep = $semua[2];
        $reaAkum[8] = $realisasiSep + $reaAkum[7];
        $selAkum[8] = $selisihSep + $selAkum[7];

        //Okt
        $semua = $this->dapat($okt,$thn);
        $realisasiOkt = $semua[0];
        $selisihOkt = $semua[1];
        $tagihanOkt = $semua[2];
        $reaAkum[9] = $realisasiOkt + $reaAkum[8];
        $selAkum[9] = $selisihOkt + $selAkum[8];

        //Nov
        $semua = $this->dapat($nov,$thn);
        $realisasiNov = $semua[0];
        $selisihNov = $semua[1];
        $tagihanNov = $semua[2];
        $reaAkum[10] = $realisasiNov + $reaAkum[9];
        $selAkum[10] = $selisihNov + $selAkum[9];

        //Des
        $semua = $this->dapat($des,$thn);
        $realisasiDes = $semua[0];
        $selisihDes = $semua[1];
        $tagihanDes = $semua[2];
        $reaAkum[11] = $realisasiDes + $reaAkum[10];
        $selAkum[11] = $selisihDes + $selAkum[10];

        return view('manajer.dashboard',[
            'reaAkum'=>$reaAkum,'selAkum'=>$selAkum,
            'Listrik'=>$Listrik,'Air'=>$Air,
            'Keamanan'=>$Keamanan,'Kebersihan'=>$Kebersihan,
            'blok'=>$blok,'ttlBlok'=>$ttlBlok,
            'Blokku'=>$Blokku,'asalPendapatan'=>$asalPendapatan,
            'realisasiJan'=>$realisasiJan,'selisihJan'=>$selisihJan,'tagihanJan'=>$tagihanJan,
            'realisasiFeb'=>$realisasiFeb,'selisihFeb'=>$selisihFeb,'tagihanFeb'=>$tagihanFeb,
            'realisasiMar'=>$realisasiMar,'selisihMar'=>$selisihMar,'tagihanMar'=>$tagihanMar,
            'realisasiApr'=>$realisasiApr,'selisihApr'=>$selisihApr,'tagihanApr'=>$tagihanApr,
            'realisasiMei'=>$realisasiMei,'selisihMei'=>$selisihMei,'tagihanMei'=>$tagihanMei,
            'realisasiJun'=>$realisasiJun,'selisihJun'=>$selisihJun,'tagihanJun'=>$tagihanJun,
            'realisasiJul'=>$realisasiJul,'selisihJul'=>$selisihJul,'tagihanJul'=>$tagihanJul,
            'realisasiAgu'=>$realisasiAgu,'selisihAgu'=>$selisihAgu,'tagihanAgu'=>$tagihanAgu,
            'realisasiSep'=>$realisasiSep,'selisihSep'=>$selisihSep,'tagihanSep'=>$tagihanSep,
            'realisasiOkt'=>$realisasiOkt,'selisihOkt'=>$selisihOkt,'tagihanOkt'=>$tagihanOkt,
            'realisasiNov'=>$realisasiNov,'selisihNov'=>$selisihNov,'tagihanNov'=>$tagihanNov,
            'realisasiDes'=>$realisasiDes,'selisihDes'=>$selisihDes,'tagihanDes'=>$tagihanDes
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
            DB::raw('SUM(REALISASI_KEBERSIHAN) as kebersihan'),
            DB::raw('SUM(SELISIH_AIR) as selair'),
            DB::raw('SUM(SELISIH_LISTRIK) as sellistrik'),
            DB::raw('SUM(SELISIH_IPKEAMANAN) as selkeamanan'),
            DB::raw('SUM(SELISIH_KEBERSIHAN) as selkebersihan')
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

        $reaAkum = array();

        //Jan
        $semua = $this->dapat($jan,$thn);
        $realisasiJan = $semua[0];
        $selisihJan = $semua[1];
        $tagihanJan = $semua[2];
        $reaAkum[0] = $realisasiJan;
        $selAkum[0] = $selisihJan;

        //Feb
        $semua = $this->dapat($feb,$thn);
        $realisasiFeb = $semua[0];
        $selisihFeb = $semua[1];
        $tagihanFeb = $semua[2];
        $reaAkum[1] = $realisasiFeb + $reaAkum[0];
        $selAkum[1] = $selisihFeb + $selAkum[0];

        //Mar
        $semua = $this->dapat($mar,$thn);
        $realisasiMar = $semua[0];
        $selisihMar = $semua[1];
        $tagihanMar = $semua[2];
        $reaAkum[2] = $realisasiMar + $reaAkum[1];
        $selAkum[2] = $selisihMar + $selAkum[1];

        //Apr
        $semua = $this->dapat($apr,$thn);
        $realisasiApr = $semua[0];
        $selisihApr = $semua[1];
        $tagihanApr = $semua[2];
        $reaAkum[3] = $realisasiApr + $reaAkum[2];
        $selAkum[3] = $selisihApr + $selAkum[2];

        //Mei
        $semua = $this->dapat($mei,$thn);
        $realisasiMei = $semua[0];
        $selisihMei = $semua[1];
        $tagihanMei = $semua[2];
        $reaAkum[4] = $realisasiMei + $reaAkum[3];
        $selAkum[4] = $selisihMei + $selAkum[3];

        //Jun
        $semua = $this->dapat($jun,$thn);
        $realisasiJun = $semua[0];
        $selisihJun = $semua[1];
        $tagihanJun = $semua[2];
        $reaAkum[5] = $realisasiJun + $reaAkum[4];
        $selAkum[5] = $selisihJun + $selAkum[4];

        //Jul
        $semua = $this->dapat($jul,$thn);
        $realisasiJul = $semua[0];
        $selisihJul = $semua[1];
        $tagihanJul = $semua[2];
        $reaAkum[6] = $realisasiJul + $reaAkum[5];
        $selAkum[6] = $selisihJul + $selAkum[5];

        //Agu
        $semua = $this->dapat($agu,$thn);
        $realisasiAgu = $semua[0];
        $selisihAgu = $semua[1];
        $tagihanAgu = $semua[2];
        $reaAkum[7] = $realisasiAgu + $reaAkum[6];
        $selAkum[7] = $selisihAgu + $selAkum[6];

        //Sep
        $semua = $this->dapat($sep,$thn);
        $realisasiSep = $semua[0];
        $selisihSep = $semua[1];
        $tagihanSep = $semua[2];
        $reaAkum[8] = $realisasiSep + $reaAkum[7];
        $selAkum[8] = $selisihSep + $selAkum[7];

        //Okt
        $semua = $this->dapat($okt,$thn);
        $realisasiOkt = $semua[0];
        $selisihOkt = $semua[1];
        $tagihanOkt = $semua[2];
        $reaAkum[9] = $realisasiOkt + $reaAkum[8];
        $selAkum[9] = $selisihOkt + $selAkum[8];

        //Nov
        $semua = $this->dapat($nov,$thn);
        $realisasiNov = $semua[0];
        $selisihNov = $semua[1];
        $tagihanNov = $semua[2];
        $reaAkum[10] = $realisasiNov + $reaAkum[9];
        $selAkum[10] = $selisihNov + $selAkum[9];

        //Des
        $semua = $this->dapat($des,$thn);
        $realisasiDes = $semua[0];
        $selisihDes = $semua[1];
        $tagihanDes = $semua[2];
        $reaAkum[11] = $realisasiDes + $reaAkum[10];
        $selAkum[11] = $selisihDes + $selAkum[10];

        return view('manajer.dashboard',[
            'reaAkum'=>$reaAkum,'selAkum'=>$selAkum,
            'Listrik'=>$Listrik,'Air'=>$Air,
            'Keamanan'=>$Keamanan,'Kebersihan'=>$Kebersihan,
            'blok'=>$blok,'ttlBlok'=>$ttlBlok,
            'Blokku'=>$Blokku,'asalPendapatan'=>$asalPendapatan,
            'realisasiJan'=>$realisasiJan,'selisihJan'=>$selisihJan,'tagihanJan'=>$tagihanJan,
            'realisasiFeb'=>$realisasiFeb,'selisihFeb'=>$selisihFeb,'tagihanFeb'=>$tagihanFeb,
            'realisasiMar'=>$realisasiMar,'selisihMar'=>$selisihMar,'tagihanMar'=>$tagihanMar,
            'realisasiApr'=>$realisasiApr,'selisihApr'=>$selisihApr,'tagihanApr'=>$tagihanApr,
            'realisasiMei'=>$realisasiMei,'selisihMei'=>$selisihMei,'tagihanMei'=>$tagihanMei,
            'realisasiJun'=>$realisasiJun,'selisihJun'=>$selisihJun,'tagihanJun'=>$tagihanJun,
            'realisasiJul'=>$realisasiJul,'selisihJul'=>$selisihJul,'tagihanJul'=>$tagihanJul,
            'realisasiAgu'=>$realisasiAgu,'selisihAgu'=>$selisihAgu,'tagihanAgu'=>$tagihanAgu,
            'realisasiSep'=>$realisasiSep,'selisihSep'=>$selisihSep,'tagihanSep'=>$tagihanSep,
            'realisasiOkt'=>$realisasiOkt,'selisihOkt'=>$selisihOkt,'tagihanOkt'=>$tagihanOkt,
            'realisasiNov'=>$realisasiNov,'selisihNov'=>$selisihNov,'tagihanNov'=>$tagihanNov,
            'realisasiDes'=>$realisasiDes,'selisihDes'=>$selisihDes,'tagihanDes'=>$tagihanDes
        ]);
    }

    public function dapat($bln,$thn){
        $dapat = DB::table('tagihanku')
        ->select('THN_TAGIHAN',
            DB::raw('SUM(TTL_TAGIHAN + DENDA) as tagihan'),
            DB::raw('SUM(REALISASI + DENDA) as realisasi'),
            DB::raw('SUM(SELISIH) as selisih')
        )
        ->where([
            ['BLN_TAGIHAN',$bln],
            ['THN_TAGIHAN',$thn]
        ])
        ->groupBy('THN_TAGIHAN')
        ->get();
        $tagihan = 0;
        $realisasi = 0;
        $selisih = 0;
        foreach($dapat as $d){
            $realisasi = $d->realisasi;
            $selisih = $d->selisih;
            $tagihan = $d->tagihan;
        }
        $semua = array($realisasi,$selisih,$tagihan);
        
        return $semua;
    }
}
