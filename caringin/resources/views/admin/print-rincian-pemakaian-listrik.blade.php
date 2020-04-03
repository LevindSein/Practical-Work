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
      <h2 style="text-align:center;">RINCIAN PEMAKAIAN LISTRIK<br>{{$bulan}}</h2>
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
          @foreach($dataset as $d)
          <tr>
            <td class="tg-cegc">{{$d->KD_KONTROL}}</td>
            <td class="tg-g25h" style="text-align:left;">{{$d->NM_NASABAH}}</td>
            <td class="tg-g25h">{{number_format($d->DAYA_LISTRIK)}}</td>
            <td class="tg-g25h">{{number_format($d->AWAL_LISTRIK)}}</td>
            <td class="tg-g25h">{{number_format($d->AKHIR_LISTRIK)}}</td>
            <td class="tg-g25h">{{number_format($d->PAKAI_LISTRIK)}}</td>
            <td class="tg-g25h">{{number_format($d->REK_MIN)}}</td>
            <td class="tg-g25h">{{number_format($d->B_BLOK1)}}</td>
            <td class="tg-g25h">{{number_format($d->B_BLOK2)}}</td>
            <td class="tg-g25h">{{number_format($d->B_BEBAN)}}</td>
            <td class="tg-g25h">{{number_format($d->BPJU)}}</td>
            <td class="tg-g25h">{{number_format($d->TTL_LISTRIK + $d->DENDA_LISTRIK)}}</td>
            <td class="tg-g25h">{{number_format($d->REALISASI_LISTRIK)}}</td>
            <td class="tg-g25h">{{number_format($d->SELISIH_LISTRIK)}}</td>
          </tr>
          @endforeach
        </table>
    </main>
  </body>
</html>