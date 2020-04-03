<?php
$bulan = date("M Y", strtotime($data->BLN_TAGIHAN));

$dayaku = 0;
$pakaiku = 0;
$bebanku = 0;
$bpjuku = 0;
$tagihanku = 0;
$realisasiku = 0;
$selisihku = 0;

foreach($dataset as $d){
    $dayaku = $dayaku + $d->daya;
    $pakaiku = $pakaiku + $d->pakaiListrik;
    $bebanku = $bebanku + $d->bBeban;
    $bpjuku = $bpjuku + $d->bpju;
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
      <h2 style="text-align:center;">REKAP PEMAKAIAN LISTRIK<br>{{$bulan}}</h2>
    <main>
      <table class="tg">
          <tr>
            <th class="tg-r8fv">Blok</th>
            <th class="tg-r8fv">Daya</th>
            <th class="tg-r8fv">Pakai</th>
            <th class="tg-r8fv">Beban</th>
            <th class="tg-r8fv">BPJU</th>
            <th class="tg-r8fv">Tagihan</th>
            <th class="tg-r8fv">Realisasi</th>
            <th class="tg-r8fv">Selisih</th>
          </tr>
          @foreach($dataset as $d)
          <tr>
            <td class="tg-cegc">{{$d->BLOK_TEMPAT}}</td>
            <td class="tg-g25h">{{number_format($d->daya)}} W</td>
            <td class="tg-g25h">{{number_format($d->pakaiListrik)}} kWh</td>
            <td class="tg-g25h">Rp. {{number_format($d->bBeban)}}</td>
            <td class="tg-g25h">Rp. {{number_format($d->bpju)}}</td>
            <td class="tg-g25h">Rp. {{number_format($d->tagihan)}}</td>
            <td class="tg-g25h">Rp. {{number_format($d->realisasi)}}</td>
            <td class="tg-g25h">Rp. {{number_format($d->selisih)}}</td>
          </tr>
          @endforeach
          <tr>
            <td class="tg-vbo4" style="text-align:center;">Total</td>
            <td class="tg-8m6k">{{number_format($dayaku)}} W</td>
            <td class="tg-8m6k">{{number_format($pakaiku)}} kWh</td>
            <td class="tg-8m6k">Rp. {{number_format($bebanku)}}</td>
            <td class="tg-8m6k">Rp. {{number_format($bpjuku)}}</td>
            <td class="tg-8m6k">Rp. {{number_format($tagihanku)}}</td>
            <td class="tg-8m6k">Rp. {{number_format($realisasiku)}}</td>
            <td class="tg-8m6k">Rp. {{number_format($selisihku)}}</td>
          </tr>
        </table>
    </main>
  </body>
</html>