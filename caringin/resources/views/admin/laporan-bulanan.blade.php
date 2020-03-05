@extends('admin.layout')
@section('content')
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Laporan Bulanan</h1>
          </div>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Tabel Laporan Bulanan</h6>
            </div>
            <div class="card-body">
            <!-- <form onsubmit="setDate()" action="{{url('filterbulanan')}}" method="POST" id="bln"> -->
            <form action="{{url('showlaporanbulanan/filter')}}" method="GET" id="bln">
              <label>Filter Bulan</label>
              @csrf
              <input type="month" name="filterbln" id="" class="form-control form-control-user" style="width:20%">
              <br><button type="submit" class="btn btn-primary btn-sm">Submit</button><p>
            </form>
              <div class="form-group">
                <label for="sel1">Tampilkan Data :</label>
                <ul class="nav nav-tabs" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#home">Air Bersih</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu1">Listrik</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu2">IPK & Keamanan</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu3">Kebersihan</a>
                  </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                  <!--AIR BERSIH-->
                  <div id="home" class="container tab-pane active"><br>
                  <div class="table-responsive">
                  <table class="table display table-bordered" id="tableAir" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Status</th>
                      <th>Bulan</th>
                      <th>Kode</th>
                      <th>Nama Nasabah</th>
                      <th>M.Lalu</th>
                      <th>M.baru</th>
                      <th>Pakai</th>
                      <th>B.Pemakaian</th>
                      <th>B.Beban</th>
                      <th>B.Pemeliharaan</th>
                      <th>B.Air Kotor</th>
                      <th>Pembayaran</th>
                      <th>Realisasi</th>
                      <th>Selisih</th>
                    </tr>
                  </thead>

                  <tbody>
                  @foreach($dataset as $d)
                  @if($d->ID_TRFAIR != null)
                    <tr>
                      <td class="text-center"
                      <?php if($d->STT_LUNAS==0){ ?> style="color:red;" <?php } ?>
                      <?php if($d->STT_LUNAS==1){ ?> style="color:green;" <?php } ?>>
                      @if($d->STT_BAYAR == 1)
                        Lunas
                      @else
                        Belum Lunas
                      @endif
                      </td>
                      <td class="text-center"
                      <?php $time = date("Y - M", strtotime($d->TGL_TAGIHAN)); ?>>
                      {{$time}}
                      </td>
                      <td class="text-left">{{$d->KD_KONTROL}}</td>
                      <td class="text-left">{{$d->NM_NASABAH}}</td>
                      <td>{{$d->AWAL_AIR}}</td>
                      <td>{{$d->AKHIR_AIR}}</td>
                      <td>{{$d->PAKAI_AIR}}</td>
                      <td>{{$d->BYR_AIR}}</td>
                      <td>{{$d->BYR_BEBAN}}</td>
                      <td>{{$d->BYR_PEMELIHARAAN}}</td>
                      <td>{{$d->BYR_ARKOT}}</td>
                      <td>{{$d->TTL_AIR}}</td>
                      <td>{{$d->REALISASI_AIR}}</td>
                      <td>{{$d->SELISIH_AIR}}</td>
                    </tr>
                    @endif
                    @endforeach
                  </tbody>
                  </table>
                  </div>
                  </div>
                  <!--END AIR BERSIH-->
                  <!--LISTRIK-->
                  <div id="menu1" class="container tab-pane fade"><br>
                  <div class="table-responsive">
                  <table class="table display table-bordered nowrap" id="tableListrik" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Status</th>
                      <th>Bulan</th>
                      <th>Kode</th>
                      <th>Nama Nasabah</th>
                      <th>Daya</th>
                      <th>M.Lalu</th>
                      <th>M.baru</th>
                      <th>Pakai</th>
                      <th>Rek.Min</th>
                      <th>B.Blok 1</th>
                      <th>B.Blok 2</th>
                      <th>B.Beban</th>
                      <th>BPJU</th>
                      <th>Pembayaran</th>
                      <th>Realisasi</th>
                      <th>Selisih</th>
                    </tr>
                  </thead>

                  <tbody>
                  @foreach($dataset as $d)
                  @if($d->ID_TRFLISTRIK != null)
                    <tr>
                    <td class="text-center"
                      <?php if($d->STT_LUNAS==0){ ?> style="color:red;" <?php } ?>
                      <?php if($d->STT_LUNAS==1){ ?> style="color:green;" <?php } ?>>
                      @if($d->STT_BAYAR == 1)
                        Lunas
                      @else
                        Belum Lunas
                      @endif
                      </td>
                      <td class="text-center"
                      <?php $time = date("Y - M", strtotime($d->TGL_TAGIHAN)); ?>>
                      {{$time}}
                      </td>
                      <td class="text-left">{{$d->KD_KONTROL}}</td>
                      <td class="text-left">{{$d->NM_NASABAH}}</td>
                      <td>{{$d->DAYA}}</td>
                      <td>{{$d->AWAL_LISTRIK}}</td>
                      <td>{{$d->AKHIR_LISTRIK}}</td>
                      <td>{{$d->PAKAI_LISTRIK}}</td>
                      <td>{{$d->REK_MIN}}</td>
                      <td>{{$d->B_BLOK1}}</td>
                      <td>{{$d->B_BLOK2}}</td>
                      <td>{{$d->B_BEBAN}}</td>
                      <td>{{$d->BPJU}}</td>
                      <td>{{$d->TTL_LISTRIK}}</td>
                      <td>{{$d->REALISASI_LISTRIK}}</td>
                      <td>{{$d->SELISIH_LISTRIK}}</td>
                    </tr>
                    @endif
                    @endforeach
                  </tbody>
                  </table>
                  </div>
                  </div>
                  <!--END LISTRIK-->
                  <!--IPK & KEAMANAN-->
                  <div id="menu2" class="container tab-pane fade"><br>
                  <div class="table-responsive">
                  <table class="table display table-bordered" id="tableKeamanan" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Status</th>
                      <th>Bulan</th>
                      <th>Blok</th>
                      <th>Nama Nasabah</th>
                      <th>Alamat</th>
                      <th>Jumlah Unit</th>
                      <th>Pembayaran</th>
                      <th>Realisasi</th>
                      <th>Selisih</th>
                    </tr>
                  </thead>
                 
                  <tbody>
                  @foreach($dataset as $d)
                  @if($d->ID_TRFIPK != null || $d->ID_TRFKEAMANAN != null)
                    <tr>
                    <td class="text-center"
                      <?php if($d->STT_LUNAS==0){ ?> style="color:red;" <?php } ?>
                      <?php if($d->STT_LUNAS==1){ ?> style="color:green;" <?php } ?>>
                      @if($d->STT_BAYAR == 1)
                        Lunas
                      @else
                        Belum Lunas
                      @endif
                      </td>
                      <td class="text-center"
                      <?php $time = date("Y - M", strtotime($d->TGL_TAGIHAN)); ?>>
                      {{$time}}
                      </td>
                      <td class="text-center">{{$d->BLOK}}</td>
                      <td class="text-left">{{$d->NM_NASABAH}}</td>
                      <td class="text-center">{{$d->NO_ALAMAT}}</td>
                      <td class="text-center">{{$d->JML_ALAMAT}}</td>
                      <td>{{$d->TTL_IPKEAMANAN}}</td>
                      <td>{{$d->REALISASI_IPKEAMANAN}}</td>
                      <td>{{$d->SELISIH_IPKEAMANAN}}</td>
                    </tr>
                  @endif
                  @endforeach
                  </tbody>
                  </table>
                  </div>
                  </div>
                  <!--END IPK&KEAMANAN-->
                  <!--KEBERSIHAN-->
                  <div id="menu3" class="container tab-pane fade"><br>
                  <div class="table-responsive">
                  <table class="table display table-bordered" id="tableKebersihan" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Status</th>
                      <th>Bulan</th>
                      <th>Blok</th>
                      <th>Nama Nasabah</th>
                      <th>Alamat</th>
                      <th>Jumlah Unit</th>
                      <th>Pembayaran</th>
                      <th>Realisasi</th>
                      <th>Selisih</th>
                    </tr>
                  </thead>
                 
                  <tbody>
                  @foreach($dataset as $d)
                  @if($d->ID_TRFKEBERSIHAN != null)
                    <tr>
                    <td class="text-center"
                      <?php if($d->STT_LUNAS==0){ ?> style="color:red;" <?php } ?>
                      <?php if($d->STT_LUNAS==1){ ?> style="color:green;" <?php } ?>>
                      @if($d->STT_BAYAR == 1)
                        Lunas
                      @else
                        Belum Lunas
                      @endif
                      </td>
                      <td class="text-center"
                      <?php $time = date("Y - M", strtotime($d->TGL_TAGIHAN)); ?>>
                      {{$time}}
                      </td>
                      <td class="text-center">{{$d->BLOK}}</td>
                      <td class="text-left">{{$d->NM_NASABAH}}</td>
                      <td class="text-center">{{$d->NO_ALAMAT}}</td>
                      <td class="text-center">{{$d->JML_ALAMAT}}</td>
                      <td>{{$d->TTL_KEBERSIHAN}}</td>
                      <td>{{$d->REALISASI_KEBERSIHAN}}</td>
                      <td>{{$d->SELISIH_KEBERSIHAN}}</td>
                    </tr>
                    @endif
                    @endforeach
                  </tbody>
                  </table>
                  </div>
                  </div>
                  <!--END KEBERSIHAN-->
                </div>
                <!--END Tab Panes-->
              </div>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
@endsection
