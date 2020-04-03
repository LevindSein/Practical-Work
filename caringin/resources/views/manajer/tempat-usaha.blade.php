@extends('manajer.layout')
@section('content')
<?php
$ttl_Blok = 0;
$ttl_Listrik = 0;
$ttl_Air = 0;
$ttl_Keamanan = 0;
$ttl_Kebersihan = 0;

for($i=0;$i<$ttlBlok;$i++){
  $ttl_Blok = $ttl_Blok + $Blokku[$i];
  $ttl_Listrik = $ttl_Listrik + $Listrik[$i];
  $ttl_Air = $ttl_Air + $Air[$i];
  $ttl_Keamanan = $ttl_Keamanan + $Keamanan[$i];
  $ttl_Kebersihan = $ttl_Kebersihan + $Kebersihan[$i];
}
?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tempat Usaha</h1>
          </div>

          <!-- Data LAPORAN -->
          <div class="card shadow mb-4">
            <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
              <h6 class="h-3 m-0 font-weight-bold text-primary">Tabel Tempat Usaha</h6>
              <a href="print/tempat/manajer" target="_blank" type="submit" class="btn btn-primary">Generate Report</a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table display table-bordered" id="tableTempat" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th rowspan="2">Blok</th>
                      <th rowspan="2">Jumlah Unit</th>
                      <th colspan="4">Pengguna</th>
                    </tr>
                    <tr>
                      <th>Listrik</th>
                      <th>Air</th>
                      <th>Kebersihan</th>
                      <th>Keamanan</th>
                    </tr>
                  </thead>

                  <tbody>
                  @for($i = 0; $i < $ttlBlok; $i++)
                    <tr>
                        <td class="text-center" <?php $bloks=$blok[$i]?>>{{$bloks->BLOK}}</td>
                        <td>{{number_format($Blokku[$i])}}</td>
                        <td>{{number_format($Listrik[$i])}}</td>
                        <td>{{number_format($Air[$i])}}</td>
                        <td>{{number_format($Kebersihan[$i])}}</td>
                        <td>{{number_format($Keamanan[$i])}}</td>
                    </tr>
                  @endfor
                  </tbody>
                  <tfoot>
                      <tr>
                        <td style="font-weight: bold;" class="text-center">Total</td>
                        <td style="font-weight: bold;">{{number_format($ttl_Blok)}}</td>
                        <td style="font-weight: bold;">{{number_format($ttl_Listrik)}}</td>
                        <td style="font-weight: bold;">{{number_format($ttl_Air)}}</td>
                        <td style="font-weight: bold;">{{number_format($ttl_Kebersihan)}}</td>
                        <td style="font-weight: bold;">{{number_format($ttl_Keamanan)}}</td>
                      </tr>
                  <t/foot>
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

@section('js')
<script>
$(document).ready(function () {
  $(
    '#tableTempat'
    ).DataTable({
      "processing": true,
      "bProcessing":true,
      "language": {
        'loadingRecords': '&nbsp;',
        'processing': '<i class="fas fa-spinner"></i>'
        },
        "scrollX": true,
        "scrollY": "300px",
        "scrollCollapse": true,
        "paging": false,
        "bSortable": false,
        "deferRender": true
        });
    });
</script>
@endsection