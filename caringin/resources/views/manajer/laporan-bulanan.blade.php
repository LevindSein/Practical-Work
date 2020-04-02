@extends('manajer.layout')
@section('content')
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Pendapatan Bulanan</h1>
          </div>

          <!-- Data LAPORAN -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="h-3 m-0 font-weight-bold text-primary">Tabel Pendapatan</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table display table-bordered" id="tablePenerimaan" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Bulan</th>
                      <th>Lihat</th>
                    </tr>
                  </thead>

                  <tbody>
                  @foreach($dataset as $d)
                  @if($d->STT_BAYAR == 1)
                    <tr>
                      <td class="text-center" <?php $bulan = date("M Y", strtotime($d->BLN_BAYAR)); ?>>{{$bulan}}</td>
                      <td class="text-center">
                          <a href="{{url('print/bulanan/manajer',[$d->BLN_BAYAR])}}" target="_blank" class="d-none d-sm-inline-block btn btn-primary btn-sm shadow-sm"><i
                            class="fas fa- fa-sm text-white-50"></i>Rekap</a>
                          <a href="{{url('print/rincian/manajer',[$d->BLN_BAYAR])}}" target="_blank" class="d-none d-sm-inline-block btn btn-primary btn-sm shadow-sm"><i
                            class="fas fa- fa-sm text-white-50"></i>Rincian</a>
                      </td>
                    </tr>
                    @endif
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