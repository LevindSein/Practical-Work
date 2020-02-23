@extends('admin.layout')
@section('content')
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Laporan Harian</h1>
          </div>

          <!-- Data LAPORAN -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="h-3 m-0 font-weight-bold text-primary">Tabel Laporan Harian</h6>
            </div>
            <div class="card-body">
              <label for="">Dari</label>
              <input type="date" name="" id="" class="form-control form-control-user" style="width:20%">
              <br>
              <label for="">Sampai</label>
              <input type="date" name="" id="" class="form-control form-control-user" style="width:20%">
              <br><a href="#" type="submit" class="btn btn-primary btn-sm">Submit</a><p>
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
                      <th rowspan="2">Tanggal</th>
                      <th rowspan="2">Kode</th>
                      <th rowspan="2">Nama Nasabah</th>
                      <th rowspan="2">M.Lalu</th>
                      <th rowspan="2">M.baru</th>
                      <th rowspan="2">Pakai</th>
                      <th rowspan="2">B.Pemakaian</th>
                      <th rowspan="2">B.Beban</th>
                      <th rowspan="2">B.Pemeliharaan</th>
                      <th rowspan="2">B.Air Kotor</th>
                      <th rowspan="2">Pembayaran</th>
                      <th colspan="2">Realisasi</th>
                    </tr>
                    <tr style="display:none">
                      <th></th>
                      <th></th>
                    </tr>
                  </thead>

                  <tbody>
                    <tr>
                      <td class="text-center">2020-01-15</td>
                      <td class="text-left">A-2-003</td>
                      <td class="text-left">fahni amsyari</td>
                      <td>996</td>
                      <td>1,006</td>
                      <td>10</td>
                      <td>60,000</td>
                      <td>22,700</td>
                      <td>10,000</td>
                      <td>18,000</td>
                      <td>121,782</td>
                      <td>&nbsp</td>
                      <td>&nbsp</td>
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
                      <th rowspan="2">Tanggal</th>
                      <th rowspan="2">Kode</th>
                      <th rowspan="2">Nama Nasabah</th>
                      <th rowspan="2">Daya</th>
                      <th rowspan="2">M.Lalu</th>
                      <th rowspan="2">M.baru</th>
                      <th rowspan="2">Pakai</th>
                      <th rowspan="2">Rek.Min</th>
                      <th rowspan="2">B.Blok 1</th>
                      <th rowspan="2">B.Blok 2</th>
                      <th rowspan="2">B.Beban</th>
                      <th rowspan="2">BPJU</th>
                      <th rowspan="2">Pembayaran</th>
                      <th colspan="2">Realisasi</th>
                    </tr>
                    <tr style="display:none">
                      <th></th>
                      <th></th>
                    </tr>
                  </thead>

                  <tbody>
                    <tr>
                      <td class="text-center">2020-01-15</td>
                      <td class="text-left">A-2-003</td>
                      <td class="text-left">PT.LPP</td>
                      <td>2,200</td>
                      <td>89,788</td>
                      <td>90,383</td>
                      <td>595</td>
                      <td>0</td>
                      <td>53,440</td>
                      <td>1,334,220</td>
                      <td>77,000</td>
                      <td>146,466</td>
                      <td>1,820,572</td>
                      <td>&nbsp</td>
                      <td>&nbsp</td>
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
                      <th>Blok</th>
                      <th>Nama Nasabah</th>
                      <th>Alamat</th>
                      <th>Jumlah Unit</th>
                      <th>Besar Tagihan</th>
                      <th>Realisasi</th>
                      <th>Selisih</th>
                    </tr>
                  </thead>
                 
                  <tbody>
                    <tr>
                      <td class="text-center">2020-01-15</td>
                      <td class="text-center">A-1</td>
                      <td class="text-left">BTPN</td>
                      <td class="text-center">8</td>
                      <td class="text-center">1</td>
                      <td>200,000</td>
                      <td>120,000</td>
                      <td>80,000</td>
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
                      <th>Blok</th>
                      <th>Nama Nasabah</th>
                      <th>Alamat</th>
                      <th>Jumlah Unit</th>
                      <th>Besar Tagihan</th>
                      <th>Realisasi</th>
                      <th>Selisih</th>
                    </tr>
                  </thead>
                 
                  <tbody>
                    <tr>
                      <td class="text-center">2020-01-15</td>
                      <td class="text-center">A-1</td>
                      <td class="text-left">PT.BTN</td>
                      <td class="text-center">1</td>
                      <td class="text-center">1</td>
                      <td>120,000</td>
                      <td>120,000</td>
                      <td>&mdash;</td>
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