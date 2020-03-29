@extends('admin.layout')
@section('content')
        <!-- Begin Page Content -->
        <div class="container-fluid ">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Data Tempat Usaha</h1>
          </div>

          <!-- Data LAPORAN -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="h-3 m-0 font-weight-bold text-primary">Tabel Tempat Usaha</h6>
            </div>
            <div class="card-body">
              <div class="form-group">
                <!--Option Menu-->
                <label for="sel1">Tampilkan Data :</label>
                <ul class="nav nav-tabs" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#home">Semua</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu1">Air Bersih</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu2">Listrik</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu3">IPK & Keamanan</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu4">Kebersihan</a>
                  </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                  <!--SEMUA-->
                  <div id="home" class="container tab-pane active"><br>
                  <div class="table-responsive">
                  <table class="table table-bordered" id="tableTempat" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Action</th>
                      <th>Kode Kontrol</th>
                      <th>Pemilik</th>
                      <th>Pengguna</th>
                      <th>No. Los</th>
                      <th>Jumlah Unit</th>
                      <th>Bentuk Usaha</th>
                      <th>No. Meter Listrik</th>
                      <th>Daya Listrik (W)</th>
                      <th>No. Meter Air</th>
                      <th>Tarif IPK</th>
                      <th>Tarif Keamanan</th>
                      <th>Tarif Kebersihan</th>
                    </tr>
                  </thead>

                  <tbody>
                  @foreach($dataset as $data)
                    <tr>
                      <td class="text-center">
                        <a href="{{url('updatetempat',[$data->ID_TEMPAT])}}" class="d-none d-sm-inline-block btn btn-primary btn-sm shadow-sm"><i
                            class="fas fa- fa-sm text-white-50"></i>Update</a>
                      </td>
                      <td class="text-left"
                      <?php if($data->STT_CICIL==0){ ?> style="color:green;" <?php } ?>
                      <?php if($data->STT_CICIL==1){ ?> style="color:red;" <?php } ?>>
                      {{$data->KD_KONTROL}}
                      </td>
                      <td class="text-left">{{$data->NM_PEMILIK}}</td>
                      <td class="text-left">{{$data->NM_NASABAH}}</td>
                      <td class="text-center">{{$data->NO_ALAMAT}}</td>
                      <td class="text-center">{{$data->JML_ALAMAT}}</td>
                      <td class="text-left">
                      @if($data->BENTUK_USAHA == null)
                        (kosong)
                      @else
                        {{$data->BENTUK_USAHA}}
                      @endif
                    </td>
                      <td class="text-center">
                      @if($data->ID_TRFLISTRIK != null)
                        @if($data->NOMTR_LISTRIK == null)
                          0
                        @else
                          {{$data->NOMTR_LISTRIK}}
                        @endif
                      @else
                        &mdash;
                      @endif
                      </td>
                      <td class="text-center">
                      @if($data->DAYA == null)
                        &mdash;
                      @else
                        {{$data->DAYA}}
                      @endif
                      </td>
                      <td class="text-center">
                      @if($data->ID_TRFAIR != null)
                        @if($data->NOMTR_AIR == null)
                          0
                        @else
                          {{$data->NOMTR_AIR}}
                        @endif
                      @else
                        &mdash;
                      @endif
                      </td>
                      <td>
                      @if($data->ID_TRFIPK == null)
                        &mdash;
                      @else
                        {{$data->TRF_IPK}}
                      @endif
                      </td>
                      <td>
                      @if($data->ID_TRFKEAMANAN == null)
                        &mdash;
                      @else
                        {{$data->TRF_KEAMANAN}}
                      @endif
                      </td>
                      <td>
                      @if($data->ID_TRFKEBERSIHAN == null)
                        &mdash;
                      @else
                        {{$data->TRF_KEBERSIHAN}}
                      @endif
                      </td>
                    </tr>
                  @endforeach
                  </tbody>
                  </table>
                  </div>
                  </div>
                  <!--END SEMUA-->
                  <!--Air-->
                  <div id="menu1" class="container tab-pane fade"><br>
                  <div class="table-responsive">
                  <table class="table display table-bordered" id="tableAir" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Tanggal</th>
                      <th>Kode Kontrol</th>
                      <th>Nama Nasabah</th>
                      <th>No. Meter Air</th>
                      <th>Bentuk Usaha</th>
                    </tr>
                  </thead>
                 
                  <tbody>
                  @foreach($dataset as $dataA)
                  @if($dataA->ID_TRFAIR != null)
                    <tr>
                      <td class="text-center">{{$dataA->TGL_TEMPAT}}</td>
                      <td class="text-center">{{$dataA->KD_KONTROL}}</td>
                      <td class="text-left">{{$dataA->NM_NASABAH}}</td>
                      <td class="text-center">
                      @if($dataA->NOMTR_AIR == null)
                          0
                      @else
                          {{$dataA->NOMTR_AIR}}
                      @endif
                      </td>
                      <td class="text-left">{{$dataA->BENTUK_USAHA}}</td>
                    </tr>
                  @endif
                  @endforeach
                  </tbody>
                  </table>
                  </div>
                  </div>
                  <!--END Air-->
                  <!--Listrik-->
                  <div id="menu2" class="container tab-pane fade"><br>
                  <div class="table-responsive">
                  <table class="table display table-bordered" id="tableListrik" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Tanggal</th>
                      <th>Kode Kontrol</th>
                      <th>Nama Nasabah</th>
                      <th>Daya (W)</th>
                      <th>No. Meter Listrik</th>
                      <th>Bentuk Usaha</th>
                    </tr>
                  </thead>
                 
                  <tbody>
                  @foreach($dataset as $dataL)
                  @if($dataL->ID_TRFLISTRIK != null)
                    <tr>
                      <td class="text-center">{{$dataL->TGL_TEMPAT}}</td>
                      <td class="text-center">{{$dataL->KD_KONTROL}}</td>
                      <td class="text-left">{{$dataL->NM_NASABAH}}</td>
                      <td class="text-left">{{$dataL->DAYA}}</td>
                      <td class="text-center">
                      @if($dataL->NOMTR_LISTRIK == null)
                          0
                      @else
                          {{$dataL->NOMTR_LISTRIK}}
                      @endif
                      </td>
                      <td class="text-left">{{$dataL->BENTUK_USAHA}}</td>
                    </tr>
                  @endif
                  @endforeach
                  </tbody>
                  </table>
                  </div>
                  </div>
                  <!--END Listrik-->
                  <!--Keamanan-->
                  <div id="menu3" class="container tab-pane fade"><br>
                  <div class="table-responsive">
                  <table class="table display table-bordered" id="tableKeamanan" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Tanggal</th>
                      <th>Kode Kontrol</th>
                      <th>Nama Nasabah</th>
                      <th>Tarif IPK (Rp.)</th>
                      <th>Tarif Keamanan (Rp.)</th>
                      <th>Bentuk Usaha</th>
                    </tr>
                  </thead>
                 
                  <tbody>
                  @foreach($dataset as $dataK)
                  @if($dataK->ID_TRFKEAMANAN != null && $dataK->ID_TRFIPK != null)
                    <tr>
                      <td class="text-center">{{$dataK->TGL_TEMPAT}}</td>
                      <td class="text-center">{{$dataK->KD_KONTROL}}</td>
                      <td class="text-left">{{$dataK->NM_NASABAH}}</td>
                      <td>{{$dataK->TRF_IPK}}</td>
                      <td>{{$dataK->TRF_KEAMANAN}}</td>
                      <td class="text-left">{{$dataK->BENTUK_USAHA}}</td>
                    </tr>
                  @endif
                  @endforeach
                  </tbody>
                  </table>
                  </div>
                  </div>
                  <!--END Keamanan-->
                  <!--Kebersihan-->
                  <div id="menu4" class="container tab-pane fade"><br>
                  <div class="table-responsive">
                  <table class="table display table-bordered" id="tableKebersihan" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Tanggal</th>
                      <th>Kode Kontrol</th>
                      <th>Nama Nasabah</th>
                      <th>Tarif Kebersihan (Rp.)</th>
                      <th>Bentuk Usaha</th>
                    </tr>
                  </thead>
                 
                  <tbody>
                  @foreach($dataset as $dataB)
                  @if($dataB->ID_TRFKEBERSIHAN != null)
                    <tr>
                      <td class="text-center">{{$dataB->TGL_TEMPAT}}</td>
                      <td class="text-center">{{$dataB->KD_KONTROL}}</td>
                      <td class="text-left">{{$dataB->NM_NASABAH}}</td>
                      <td>{{$dataB->TRF_KEBERSIHAN}}</td>
                      <td class="text-left">{{$dataB->BENTUK_USAHA}}</td>
                    </tr>
                  @endif
                    @endforeach
                  </tbody>
                  </table>
                  </div>
                  </div>
                  <!--END Kebersihan-->
                </div>
                <!--END Tab Panes-->
              </div>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->

@endsection

