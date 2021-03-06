@extends('admin.layout')
@section('content')

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Laporan Bongkaran</h1>
          </div>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Tabel Laporan Bongkaran</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Tanggal Tagihan</th>
                      <th>Kode Kontrol</th>
                      <th>Pengguna</th>
                      <th>Surat Peringatan</th>
                      <th>Perintah</th>
                    </tr>
                  </thead>
                  
                  <tbody>
                  @foreach($dataset as $d)
                    <tr>
                      <td class="text-center">{{$d->TGL_TAGIHAN}}</td>
                      <td class="text-center">{{$d->KD_KONTROL}}</td>
                      <td class="text-left">{{$d->NM_NASABAH}}</td>
                      <td class="text-center">
                      <a href="{{url('printperingatan/'.$d->ID_TEMPAT.'/'.$d->SELISIH_AIR.'/'.$d->SELISIH_LISTRIK.'/'.$d->SELISIH_IPKEAMANAN.'/'.$d->SELISIH_KEBERSIHAN.'/'.$d->DENDA_AIR.'/'.$d->DENDA_LISTRIK.'/'.$d->EXPIRED.'/'.$d->TGL_TAGIHAN)}}" class="d-none d-sm-inline-block btn btn-primary btn-sm shadow-sm"><i
                            class="fas fa- fa-sm text-white-50"></i>Print</a>
                      </td>
                      <td class="text-center">@if($d->STT_DENDA == 4)
                      <a href="{{url('bongkaralat/'.$d->ID_TEMPAT.'/'.$d->SELISIH_AIR.'/'.$d->SELISIH_LISTRIK.'/'.$d->SELISIH_IPKEAMANAN.'/'.$d->SELISIH_KEBERSIHAN.'/'.$d->DENDA_AIR.'/'.$d->DENDA_LISTRIK)}}" class="d-none d-sm-inline-block btn btn-primary btn-sm shadow-sm"><i
                            class="fas fa- fa-sm text-white-50"></i>Bongkar</a>
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