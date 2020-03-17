@extends('admin.layout')
@section('content')
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Laporan Tunggakan</h1>
          </div>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Tabel Laporan Tunggakan</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table display table-bordered" id="tableTunggakan" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Status</th>
                      <th>Tgl Tagihan</th>
                      <th>Jatuh Tempo</th>
                      <th>Kode Kontrol</th>
                      <th>Nama Nasabah</th>
                      <th>Tunggakan (Rp.)</th>
                      <th>Denda (Rp.)</th>
                      <th>Ket</th>
                    </tr>
                  </thead>

                  <tbody>
                  @foreach($dataset as $d)
                    <tr>
                    <td class="text-center"
                      <?php if($d->STT_LUNAS==0){ ?> style="color:red;" <?php } ?>
                      <?php if($d->STT_LUNAS==1){ ?> style="color:green;" <?php } ?>>
                      @if($d->STT_LUNAS == 1)
                        Lunas
                      @else
                        Belum Lunas
                      @endif
                      </td>
                      <td class="text-center">{{$d->TGL_TAGIHAN}}</td>
                      <td class="text-center">{{$d->EXPIRED}}</td>
                      <td class="text-center">{{$d->KD_KONTROL}}</td>
                      <td class="text-left">{{$d->NM_NASABAH}}</td>
                      <td>{{number_format($d->SELISIH)}}</td>
                      <td>
                      @if($d->DENDA == NULL)
                        0
                      @else
                        {{number_format($d->DENDA)}}
                      @endif
                      </td>
                      <td class="text-center" <?php if($d->STT_DENDA==4){ ?> style="color:red;" <?php } ?>>
                      @if($d->STT_DENDA == 4)
                        Bongkar
                      @else
                        &mdash;
                      @endif
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