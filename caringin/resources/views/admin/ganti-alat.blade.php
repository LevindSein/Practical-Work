@extends('admin.layout')
@section('content')

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Data Alat</h1>
          </div>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
              <h6 class="m-0 font-weight-bold text-primary">Tabel Alat Meteran</h6>
              <!--Print Form-->
              <a href="printform" type="submit" class="btn btn-primary"><i class="fas fa-download fa-sm text-white-50"></i> Print Form</a>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="sel1">Tampilkan Data :</label>
                <ul class="nav nav-tabs" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#home">Alat Air</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu1">Alat Listrik</a>
                  </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                  <!--AIR BERSIH-->
                  <div id="home" class="container tab-pane active"><br>
                  <div class="table-responsive">
                  <table class="table table-bordered" id="dataAir" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Kode Kontrol</th>
                      <th>Nama Nasabah</th>
                      <th>Nomor Meter</th>
                      <th>Action</th>
                    </tr>
                  </thead>

                  <tbody>
                  @foreach($dataset as $data)
                  @if($data->ID_MAIR != null)
                    <tr>
                      <td class="text-center">{{$data->KD_KONTROL}}</td>
                      <td class="text-center">{{$data->NM_NASABAH}}</td>
                      <td class="text-center">
                      @if($data->NOMTR_AIR == null)
                        0
                      @else  
                        {{$data->NOMTR_AIR}}
                      @endif
                      </td>
                      <td class="text-center">
                        <a href="{{url('updategantialatair',[$data->ID_TEMPAT])}}" class="d-none d-sm-inline-block btn btn-primary btn-sm shadow-sm"><i
                            class="fas fa- fa-sm text-white-50"></i>Ganti</a>
                      </td>
                    </tr>
                    @endif
                    @endforeach
                  </tbody>
                </table>
                  </div>
                  </div>
                  <!--END AIR BERSIH-->
                  <!--LISTRIK-->
                  <div id="menu1" class="container tab-pane fade"><br>
                  <div class="table-responsive">
                  <table class="table table-bordered" id="dataListrik" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Kode Kontrol</th>
                      <th>Nama Nasabah</th>
                      <th>Nomor Meter</th>
                      <th>Action</th>
                    </tr>
                  </thead>

                  <tbody>
                  @foreach($dataset as $data)
                  @if($data->ID_MLISTRIK != null)
                    <tr>
                      <td class="text-center">{{$data->KD_KONTROL}}</td>
                      <td class="text-center">{{$data->NM_NASABAH}}</td>
                      <td class="text-center">
                      @if($data->NOMTR_LISTRIK == null)
                        0
                      @else  
                        {{$data->NOMTR_LISTRIK}}
                      @endif
                      </td>
                      <td class="text-center">
                        <a href="{{url('updategantialatlistrik',[$data->ID_TEMPAT])}}" class="d-none d-sm-inline-block btn btn-primary btn-sm shadow-sm"><i
                            class="fas fa- fa-sm text-white-50"></i>Ganti</a>
                      </td>
                    </tr>
                    @endif
                    @endforeach
                  </tbody>
                </table>
                  </div>
                  </div>
                  <!--END LISTRIK-->
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