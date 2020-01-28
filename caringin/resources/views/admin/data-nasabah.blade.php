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
                <select class="form-control" id="sel1">
                  <option>Pilih Data</option>
                  <option value="air">Air Bersih</option>
                  <option value="listrik">Listrik</option>
                  <option value="keamanan">IPK & Keamanan</option>
                  <option value="kebersihan">Kebersihan</option>
                </select>
              </div>
            <!--AIR BERSIH-->
            <div class="air box card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="tableAirNasabah" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Tanggal</th>
                      <th>No. Kontrol</th>
                      <th>Nama</th>
                      <th>No. Los</th>
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
                      <td class="text-left">Said</td>
                      <td class="text-center">1</td>
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
            <!--LISTRIK-->
            <div class="listrik box card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="tableListrikNasabah" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Tanggal</th>
                      <th>No. Kontrol</th>
                      <th>Nama</th>
                      <th>No. Los</th>
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
            <!--KEAMANAN-->
            <div class="keamanan box card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="tableKeamananNasabah" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Tanggal</th>
                      <th>No. Kontrol</th>
                      <th>Nama</th>
                      <th>No. Los</th>
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
                      <td class="text-left">Said</td>
                      <td class="text-center">1</td>
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
            <!--KEBERSIHAN-->
            <div class="kebersihan box card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="tableKebersihanNasabah" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Tanggal</th>
                      <th>No. Kontrol</th>
                      <th>Nama</th>
                      <th>No. Los</th>
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
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

@endsection

@section('js')
  <!-- Selection Menu Scripts (Levind) -->
  <script>
    $(document).ready(function () {
      $("select").change(function () {
        $(this).find("option:selected").each(function () {
          var optionValue = $(this).attr("value");
          if (optionValue) {
            $(".box").not("." + optionValue).hide();
            $("." + optionValue).show();
          } else {
            $(".box").hide();
          }
        });
      }).change();
    });
  </script>

  <!-- Scroll Table -->
  <script>
    $(document).ready(function () {
      $('#tableAirNasabah').DataTable({
        "scrollX": true
      });
    });
  </script>

  <script>
    $(document).ready(function () {
      $('#tableListrikNasabah').DataTable({
        "scrollX": true
      });
    });
  </script>

  <script>
    $(document).ready(function () {
      $('#tableKeamananNasabah').DataTable({
        "scrollX": true
      });
    });
  </script>

  <script>
    $(document).ready(function () {
      $('#tableKebersihanNasabah').DataTable({
        "scrollX": true
      });
    });
  </script>
  <!-- End Scroll Table -->

  <!-- Multiple Datatable Scripts -->
  <script>
    $(document).ready(function () {
      $('table.display').DataTable();
    });
  </script>
@endsection

