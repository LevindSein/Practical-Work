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
    <link rel="stylesheet" href="{{asset('css/style-bulanan.css')}}" media="all" />
  </head>
  
  <body onload="window.print()">
      <h2 style="text-align:center;">RINCIAN PEMAKAIAN KEAMANAN<br>{{$bulan}}</h2>
      @for($i=0;$i<$ttlBlok;$i++)
      <h3>{{$blok[$i]->BLOK_TEMPAT}}</h3>

      <?php
      $alamatku = 0;
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
            <th class="tg-r8fv">Kode Kontrol</th>
            <th class="tg-r8fv">Pengguna</th>
            <th class="tg-r8fv">Jum Los</th>
            <th class="tg-r8fv">Tagihan</th>
            <th class="tg-r8fv">Realisasi</th>
            <th class="tg-r8fv">Selisih</th>
          </tr>
          @for($j=0;$j<$blok[$i]->ttl_Blok;$j++)
          <tr>
            <td class="tg-cegc">{{$d[$j]->KD_KONTROL}}</td>
            <td class="tg-g25h" style="text-align:left;">{{$d[$j]->NM_NASABAH}}</td>
            <td class="tg-g25h">{{number_format($d[$j]->JML_ALAMAT)}}</td>
            <td class="tg-g25h">{{number_format($d[$j]->TTL_IPKEAMANAN)}}</td>
            <td class="tg-g25h">{{number_format($d[$j]->REALISASI_IPKEAMANAN)}}</td>
            <td class="tg-g25h">{{number_format($d[$j]->SELISIH_IPKEAMANAN)}}</td>
          </tr>

          <?php
          $alamatku = $alamatku + $d[$j]->JML_ALAMAT;
          $tagihanku = $tagihanku + $d[$j]->TTL_IPKEAMANAN;
          $realisasiku = $realisasiku + $d[$j]->REALISASI_IPKEAMANAN;
          $selisihku = $selisihku + $d[$j]->SELISIH_IPKEAMANAN;
          ?>
          @endfor
          <tr>
            <td class="tg-vbo4" style="text-align:center;" colspan="2">Total</td>
            <td class="tg-8m6k">{{number_format($alamatku)}}</td>
            <td class="tg-8m6k">{{number_format($tagihanku)}}</td>
            <td class="tg-8m6k">{{number_format($realisasiku)}}</td>
            <td class="tg-8m6k">{{number_format($selisihku)}}</td>
          </tr>
        </table>
    </main>
    @endfor
  </body>
</html>