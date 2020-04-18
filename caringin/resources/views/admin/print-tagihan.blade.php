<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>PT. PENGELOLA PUSAT PERDAGANGAN CARINGIN</title>
    <link rel="stylesheet" href="{{asset('css/style-tahunan.css')}}" media="all" />
  </head>
  
  <body onload="window.print()">
    <header class="clearfix">
      <h1>TAGIHAN & TUNGGAKAN</h1>
      <div id="company" class="clearfix">
        <div>PT. Pengelola Pusat Perdagangan Caringin</div>
        <div>Jl. Soekarno Hatta No. 220 Blok A1 No. 21-24<br /> Pasar Induk Caringin, Bandung</div>
        <div>(022) 540-4556</div>
      </div>
      <div id="project">
        <div><span>Nama Admin</span>: Super_Admin</div>
      </div>
    </header>
    <main>
      <table class="tg">
          <tr>
            <th class="tg-r8fv" rowspan="2">Tgl</th>
            <th class="tg-r8fv" rowspan="2">Kode</th>
            <th class="tg-r8fv" rowspan="2">Pengguna</th>
            <th class="tg-r8fv" colspan="2">Pakai</th>
            <th class="tg-r8fv" colspan="4">Jumlah Tagihan</th>
            <th class="tg-r8fv" rowspan="2">Total</th>
            <th class="tg-r8fv" rowspan="2">Ket.</th>

          </tr>
          <tr>
            <th class="tg-r8fv">Listrik</th>
            <th class="tg-r8fv">Air</th>
            <th class="tg-r8fv">Listrik</th>
            <th class="tg-r8fv">Air</th>
            <th class="tg-r8fv">Keamanan</th>
            <th class="tg-r8fv">Kebersihan</th>
          </tr>
          @foreach($dataset as $d)
          <tr>
            <td class="tg-cegc">{{$d->TGL_TAGIHAN}}</td>
            <td class="tg-rtqe">{{$d->KD_KONTROL}}</td>
            <td class="tg-rtqe">{{$d->NM_NASABAH}}</td>
            <td class="tg-g25h">{{number_format($d->PAKAI_LISTRIK)}}</td>
            <td class="tg-g25h">{{number_format($d->PAKAI_AIR)}}</td>
            <td class="tg-g25h">{{number_format($d->SELISIH_LISTRIK + $d->DENDA_LISTRIK)}}</td>
            <td class="tg-g25h">{{number_format($d->SELISIH_AIR + $d->DENDA_AIR)}}</td>
            <td class="tg-g25h">{{number_format($d->SELISIH_IPKEAMANAN)}}</td>
            <td class="tg-g25h">{{number_format($d->SELISIH_KEBERSIHAN)}}</td>
            <td class="tg-g25h">{{number_format($d->SELISIH)}}</td>
            <td class="tg-g25h">{{number_format($d->KET)}}</td>
          </tr>
          @endforeach
        </table>
      <div id="notices">
        <div><b>CATATAN :</b></div>
        <div class="notice">Super_Admin</div>
      </div>
    </main>
  </body>
</html>