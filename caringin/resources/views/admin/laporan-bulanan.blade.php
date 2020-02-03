@extends('admin.layout')
@section('content')
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Laporan Bulanan</h1>
          </div>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Tabel Laporan Bulanan</h6>
            </div>
            <div class="card-body">
              <label for="">Filter Bulan</label>
              <input type="month" name="" id="">
              <div class="form-group">
                <label for="sel1">Tampilkan Data :</label>
                <select class="form-control" id="table" name="table">
                  <option value="Pilih">Pilih Data</option>
                  <option value="Air">Air Bersih</option>
                  <option value="Listrik">Listrik</option>
                  <option value="Keamanan">IPK & Keamanan</option>
                  <option value="Kebersihan">Kebersihan</option>
                </select>
                
              </div>
            </div>
            <!--AIR BERSIH-->
            <div class="card-body" id="tAir">
              <div class="table-responsive">
                <table class="table display table-bordered" id="tableAir" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th rowspan="2">Tanggal</th>
                      <th rowspan="2">Kode</th>
                      <th rowspan="2">Nama Pemilik</th>
                      <th rowspan="2">No.Los</th>
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
                      <td class="text-left">PT.LPP</td>
                      <td class="text-center">3</td>
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
            <!--LISTRIK-->
            <div class="card-body" id="tListrik">
              <div class="table-responsive">
                <table class="table display table-bordered" id="tableListrik" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th rowspan="2">Tanggal</th>
                      <th rowspan="2">Kode</th>
                      <th rowspan="2">Nama Pemilik</th>
                      <th rowspan="2">No.Los</th>
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
                      <td class="text-center">3</td>
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
            <!--KEAMANAN-->
            <div class="card-body" id="tKeamanan">
              <div class="table-responsive">
                <table class="table display table-bordered" id="tableKeamanan" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Tanggal</th>
                      <th>Blok</th>
                      <th>Nama</th>
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
            <!--KEBERSIHAN-->
            <div class="card-body" id="tKebersihan">
              <div class="table-responsive">
                <table class="table display table-bordered" id="tableKebersihan" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Tanggal</th>
                      <th>Blok</th>
                      <th>Nama</th>
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
            <!-- End Tables -->
          </div>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
@endsection

@section('js')
  <!-- Selection Menu Scripts -->
  <script>
    $('#tAir,#tListrik,#tKeamanan,#tKebersihan').hide();
    $('#table').change(function() {
    $('#tAir,#tListrik,#tKeamanan,#tKebersihan').hide();
    $('#t' + $(this).val()).show();
    });
  </script>

  <!-- Scroll Table -->
  <script>
    $(document).ready(function () {
      $('#tableAir,#tableListrik,#tableKeamanan,#tableKebersihan').DataTable({
        "scrollX": true
      });
    });
  </script>
  <!-- End Scroll Table -->

  <!-- Multiple Datatable Scripts (Levind) -->
  <script>
	  $(document).ready(function() {
      $('table.display').DataTable();
	  } );
	</script>
@endsection