@extends('admin.layout')
@section('content')
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Data Tempat Usaha</h1>
          </div>

          <!-- Data LAPORAN -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="h-3 m-0 font-weight-bold text-primary">Tabel Tempat Usaha</h6>
            </div>
            <div class="card-body">
              <div class="form-group">
                <!--Option Menu-->
                <label for="sel1">Tampilkan Data :</label>
                <ul class="nav nav-tabs" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#home">Semua</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu1">Air Bersih</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu2">Listrik</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu3">IPK & Keamanan</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu4">Kebersihan</a>
                  </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                  <!--SEMUA-->
                  <div id="home" class="container tab-pane active"><br>
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
                      <td class="text-center">1 - 2</td>
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
                  <!--END SEMUA-->
                  <!--Air-->
                  <div id="menu1" class="container tab-pane fade"><br>
                  <div class="table-responsive">
                  <table class="table display table-bordered" id="tableAir" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Tanggal</th>
                      <th>Kode Kontrol</th>
                      <th>Nama Nasabah</th>
                      <th>No. Meter Air</th>
                      <th>Bentuk Usaha</th>
                    </tr>
                  </thead>
                 
                  <tbody>
                    <tr>
                      <td class="text-center">2020-01-15</td>
                      <td class="text-center">A-1-001</td>
                      <td class="text-left">Fahni Amsyari</td>
                      <td class="text-center">1324822947</td>
                      <td class="text-left">Pedagang Kasur</td>
                    </tr>
                  </tbody>
                  </table>
                  </div>
                  </div>
                  <!--END Air-->
                  <!--Listrik-->
                  <div id="menu2" class="container tab-pane fade"><br>
                  <div class="table-responsive">
                  <table class="table display table-bordered" id="tableListrik" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Tanggal</th>
                      <th>Kode Kontrol</th>
                      <th>Nama Nasabah</th>
                      <th>No. Meter Listrik</th>
                      <th>Bentuk Usaha</th>
                    </tr>
                  </thead>
                 
                  <tbody>
                    <tr>
                      <td class="text-center">2020-01-15</td>
                      <td class="text-center">A-1-001</td>
                      <td class="text-left">Fahni Amsyari</td>
                      <td class="text-center">214822947</td>
                      <td class="text-left">Pedagang Kasur</td>
                    </tr>
                  </tbody>
                  </table>
                  </div>
                  </div>
                  <!--END Listrik-->
                  <!--Keamanan-->
                  <div id="menu3" class="container tab-pane fade"><br>
                  <div class="table-responsive">
                  <table class="table display table-bordered" id="tableKeamanan" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Tanggal</th>
                      <th>Kode Kontrol</th>
                      <th>Nama Nasabah</th>
                      <th>Tarif IPK</th>
                      <th>Tarif Keamanan</th>
                      <th>Bentuk Usaha</th>
                    </tr>
                  </thead>
                 
                  <tbody>
                    <tr>
                      <td class="text-center">2020-01-15</td>
                      <td class="text-center">A-1-001</td>
                      <td class="text-left">Fahni Amsyari</td>
                      <td>120000</td>
                      <td>100000</td>
                      <td class="text-left">Pedagang Kasur</td>
                    </tr>
                  </tbody>
                  </table>
                  </div>
                  </div>
                  <!--END Keamanan-->
                  <!--Kebersihan-->
                  <div id="menu4" class="container tab-pane fade"><br>
                  <div class="table-responsive">
                  <table class="table display table-bordered" id="tableKebersihan" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Tanggal</th>
                      <th>Kode Kontrol</th>
                      <th>Nama Nasabah</th>
                      <th>Tarif Kebersihan</th>
                      <th>Bentuk Usaha</th>
                    </tr>
                  </thead>
                 
                  <tbody>
                    <tr>
                      <td class="text-center">2020-01-15</td>
                      <td class="text-center">A-1-001</td>
                      <td class="text-left">Fahni Amsyari</td>
                      <td>200000</td>
                      <td class="text-left">Pedagang Kasur</td>
                    </tr>
                  </tbody>
                  </table>
                  </div>
                  </div>
                  <!--END Kebersihan-->
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