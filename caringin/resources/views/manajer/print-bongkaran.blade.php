<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>PT. PENGELOLA PUSAT PERDAGANGAN CARINGIN</title>
    <link rel="stylesheet" href="{{asset('css/style-bulanan.css')}}" media="all" />
  </head>
  
  <body onload="window.print()">
      <h2 style="text-align:center;">REKAP BONGKARAN</h2>
    <main>
      <table class="tg">
          <tr>
            <th class="tg-r8fv" rowspan="2">Blok</th>
            <th class="tg-r8fv" rowspan="2">Jumlah Unit</th>
            <th class="tg-r8fv" colspan="2">Tunggakan</th>
          </tr>
          <tr>
              <th>3 Bulan</th>
              <th>>= 4 Bulan</th>
          </tr>
        @for($i = 0; $i < $ttlBlok; $i++)
          <tr>
              <td class="tg-cegc" <?php $bloks=$blok[$i]?>>{{$bloks->BLOK}}</td>
              <td class="tg-cegc">{{number_format($Blokku[$i])}}</td>
              <td class="tg-cegc">{{number_format($Bulan3[$i])}} unit</td>
              <td class="tg-cegc">{{number_format($Bulan4[$i])}} unit</td>
          </tr>
        @endfor
        </table>
    </main>
  </body>
</html>