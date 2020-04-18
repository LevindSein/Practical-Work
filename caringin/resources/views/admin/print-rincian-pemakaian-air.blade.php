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
      <h2 style="text-align:center;">RINCIAN PEMAKAIAN AIR<br>{{$bulan}}</h2>
      @for($i=0;$i<$ttlBlok;$i++)
      <h3>{{$blok[$i]->BLOK_TEMPAT}}</h3>

      <?php
      $pakaiku = 0;
      $airku = 0;
      $bebanku = 0;
      $pemeliharaanku = 0;
      $arkotku = 0;
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
            <th class="tg-r8fv">Kontrol</th>
            <th class="tg-r8fv">Pengguna</th>
            <th class="tg-r8fv">M.Lalu</th>
            <th class="tg-r8fv">M.Baru</th>
            <th class="tg-r8fv">Pakai</th>
            <th class="tg-r8fv">B.Pakai</th>
            <th class="tg-r8fv">B.Beban</th>
            <th class="tg-r8fv">B.Pemeliharaan</th>
            <th class="tg-r8fv">B.Air Kotor</th>
            <th class="tg-r8fv">Tagihan</th>
            <th class="tg-r8fv">Realisasi</th>
            <th class="tg-r8fv">Selisih</th>
          </tr>
          @for($j=0;$j<$blok[$i]->ttl_Blok;$j++)
          <tr>
            <td class="tg-cegc">{{$d[$j]->KD_KONTROL}}</td>
            <td class="tg-g25h" style="text-align:left;">{{$d[$j]->NM_NASABAH}}</td>
            <td class="tg-g25h">{{number_format($d[$j]->AWAL_AIR)}}</td>
            <td class="tg-g25h">{{number_format($d[$j]->AKHIR_AIR)}}</td>
            <td class="tg-g25h">{{number_format($d[$j]->PAKAI_AIR)}}</td>
            <td class="tg-g25h">{{number_format($d[$j]->BYR_AIR)}}</td>
            <td class="tg-g25h">{{number_format($d[$j]->BYR_BEBAN)}}</td>
            <td class="tg-g25h">{{number_format($d[$j]->BYR_PEMELIHARAAN)}}</td>
            <td class="tg-g25h">{{number_format($d[$j]->BYR_ARKOT)}}</td>
            <td class="tg-g25h">{{number_format($d[$j]->TTL_AIR + $d[$j]->DENDA_AIR)}}</td>
            <td class="tg-g25h">{{number_format($d[$j]->REALISASI_AIR)}}</td>
            <td class="tg-g25h">{{number_format($d[$j]->SELISIH_AIR)}}</td>
          </tr>

          <?php
              $pakaiku = $pakaiku + $d[$j]->PAKAI_AIR;
              $airku = $airku + $d[$j]->BYR_AIR;
              $bebanku = $bebanku + $d[$j]->BYR_BEBAN;
              $pemeliharaanku = $pemeliharaanku + $d[$j]->BYR_PEMELIHARAAN;
              $arkotku = $arkotku + $d[$j]->BYR_ARKOT;
              $tagihanku = $tagihanku + $d[$j]->TTL_AIR + $d[$j]->DENDA_AIR;
              $realisasiku = $realisasiku + $d[$j]->REALISASI_AIR;
              $selisihku = $selisihku + $d[$j]->SELISIH_AIR;
          ?>
          @endfor
          <tr>
            <td class="tg-vbo4" style="text-align:center;" colspan="4">Total</td>
            <td class="tg-8m6k">{{number_format($pakaiku)}}</td>
            <td class="tg-8m6k">{{number_format($airku)}}</td>
            <td class="tg-8m6k">{{number_format($bebanku)}}</td>
            <td class="tg-8m6k">{{number_format($pemeliharaanku)}}</td>
            <td class="tg-8m6k">{{number_format($arkotku)}}</td>
            <td class="tg-8m6k">{{number_format($tagihanku)}}</td>
            <td class="tg-8m6k">{{number_format($realisasiku)}}</td>
            <td class="tg-8m6k">{{number_format($selisihku)}}</td>
          </tr>
        </table>
    </main>
    @endfor
  </body>
</html>