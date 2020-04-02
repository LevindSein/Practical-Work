<?php
$bulan = date("M Y", strtotime($data->BLN_BAYAR));
$ttl_listrik = 0;
$ttl_kebersihan = 0;

foreach($dataset as $d){
  $ttl_listrik = $ttl_listrik + $d->Listrik;
  $ttl_kebersihan = $ttl_kebersihan + $d->Kebersihan;
}
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
      <h1>RINCIAN PENDAPATAN BULANAN</h1>
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
            <th class="tg-r8fv" rowspan="2">Tanggal</th>
            <th class="tg-r8fv" colspan="2">Penerimaan</th>
            <th class="tg-r8fv" rowspan="2">Jumlah</th>
          </tr>
            <th class="tg-r8fv">Listrik</th>
            <th class="tg-r8fv">Kebersihan</th>
          <tr>
          </tr>
          @foreach($dataset as $d)
          <tr>
            <td class="tg-cegc" <?php $tgl = date("d-m-Y", strtotime($d->TGL_BAYAR)); ?>>{{$tgl}}</td>
            <td class="tg-g25h">{{number_format($d->Listrik)}}</td>
            <td class="tg-g25h">{{number_format($d->Kebersihan)}}</td>
            <td class="tg-g25h">{{number_format($d->Listrik + $d->Kebersihan)}}</td>
          </tr>
          @endforeach
          <tr>
            <td class="tg-vbo4" style="text-align:center;">Total</td>
            <td class="tg-8m6k">Rp. {{number_format($ttl_listrik)}}</td>
            <td class="tg-8m6k">Rp. {{number_format($ttl_kebersihan)}}</td>
            <td class="tg-8m6k">Rp. {{number_format($ttl_listrik + $ttl_kebersihan)}}</td>
          </tr>
          <tr>
            <td class="tg-vbo4" style="text-align:center;">Dana Titipan</td>
            <td class="tg-8m6k">Rp. {{number_format($ttl_listrik * 0.6)}}</td>
            <td class="tg-8m6k">Rp. {{number_format($ttl_kebersihan * 0.9)}}</td>
            <td class="tg-8m6k">Rp. {{number_format(($ttl_listrik * 0.6) + ($ttl_kebersihan * 0.9))}}</td>
          </tr>
          <tr>
            <td class="tg-vbo4" style="text-align:center;">Jasa</td>
            <td class="tg-8m6k">Rp. {{number_format($ttl_listrik * 0.4)}}</td>
            <td class="tg-8m6k">Rp. {{number_format($ttl_kebersihan * 0.1)}}</td>
            <td class="tg-8m6k">Rp. {{number_format(($ttl_listrik * 0.4) + ($ttl_kebersihan * 0.1))}}</td>
          </tr>
          <tr>
            <td class="tg-vbo4" style="text-align:center;">PPN</td>
            <td class="tg-8m6k">Rp. {{number_format(($ttl_listrik * 0.4) * 0.1)}}</td>
            <td class="tg-8m6k">Rp. {{number_format(($ttl_kebersihan * 0.1) * 0.1)}}</td>
            <td class="tg-8m6k">Rp. {{number_format((($ttl_listrik * 0.4) * 0.1) + (($ttl_kebersihan * 0.1) * 0.1))}}</td>
          </tr>
        </table>
      <div id="notices">
        <div><b>CATATAN :</b></div>
        <div class="notice">Bag.Keuangan</div>
      </div>
    </main>
  </body>
</html>