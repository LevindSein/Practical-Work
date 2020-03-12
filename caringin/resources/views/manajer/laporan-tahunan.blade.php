@extends('manajer.layout')
@section('content')

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Laporan Tahunan</h1>
          </div>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Tabel Laporan Tahunan</h6>
            </div>
            <div class="card-body">
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
                      <th>Tahun</th>
                      <th>Bulan</th>
                      <th>Vol.Pakai (M<sup>3</sup>)</th>
                      <th>B.Pakai (Rp.)</th>
                      <th>B.Beban (Rp.)</th>
                      <th>B.Pemeliharaan (Rp.)</th>
                      <th>B.Arkot (Rp.)</th>
                      <th>Total (Rp.)</th>
                      <th>Realisasi (Rp.)</th>
                      <th>Selisih (Rp.)</th>
                      <th>Denda (Rp.)</th>
                    </tr>
                  </thead>

                  <tbody>
                  @foreach($dataA as $d)
                    <tr>
                      <td class="text-center"
                      <?php $tahun = date("Y", strtotime($d->BLN_TAGIHAN)); ?>>
                      {{$tahun}}
                      </td>
                      <td class="text-center"
                      <?php $bulan = date("M", strtotime($d->BLN_TAGIHAN)); ?>>
                      {{$bulan}}
                      </td>
                      <td>{{number_format($d->pakaiAir)}}</td>
                      <td>{{number_format($d->byrAir)}}</td>
                      <td>{{number_format($d->byrBeban)}}</td>
                      <td>{{number_format($d->byrPemeliharaan)}}</td>
                      <td>{{number_format($d->byrArkot)}}</td>
                      <td>{{number_format($d->ttlAir)}}</td>
                      <td>{{number_format($d->realisasiAir)}}</td>
                      <td>{{number_format($d->selisihAir)}}</td>
                      <td>{{number_format($d->dendaAir)}}</td>
                    </tr>
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
                      <th>Tahun</th>
                      <th>Bulan</th>
                      <th>Daya Pakai (kWh)</th>
                      <th>Rekmin (Rp.)</th>
                      <th>B.Blok 1 (Rp.)</th>
                      <th>B.Blok 2 (Rp.)</th>
                      <th>B.Beban (Rp.)</th>
                      <th>BPJU (Rp.)</th>
                      <th>Total (Rp.)</th>
                      <th>Realisasi (Rp.)</th>
                      <th>Selisih (Rp.)</th>
                      <th>Denda (Rp.)</th>
                    </tr>
                  </thead>
                 
                  <tbody>
                  @foreach($dataL as $d)
                    <tr>
                      <td class="text-center"
                      <?php $tahun = date("Y", strtotime($d->BLN_TAGIHAN)); ?>>
                      {{$tahun}}
                      </td>
                      <td class="text-center"
                      <?php $bulan = date("M", strtotime($d->BLN_TAGIHAN)); ?>>
                      {{$bulan}}
                      </td>
                      <td>{{number_format($d->pakaiListrik)}}</td>
                      <td>{{number_format($d->rekmin)}}</td>
                      <td>{{number_format($d->bBlok1)}}</td>
                      <td>{{number_format($d->bBlok2)}}</td>
                      <td>{{number_format($d->bBeban)}}</td>
                      <td>{{number_format($d->bpju)}}</td>
                      <td>{{number_format($d->ttlListrik)}}</td>
                      <td>{{number_format($d->realisasiListrik)}}</td>
                      <td>{{number_format($d->selisihListrik)}}</td>
                      <td>{{number_format($d->dendaListrik)}}</td>
                    </tr>
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
                      <th>Tahun</th>
                      <th>Bulan</th>
                      <th>Total Tagihan (Rp.)</th>
                      <th>Realisasi (Rp.)</th>
                      <th>Selisih (Rp.)</th>
                    </tr>
                  </thead>
                  
                  <tbody>
                  @foreach($dataK as $d)
                    <tr>
                      <td class="text-center"
                      <?php $tahun = date("Y", strtotime($d->BLN_TAGIHAN)); ?>>
                      {{$tahun}}
                      </td>
                      <td class="text-center"
                      <?php $bulan = date("M", strtotime($d->BLN_TAGIHAN)); ?>>
                      {{$bulan}}
                      </td>
                      <td>{{number_format($d->ttlIpkeamanan)}}</td>
                      <td>{{number_format($d->realisasiIpkeamanan)}}</td>
                      <td>{{number_format($d->selisihIpkeamanan)}}</td>
                    </tr>
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
                      <th>Tahun</th>
                      <th>Bulan</th>
                      <th>Total Tagihan (Rp.)</th>
                      <th>Realisasi (Rp.)</th>
                      <th>Selisih (Rp.)</th>
                    </tr>
                  </thead>
                
                  <tbody>
                  @foreach($dataB as $d)
                    <tr>
                      <td class="text-center"
                      <?php $tahun = date("Y", strtotime($d->BLN_TAGIHAN)); ?>>
                      {{$tahun}}
                      </td>
                      <td class="text-center"
                      <?php $bulan = date("M", strtotime($d->BLN_TAGIHAN)); ?>>
                      {{$bulan}}
                      </td>
                      <td>{{number_format($d->ttlKebersihan)}}</td>
                      <td>{{number_format($d->realisasiKebersihan)}}</td>
                      <td>{{number_format($d->selisihKebersihan)}}</td>
                    </tr>
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