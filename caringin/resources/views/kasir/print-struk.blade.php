@foreach($dataset as $d)
<?php
$timezone = date_default_timezone_set('Asia/Jakarta');
$now = date("d-m-Y", time());
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Print Tagihan</title>
    <link rel="stylesheet" href="{{asset('css/style.css')}}" media="all" />
  </head>
  <body onload="window.print()">
    <header class="clearfix">
      <div id="logo">
        <img src="">
      </div>
      <h1>TAGIHAN</h1>
      <div id="company" class="clearfix">
        <div>PT. Pengelola Pusat Perdagangan Caringin</div>
        <div>Jl. Soekarno Hatta No. 220 Blok A1 No. 21-24<br /> Pasar Induk Caringin, Bandung</div>
        <div>(602) 519-0450</div>
        <div><a href="mailto:company@example.com">caringin@google.com</a></div>
      </div>
      <div id="project">
        <div><span>NAMA NASABAH</span> {{$d->NM_NASABAH}}</div>
        <div><span>KODE KONTROL</span> {{$d->KD_KONTROL}}</div>
        <div><span>ID TAGIHAN</span> {{$d->ID_TAGIHANKU}}</div>
        <div><span>TGL TAGIHAN</span><?php $tag = date("d-m-Y", strtotime($d->TGL_TAGIHAN)); ?> {{$tag}}</div>
        <div><span>BULAN PEMBAYARAN</span><?php $time = date("M", strtotime($d->TGL_TAGIHAN)); ?> {{$time}}</div>
        <div><span>STRUK TAGIHAN</span> {{$now}}</div>
      </div>
    </header>
    <main>
      <table>
        <thead>
          <tr>
            <th class="service">FASILITAS</th>
            <th class="desc">KETERANGAN</th>
            <th>JUMLAH</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="service">AIR</td>
            <td class="desc">M. Lalu</td>
            <td class="total">{{number_format($d->AWAL_AIR)}}</td>
          </tr>
          <tr>
            <td class="service">AIR</td>
            <td class="desc">M. Baru</td>
            <td class="total">{{number_format($d->AKHIR_AIR)}}</td>
          </tr>
          <tr>
            <td class="service">AIR</td>
            <td class="desc">Pakai</td>
            <td class="total">{{number_format($d->PAKAI_AIR)}} M<sup>3</sup></td>
          </tr>
          <tr>
            <td class="service">AIR</td>
            <td class="desc">Harga</td>
            <td class="total">{{number_format($d->TTL_AIR)}}</td>
          </tr>
          <tr>
            <td class="service">AIR</td>
            <td class="desc">Denda</td>
            <td class="total">{{number_format($d->DENDA_AIR)}}</td>
          </tr>
          <tr>
            <td colspan="2" class="grand dark">TOTAL AIR (Rp.)</td>
            <td class="grand dark total"><b>{{number_format($d->TTL_AIR + $d->DENDA_AIR)}}</b></td>
          </tr>

          <tr>
            <td class="grand service">LISTRIK</td>
            <td class="desc">M. Lalu</td>
            <td class="grand total">{{number_format($d->AWAL_LISTRIK)}}</td>
          </tr>
          <tr>
            <td class="service">LISTRIK</td>
            <td class="desc">M. Baru</td>
            <td class="total">{{number_format($d->AKHIR_LISTRIK)}}</td>
          </tr>
          <tr>
            <td class="service">LISTRIK</td>
            <td class="desc">Pakai</td>
            <td class="total">{{number_format($d->PAKAI_LISTRIK)}} watt</td>
          </tr>
          <tr>
            <td class="service">LISTRIK</td>
            <td class="desc">Harga</td>
            <td class="total">{{number_format($d->TTL_LISTRIK)}}</td>
          </tr>
          <tr>
            <td class="service">LISTRIK</td>
            <td class="desc">Denda</td>
            <td class="total">{{number_format($d->DENDA_LISTRIK)}}</td>
          </tr>
          <tr>
            <td colspan="2" class="grand dark">TOTAL LISTRIK (Rp.)</td>
            <td class="grand dark total"><b>{{number_format($d->TTL_LISTRIK + $d->DENDA_LISTRIK)}}</b></td>
          </tr>

          <tr>
            <td class="grand service">IPK & KEAMANAN</td>
            <td class="desc">Jumlah Unit</td>
            <td class="grand total">x{{$d->JML_ALAMAT}}</td>
          </tr>
          <tr>
            <td class="service">IPK</td>
            <td class="desc">Harga</td>
            <td class="total">{{number_format($d->BYR_IPK)}}</td>
          </tr>
          <tr>
            <td class="service">KEAMANAN</td>
            <td class="desc">Harga</td>
            <td class="total">{{number_format($d->BYR_KEAMANAN)}}</td>
          </tr>
          <tr>
            <td colspan="2" class="grand dark">TOTAL IPK & KEAMANAN (Rp.)</td>
            <td class="grand dark total"><b>{{number_format($d->TTL_IPKEAMANAN)}}</b></td>
          </tr>

          <tr>
            <td class="grand service">KEBERSIHAN</td>
            <td class="desc">Jumlah Unit</td>
            <td class="grand total">x{{$d->JML_ALAMAT}}</td>
          </tr>
          <tr>
            <td class="service">KEBERSIHAN</td>
            <td class="desc">Harga</td>
            <td class="total">{{number_format($d->BYR_KEBERSIHAN)}}</td>
          </tr>
          <tr>
            <td colspan="2" class="grand dark">TOTAL KEBERSIHAN (Rp.)</td>
            <td class="grand dark total"><b>{{number_format($d->TTL_KEBERSIHAN)}}</b></td>
          </tr>
          <tr>
            <td colspan="2" class="grand"><h3>TOTAL</h3> (Rp.)</td>
            <td class="grand total"><b>{{number_format($d->TTL_TAGIHAN + $d->DENDA)}}</b></td>
          </tr>
        </tbody>
      </table>
      <div id="notices">
        <div>CATATAN:</div>
        <div class="notice"> <?php $exp = date("d M Y", strtotime($d->EXPIRED)); ?> Jatuh Tempo Pertama Tanggal {{$exp}}</div>
      </div>
    </main>
    <footer>
      Terima kasih.
    </footer>
  </body>
</html>
@endforeach