<?php
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
      <h2 style="text-align:center;">RINCIAN PEMAKAIAN KEBERSIHAN<br>{{$bulan}}</h2>
    <main>
      <table class="tg">
          <tr>
            <th class="tg-r8fv">Kode Kontrol</th>
            <th class="tg-r8fv">Pengguna</th>
            <th class="tg-r8fv">Jumlah Los</th>
            <th class="tg-r8fv">Tagihan</th>
            <th class="tg-r8fv">Realisasi</th>
            <th class="tg-r8fv">Selisih</th>
          </tr>
          @foreach($dataset as $d)
          <tr>
            <td class="tg-cegc">{{$d->KD_KONTROL}}</td>
            <td class="tg-g25h" style="text-align:left;">{{$d->NM_NASABAH}}</td>
            <td class="tg-g25h">{{number_format($d->JML_ALAMAT)}}</td>
            <td class="tg-g25h">{{number_format($d->TTL_KEBERSIHAN)}}</td>
            <td class="tg-g25h">{{number_format($d->REALISASI_KEBERSIHAN)}}</td>
            <td class="tg-g25h">{{number_format($d->SELISIH_KEBERSIHAN)}}</td>
          </tr>
          @endforeach
        </table>
    </main>
  </body>
</html>