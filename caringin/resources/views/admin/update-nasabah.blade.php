@extends('admin.layout')
@section('content')
       <!-- Begin Page Content -->
       <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-center">
          <h1 class="h3 mb-0 text-gray-800">Update Nasabah</h1>
        </div>

        <div class="row justify-content-center">
          <div class="col-lg-6">
            <div class="p-4">
            @foreach ($dataset as $data)
            <form class="user" action="{{url('update/store',[$data->ID_NASABAH])}}" method="POST">
              @csrf
                <div class="form-group">
                  Nama Nasabah
                  <input value="{{$data->NM_NASABAH}}" required type="text" name="nama" class="form-control form-control-user" id="exampleInputNamaNasabah" placeholder="Nama">
                </div>
                <div class="form-group">
                  Nomor KTP Nasabah
                  <input value="{{$data->NO_KTP}}" required type="number" name="ktp" class="form-control form-control-user" id="exampleInputNomorKtp" placeholder="321xxxxx">
                </div>
                <div class="form-group">
                  Nomor NPWP Nasabah
                  <input value="{{$data->NO_NPWP}}" required type="text" name="npwp" class="form-control form-control-user" id="exampleInputNpwpPelanggan" placeholder="99xxxxx">
                </div>
                <div class="form-group">
                  Nomor Telpon
                  <input value="{{$data->NO_TLP}}" required type="number" name="telpon" class="form-control form-control-user" id="exampleInput" placeholder="0818xxxxx">
                </div>
                @endforeach
                <button type="submit" class="btn btn-primary btn-user btn-block">Simpan</button>
              </form>
              
            </div>
          </div>
        </div>

    <!-- End of Main Content -->
@endsection