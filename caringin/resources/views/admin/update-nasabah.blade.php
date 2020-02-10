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
              <form class="user">
                <div class="form-group">
                  Nama Nasabah
                  <input type="text" class="form-control form-control-user" id="exampleInputNamaNasabah" placeholder="Nama">
                </div>
                <div class="form-group">
                  Nomor KTP Nasabah
                  <input type="number" class="form-control form-control-user" id="exampleInputNomorKtp" placeholder="321xxxxx">
                </div>
                <div class="form-group">
                  Nomor NPWP Nasabah
                  <input type="number" class="form-control form-control-user" id="exampleInputNpwpPelanggan" placeholder="99xxxxx">
                </div>
                <a href="index.html" class="btn btn-primary btn-user btn-block">
                  Update Nasabah
                </a>
              </form>
              
            </div>
          </div>
        </div>

    <!-- End of Main Content -->
@endsection