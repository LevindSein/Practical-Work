@extends('admin.layout')
@section('content')
       <!-- Begin Page Content -->
       <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-center">
          <h1 class="h3 mb-0 text-gray-800">Ganti Alat Listrik</h1>
        </div>

        <div class="row justify-content-center">
          <div class="col-lg-6">
            <div class="p-4">
            @foreach ($dataset as $data)
              <form class="user" action="{{url('update/storegantialatlistrik',[$data->ID_TEMPAT])}}" method="POST">
              @csrf
                <div class="form-group">
                  Kode Kontrol
                  <input readonly value="{{$data->KD_KONTROL}}" type="text" name="kontrol" class="form-control form-control-user" id="exampleInputKode" placeholder="(kosong)">
                </div>
                <div class="form-group">
                  Nama Nasabah
                  <input readonly value="{{$data->NM_NASABAH}}" type="text" name="nasabah" class="form-control form-control-user" id="exampleInputNas" placeholder="(kosong)">
                </div>
                <div class="form-group">
                  ID Meteran Lama
                  <input readonly value="{{$data->ID_MLISTRIK}}" type="number" name="idMAirLama" class="form-control form-control-user" id="exampleInputMAirLama" placeholder="(kosong)">
                </div>
                <div class="form-group">
                  Nomor Meteran Lama
                  <input readonly value="{{$data->NOMTR_LISTRIK}}" type="text" name="noMAirLama" class="form-control form-control-user" id="exampleInputNoAirLama" placeholder="(kosong)">
                </div>
                <div class="form-group">
                  ID Meteran Baru
                  <input required type="number" name="idMBaru" class="form-control form-control-user" id="exampleInputMAirBaru" placeholder="ID Meteran ada di Data Alat">
                </div>
                <div class="form-group">
                  Daya Listrik
                  <input required type="number" min="0" name="daya" class="form-control form-control-user" id="exampleInputDaya" placeholder="12xx">
                </div>
            @endforeach
                <button type="submit" class="btn btn-primary btn-user btn-block">Simpan</button>
              </form>
              
            </div>
          </div>
        </div>
      </div>
    <!-- End of Main Content -->
@endsection