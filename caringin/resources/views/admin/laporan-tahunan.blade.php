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
              <label for="">Tahun</label>
              <input type="text" class="date-own form-control" style="width: 20%;">
              <script>
              $('.date-own').datepicker({
                minViewMode:2,
                format: 'yyyy'
              });
              </script>
              <div class="form-group">
                <label for="sel1">Tampilkan Data :</label>
                <select class="form-control" id="sel1">
                  <option>Pilih Data</option>
                  <option value="air">Air Bersih</option>
                  <option value="listrik">Listrik</option>
                  <option value="keamanan">IPK & Keamanan</option>
                  <option value="kebersihan">Kebersihan</option>
                </select>

              </div>
            </div>
            <!--AIR BERSIH-->
            <div class="air box card-body">
              <div class="table-responsive">
                <table class="table display table-bordered" id="tableAir" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Tahun</th>
                      <th>Blok</th>
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
                      <td class="text-center">A-1</td>
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
            <!--LISTRIK-->
            <div class="listrik box card-body">
              <div class="table-responsive">
                <table class="table display table-bordered" id="tableListrik" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Tahun</th>
                      <th>Blok</th>
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
                      <td class="text-center">A-1</td>
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
            <!--KEAMANAN-->
            <div class="keamanan box card-body">
              <div class="table-responsive">
                <table class="table display table-bordered" id="tableKeamanan" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Tahun</th>
                      <th>Blok</th>
                      <th>Total Tagihan</th>
                      <th>Realisasi</th>
                      <th>Selisih</th>
                    </tr>
                  </thead>
                  
                  <tbody>
                    <tr>
                      <td class="text-center">2019</td>
                      <td class="text-center">A-1</td>
                      <td>15,100,000</td>
                      <td>13,100,000</td>
                      <td>2,000,000</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <!--KEBERSIHAN-->
            <div class="kebersihan box card-body">
              <div class="table-responsive">
                <table class="table display table-bordered" id="tableKebersihan" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Tahun</th>
                      <th>Blok</th>
                      <th>Total Tagihan</th>
                      <th>Realisasi</th>
                      <th>Selisih</th>
                    </tr>
                  </thead>
                
                  <tbody>
                    <tr>
                      <td class="text-center">2019</td>
                      <td class="text-center">A-1</td>
                      <td>11,130,000</td>
                      <td>8,785,000</td>
                      <td>2,345,000</td>
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

  <!-- Selection Menu Scripts (Levind) -->
  <script>
    $(document).ready(function(){
        $("select").change(function(){
            $(this).find("option:selected").each(function(){
                var optionValue = $(this).attr("value");
                if(optionValue){
                    $(".box").not("." + optionValue).hide();
                    $("." + optionValue).show();
                } else{
                    $(".box").hide();
                }
            });
        }).change();
    });
  </script>

  <!-- Scroll Table -->
  <script>
    $(document).ready(function () {
      $('#tableAir').DataTable({
        "scrollX": true
      });
    });
  </script>

  <script>
    $(document).ready(function () {
      $('#tableListrik').DataTable({
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
