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
            <div class="card-header py-3">
              <h6 class="h-3 m-0 font-weight-bold text-primary">Tabel Tempat Usaha</h6>
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
        "dom": "r" + "<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>><'row'<'col-sm-12'tr>><'r" +
                                "ow'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",

                        "buttons": [
                            {
                                text: '<i class="fas fa-file-pdf fa-lg"></i>',
                                extend: 'pdf',
                                className: 'btn btn-danger bg-gradient-danger',
                                title: 'BP3C PDF',
                                exportOptions: {
                                    columns: ':visible(.export-col)'
                                },
                                customize: function (doc) {
                                    doc.pageMargins = [25,25,25,25];
                                    doc.defaultStyle.fontSize = 12;
                                    doc.styles.tableHeader.fontSize = 14;
                                    doc.styles.title.fontSize = 20;
                                }
                            }, {
                                text: '<i class="fas fa-file-excel fa-lg"></i>',
                                extend: 'excel',
                                className: 'btn btn-success bg-gradient-success',
                                title: 'BP3C Excel',
                                exportOptions: {
                                    columns: ':visible(.export-col)'
                                }
                            }, {
                                text: '<i class="fas fa-print fa-lg"></i>',
                                extend: 'print',
                                className: 'btn btn-info bg-gradient-info',
                                title: 'BP3C Print',
                                exportOptions: {
                                    columns: ':visible(.export-col)'
                                },
                            }
                        ],
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