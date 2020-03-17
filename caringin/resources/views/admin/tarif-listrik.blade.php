@extends('admin.layout')
@section('content')
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-center">
            <h1 class="h3 mb-0 text-gray-800">Tarif Listrik</h1>
          </div>
  
          <div class="row justify-content-center">
            <div class="col-lg-6">
              <div class="p-4">
              @foreach ($dataset as $data)
                <form class="user" action="{{url('update/storeL',[$data->ID_TRFLISTRIK])}}" method="POST">
                @csrf
                  <div class="form-group">
                    Tarif Blok 1
                    <input value="{{$data->VAR_BLOK1}}" required type="number" name="tarifblok1" class="form-control form-control-user" id="exampleInputTarifListrik" placeholder="Rp.">
                  </div>
                  <div class="form-group">
                    Tarif Blok 2
                    <input value="{{$data->VAR_BLOK2}}" required type="number" name="tarifblok2" class="form-control form-control-user" id="exampleInputTarifListrik" placeholder="Rp.">
                  </div>
                  <div class="form-group">
                    Waktu Kerja
                    <input value="{{$data->VAR_STANDAR}}" required type="number" name="tarifstandar" class="form-control form-control-user" id="exampleInputTarifPengaliListrik" placeholder="Jam">
                  </div>
                  <div class="form-group">
                    Tarif Beban Daya
                    <input value="{{$data->VAR_BEBAN}}" required type="number" name="tarifbeban" class="form-control form-control-user" id="exampleInputTarifListrik" placeholder="Rp.">
                  </div>
                  <div class="form-group">
                    Tarif BPJU
                    <input value="{{$data->VAR_BPJU}}" required type="number" name="tarifbpju" class="form-control form-control-user" id="exampleInputTarifBebanDayaListrik" placeholder="Rp.">
                  </div>
                  <div class="form-group">
                    Tarif Denda
                    <input value="{{$data->VAR_DENDA}}" required type="number" name="tarifdenda" class="form-control form-control-user" id="exampleInputTarifBebanRekMin" placeholder="Rp.">
                  </div>
                  <div class="form-group">
                    Denda > 4400 Watt
                    <input value="{{$data->DENDA_LEBIH}}" required type="number" name="dendalebih" class="form-control form-control-user" id="exampleInputTarifBebanRekMin" placeholder="% dari Total Tagihan">
                  </div>
                  <div class="form-group">
                    PPN Listrik
                    <input value="{{$data->PPN_LISTRIK}}" required type="number" name="ppnlistrik" class="form-control form-control-user" id="exampleInputPpnAir" placeholder="%">
                  </div>
                  <div class="form-group">
                    Pemasangan Alat Baru
                    <input value="{{$data->PASANG_LISTRIK}}" required type="number" name="pasanglistrik" class="form-control form-control-user" id="exampleInputPasangListrik" placeholder="Rp.">
                  </div>
                  @endforeach
                  <button type="submit" class="btn btn-primary btn-user btn-block">Simpan</button>
                </form>
                
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

@endsection