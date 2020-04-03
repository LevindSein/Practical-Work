<?php
$ttl_Blok = 0;
$ttl_Listrik = 0;
$ttl_Air = 0;
$ttl_Keamanan = 0;
$ttl_Kebersihan = 0;

for($i=0;$i<$ttlBlok;$i++){
  $ttl_Blok = $ttl_Blok + $Blokku[$i];
  $ttl_Listrik = $ttl_Listrik + $Listrik[$i];
  $ttl_Air = $ttl_Air + $Air[$i];
  $ttl_Keamanan = $ttl_Keamanan + $Keamanan[$i];
  $ttl_Kebersihan = $ttl_Kebersihan + $Kebersihan[$i];
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
      <h2 style="text-align:center;">DAFTAR PENGGUNAAN TEMPAT</h2>
    <main>
      <table class="tg">
          <tr>
            <th class="tg-r8fv" rowspan="2">Blok</th>
            <th class="tg-r8fv" rowspan="2">Jumlah Unit</th>
            <th class="tg-r8fv" colspan="4">Pengguna</th>
          </tr>
          <tr>
              <th>Listrik</th>
              <th>Air</th>
              <th>Kebersihan</th>
              <th>Keamanan</th>
          </tr>
        @for($i = 0; $i < $ttlBlok; $i++)
          <tr>
              <td class="tg-cegc" <?php $bloks=$blok[$i]?>>{{$bloks->BLOK}}</td>
              <td class="tg-cegc">{{number_format($Blokku[$i])}}</td>
              <td class="tg-cegc">{{number_format($Listrik[$i])}}</td>
              <td class="tg-cegc">{{number_format($Air[$i])}}</td>
              <td class="tg-cegc">{{number_format($Kebersihan[$i])}}</td>
              <td class="tg-cegc">{{number_format($Keamanan[$i])}}</td>
          </tr>
        @endfor
          <tr>
            <td class="tg-vbo4" style="text-align:center;">Total</td>
            <td class="tg-vbo4" style="text-align:center;">{{number_format($ttl_Blok)}}</td>
            <td class="tg-vbo4" style="text-align:center;">{{number_format($ttl_Listrik)}}</td>
            <td class="tg-vbo4" style="text-align:center;">{{number_format($ttl_Air)}}</td>
            <td class="tg-vbo4" style="text-align:center;">{{number_format($ttl_Kebersihan)}}</td>
            <td class="tg-vbo4" style="text-align:center;">{{number_format($ttl_Keamanan)}}</td>
          </tr>
        </table>
    </main>
  </body>
</html>