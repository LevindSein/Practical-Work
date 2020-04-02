<?php
$bulan = date("M Y", strtotime($data->BLN_BAYAR));
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>PT. PENGELOLA PUSAT PERDAGANGAN CARINGIN</title>
    <link rel="stylesheet" href="{{asset('css/style-bulanan.css')}}" media="all" />
  </head>
  
  <body onload="window.print()">
    <header class="clearfix">
      <h1>PENDAPATAN BULANAN</h1>
      <div id="company" class="clearfix">
        <div>PT. Pengelola Pusat Perdagangan Caringin</div>
        <div>Jl. Soekarno Hatta No. 220 Blok A1 No. 21-24<br /> Pasar Induk Caringin, Bandung</div>
        <div>(022) 540-4556</div>
      </div>
      <div id="project">
        <div><span>Bulan Penerimaan</span>: {{$bulan}}</div>
      </div>
    </header>
    <main>
      <table class="tg">
          <tr>
            <th class="tg-r8fv">Fasilitas</th>
            <th class="tg-r8fv">Penerimaan</th>
            <th class="tg-r8fv">Dana Titipan</th>
            <th class="tg-r8fv">Jasa</th>
            <th class="tg-r8fv">PPN</th>
          </tr>
          @foreach($dataset as $d)
          <tr>
            <td class="tg-cegc">Listrik</td>
            <td class="tg-g25h">{{number_format($d->Listrik)}}</td>
            <td class="tg-g25h">{{number_format($d->Listrik * 0.6)}}</td>
            <td class="tg-g25h">{{number_format($d->Listrik * 0.4)}}</td>
            <td class="tg-g25h">{{number_format(($d->Listrik * 0.4) * 0.1)}}</td>
          </tr>
          <tr>
            <td class="tg-cegc">Kebersihan</td>
            <td class="tg-g25h">{{number_format($d->Kebersihan)}}</td>
            <td class="tg-g25h">{{number_format($d->Kebersihan * 0.9)}}</td>
            <td class="tg-g25h">{{number_format($d->Kebersihan * 0.1)}}</td>
            <td class="tg-g25h">{{number_format(($d->Kebersihan * 0.1) * 0.1)}}</td>
          </tr>
          <tr>
            <td class="tg-cegc">Air</td>
            <td class="tg-g25h">{{number_format($d->Air)}}</td>
            <td class="tg-g25h">0</td>
            <td class="tg-g25h">0</td>
            <td class="tg-g25h">0</td>
          </tr>
          <tr>
            <td class="tg-cegc">IPK & Keamanan</td>
            <td class="tg-g25h">{{number_format($d->Keamanan)}}</td>
            <td class="tg-g25h">0</td>
            <td class="tg-g25h">0</td>
            <td class="tg-g25h">0</td>
          </tr>
          <tr>
            <td class="tg-vbo4" style="text-align:center;">Total</td>
            <td class="tg-8m6k">Rp. {{number_format($d->Listrik + $d->Kebersihan + $d->Air + $d->Keamanan)}}</td>
            <td class="tg-8m6k">Rp. {{number_format(($d->Listrik * 0.6) + ($d->Kebersihan * 0.9))}}</td>
            <td class="tg-8m6k">Rp. {{number_format(($d->Listrik * 0.4) + ($d->Kebersihan * 0.1))}}</td>
            <td class="tg-8m6k">Rp. {{number_format((($d->Kebersihan * 0.1) * 0.1) + (($d->Listrik * 0.4) * 0.1))}}</td>
          </tr>
          @endforeach
        </table>
      <div id="notices">
        <div><b>CATATAN :</b></div>
        <div class="notice">Manager</div>
      </div>
    </main>
  </body>
</html>