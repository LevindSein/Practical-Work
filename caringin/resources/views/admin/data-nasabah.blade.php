@extends('admin.layout')
@section('content')

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Data Nasabah</h1>
          </div>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Tabel Data Nasabah</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataNasabah" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Nama Nasabah</th>
                      <th>No. KTP</th>
                      <th>No. NPWP</th>
                      <th>No. Telp</th>
                      <th>Action</th>
                    </tr>
                  </thead>

                  <tbody>
                  @foreach($dataset as $data)
                    <tr>
                      <td class="text-left">{{$data->NM_NASABAH}}</td>
                      <td class="text-left">{{$data->NO_KTP}}</td>
                      <td class="text-left">{{$data->NO_NPWP}}</td>
                      <td class="text-left">{{$data->NO_TLP}}</td>
                      <td class="text-center">
                        <a href="{{url('updatenasabah',[$data->ID_NASABAH])}}" class="d-none d-sm-inline-block btn btn-primary shadow-sm"><i
                            class="fas fa- fa-sm text-white-50"></i>Update</a>
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