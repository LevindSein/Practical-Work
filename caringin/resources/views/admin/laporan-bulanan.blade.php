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
                      <th>Pakai (M<sup>3</sup>)</th>
                      <th>B.Pemakaian (Rp.)</th>
                      <th>B.Beban (Rp.)</th>
                      <th>B.Pemeliharaan (Rp.)</th>
                      <th>B.Air Kotor (Rp.)</th>
                      <th>Pembayaran (Rp.)</th>
                      <th>Realisasi (Rp.)</th>
                      <th>Selisih (Rp.)</th>
                      <th>Denda (Rp.)</th>
                    </tr>
                  </thead>

                  <tbody>
                  @foreach($dataset as $d)
                  @if($d->ID_TRFAIR != null)
                    <tr>
                      <td class="text-center"
                      <?php if($d->STT_LUNAS==0){ ?> style="color:red;" <?php } ?>
                      <?php if($d->STT_LUNAS==1){ ?> style="color:green;" <?php } ?>>
                      @if($d->STT_LUNAS == 1)
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
                      <td>{{number_format($d->AWAL_AIR)}}</td>
                      <td>{{number_format($d->AKHIR_AIR)}}</td>
                      <td>{{number_format($d->PAKAI_AIR)}}</td>
                      <td>{{number_format($d->BYR_AIR)}}</td>
                      <td>{{number_format($d->BYR_BEBAN)}}</td>
                      <td>{{number_format($d->BYR_PEMELIHARAAN)}}</td>
                      <td>{{number_format($d->BYR_ARKOT)}}</td>
                      <td>{{number_format($d->TTL_AIR)}}</td>
                      <td>{{number_format($d->REALISASI_AIR)}}</td>
                      <td>{{number_format($d->SELISIH_AIR)}}</td>
                      <td>{{number_format($d->DENDA_AIR)}}</td>
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
                      <th>Daya (W)</th>
                      <th>M.Lalu</th>
                      <th>M.baru</th>
                      <th>Pakai (kWh)</th>
                      <th>Rek.Min (Rp.)</th>
                      <th>B.Blok 1 (Rp.)</th>
                      <th>B.Blok 2 (Rp.)</th>
                      <th>B.Beban (Rp.)</th>
                      <th>BPJU (Rp.)</th>
                      <th>Pembayaran (Rp.)</th>
                      <th>Realisasi (Rp.)</th>
                      <th>Selisih (Rp.)</th>
                      <th>Denda (Rp.)</th>
                    </tr>
                  </thead>

                  <tbody>
                  @foreach($dataset as $d)
                  @if($d->ID_TRFLISTRIK != null)
                    <tr>
                    <td class="text-center"
                      <?php if($d->STT_LUNAS==0){ ?> style="color:red;" <?php } ?>
                      <?php if($d->STT_LUNAS==1){ ?> style="color:green;" <?php } ?>>
                      @if($d->STT_LUNAS == 1)
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
                      <td>{{number_format($d->DAYA_LISTRIK)}}</td>
                      <td>{{number_format($d->AWAL_LISTRIK)}}</td>
                      <td>{{number_format($d->AKHIR_LISTRIK)}}</td>
                      <td>{{number_format($d->PAKAI_LISTRIK)}}</td>
                      <td>{{number_format($d->REK_MIN)}}</td>
                      <td>{{number_format($d->B_BLOK1)}}</td>
                      <td>{{number_format($d->B_BLOK2)}}</td>
                      <td>{{number_format($d->B_BEBAN)}}</td>
                      <td>{{number_format($d->BPJU)}}</td>
                      <td>{{number_format($d->TTL_LISTRIK)}}</td>
                      <td>{{number_format($d->REALISASI_LISTRIK)}}</td>
                      <td>{{number_format($d->SELISIH_LISTRIK)}}</td>
                      <td>{{number_format($d->DENDA_LISTRIK)}}</td>
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
                      <th>Total (Rp.)</th>
                      <th>Realisasi (Rp.)</th>
                      <th>Selisih (Rp.)</th>
                    </tr>
                  </thead>
                 
                  <tbody>
                  @foreach($dataset as $d)
                  @if($d->ID_TRFIPK != null || $d->ID_TRFKEAMANAN != null)
                    <tr>
                    <td class="text-center"
                      <?php if($d->STT_LUNAS==0){ ?> style="color:red;" <?php } ?>
                      <?php if($d->STT_LUNAS==1){ ?> style="color:green;" <?php } ?>>
                      @if($d->STT_LUNAS == 1)
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
                      <td>{{number_format($d->TTL_IPKEAMANAN)}}</td>
                      <td>{{number_format($d->REALISASI_IPKEAMANAN)}}</td>
                      <td>{{number_format($d->SELISIH_IPKEAMANAN)}}</td>
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
                      <th>Total (Rp.)</th>
                      <th>Realisasi (Rp.)</th>
                      <th>Selisih (Rp.)</th>
                    </tr>
                  </thead>
                 
                  <tbody>
                  @foreach($dataset as $d)
                  @if($d->ID_TRFKEBERSIHAN != null)
                    <tr>
                    <td class="text-center"
                      <?php if($d->STT_LUNAS==0){ ?> style="color:red;" <?php } ?>
                      <?php if($d->STT_LUNAS==1){ ?> style="color:green;" <?php } ?>>
                      @if($d->STT_LUNAS == 1)
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
                      <td>{{number_format($d->TTL_KEBERSIHAN)}}</td>
                      <td>{{number_format($d->REALISASI_KEBERSIHAN)}}</td>
                      <td>{{number_format($d->SELISIH_KEBERSIHAN)}}</td>
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
