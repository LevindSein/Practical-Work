@extends('kasir.layout')
@section('content')

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tagihan Nasabah</h1>
          </div>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
              <h6 class="m-0 font-weight-bold text-primary">Tabel Nasabah</h6>
            </div>
            <div class="card-body">
            <div class="form-group">
                <label for="sel1">Tampilkan Data :</label>
                <ul class="nav nav-tabs" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#home">by PENGGUNA</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu1">by KONTROL</a>
                  </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                  <div id="home" class="container tab-pane active"><br>
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable1" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Pengguna</th>
                      <th>No.Anggota</th>
                      <th>No.KTP</th>
                      <th>No.NPWP</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($datanas as $data)
                    <tr>
                      <td class="text-left">{{$data->NM_NASABAH}}</td>
                      <td class="text-center">{{$data->NO_ANGGOTA}}</td>
                      <td class="text-center">{{$data->NO_KTP}}</td>
                      <td class="text-center">{{$data->NO_NPWP}}</td>
                      <td class="text-center">
                        <a href="{{url('all/datatagihankasir',[$data->ID_NASABAH])}}" class="d-none d-sm-inline-block btn btn-primary btn-sm shadow-sm"><i
                            class="fas fa- fa-sm text-white-50"></i>Lihat</a>
                      </td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
              </div>
              <div id="menu1" class="container tab-pane fade"><br>
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Kode</th>
                      <th>Pengguna</th>
                      <th>No.Anggota</th>
                      <th>No.KTP</th>
                      <th>No.NPWP</th>
                      <th>Action</th>
                    </tr>
                  </thead>

                  <tbody>
                  @foreach($dataset as $data)
                    <tr>
                    <td class="text-left">{{$data->KD_KONTROL}}</td>
                      <td class="text-left">{{$data->NM_NASABAH}}</td>
                      <td class="text-center">{{$data->NO_ANGGOTA}}</td>
                      <td class="text-center">{{$data->NO_KTP}}</td>
                      <td class="text-center">{{$data->NO_NPWP}}</td>
                      <td class="text-center">
                        <a href="{{url('datatagihankasir',[$data->ID_TEMPAT])}}" class="d-none d-sm-inline-block btn btn-primary btn-sm shadow-sm"><i
                            class="fas fa- fa-sm text-white-50"></i>Lihat</a>
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