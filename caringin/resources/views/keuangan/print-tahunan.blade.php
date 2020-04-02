<?php
$tahun = date("Y", strtotime($data->THN_TAGIHAN));
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>PT. PENGELOLA PUSAT PERDAGANGAN CARINGIN</title>
    <link rel="stylesheet" href="{{asset('css/style-tahunan.css')}}" media="all" />
  </head>
  
  <body onload="window.print()">
    <header class="clearfix">
      <h1>PENDAPATAN TAHUNAN</h1>
      <div id="company" class="clearfix">
        <div>PT. Pengelola Pusat Perdagangan Caringin</div>
        <div>Jl. Soekarno Hatta No. 220 Blok A1 No. 21-24<br /> Pasar Induk Caringin, Bandung</div>
        <div>(022) 540-4556</div>
      </div>
      <div id="project">
        <div><span>Tahun</span>: {{$tahun}}</div>
      </div>
    </header>
    <main>
      <table class="tg">
          <tr>
            <th class="tg-r8fv" rowspan="2">Bulan</th>
            <th class="tg-r8fv" rowspan="2">Total Tagihan</th>
            <th class="tg-r8fv" colspan="4">Realisasi</th>
            <th class="tg-r8fv" colspan="4">Selisih</th>
            <th class="tg-r8fv" colspan="2">Total</th>
          </tr>
          <tr>
            <th class="tg-r8fv">Listrik</th>
            <th class="tg-r8fv">Air Bersih</th>
            <th class="tg-r8fv">Keamanan</th>
            <th class="tg-r8fv">Kebersihan</th>
            <th class="tg-r8fv">Listrik</th>
            <th class="tg-r8fv">Air Bersih</th>
            <th class="tg-r8fv">Keamanan</th>
            <th class="tg-r8fv">Kebersihan</th>
            <th class="tg-r8fv">Realisasi</th>
            <th class="tg-r8fv">Selisih</th>
          </tr>
          @foreach($dataset as $d)
          <tr>
            <td class="tg-cegc" <?php $bulan = date("M Y", strtotime($d->BLN_TAGIHAN));?>>{{$bulan}}</td>
            <td class="tg-g25h">{{number_format($d->Total)}}</td>
            <td class="tg-g25h">{{number_format($d->Listrik)}}</td>
            <td class="tg-g25h">{{number_format($d->Air)}}</td>
            <td class="tg-g25h">{{number_format($d->Keamanan)}}</td>
            <td class="tg-g25h">{{number_format($d->Kebersihan)}}</td>
            <td class="tg-g25h">{{number_format($d->selListrik)}}</td>
            <td class="tg-g25h">{{number_format($d->selAir)}}</td>
            <td class="tg-g25h">{{number_format($d->selKeamanan)}}</td>
            <td class="tg-g25h">{{number_format($d->selKebersihan)}}</td>
            <td class="tg-g25h">{{number_format($d->Realisasi)}}</td>
            <td class="tg-g25h">{{number_format($d->Selisih)}}</td>
          </tr>
          @endforeach
        </table>
      <div id="notices">
        <div><b>CATATAN :</b></div>
        <div class="notice">Bag.Keuangan</div>
      </div>
    </main>
  </body>
</html>