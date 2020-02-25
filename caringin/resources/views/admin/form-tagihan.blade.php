@extends('admin.layout')
@section('content')
       <!-- Begin Page Content -->
  
       <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-center">
          <h1 class="h3 mb-0 text-gray-800">Tambah Tagihan</h1>
        </div>

        <div class="row justify-content-center">
          <div class="col-lg-6">
            <div class="p-4">
              @foreach ($dataset as $data)
              <form class="user" action="{{url('tagihan/store',[$data->ID_TEMPAT])}}" method="POST">
                @csrf
                <div class="form-group">
                  Kode Kontrol
                  <input readonly value="{{$data->KD_KONTROL}}" type="text" name="kode" class="form-control form-control-user" id="exampleInputKode" placeholder="A-1-001">
                </div>
                <div class="form-group">
                  Nama Nasabah
                  <input readonly value="{{$data->NM_NASABAH}}" type="text" name="nama" class="form-control form-control-user" id="exampleInputNama" placeholder="Fahni Amsyari">
                </div>
                <div class="form-group">
                  Meter Baru Air
                  <input type="number" name="mAir" class="form-control form-control-user" id="exampleInputAir"
                  <?php if($data->ID_TRFAIR == NULL){ ?> readonly placeholder="(kosong)" <?php } ?>>
                </div>
                <div class="form-group">
                  Meter Baru Listrik
                  <input type="number" name="mListrik" class="form-control form-control-user" id="exampleInputListrik"
                  <?php if($data->ID_TRFLISTRIK == NULL){ ?> readonly placeholder="(kosong)" <?php } ?>>
                </div>
                @endforeach
                <Input type="submit" value="Tambah Tagihan" class="btn btn-primary btn-user btn-block">
              </form>      
            </div>
          </div>
        </div>

    <!-- End of Main Content -->
@endsection