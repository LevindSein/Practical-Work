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
          </tr>
          @foreach($dataset as $d)
          <tr>
            <td class="tg-cegc">Air Bersih</td>
            <td class="tg-g25h">{{number_format($d->Air)}}</td>
          </tr>
          <tr>
            <td class="tg-cegc">IPK & Keamanan</td>
            <td class="tg-g25h">{{number_format($d->Keamanan)}}</td>
          </tr>
          <tr>
            <td class="tg-vbo4" style="text-align:center;">Total</td>
            <td class="tg-8m6k">Rp.{{number_format($d->Air + $d->Keamanan)}}</td>
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