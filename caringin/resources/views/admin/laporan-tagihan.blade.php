@extends('admin.layout')
@section('content')

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Laporan Tagihan</h1>
          </div>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
              <h6 class="m-0 font-weight-bold text-primary">Tabel Laporan Tagihan</h6>
              
              <a href="semuatagihan" type="submit" target="_blank" class="btn btn-primary"><i class="fas fa-download fa-sm text-white-50"></i> Print Tagihan</a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Kode</th>
                      <th>Pemilik</th>
                      <th>Pengguna</th>
                      <th>No.Pengguna</th>
                      <th>No.KTP</th>
                      <th>No.NPWP</th>
                      <th>Action</th>
                    </tr>
                  </thead>

                  <tbody>
                  @foreach($dataset as $data)
                    <tr>
                    <td class="text-left">{{$data->KD_KONTROL}}</td>
                      <td class="text-left">{{$data->NM_PEMILIK}}</td>
                      <td class="text-left">{{$data->NM_NASABAH}}</td>
                      <td class="text-center">{{$data->NO_ANGGOTA}}</td>
                      <td class="text-center">{{$data->NO_KTP}}</td>
                      <td class="text-center">{{$data->NO_NPWP}}</td>
                      <td class="text-center">
                        <a href="{{url('datatagihannasabah',[$data->ID_TEMPAT])}}" class="d-none d-sm-inline-block btn btn-primary btn-sm shadow-sm"><i
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
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

@endsection