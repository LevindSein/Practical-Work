@extends('admin.layout')
@section('content')
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tagihan Nasabah</h1>
          </div>

          <!-- Data LAPORAN -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="h-3 m-0 font-weight-bold text-primary">Tabel Tagihan Nasabah</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table display table-bordered" id="tableTagihan" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Status</th>
                      <th>Tanggal</th>
                      <th>Kode Kontrol</th>
                      <th>Nama Nasabah</th>
                      <th>Pakai Air (M<sup>3</sup>)</th>
                      <th>Pakai Listrik (Watt)</th>
                      <th>Tagihan Air</th>
                      <th>Tagihan Listrik</th>
                      <th>Tagihan IPK & Keamanan</th>
                      <th>Tagihan Kebersihan</th>
                      <th>Total Tagihan</th>
                      <th>Realisasi</th>
                      <th>Selisih</th>
                      <th>Bayar</th>
                    </tr>
                  </thead>

                  <tbody>
                    <tr>
                      <td class="text-center">False</td>
                      <td class="text-center">2020-01-15</td>
                      <td class="text-left">A-1-001</td>
                      <td class="text-left">PT.BTN</td>
                      <td>120</td>
                      <td>200</td>
                      <td>120,000</td>
                      <td>120,000</td>
                      <td>200,000</td>
                      <td>140,000</td>
                      <td>500,000</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td class="text-center">
                          <a href="bayartagihan" class="d-none d-sm-inline-block btn btn-primary btn-sm shadow-sm"><i
                            class="fas fa- fa-sm text-white-50"></i>Bayar</a>
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