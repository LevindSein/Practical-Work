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
              @foreach($dataset as $data)
              <h6 class="h-3 m-0 font-weight-bold text-primary">{{$data->KD_KONTROL}} {{$data->NM_NASABAH}}</h6>
              @endforeach
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table display table-bordered" id="tableTagihan" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Action</th>
                      <th>Lunas</th>
                      <th>Tanggal</th>
                      <th>Lalu Air</th>
                      <th>Baru Air</th>
                      <th>Pakai Air (M<sup>3</sup>)</th>
                      <th>Bayar Pakai (Rp.)</th>
                      <th>B.Beban (Rp.)</th>
                      <th>B.Pemeliharaan (Rp.)</th>
                      <th>B.Air Kotor (Rp.)</th>
                      <th>Tagihan Air (Rp.)</th>
                      <th>Daya Listrik</th>
                      <th>Lalu Listrik</th>
                      <th>Baru Listrik</th>
                      <th>Pakai Listrik (kWh)</th>
                      <th>Rek.Min (Rp.)</th>
                      <th>B.Blok 1 (Rp.)</th>
                      <th>B.Blok 2 (Rp.)</th>
                      <th>B.Beban (Rp.)</th>
                      <th>BPJU (Rp.)</th>
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
                      <td class="text-center">
                          <a href="{{url('bayartagihankasir',[$dataT->ID_TAGIHANKU])}}" class="d-none d-sm-inline-block btn btn-primary btn-sm shadow-sm"><i
                            class="fas fa- fa-sm text-white-50"></i>Bayar</a>
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
                      <td>
                      @if($dataT->AWAL_AIR == null)
                        0
                      @else
                        {{number_format($dataT->AWAL_AIR)}}
                      @endif
                      </td>
                      <td>
                      @if($dataT->AKHIR_AIR == null)
                        0
                      @else
                        {{number_format($dataT->AKHIR_AIR)}}
                      @endif
                      </td>
                      <td>
                      @if($dataT->PAKAI_AIR == null)
                        0
                      @else
                        {{number_format($dataT->PAKAI_AIR)}}
                      @endif
                      </td>
                      <td>
                      @if($dataT->BYR_AIR == null)
                        0
                      @else
                        {{number_format($dataT->BYR_AIR)}}
                      @endif
                      </td>
                      <td>
                      @if($dataT->BYR_BEBAN == null)
                        0
                      @else
                        {{number_format($dataT->BYR_BEBAN)}}
                      @endif
                      </td>
                      <td>
                      @if($dataT->BYR_PEMELIHARAAN == null)
                        0
                      @else
                        {{number_format($dataT->BYR_PEMELIHARAAN)}}
                      @endif
                      </td>
                      <td>
                      @if($dataT->BYR_ARKOT == null)
                        0
                      @else
                        {{number_format($dataT->BYR_ARKOT)}}
                      @endif
                      </td>
                      <td>
                      @if($dataT->TTL_AIR == null)
                        0
                      @else
                        {{number_format($dataT->TTL_AIR)}}
                      @endif
                      </td>
                      <td>
                      @if($dataT->DAYA_LISTRIK == null)
                        0
                      @else
                        {{number_format($dataT->DAYA_LISTRIK)}}
                      @endif
                      </td>
                      <td>
                      @if($dataT->AWAL_LISTRIK == null)
                        0
                      @else
                        {{number_format($dataT->AWAL_LISTRIK)}}
                      @endif
                      </td>
                      <td>
                      @if($dataT->AKHIR_LISTRIK == null)
                        0
                      @else
                        {{number_format($dataT->AKHIR_LISTRIK)}}
                      @endif
                      </td>
                      <td>
                      @if($dataT->PAKAI_LISTRIK == null)
                        0
                      @else
                        {{number_format($dataT->PAKAI_LISTRIK)}}
                      @endif
                      </td>
                      <td>
                      @if($dataT->REK_MIN == null)
                        0
                      @else
                        {{number_format($dataT->REK_MIN)}}
                      @endif
                      </td>
                      <td>
                      @if($dataT->B_BLOK1 == null)
                        0
                      @else
                        {{number_format($dataT->B_BLOK1)}}
                      @endif
                      </td>
                      <td>
                      @if($dataT->B_BLOK2 == null)
                        0
                      @else
                        {{number_format($dataT->B_BLOK2)}}
                      @endif
                      </td>
                      <td>
                      @if($dataT->B_BEBAN == null)
                        0
                      @else
                        {{number_format($dataT->B_BEBAN)}}
                      @endif
                      </td>
                      <td>
                      @if($dataT->BPJU == null)
                        0
                      @else
                        {{number_format($dataT->BPJU)}}
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