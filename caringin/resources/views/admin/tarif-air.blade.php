@extends('admin.layout')
@section('content')
        
        <!-- Begin Page Content -->
        <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-center">
          <h1 class="h3 mb-0 text-gray-800">Tarif Air</h1>
        </div>

        <div class="row justify-content-center">
          <div class="col-lg-6">
            <div class="p-4">
            @foreach ($dataset as $data)
              <form class="user" action="{{url('update/storeA',[$data->ID_TRFAIR])}}" method="POST">
              @csrf
                <div class="form-group">
                  Tarif Air 1
                  <input value="{{$data->TRF_AIR1}}" required type="number" name="tarif1" class="form-control form-control-user" id="exampleInputTarifAir" placeholder="Rp.">
                </div>
                <div class="form-group">
                  Tarif Air 2 (diatas 10 M<sup>3</sup>)
                  <input value="{{$data->TRF_AIR2}}" required type="number" name="tarif2" class="form-control form-control-user" id="exampleInputTarifAir" placeholder="Rp.">
                </div>
                <div class="form-group">
                  Tarif Pemeliharaan Air
                  <input value="{{$data->TRF_PEMELIHARAAN}}" required type="number" name="tarifpemeliharaan" class="form-control form-control-user" id="exampleInputTarifPemeliharaanAir" placeholder="Rp.">
                </div>
                <div class="form-group">
                  Tarif Beban Air
                  <input value="{{$data->TRF_BEBAN}}" required type="number" name="tarifbeban" class="form-control form-control-user" id="exampleInputTarifBebanAir" placeholder="Rp.">
                </div>
                <div class="form-group">
                  Tarif Air Kotor
                  <input value="{{$data->TRF_ARKOT}}" required type="number" name="tarifarkot" class="form-control form-control-user" id="exampleInputTarifAirKotor" placeholder="%">
                </div>
                <div class="form-group">
                  Tarif Denda
                  <input value="{{$data->TRF_DENDA}}" required type="number" name="tarifdenda" class="form-control form-control-user" id="exampleInputTarifAirKotor" placeholder="%">
                </div>
                <div class="form-group">
                  PPN Air
                  <input value="{{$data->PPN_AIR}}" required type="number" name="ppnair" class="form-control form-control-user" id="exampleInputPpnAir" placeholder="%">
                </div>
                <div class="form-group">
                  Pemasangan Alat Baru
                  <input value="{{$data->PASANG_AIR}}" required type="number" name="pasangair" class="form-control form-control-user" id="exampleInputPasangAir" placeholder="Rp.">
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