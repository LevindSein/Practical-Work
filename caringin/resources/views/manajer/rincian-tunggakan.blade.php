<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>PT. PENGELOLA PUSAT PERDAGANGAN CARINGIN</title>
    <link rel="stylesheet" href="{{asset('css/style-faktur.css')}}" media="all" />
  </head>
  
  <body onload="window.print()">
      <h2 style="text-align:center;">RINCIAN TUNGGAKAN</h2>
    <main>
      <table class="tg">
          <tr>
            <th class="tg-r8fv" rowspan="2">Tgl Tagihan</th>
            <th class="tg-r8fv" rowspan="2">Kode Kontrol</th>
            <th class="tg-r8fv" rowspan="2">Pengguna</th>
            <th class="tg-r8fv" colspan="4">Tunggakan</th>
            <th class="tg-r8fv" rowspan="2">Total</th>
          </tr>
          <tr>
            <th class="tg-r8fv">Listrik</th>
            <th class="tg-r8fv">Air Bersih</th>
            <th class="tg-r8fv">Keamanan</th>
            <th class="tg-r8fv">Kebersihan</th>
          </tr>
          @foreach($dataset as $d)
          <tr>
            <td class="tg-cegc" <?php $tgl = date("d-m-Y", strtotime($d->TGL_TAGIHAN)); ?>>{{$tgl}}</td>
            <td class="tg-cegc">{{$d->KD_KONTROL}}</td>
            <td class="tg-g25h" style="text-align:left;">{{$d->NM_NASABAH}}</td>
            <td class="tg-g25h">Rp. {{number_format($d->SELISIH_LISTRIK + $d->DENDA_LISTRIK)}}</td>
            <td class="tg-g25h">Rp. {{number_format($d->SELISIH_AIR + $d->DENDA_AIR)}}</td>
            <td class="tg-g25h">Rp. {{number_format($d->SELISIH_IPKEAMANAN)}}</td>
            <td class="tg-g25h">Rp. {{number_format($d->SELISIH_KEBERSIHAN)}}</td>
            <td class="tg-g25h">Rp. {{number_format($d->SELISIH_LISTRIK + $d->DENDA_LISTRIK + $d->SELISIH_AIR + $d->DENDA_AIR + $d->SELISIH_IPKEAMANAN + $d->SELISIH_KEBERSIHAN)}}</td>
          </tr>
          @endforeach
        </table>
    </main>
  </body>
</html>