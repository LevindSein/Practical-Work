@extends('admin.layout')
@section('content')

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Laporan Tahunan</h1>
          </div>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Tabel Laporan Tahunan</h6>
            </div>
            <div class="card-body">
              <div class="form-group">
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
                      <th>Tahun</th>
                      <th>Bulan</th>
                      <th>Vol.Pakai (M<sup>3</sup>)</th>
                      <th>B.Beban</th>
                      <th>B.Pemeliharaan</th>
                      <th>Air Kotor</th>
                      <th>Pembayaran</th>
                      <th>Realisasi</th>
                      <th>Selisih</th>
                    </tr>
                  </thead>

                  <tbody>
                    <tr>
                      <td class="text-center">2019</td>
                      <td class="text-center">Januari</td>
                      <td>5,714</td>
                      <td>7,513,000</td>
                      <td>3,310,000</td>
                      <td>10,285,200</td>
                      <td>60,938,312</td>
                      <td>58,938,312</td>
                      <td>2,000,000</td>
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
                      <th>Tahun</th>
                      <th>Bulan</th>
                      <th>Daya Pakai (kWh)</th>
                      <th>Biaya Pemakaian</th>
                      <th>BPJU</th>
                      <th>Pembayaran</th>
                      <th>Realisasi</th>
                      <th>Selisih</th>
                    </tr>
                  </thead>
                 
                  <tbody>
                    <tr>
                      <td class="text-center">2019</td>
                      <td class="text-center">Januari</td>
                      <td>220,412</td>
                      <td>39,637,150</td>
                      <td>55,181,190</td>
                      <td>685,901,814</td>
                      <td>680,901,814</td>
                      <td>5,000,000</td>
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
                      <th>Tahun</th>
                      <th>Bulan</th>
                      <th>Total Tagihan</th>
                      <th>Realisasi</th>
                      <th>Selisih</th>
                    </tr>
                  </thead>
                  
                  <tbody>
                    <tr>
                      <td class="text-center">2019</td>
                      <td class="text-center">Januari</td>
                      <td>15,100,000</td>
                      <td>13,100,000</td>
                      <td>2,000,000</td>
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
                      <th>Tahun</th>
                      <th>Bulan</th>
                      <th>Total Tagihan</th>
                      <th>Realisasi</th>
                      <th>Selisih</th>
                    </tr>
                  </thead>
                
                  <tbody>
                    <tr>
                      <td class="text-center">2019</td>
                      <td class="text-center">Januari</td>
                      <td>11,130,000</td>
                      <td>8,785,000</td>
                      <td>2,345,000</td>
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