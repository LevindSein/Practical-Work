@extends('admin.layout')
@section('content')

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Laporan Penghapusan</h1>
          </div>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Tabel Laporan Penghapusan</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Tanggal</th>
                      <th>Kode Kontrol</th>
                      <th>Nama Nasabah</th>
                      <th>No.Anggota</th>
                      <th>No.KTP</th>
                      <th>No.NPWP</th>
                      <th>Total Tunggakan</th>
                    </tr>
                  </thead>

                  <tbody>
                    @foreach($dataset as $d)
                    <tr>
                      <td class="text-center">{{$d->TGL_HAPUS}}</td>
                      <td class="text-center">{{$d->KD_KONTROL}}</td>
                      <td class="text-left">{{$d->NAMA}}</td>
                      <td class="text-center">
                      @if($d->NMR_ANGGOTA == null)
                        &mdash;
                      @else
                        {{$d->NMR_ANGGOTA}}
                      @endif
                      </td>
                      <td class="text-center">
                      @if($d->NMR_KTP == null)
                        &mdash;
                      @else
                        {{$d->NMR_KTP}}
                      @endif
                      </td>
                      <td class="text-center">
                      @if($d->NMR_NPWP == null)
                        &mdash;
                      @else
                        {{$d->NMR_NPWP}}
                      @endif
                      </td>
                      <td>{{number_format($d->TTL_TUNGGAKAN)}}</td>
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