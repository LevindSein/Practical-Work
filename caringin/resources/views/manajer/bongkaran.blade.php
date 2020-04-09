@extends('manajer.layout')
@section('content')

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Bongkaran</h1>
          </div>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
              <h6 class="m-0 font-weight-bold text-primary">Tabel Bongkaran</h6>
              <a href="print/bongkaran/manajer" target="_blank" type="submit" class="btn btn-primary"><i class="fas fa-download"></i> Rekap</a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="tableBongkaran" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Tanggal Tagihan</th>
                      <th>Kode Kontrol</th>
                      <th>Pengguna</th>
                      <th>Waktu</th>
                      <th>Jumlah Tunggakan</th>
                    </tr>
                  </thead>
                  
                  <tbody>
                  @foreach($dataset as $d)
                    <tr>
                      <td class="text-center">{{$d->TGL_TAGIHAN}}</td>
                      <td class="text-center"
                      <?php if($d->STT_DENDA==3){ ?> style="color:#FFD700;" <?php } ?>
                      <?php if($d->STT_DENDA>3){ ?> style="color:red;" <?php } ?>>
                      {{$d->KD_KONTROL}}</td>
                      <td class="text-left">{{$d->NM_NASABAH}}</td>
                      <td class="text-center">{{$d->STT_DENDA}} Bulan</td>
                      <td>Rp. {{number_format($d->SELISIH + $d->DENDA)}}</td>
                      </td>
                    </tr>
                  @endforeach
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