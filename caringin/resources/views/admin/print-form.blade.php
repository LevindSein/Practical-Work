<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>PT. PENGELOLA PUSAT PERDAGANGAN CARINGIN</title>
    <link rel="stylesheet" href="{{asset('css/style-bulanan.css')}}" media="all" />
  </head>
  
  <body onload="window.print()">
  @for($i=1;$i<=2;$i++)
  @if($i == 1)
      <h2 style="text-align:center;">FORM METERAN AIR</h2>
    <main>
      <table class="tg">
          <tr>
            <th class="tg-r8fv">Blok</th>
            <th class="tg-r8fv">Pengguna</th>
            <th class="tg-r8fv">No.Meter Air</th>
            <th class="tg-r8fv">Meteran Lalu</th>
            <th class="tg-r8fv">Meteran Baru</th>
            <th class="tg-r8fv">Keterangan</th>
          </tr>
          @foreach($dataset as $d)
          <tr>
            <td class="tg-cegc">{{$d->KD_KONTROL}}</td>
            <td class="tg-g25h" style="text-align:left;">{{$d->NM_NASABAH}}</td>
            <td class="tg-g25h" style="text-align:center;">{{($d->NOMTR_AIR)}}</td>
            <td class="tg-g25h" style="text-align:right;">{{number_format($d->MAKHIR_AIR)}}</td>
            <td class="tg-g25h" style="text-align:center;"></td>
            <td></td>
          </tr>
          @endforeach
        </table>
    </main>
  @else
  <h2 style="text-align:center;page-break-before:always">FORM METERAN LISTRIK</h2>
    <main>
    <table class="tg">
          <tr>
            <th class="tg-r8fv">Blok</th>
            <th class="tg-r8fv">Pengguna</th>
            <th class="tg-r8fv">Bentuk Usaha</th>
            <th class="tg-r8fv">No.Meter Listrik</th>
            <th class="tg-r8fv">Meteran Lalu</th>
            <th class="tg-r8fv">Meteran Baru</th>
          </tr>
          @foreach($dataset as $d)
          <tr>
            <td class="tg-cegc">{{$d->KD_KONTROL}}</td>
            <td class="tg-g25h" style="text-align:left;">{{$d->NM_NASABAH}}</td>
            <td class="tg-g25h" style="text-align:left;">{{$d->BENTUK_USAHA}}</td>
            <td class="tg-g25h" style="text-align:center;">{{($d->NOMTR_LISTRIK)}}</td>
            <td class="tg-g25h" style="text-align:right;">{{number_format($d->MAKHIR_LISTRIK)}}</td>
            <td></td>
          </tr>
          @endforeach
        </table>
    </main>
  @endif
  @endfor
  </body>
</html>