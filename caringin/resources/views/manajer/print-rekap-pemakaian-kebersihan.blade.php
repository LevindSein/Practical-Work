<?php
$bulan = date("M Y", strtotime($data->BLN_TAGIHAN));

$alamatku = 0;
$tagihanku = 0;
$realisasiku = 0;
$selisihku = 0;

foreach($dataset as $d){
    $alamatku = $alamatku + $d->alamat;
    $tagihanku = $tagihanku + $d->tagihan;
    $realisasiku = $realisasiku + $d->realisasi;
    $selisihku = $selisihku + $d->selisih;  
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
      <h2 style="text-align:center;">REKAP PEMAKAIAN KEBERSIHAN<br>{{$bulan}}</h2>
    <main>
        <table class="tg">
          <tr>
            <th class="tg-r8fv">Blok</th>
            <th class="tg-r8fv">Jumlah Los</th>
            <th class="tg-r8fv">Tagihan</th>
            <th class="tg-r8fv">Realisasi</th>
            <th class="tg-r8fv">Selisih</th>
          </tr>
          @foreach($dataset as $d)
          <tr>
            <td class="tg-cegc">{{$d->BLOK_TEMPAT}}</td>
            <td class="tg-g25h">{{number_format($d->alamat)}} unit</td>
            <td class="tg-g25h">Rp. {{number_format($d->tagihan)}}</td>
            <td class="tg-g25h">Rp. {{number_format($d->realisasi)}}</td>
            <td class="tg-g25h">Rp. {{number_format($d->selisih)}}</td>
          </tr>
          @endforeach
          <tr>
            <td class="tg-vbo4" style="text-align:center;">Total</td>
            <td class="tg-8m6k">{{number_format($alamatku)}} unit</td>
            <td class="tg-8m6k">Rp. {{number_format($tagihanku)}}</td>
            <td class="tg-8m6k">Rp. {{number_format($realisasiku)}}</td>
            <td class="tg-8m6k">Rp. {{number_format($selisihku)}}</td>
          </tr>
        </table>
    </main>
  </body>
</html>