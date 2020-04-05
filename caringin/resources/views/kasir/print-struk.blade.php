<?php
$timezone = date_default_timezone_set('Asia/Jakarta');
$now = date("d-m-Y", time());
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>PT. PENGELOLA PUSAT PERDAGANGAN CARINGIN</title>
    <link rel="stylesheet" href="{{asset('css/style.css')}}" media="all" />
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="">
      </div>
      <h1>TAGIHAN</h1>
      <div id="company" class="clearfix">
        <div>PT. Pengelola Pusat Perdagangan Caringin</div>
        <div>Jl. Soekarno Hatta No. 220 Blok A1 No. 21-24<br /> Pasar Induk Caringin, Bandung</div>
        <div>(022) 540-4556</div>
      </div>
      <div id="project">
        <div><span>NAMA NASABAH</span> {{$dataset->NM_NASABAH}}</div>
        <div><span>KODE KONTROL</span> {{$dataset->KD_KONTROL}}</div>
        <div><span>ID TAGIHAN</span> {{$dataset->ID_TAGIHANKU}}</div>
        <div><span>TGL TAGIHAN</span><?php $tag = date("d-m-Y", strtotime($dataset->TGL_TAGIHAN)); ?> {{$tag}}</div>
        <div><span>BULAN PEMBAYARAN</span><?php $time = date("M", strtotime($dataset->TGL_TAGIHAN)); ?> {{$time}}</div>
        <div><span>STRUK TAGIHAN</span> {{$now}}</div>
        <div><span>STATUS BAYAR</span> Dibayar</div>
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
            <td class="total">{{number_format($dataset->AWAL_AIR)}}</td>
          </tr>
          <tr>
            <td class="service">AIR</td>
            <td class="desc">M. Baru</td>
            <td class="total">{{number_format($dataset->AKHIR_AIR)}}</td>
          </tr>
          <tr>
            <td class="service">AIR</td>
            <td class="desc">Pakai</td>
            <td class="total">{{number_format($dataset->PAKAI_AIR)}} M<sup>3</sup></td>
          </tr>
          <tr>
            <td class="service">AIR</td>
            <td class="desc">Harga</td>
            <td class="total">{{number_format($dataset->SELISIH_AIR)}}</td>
          </tr>
          <tr>
            <td class="service">AIR</td>
            <td class="desc">Denda</td>
            <td class="total">{{number_format($dataset->DENDA_AIR)}}</td>
          </tr>
          <tr>
            <td colspan="2" class="grand dark">TOTAL AIR (Rp.)</td>
            <td class="grand dark total"><b>{{number_format($dataset->SELISIH_AIR + $dataset->DENDA_AIR)}}</b></td>
          </tr>

          <tr>
            <td class="grand service">LISTRIK</td>
            <td class="desc">M. Lalu</td>
            <td class="grand total">{{number_format($dataset->AWAL_LISTRIK)}}</td>
          </tr>
          <tr>
            <td class="service">LISTRIK</td>
            <td class="desc">M. Baru</td>
            <td class="total">{{number_format($dataset->AKHIR_LISTRIK)}}</td>
          </tr>
          <tr>
            <td class="service">LISTRIK</td>
            <td class="desc">Pakai</td>
            <td class="total">{{number_format($dataset->PAKAI_LISTRIK)}} watt</td>
          </tr>
          <tr>
            <td class="service">LISTRIK</td>
            <td class="desc">Harga</td>
            <td class="total">{{number_format($dataset->SELISIH_LISTRIK)}}</td>
          </tr>
          <tr>
            <td class="service">LISTRIK</td>
            <td class="desc">Denda</td>
            <td class="total">{{number_format($dataset->DENDA_LISTRIK)}}</td>
          </tr>
          <tr>
            <td colspan="2" class="grand dark">TOTAL LISTRIK (Rp.)</td>
            <td class="grand dark total"><b>{{number_format($dataset->SELISIH_LISTRIK + $dataset->DENDA_LISTRIK)}}</b></td>
          </tr>

          <tr>
            <td class="grand service">IPK & KEAMANAN</td>
            <td class="desc">Jumlah Unit</td>
            <td class="grand total">x{{$dataset->JML_ALAMAT}}</td>
          </tr>
          <tr>
            <td class="service">IPK</td>
            <td class="desc">Harga</td>
            <td class="total">{{number_format($dataset->BYR_IPK)}}</td>
          </tr>
          <tr>
            <td class="service">KEAMANAN</td>
            <td class="desc">Harga</td>
            <td class="total">{{number_format($dataset->BYR_KEAMANAN)}}</td>
          </tr>
          <tr>
            <td colspan="2" class="grand dark">TOTAL IPK & KEAMANAN (Rp.)</td>
            <td class="grand dark total"><b>{{number_format($dataset->SELISIH_IPKEAMANAN)}}</b></td>
          </tr>

          <tr>
            <td class="grand service">KEBERSIHAN</td>
            <td class="desc">Jumlah Unit</td>
            <td class="grand total">{{$dataset->JML_ALAMAT}}</td>
          </tr>
          <tr>
            <td class="service">KEBERSIHAN</td>
            <td class="desc">Harga</td>
            <td class="total">{{number_format($dataset->BYR_KEBERSIHAN)}}</td>
          </tr>
          <tr>
            <td colspan="2" class="grand dark">TOTAL KEBERSIHAN (Rp.)</td>
            <td class="grand dark total"><b>{{number_format($dataset->SELISIH_KEBERSIHAN)}}</b></td>
          </tr>
          <tr>
            <td colspan="2" class="grand"><h3>TOTAL</h3></td>
            <td class="grand total"><b>RP. {{number_format($dataset->SELISIH + $dataset->DENDA)}}</b></td>
          </tr>
          <tr>
            <td colspan="2" class="grand"><h4>Cash</h4></td>
            <td class="grand total"><b>RP. {{number_format($realisasi)}}</b></td>
          </tr>
          <tr>
            <td colspan="2" class="grand"><h4>Selisih</h4></td>
            <td class="grand total"<?php if($realisasi >= $dataset->SELISIH + $dataset->DENDA){ $selisih = 0; } else{$selisih = $dataset->SELISIH + $dataset->DENDA - $realisasi;} ?>><b>RP. {{number_format($selisih)}}</b></td>
          </tr>
        </tbody>
      </table>
      <div id="notices">
        <div>CATATAN:</div>
        <div class="notice"> <?php $exp = date("d M Y", strtotime($dataset->EXPIRED)); ?> Jatuh Tempo Pertama Tanggal {{$exp}}</div>
      </div>
    </main>
    <footer>
      Terima kasih.
    </footer>
    <script type="text/javascript">
      window.print();
      window.onafterprint=function(){
        window.location.href = "{{URL::to('bayarankasir/store',['id' => "$dataset->ID_TAGIHANKU",'real' => "$realisasi"])}}"
      }
    </script>
  </body>
</html>