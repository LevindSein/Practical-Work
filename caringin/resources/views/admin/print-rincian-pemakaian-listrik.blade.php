<?php
use Illuminate\Http\Request;
use App\Tempat_usaha;
use App\Nasabah;
use App\Tagihan;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Redirector;

$bulan = date("M Y", strtotime($data->BLN_TAGIHAN));
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>PT. PENGELOLA PUSAT PERDAGANGAN CARINGIN</title>
    <link rel="stylesheet" href="{{asset('css/style-pemakaian.css')}}" media="all" />
  </head>
  
  <body onload="window.print()">
      <h2 style="text-align:center;">RINCIAN PEMAKAIAN LISTRIK<br>{{$bulan}}</h2>
      @for($i=0;$i<$ttlBlok;$i++)
      <h3>{{$blok[$i]->BLOK_TEMPAT}}</h3>

      <?php
      $dayaku = 0;
      $pakaiku = 0;
      $bebanku = 0;
      $bpjuku = 0;
      $tagihanku = 0;
      $realisasiku = 0;
      $selisihku = 0;

      $d = DB::table('tagihanku')
      ->leftJoin('tempat_usaha','tagihanku.ID_TEMPAT','=','tempat_usaha.ID_TEMPAT')
      ->leftJoin('nasabah','tagihanku.ID_NASABAH','=','nasabah.ID_NASABAH')
      ->where([
          ['tagihanku.BLN_TAGIHAN',$bln],
          ['tagihanku.BLOK_TEMPAT',$blok[$i]->BLOK_TEMPAT]
        ])
      ->get();
      ?>
    <main>
      <table class="tg">
          <tr>
            <th class="tg-r8fv">Kode</th>
            <th class="tg-r8fv">Pengguna</th>
            <th class="tg-r8fv">Daya</th>
            <th class="tg-r8fv">M.Lalu</th>
            <th class="tg-r8fv">M.Baru</th>
            <th class="tg-r8fv">Pakai</th>
            <th class="tg-r8fv">Rek.Min</th>
            <th class="tg-r8fv">B.Blok1</th>
            <th class="tg-r8fv">B.Blok2</th>
            <th class="tg-r8fv">B.Beban</th>
            <th class="tg-r8fv">BPJU</th>
            <th class="tg-r8fv">Tagihan</th>
            <th class="tg-r8fv">Realisasi</th>
            <th class="tg-r8fv">Selisih</th>
          </tr>
          @for($j=0;$j<$blok[$i]->ttl_Blok;$j++)
          <tr>
            <td class="tg-cegc">{{$d[$j]->KD_KONTROL}}</td>
            <td class="tg-g25h" style="text-align:left;">{{$d[$j]->NM_NASABAH}}</td>
            <td class="tg-g25h">{{number_format($d[$j]->DAYA_LISTRIK)}}</td>
            <td class="tg-g25h">{{number_format($d[$j]->AWAL_LISTRIK)}}</td>
            <td class="tg-g25h">{{number_format($d[$j]->AKHIR_LISTRIK)}}</td>
            <td class="tg-g25h">{{number_format($d[$j]->PAKAI_LISTRIK)}}</td>
            <td class="tg-g25h">{{number_format($d[$j]->REK_MIN)}}</td>
            <td class="tg-g25h">{{number_format($d[$j]->B_BLOK1)}}</td>
            <td class="tg-g25h">{{number_format($d[$j]->B_BLOK2)}}</td>
            <td class="tg-g25h">{{number_format($d[$j]->B_BEBAN)}}</td>
            <td class="tg-g25h">{{number_format($d[$j]->BPJU)}}</td>
            <td class="tg-g25h">{{number_format($d[$j]->TTL_LISTRIK + $d[$j]->DENDA_LISTRIK)}}</td>
            <td class="tg-g25h">{{number_format($d[$j]->REALISASI_LISTRIK)}}</td>
            <td class="tg-g25h">{{number_format($d[$j]->SELISIH_LISTRIK)}}</td>
          </tr>

          <?php
           $dayaku = $dayaku + $d[$j]->DAYA_LISTRIK;
           $pakaiku = $pakaiku + $d[$j]->PAKAI_LISTRIK;
           $bebanku = $bebanku + $d[$j]->B_BEBAN;
           $bpjuku = $bpjuku + $d[$j]->BPJU;
           $tagihanku = $tagihanku + $d[$j]->TTL_LISTRIK + $d[$j]->DENDA_LISTRIK;
           $realisasiku = $realisasiku + $d[$j]->REALISASI_LISTRIK;
           $selisihku = $selisihku + $d[$j]->SELISIH_LISTRIK;
          ?>
          @endfor
          <tr>
            <td class="tg-vbo4" style="text-align:center;" colspan="2">Total</td>
            <td class="tg-8m6k">{{number_format($dayaku)}}</td>
            <td class="tg-8m6k" colspan="2"></td>
            <td class="tg-8m6k">{{number_format($pakaiku)}}</td>
            <td class="tg-8m6k" colspan="3"></td>
            <td class="tg-8m6k">{{number_format($bebanku)}}</td>
            <td class="tg-8m6k">{{number_format($bpjuku)}}</td>
            <td class="tg-8m6k">{{number_format($tagihanku)}}</td>
            <td class="tg-8m6k">{{number_format($realisasiku)}}</td>
            <td class="tg-8m6k">{{number_format($selisihku)}}</td>
          </tr>
        </table>
    </main>
    @endfor
  </body>
</html>