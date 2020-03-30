@extends('kasir.layout')
@section('content')
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Data Tagihan</h1>
          </div>

          <!-- Data LAPORAN -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="h-3 m-0 font-weight-bold text-primary">{{$dataset->NM_NASABAH}} {{$dataset->NO_ANGGOTA}}</h6>
            </div>
            
            <form id="form" action="{{url('checkout/tagihan',[$dataset->ID_NASABAH])}}" method="POST">
            @csrf
            <div class="card-body">
              <div class="table-responsive">
                <table class="table display table-bordered" id="tableTagihan1" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Pilih</th>
                      <th>Lunas</th>
                      <th>Tanggal</th>
                      <th>Kode Kontrol</th>
                      <th>Tagihan Air (Rp.)</th>
                      <th>Tagihan Listrik (Rp.)</th>
                      <th>Tagihan IPK & Keamanan (Rp.)</th>
                      <th>Tagihan Kebersihan (Rp.)</th>
                      <th>Total Tagihan (Rp.)</th>
                      <th>Realisasi (Rp.)</th>
                      <th>Selisih (Rp.)</th>
                      <th>Denda (Rp.)</th>
                      <th>Ket</th>
                    </tr>
                  </thead>

                  <tbody>
                  @foreach($dataTagihan as $dataT)
                  @if($dataT->STT_LUNAS==0)
                    <tr>
                      <td class="text-center">
                      <input type="checkbox" id="checkBox" name="check[]" value="{{$dataT->ID_TAGIHANKU}}">
                      </td>
                      <td class="text-center" 
                      <?php if($dataT->STT_LUNAS==0){ ?> style="color:red;" <?php } ?>
                      <?php if($dataT->STT_LUNAS==1){ ?> style="color:green;" <?php } ?>>
                      @if($dataT->STT_LUNAS == 1)
                        Lunas
                      @else
                        Belum Lunas
                      @endif
                      </td>
                      <td class="text-center">{{$dataT->TGL_TAGIHAN}}</td>
                      <td class="text-center">{{$dataT->KD_KONTROL}}</td>
                      <td>
                      @if($dataT->TTL_AIR == null)
                        0
                      @else
                        {{number_format($dataT->TTL_AIR)}}
                      @endif
                      </td>
                      <td>
                      @if($dataT->TTL_LISTRIK == null)
                        0
                      @else
                        {{number_format($dataT->TTL_LISTRIK)}}
                      @endif
                      </td>
                      <td>
                      @if($dataT->TTL_IPKEAMANAN == null)
                        0
                      @else
                        {{number_format($dataT->TTL_IPKEAMANAN)}}
                      @endif
                      </td>
                      <td>
                      @if($dataT->TTL_KEBERSIHAN == null)
                        0
                      @else
                        {{number_format($dataT->TTL_KEBERSIHAN)}}
                      @endif
                      </td>
                      <td>
                      @if($dataT->TTL_TAGIHAN == null)
                        0
                      @else
                        {{number_format($dataT->TTL_TAGIHAN)}}
                      @endif
                      </td>
                      <td>{{number_format($dataT->REALISASI)}}</td>
                      <td>{{number_format($dataT->SELISIH)}}</td>
                      <td>{{number_format($dataT->DENDA)}}</td>
                      <td class="text-center">{{$dataT->KET}}</td>
                    </tr>
                    @endif
                  @endforeach
                  </tbody>
                </table>
              </div>
            </div>
            <input id="checkout" type="submit" class="btn btn-primary" value="Checkout" style="margin-left:35px;margin-bottom:35px;" >
            </form>
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
      '#tableTagihan1'
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