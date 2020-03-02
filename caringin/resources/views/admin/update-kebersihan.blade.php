@extends('admin.layout')
@section('content')
       <!-- Begin Page Content -->
       <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-center">
          <h1 class="h3 mb-0 text-gray-800">Update Tarif Kebersihan</h1>
        </div>

        <div class="row justify-content-center">
          <div class="col-lg-6">
            <div class="p-4">
            @foreach ($dataset as $data)
            <form class="user" action="{{url('update/storeB',[$data->ID_TRFKEBERSIHAN])}}" method="POST">
              @csrf
                <div class="form-group">
                  Kategori
                  <input value="{{$data->ID_TRFKEBERSIHAN}}" required type="text" name="kategori" readonly class="form-control form-control-user" id="exampleInputNamaNasabah">
                </div>
                <div class="form-group">
                  Tarif Kebersihan
                  <input value="{{$data->TRF_KEBERSIHAN}}" required type="number" name="tarif" class="form-control form-control-user" id="exampleInputNomorKtp" placeholder="Rp.">
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