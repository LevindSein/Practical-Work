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
              <form class="user">
              @csrf
                <div class="form-group">
                  Kode Kontrol
                  <input readonly type="text" name="kode" class="form-control form-control-user" id="exampleInputKode" placeholder="A-1-001">
                </div>
                <div class="form-group">
                  Nama Nasabah
                  <input readonly type="text" name="nama" class="form-control form-control-user" id="exampleInputNama" placeholder="Fahni Amsyari">
                </div>
                <div class="form-group">
                  Meter Baru Air
                  <input type="number" name="mAir" class="form-control form-control-user" id="exampleInputAir" placeholder="12345">
                </div>
                <div class="form-group">
                  Meter Baru Listrik
                  <input type="number" name="mListrik" class="form-control form-control-user" id="exampleInputListrik" placeholder="12345">
                </div>
                <input type="submit" value="Tambah Nasabah" class="btn btn-primary btn-user btn-block">
              </form>      
            </div>
          </div>
        </div>

    <!-- End of Main Content -->
@endsection