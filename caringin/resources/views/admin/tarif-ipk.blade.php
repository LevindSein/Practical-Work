@extends('admin.layout')
@section('content')

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tarif IPK</h1>
          </div>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
              <h6 class="m-0 font-weight-bold text-primary">Kategori Tarif</h6>

              <!--Tambah Kategori-->
              <a href="tambahipk" type="submit" class="btn btn-primary">Tambah Kategori</a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Kategori</th>
                      <th>Tarif (Unit)</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($dataset as $data)
                    <tr>
                      <td class="text-center">{{$data->ID_TRFIPK}}</td>
                      <td>{{number_format($data->TRF_IPK)}}</td>
                      <td class="text-center">
                        <a href="{{url('updateipk',[$data->ID_TRFIPK])}}" class="d-none d-sm-inline-block btn btn-primary btn-sm shadow-sm"><i
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