@extends('admin.layout')
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
                      <th>Bayar</th>
                      <th>Lunas</th>
                      <th>Tanggal</th>
                      <th>Lalu Air</th>
                      <th>Baru Air</th>
                      <th>Pakai Air</th>
                      <th>Bayar Pakai</th>
                      <th>B.Beban</th>
                      <th>B.Pemeliharaan</th>
                      <th>B.Air Kotor</th>
                      <th>Tagihan Air</th>
                      <th>Lalu Listrik</th>
                      <th>Baru Listrik</th>
                      <th>Pakai Listrik</th>
                      <th>Rek.Min</th>
                      <th>B.Blok 1</th>
                      <th>B.Blok 2</th>
                      <th>B.Beban</th>
                      <th>BPJU</th>
                      <th>Tagihan Listrik</th>
                      <th>Tagihan IPK & Keamanan</th>
                      <th>Tagihan Kebersihan</th>
                      <th>Total Tagihan</th>
                      <th>Realisasi</th>
                      <th>Selisih</th>
                    </tr>
                  </thead>

                  <tbody>
                  @foreach($dataTagihan as $dataT)
                    <tr>
                      <td class="text-center">
                          <a href="{{url('bayartagihan',[$dataT->ID_TAGIHANKU])}}" class="d-none d-sm-inline-block btn btn-primary btn-sm shadow-sm"><i
                            class="fas fa- fa-sm text-white-50"></i>Bayar</a>
                      </td>
                      <td class="text-center" 
                      <?php if($dataT->STT_BAYAR==0){ ?> style="color:red;" <?php } ?>
                      <?php if($dataT->STT_BAYAR==1){ ?> style="color:green;" <?php } ?>>
                      @if($dataT->STT_BAYAR == 1)
                        Dibayar
                      @else
                        Belum Dibayar
                      @endif
                      </td>
                      <td class="text-center" 
                      <?php if($dataT->STT_LUNAS==0){ ?> style="color:red;" <?php } ?>
                      <?php if($dataT->STT_LUNAS==1){ ?> style="color:green;" <?php } ?>>
                      @if($dataT->STT_BAYAR == 1)
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
                        {{$dataT->AWAL_AIR}}
                      @endif
                      </td>
                      <td>
                      @if($dataT->AKHIR_AIR == null)
                        0
                      @else
                        {{$dataT->AKHIR_AIR}}
                      @endif
                      </td>
                      <td>
                      @if($dataT->PAKAI_AIR == null)
                        0
                      @else
                        {{$dataT->PAKAI_AIR}}
                      @endif
                      </td>
                      <td>
                      @if($dataT->BYR_AIR == null)
                        0
                      @else
                        {{$dataT->BYR_AIR}}
                      @endif
                      </td>
                      <td>
                      @if($dataT->BYR_BEBAN == null)
                        0
                      @else
                        {{$dataT->BYR_BEBAN}}
                      @endif
                      </td>
                      <td>
                      @if($dataT->BYR_PEMELIHARAAN == null)
                        0
                      @else
                        {{$dataT->BYR_PEMELIHARAAN}}
                      @endif
                      </td>
                      <td>
                      @if($dataT->BYR_ARKOT == null)
                        0
                      @else
                        {{$dataT->BYR_ARKOT}}
                      @endif
                      </td>
                      <td>
                      @if($dataT->TTL_AIR == null)
                        0
                      @else
                        {{$dataT->TTL_AIR}}
                      @endif
                      </td>
                      <td>
                      @if($dataT->AWAL_LISTRIK == null)
                        0
                      @else
                        {{$dataT->AWAL_LISTRIK}}
                      @endif
                      </td>
                      <td>
                      @if($dataT->AKHIR_LISTRIK == null)
                        0
                      @else
                        {{$dataT->AKHIR_LISTRIK}}
                      @endif
                      </td>
                      <td>
                      @if($dataT->PAKAI_LISTRIK == null)
                        0
                      @else
                        {{$dataT->PAKAI_LISTRIK}}
                      @endif
                      </td>
                      <td>
                      @if($dataT->REK_MIN == null)
                        0
                      @else
                        {{$dataT->REK_MIN}}
                      @endif
                      </td>
                      <td>
                      @if($dataT->B_BLOK1 == null)
                        0
                      @else
                        {{$dataT->B_BLOK1}}
                      @endif
                      </td>
                      <td>
                      @if($dataT->B_BLOK2 == null)
                        0
                      @else
                        {{$dataT->B_BLOK2}}
                      @endif
                      </td>
                      <td>
                      @if($dataT->B_BEBAN == null)
                        0
                      @else
                        {{$dataT->B_BEBAN}}
                      @endif
                      </td>
                      <td>
                      @if($dataT->BPJU == null)
                        0
                      @else
                        {{$dataT->BPJU}}
                      @endif
                      </td>
                      <td>
                      @if($dataT->TTL_LISTRIK == null)
                        0
                      @else
                        {{$dataT->TTL_LISTRIK}}
                      @endif
                      </td>
                      <td>
                      @if($dataT->TTL_IPKEAMANAN == null)
                        0
                      @else
                        {{$dataT->TTL_IPKEAMANAN}}
                      @endif
                      </td>
                      <td>
                      @if($dataT->TTL_KEBERSIHAN == null)
                        0
                      @else
                        {{$dataT->TTL_KEBERSIHAN}}
                      @endif
                      </td>
                      <td>
                      @if($dataT->TTL_TAGIHAN == null)
                        0
                      @else
                        {{$dataT->TTL_TAGIHAN}}
                      @endif
                      </td>
                      <td>{{$dataT->REALISASI}}</td>
                      <td>{{$dataT->SELISIH}}</td>
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