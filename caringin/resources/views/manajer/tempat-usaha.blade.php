@extends('manajer.layout')
@section('content')
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tempat Usaha</h1>
          </div>

          <!-- Data LAPORAN -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="h-3 m-0 font-weight-bold text-primary">Tabel Tempat Usaha</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table display table-bordered" id="tablePenerimaan" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th rowspan="2">Blok</th>
                      <th rowspan="2">Total Unit</th>
                      <th colspan="4">Pengguna</th>
                    </tr>
                    <tr>
                      <th>Listrik</th>
                      <th>Air</th>
                      <th>Kebersihan</th>
                      <th>Keamanan</th>
                    </tr>
                  </thead>

                  <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <!-- End Tables -->
          </div>
          <!-- END Data LAPORAN -->
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

@endsection