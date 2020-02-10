@extends('admin.layout')
@section('content')

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Data Tempat Usaha</h1>
          </div>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Tabel Tempat Usaha</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="tableTempat" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Kode Kontrol</th>
                      <th>Nama Nasabah</th>
                      <th>No. Los</th>
                      <th>Jumlah Unit</th>
                      <th>Bentuk Usaha</th>
                      <th>No. Meter Listrik</th>
                      <th>No. Meter Air</th>
                      <th>Tarif IPK</th>
                      <th>Tarif Keamanan</th>
                      <th>Tarif Kebersihan</th>
                      <th>Action</th>
                    </tr>
                  </thead>

                  <tbody>
                    <tr>
                      <td class="text-left">A-1-001</td>
                      <td class="text-left">Fahni Amsyari</td>
                      <td class="text-center">3 - 4</td>
                      <td class="text-center">2</td>
                      <td class="text-left">Pedagang Kasur</td>
                      <td class="text-center">1238242947</td>
                      <td class="text-center">32749872947</td>
                      <td>50000</td>
                      <td>100000</td>
                      <td>120000</td>
                      <td class="text-center">
                        <a href="updatetempat" class="d-none d-sm-inline-block btn btn-primary shadow-sm"><i
                            class="fas fa- fa-sm text-white-50"></i>Update</a>
                      </td>
                    </tr>
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

@section('js')
    <script>
    $(document).ready(function () {
      $('#tableTempat').DataTable({
        scrollX: true
      });
    });
  </script>
@endsection