@extends('manajer.layout')
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
              @foreach($dataset as $data)
              <h6 class="h-3 m-0 font-weight-bold text-primary">{{$data->KD_KONTROL}} {{$data->NM_NASABAH}}</h6>
              @endforeach
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table display table-bordered" id="tableTagihan" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Status</th>
                      <th>Tanggal</th>
                      <th>Tagihan Air (Rp.)</th>
                      <th>Tagihan Listrik (Rp.)</th>
                      <th>Tagihan IPK & Keamanan (Rp.)</th>
                      <th>Tagihan Kebersihan (Rp.)</th>
                      <th>Total Tagihan (Rp.)</th>
                      <th>Realisasi (Rp.)</th>
                      <th>Selisih (Rp.)</th>
                      <th>Denda (Rp.)</th>
                    </tr>
                  </thead>

                  <tbody>
                  @foreach($dataTagihan as $dataT)
                    <tr>
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