<?php
$timezone = date_default_timezone_set('Asia/Jakarta');
$now = date("d M Y", time());
$total = 0;
$id = implode(",",$id_exp);
?>


@foreach($dataset as $d)
<?php
$total = $d->SELISIH + $total;
?>
@endforeach

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>PT. PENGELOLA PUSAT PERDAGANGAN CARINGIN</title>
    <link rel="stylesheet" href="{{asset('css/style-faktur.css')}}" media="all" />
  </head>
  
  <body>
    <header class="clearfix">
      <h1>Rincian Tagihan</h1>
      <div id="company" class="clearfix">
        <div>PT. Pengelola Pusat Perdagangan Caringin</div>
        <div>Jl. Soekarno Hatta No. 220 Blok A1 No. 21-24<br /> Pasar Induk Caringin, Bandung</div>
        <div>(022) 540-4556</div>
      </div>
      <div id="project">
        <div><span>Nama Pengguna</span>: {{$dataku->NM_NASABAH}}</div>
        <div><span>No.Anggota</span>: {{$dataku->NO_ANGGOTA}}</div>
        <div><span>Status Bayar</span>: Belum Dibayar</div>
      </div>
    </header>
    <main>
      <table class="tg">
        <colgroup>
        <col style="width: 10%">
        <col style="width: 9%">
        <col style="width: 13%">
        <col style="width: 10%">
        <col style="width: 13%">
        <col style="width: 10%">
        <col style="width: 10%">
        <col style="width: 10%">
        <col style="width: 15%">
        </colgroup>
          <tr>
            <th class="tg-r8fv" rowspan="3">Tanggal</th>
            <th class="tg-r8fv" rowspan="3">Kode</th>
            <th class="tg-r8fv" colspan="6">Tagihan</th>
            <th class="tg-r8fv" rowspan="3">Jumlah</th>
          </tr>
          <tr>
            <th class="tg-r8fv" colspan="2">Tagihan Listrik</th>
            <th class="tg-r8fv" colspan="2">Tagihan Air </th>
            <th class="tg-ccvv" rowspan="2" style="vertical-align:middle;">Keamanan</th>
            <th class="tg-ccvv" rowspan="2" style="vertical-align:middle;">Kebersihan</th>
          </tr>
          <tr>
            <th class="tg-r8fv">Listrik</th>
            <th class="tg-r8fv">Denda</th>
            <th class="tg-ccvv">Air</th>
            <th class="tg-ccvv">Denda</th>
          </tr>
          @foreach($dataset as $d)
          <tr>
            <td class="tg-cegc">{{$d->TGL_TAGIHAN}}</td>
            <td class="tg-rtqe">{{$d->KD_KONTROL}}</td>
            <td class="tg-g25h">{{number_format($d->SELISIH_LISTRIK)}}</td>
            <td class="tg-g25h">{{number_format($d->DENDA_LISTRIK)}}</td>
            <td class="tg-g25h">{{number_format($d->SELISIH_AIR)}}</td>
            <td class="tg-g25h">{{number_format($d->DENDA_AIR)}}</td>
            <td class="tg-g25h">{{number_format($d->SELISIH_IPKEAMANAN)}}</td>
            <td class="tg-g25h">{{number_format($d->SELISIH_KEBERSIHAN)}}</td>
            <td class="tg-g25h">{{number_format($d->SELISIH)}}</td>
          </tr>
          @endforeach
          <tr>
            <td class="tg-vbo4" style="text-align:center;" colspan="8">Total Tagihan</td>
            <td class="tg-8m6k">Rp. {{number_format($total)}}</td>
          </tr>
        </table>
      <div id="notices">
        <div><b>CATATAN :</b></div>
        <div class="notice"></div>
      </div>
      <div id="ttd" class="clearfix">
        <div>Bandung, {{$now}}</div>
        <div><br/>Kasir</div>
        <div><br/><br/><br/><br/></div>
        <div><b>Said</b></div>
      </div>
    </main>
    <script type="text/javascript">
      window.print();
      window.onafterprint=function(){
        window.location.href = "{{URL::to('storecheckout',['id' => "$id"])}}"
      }
    </script>
  </body>
</html>