@extends('keuangan.layout')
@section('content')
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Pendapatan Tahunan</h1>
          </div>

          <!-- Data LAPORAN -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="h-3 m-0 font-weight-bold text-primary">Tabel Pendapatan</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table display table-bordered" id="tablePenerimaan" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Tahun</th>
                      <th>Action</th>
                    </tr>
                  </thead>

                  <tbody>
                    <tr>
                      <td class="text-center">2020</td>
                      <td class="text-center">
                          <a href="{{url('print/tahunan/keuangan')}}" target="_blank" class="d-none d-sm-inline-block btn btn-primary btn-sm shadow-sm"><i
                            class="fas fa- fa-sm text-white-50"></i>Print</a>
                      </td>
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