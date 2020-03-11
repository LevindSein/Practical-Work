@extends('admin.layout')
@section('content')
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Laporan Harian</h1>
          </div>

          <!-- Data LAPORAN -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="h-3 m-0 font-weight-bold text-primary">Tabel Laporan Harian</h6>
            </div>
            <div class="card-body">
            <form  action="{{url('showlaporanharian/filter')}}" method="GET" id="hari">
            @csrf
              <label for="">Dari</label>
              <input type="date" name="dari" id="" class="form-control form-control-user" style="width:20%">
              <br>
              <label for="">Sampai</label>
              <input type="date" name="sampai" id="" class="form-control form-control-user" style="width:20%">
              <br><button type="submit" class="btn btn-primary btn-sm">Submit</button><p>
            </form>
                  <div class="table-responsive">
                  <table class="table display table-bordered" id="tableAir" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Tanggal</th>
                      <th>Kode</th>
                      <th>Nama Nasabah</th>
                      <th>Air Bersih (Rp.)</th>
                      <th>Listrik (Rp.)</th>
                      <th>IPK & Keamanan(Rp.)</th>
                      <th>Kebersihan(Rp.)</th>
                      <th>Total (Rp.)</th>
                      <th>Realisasi (Rp.)</th>
                      <th>Selisih (Rp.)</th>
                    </tr>
                  </thead>

                  <tbody>
                  @foreach($dataset as $d)
                    <tr>
                      <td class="text-center">{{$d->TGL_BAYAR}}</td>
                      <td class="text-left">{{$d->KD_KONTROL}}</td>
                      <td class="text-left">{{$d->NM_NASABAH}}</td>
                      <td>
                      @if($d->TTL_AIR == null)
                        &mdash;
                      @else
                        {{number_format($d->TTL_AIR)}}
                      @endif
                      </td>
                      <td>
                      @if($d->TTL_LISTRIK == null)
                        &mdash;
                      @else
                        {{number_format($d->TTL_LISTRIK)}}
                      @endif
                      </td>
                      <td>
                      @if($d->TTL_IPKEAMANAN == null)
                        &mdash;
                      @else
                        {{number_format($d->TTL_IPKEAMANAN)}}
                      @endif
                      </td>
                      <td>
                      @if($d->TTL_KEBERSIHAN == null)
                        &mdash;
                      @else
                        {{number_format($d->TTL_KEBERSIHAN)}}
                      @endif
                      </td>
                      <td>{{number_format($d->TTL_TAGIHAN)}}</td>
                      <td>{{number_format($d->REALISASI)}}</td>
                      <td>{{number_format($d->SELISIH)}}</td>
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