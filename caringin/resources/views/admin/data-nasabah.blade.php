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
              <h6 class="h-3 m-0 font-weight-bold text-primary">Tabel Data Nasabah</h6>
            </div>
            <div class="card-body">
              <div class="form-group">
                <!--Option Menu-->
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
                      <th>Tanggal</th>
                      <th>Kode Kontrol</th>
                      <th>Nama</th>
                      <th>No. Los</th>
                      <th>Status</th>
                      <th>KTP</th>
                      <th>NPWP</th>
                      <th>No. Meter</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="text-center">2020-12-01</td>
                      <td class="text-center">A-1-001</td>
                      <td class="text-left">Said Marzuqi Irfan Fahni Amsyari</td>
                      <td class="text-center">1</td>
                      <td class="text-center">Pemilik</td>
                      <td class="text-left">32123456789</td>
                      <td class="text-left">998099876</td>
                      <td class="text">10000</td>
                      <td class="text-center">
                        <a href="#" class="d-none d-sm-inline-block btn btn-primary shadow-sm"><i
                            class="fas fa- fa-sm text-white-50"></i> Update</a>
                      </td>
                    </tr>
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
                      <th>Tanggal</th>
                      <th>Kode Kontrol</th>
                      <th>Nama</th>
                      <th>No. Los</th>
                      <th>Status</th>
                      <th>KTP</th>
                      <th>NPWP</th>
                      <th>Daya</th>
                      <th>No. Meter</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="text-center">2020-12-01</td>
                      <td class="text-center">A-1-001</td>
                      <td class="text-left">Said</td>
                      <td class="text-center">1</td>
                      <td class="text-center">Pemilik</td>
                      <td class="text-left">32123456789</td>
                      <td class="text-left">998099876</td>
                      <td class="text">10000</td>
                      <td class="text">10000</td>
                      <td class="text-center">
                        <a href="#" class="d-none d-sm-inline-block btn btn-primary shadow-sm"><i
                            class="fas fa- fa-sm text-white-50"></i> Update</a>
                      </td>
                    </tr>
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
                      <th>Tanggal</th>
                      <th>Kode Kontrol</th>
                      <th>Nama</th>
                      <th>No. Los</th>
                      <th>Status</th>
                      <th>KTP</th>
                      <th>NPWP</th>
                      <th>Tarif IPK</th>
                      <th>Tarif Keamanan</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="text-center">2020-12-01</td>
                      <td class="text-center">A-1-001</td>
                      <td class="text-left">Said Marzuqi Irfan Fahni Amsyari</td>
                      <td class="text-center">1</td>
                      <td class="text-center">Pemilik</td>
                      <td class="text-left">32123456789</td>
                      <td class="text-left">99809987672163131</td>
                      <td class="text">10000</td>
                      <td class="text">10000</td>
                      <td class="text-center">
                        <a href="#" class="d-none d-sm-inline-block btn btn-primary shadow-sm"><i
                            class="fas fa- fa-sm text-white-50"></i> Update</a>
                      </td>
                    </tr>
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
                      <th>Tanggal</th>
                      <th>No. Kontrol</th>
                      <th>Nama</th>
                      <th>No. Los</th>
                      <th>Status</th>
                      <th>KTP</th>
                      <th>NPWP</th>
                      <th>Tarif Kebersihan</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="text-center">2020-12-01</td>
                      <td class="text-center">A-1-001</td>
                      <td class="text-left">Said</td>
                      <td class="text-center">1</td>
                      <td class="text-center">Pemilik</td>
                      <td class="text-left">32123456789</td>
                      <td class="text-left">998099876</td>
                      <td class="text">10000</td>
                      <td class="text-center">
                        <a href="#" class="d-none d-sm-inline-block btn btn-primary shadow-sm"><i
                            class="fas fa- fa-sm text-white-50"></i> Update</a>
                      </td>
                    </tr>
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

@section('js')
  <!--for scrolling table-->
  <script>
    $(document).ready(function () {
      $('#tableAir,#tableListrik,#tableKeamanan,#tableKebersihan').DataTable({
        scrollX: true
      });
    });
  </script>
  <!--for column table toggle-->
  <script>
  $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
   $($.fn.dataTable.tables(true)).DataTable()
      .columns.adjust();
    });
  </script>
@endsection

