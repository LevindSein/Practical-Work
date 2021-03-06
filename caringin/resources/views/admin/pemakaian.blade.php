@extends('admin.layout')
@section('content')

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Pemakaian Fasilitas</h1>
          </div>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
              <h6 class="m-0 font-weight-bold text-primary">Tabel Pemakaian</h6>
            </div>
            <div class="card-body">
            <div class="form-group">
                <label for="sel1">Tampilkan Data :</label>
                <ul class="nav nav-tabs" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#home">LISTRIK</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu1">AIR</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu2">KEBERSIHAN</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu3">KEAMANAN</a>
                  </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                  <div id="home" class="container tab-pane active"><br>
              <div class="table-responsive">
              <table class="table display table-bordered" id="tableListrikPakai" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Bulan</th>
                      <th>Lihat</th>
                    </tr>
                  </thead>

                  <tbody>
                  @foreach($dataset as $d)
                    <tr>
                      <td class="text-center" <?php $bulan = date("M Y", strtotime($d->BLN_TAGIHAN)); ?>>{{$bulan}}</td>
                      <td class="text-center">
                          <a href="{{url('print/rekaplistrik',[$d->BLN_TAGIHAN])}}" target="_blank" class="d-none d-sm-inline-block btn btn-primary btn-sm shadow-sm"><i
                            class="fas fa- fa-sm text-white-50"></i>Rekap</a>
                          <a href="{{url('print/rincianlistrik',[$d->BLN_TAGIHAN])}}" target="_blank" class="d-none d-sm-inline-block btn btn-primary btn-sm shadow-sm"><i
                            class="fas fa- fa-sm text-white-50"></i>Rincian</a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              </div>
              <div id="menu1" class="container tab-pane fade"><br>
              <div class="table-responsive">
              <table class="table display table-bordered" id="tableAirPakai" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Bulan</th>
                      <th>Lihat</th>
                    </tr>
                  </thead>

                  <tbody>
                  @foreach($dataset as $d)
                    <tr>
                      <td class="text-center" <?php $bulan = date("M Y", strtotime($d->BLN_TAGIHAN)); ?>>{{$bulan}}</td>
                      <td class="text-center">
                          <a href="{{url('print/rekapair',[$d->BLN_TAGIHAN])}}" target="_blank" class="d-none d-sm-inline-block btn btn-primary btn-sm shadow-sm"><i
                            class="fas fa- fa-sm text-white-50"></i>Rekap</a>
                          <a href="{{url('print/rincianair',[$d->BLN_TAGIHAN])}}" target="_blank" class="d-none d-sm-inline-block btn btn-primary btn-sm shadow-sm"><i
                            class="fas fa- fa-sm text-white-50"></i>Rincian</a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              </div>
              <div id="menu2" class="container tab-pane fade"><br>
              <div class="table-responsive">
              <table class="table display table-bordered" id="tableKebersihanPakai" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Bulan</th>
                      <th>Lihat</th>
                    </tr>
                  </thead>

                  <tbody>
                  @foreach($dataset as $d)
                    <tr>
                      <td class="text-center" <?php $bulan = date("M Y", strtotime($d->BLN_TAGIHAN)); ?>>{{$bulan}}</td>
                      <td class="text-center">
                          <a href="{{url('print/rekapkebersihan',[$d->BLN_TAGIHAN])}}" target="_blank" class="d-none d-sm-inline-block btn btn-primary btn-sm shadow-sm"><i
                            class="fas fa- fa-sm text-white-50"></i>Rekap</a>
                          <a href="{{url('print/rinciankebersihan',[$d->BLN_TAGIHAN])}}" target="_blank" class="d-none d-sm-inline-block btn btn-primary btn-sm shadow-sm"><i
                            class="fas fa- fa-sm text-white-50"></i>Rincian</a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              </div>
              <div id="menu3" class="container tab-pane fade"><br>
              <div class="table-responsive">
              <table class="table display table-bordered" id="tableKeamananPakai" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Bulan</th>
                      <th>Lihat</th>
                    </tr>
                  </thead>

                  <tbody>
                  @foreach($dataset as $d)
                    <tr>
                      <td class="text-center" <?php $bulan = date("M Y", strtotime($d->BLN_TAGIHAN)); ?>>{{$bulan}}</td>
                      <td class="text-center">
                          <a href="{{url('print/rekapkeamanan',[$d->BLN_TAGIHAN])}}" target="_blank" class="d-none d-sm-inline-block btn btn-primary btn-sm shadow-sm"><i
                            class="fas fa- fa-sm text-white-50"></i>Rekap</a>
                          <a href="{{url('print/rinciankeamanan',[$d->BLN_TAGIHAN])}}" target="_blank" class="d-none d-sm-inline-block btn btn-primary btn-sm shadow-sm"><i
                            class="fas fa- fa-sm text-white-50"></i>Rincian</a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              </div>
          </div>
          </div>
          </div>
        </div>
        <!-- /.container-fluid -->
        </div>
      </div>
      <!-- End of Main Content -->

@endsection