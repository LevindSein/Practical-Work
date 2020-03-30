@extends('kasir.layout')
@section('content')
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Checkout Tagihan</h1>
          </div>

          <!-- Data LAPORAN -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="h-3 m-0 font-weight-bold text-primary">{{$dataku->NM_NASABAH}} {{$dataku->NO_ANGGOTA}}</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table display table-bordered" id="tableTagihanAll" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Bayar</th>
                      <th>Faktur</th>
                      <th>Tagihan Air</th>
                      <th>Denda Air</th>
                      <th>T agihan Listrik</th>
                      <th>Denda Listrik</th>
                      <th>Tagihan IPK & Keamanan</th>
                      <th>Tagihan Kebersihan</th>
                      <th>Total Tagihan</th>
                    </tr>
                  </thead>

                  <tbody>
                  @foreach($dataset as $d)
                    <tr>
                      <td class="text-center">
                          <a href="#" class="d-none d-sm-inline-block btn btn-primary btn-sm shadow-sm"><i
                            class="fas fa- fa-sm text-white-50"></i>Bayar</a>
                      </td>
                      <td class="text-center">
                          <a href="{{url('all/printfaktur',[$dataku->ID_NASABAH])}}" target="_blank" class="d-none d-sm-inline-block btn btn-primary btn-sm shadow-sm"><i
                            class="fas fa- fa-sm text-white-50"></i>Print</a>
                      </td>
                      <td>{{number_format($d->ttlAir)}}</td>
                      <td>{{number_format($d->dendaAir)}}</td>
                      <td>{{number_format($d->ttlListrik)}}</td>
                      <td>{{number_format($d->dendaListrik)}}</td>
                      <td>{{number_format($d->ttlIpkeamanan)}}</td>
                      <td>{{number_format($d->ttlKebersihan)}}</td>
                      <td>{{number_format($d->ttlTagihan)}}</td>
                      
                    </tr>
                  @endforeach
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

@section('js')
<script>
$(document).ready(function () {
  $(
      '#tableTagihanAll'
    ).DataTable({
      "processing": true,
      "bProcessing":true,
      "language": {
        'loadingRecords': '&nbsp;',
        'processing': '<i class="fas fa-spinner"></i>'
      },
      "scrollX": true,
      "scrollY": "400px",
      "scrollCollapse": true,
      "bSortable": false,
      "deferRender": true,
      "paging":false
    });
  });
</script>
@endsection