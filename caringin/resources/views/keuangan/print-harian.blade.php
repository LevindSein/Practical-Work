<?php
$tanggal = date("d M Y", strtotime($data->TGL_BAYAR));

$total = 0;
foreach($dataset as $d){
  $total = $total + $d->Realisasi;
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>PT. PENGELOLA PUSAT PERDAGANGAN CARINGIN</title>
    <link rel="stylesheet" href="{{asset('css/style-harian.css')}}" media="all" />
  </head>
  
  <body onload="window.print()">
    <header class="clearfix">
      <h1>PENDAPATAN HARIAN</h1>
      <div id="company" class="clearfix">
        <div>PT. Pengelola Pusat Perdagangan Caringin</div>
        <div>Jl. Soekarno Hatta No. 220 Blok A1 No. 21-24<br /> Pasar Induk Caringin, Bandung</div>
        <div>(022) 540-4556</div>
      </div>
      <div id="project">
        <div><span>Tanggal Penerimaan</span>: {{$tanggal}}</div>
      </div>
    </header>
    <main>
      <table class="tg">
          <tr>
            <th class="tg-r8fv" rowspan="3">Nama Kasir</th>
            <th class="tg-r8fv" colspan="6">Penerimaan</th>
            <th class="tg-r8fv" rowspan="3">Jumlah</th>
          </tr>
          <tr>
            <th class="tg-r8fv" rowspan="2">Listrik</th>
            <th class="tg-r8fv" rowspan="2">Air Bersih</th>
            <th class="tg-ccvv" rowspan="2" style="vertical-align:middle;">Keamanan</th>
            <th class="tg-ccvv" rowspan="2" style="vertical-align:middle;">Kebersihan</th>
            <th class="tg-r8fv" colspan="2">Denda</th>
          </tr>
          <tr>
            <th class="tg-ccvv">Listrik</th>
            <th class="tg-ccvv">Air</th>
          </tr>
          @foreach($dataset as $d)
          <tr>
            <td class="tg-cegc">{{$d->NAMA_USER}}</td>
            <td class="tg-g25h">{{number_format($d->Listrik)}}</td>
            <td class="tg-g25h">{{number_format($d->Air)}}</td>
            <td class="tg-g25h">{{number_format($d->Keamanan)}}</td>
            <td class="tg-g25h">{{number_format($d->Kebersihan)}}</td>
            <td class="tg-g25h">{{number_format($d->DendaListrik)}}</td>
            <td class="tg-g25h">{{number_format($d->DendaAir)}}</td>
            <td class="tg-g25h">{{number_format($d->Realisasi)}}</td>
          </tr>
          @endforeach
          <tr>
            <td class="tg-vbo4" style="text-align:center;" colspan="7">Total</td>
            <td class="tg-8m6k">Rp. {{number_format($total)}}</td>
          </tr>
        </table>
      <div id="notices">
        <div><b>CATATAN :</b></div>
        <div class="notice"></div>
      </div>
    </main>
  </body>
</html>