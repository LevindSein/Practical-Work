<?php
$bulan = date("M Y", strtotime($data->BLN_TAGIHAN));

$pakaiku = 0;
$airku = 0;
$bebanku = 0;
$pemeliharaanku = 0;
$arkotku = 0;
$tagihanku = 0;
$realisasiku = 0;
$selisihku = 0;

foreach($dataset as $d){
    $pakaiku = $pakaiku + $d->pakaiAir;
    $airku = $airku + $d->bAir;
    $bebanku = $bebanku + $d->bBeban;
    $pemeliharaanku = $pemeliharaanku + $d->bPemeliharaan;
    $arkotku = $arkotku + $d->bArkot;
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
    <link rel="stylesheet" href="{{asset('css/style-pemakaian.css')}}" media="all" />
  </head>
  
  <body onload="window.print()">
      <h2 style="text-align:center;">REKAP PEMAKAIAN AIR<br>{{$bulan}}</h2>
    <main>
      <table class="tg">
          <tr>
            <th class="tg-r8fv">Blok</th>
            <th class="tg-r8fv">Pemakaian</th>
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
            <td class="tg-cegc">{{$d->BLOK_TEMPAT}}</td>
            <td class="tg-g25h">{{number_format($d->pakaiAir)}} M<sup>3</sup></td>
            <td class="tg-g25h">Rp. {{number_format($d->bAir)}}</td>
            <td class="tg-g25h">Rp. {{number_format($d->bBeban)}}</td>
            <td class="tg-g25h">Rp. {{number_format($d->bPemeliharaan)}}</td>
            <td class="tg-g25h">Rp. {{number_format($d->bArkot)}}</td>
            <td class="tg-g25h">Rp. {{number_format($d->tagihan)}}</td>
            <td class="tg-g25h">Rp. {{number_format($d->realisasi)}}</td>
            <td class="tg-g25h">Rp. {{number_format($d->selisih)}}</td>
          </tr>
          @endforeach
          <tr>
            <td class="tg-vbo4" style="text-align:center;">Total</td>
            <td class="tg-8m6k">{{number_format($pakaiku)}} M<sup>3</sup></td>
            <td class="tg-8m6k">Rp. {{number_format($airku)}}</td>
            <td class="tg-8m6k">Rp. {{number_format($bebanku)}}</td>
            <td class="tg-8m6k">Rp. {{number_format($pemeliharaanku)}}</td>
            <td class="tg-8m6k">Rp. {{number_format($arkotku)}}</td>
            <td class="tg-8m6k">Rp. {{number_format($tagihanku)}}</td>
            <td class="tg-8m6k">Rp. {{number_format($realisasiku)}}</td>
            <td class="tg-8m6k">Rp. {{number_format($selisihku)}}</td>
          </tr>
        </table>
    </main>
  </body>
</html>