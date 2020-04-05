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
      <h1>REKAP TUNGGAKAN</h1>
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
          <?php
            $nListrik = 0;
            $nAir = 0;
            $nKeamanan = 0;
            $nKebersihan = 0;
            $nRealisasi = 0;
            $mListrik = 0;
            $mAir = 0;
            $mKeamanan = 0;
            $mKebersihan = 0;
            $mSelisih = 0;
          ?>
          @foreach($dataset as $d)
          <tr>
            <td class="tg-cegc" <?php $bulan = date("M Y", strtotime($d->BLN_TAGIHAN));?>>{{$bulan}}</td>
            <td class="tg-g25h">{{number_format($d->Listrik + $nListrik)}}</td>
            <td class="tg-g25h">{{number_format($d->Air + $nAir)}}</td>
            <td class="tg-g25h">{{number_format($d->Keamanan + $nKeamanan)}}</td>
            <td class="tg-g25h">{{number_format($d->Kebersihan + $nKebersihan)}}</td>
            <td class="tg-g25h">{{number_format($d->selListrik + $mListrik)}}</td>
            <td class="tg-g25h">{{number_format($d->selAir + $mAir)}}</td>
            <td class="tg-g25h">{{number_format($d->selKeamanan + $mKeamanan)}}</td>
            <td class="tg-g25h">{{number_format($d->selKebersihan + $mKebersihan)}}</td>
            <td class="tg-g25h">{{number_format($d->Realisasi + $nRealisasi)}}</td>
            <td class="tg-g25h">{{number_format($d->Selisih + $mSelisih)}}</td>
          </tr>
          <?php
            $nListrik = $nListrik + $d->Listrik;
            $nAir = $nAir + $d->Air;
            $nKeamanan = $nKeamanan + $d->Keamanan;
            $nKebersihan = $nKebersihan + $d->Kebersihan;
            $nRealisasi = $nRealisasi + $d->Realisasi;
            $mListrik = $mListrik + $d->selListrik;
            $mAir = $mAir + $d->selAir;
            $mKeamanan = $mKeamanan + $d->selKeamanan;
            $mKebersihan = $mKebersihan + $d->selKebersihan;
            $mSelisih = $mSelisih + $d->Selisih;
          ?>
          @endforeach
        </table>
      <div id="notices">
        <div><b>CATATAN :</b></div>
        <div class="notice">Manager</div>
      </div>
    </main>
  </body>
</html>