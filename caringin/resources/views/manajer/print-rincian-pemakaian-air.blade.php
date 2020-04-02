<?php
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
    <main>
      <table class="tg">
          <tr>
            <th class="tg-r8fv">Kode Kontrol</th>
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
          @foreach($dataset as $d)
          <tr>
            <td class="tg-cegc">{{$d->KD_KONTROL}}</td>
            <td class="tg-g25h" style="text-align:left;">{{$d->NM_NASABAH}}</td>
            <td class="tg-g25h">{{number_format($d->AWAL_AIR)}}</td>
            <td class="tg-g25h">{{number_format($d->AKHIR_AIR)}}</td>
            <td class="tg-g25h">{{number_format($d->PAKAI_AIR)}}</td>
            <td class="tg-g25h">{{number_format($d->BYR_AIR)}}</td>
            <td class="tg-g25h">{{number_format($d->BYR_BEBAN)}}</td>
            <td class="tg-g25h">{{number_format($d->BYR_PEMELIHARAAN)}}</td>
            <td class="tg-g25h">{{number_format($d->BYR_ARKOT)}}</td>
            <td class="tg-g25h">{{number_format($d->TTL_AIR + $d->DENDA_AIR)}}</td>
            <td class="tg-g25h">{{number_format($d->REALISASI_AIR)}}</td>
            <td class="tg-g25h">{{number_format($d->SELISIH_AIR)}}</td>
          </tr>
          @endforeach
        </table>
    </main>
  </body>
</html>