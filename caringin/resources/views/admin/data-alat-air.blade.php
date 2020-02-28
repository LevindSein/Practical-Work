@extends('admin.layout')
@section('content')

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Data Alat Air</h1>
          </div>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Tabel Data Alat</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataNasabah" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>ID Alat</th>
                      <th>Nomor Alat</th>
                      <th>Meter Akhir</th>
                      <th>Action</th>
                    </tr>
                  </thead>

                  <tbody>
                  @foreach($dataset as $data)
                    <tr>
                      <td class="text-center">{{$data->ID_MAIR}}</td>
                      <td class="text-center">
                      @if($data->NOMTR_AIR == null)
                          0
                      @else
                          {{$data->NOMTR_AIR}}
                      @endif
                      </td>
                      <td class="text-center">{{$data->MAKHIR_AIR}}</td>
                      <td class="text-center">
                        <a href="{{url('updatealatair',[$data->ID_MAIR])}}" class="d-none d-sm-inline-block btn btn-primary btn-sm shadow-sm"><i
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