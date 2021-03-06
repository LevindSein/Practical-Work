<?php
    $role = Session::get('role');
?>


@extends( $role == 'Super Admin' ? 'admin.layout' : 'normal.layout')
@section('content')
       <!-- Begin Page Content -->
  
       <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-center">
          <h1 class="h3 mb-0 text-gray-800">Tambah Nasabah</h1>
        </div>

        <div class="row justify-content-center">
          <div class="col-lg-6">
            <div class="p-4">
              <form class="user" action="storenasabah" method="POST">
              @csrf
                <div class="form-group">
                  Nama Nasabah
                  <input required type="text" style="text-transform: capitalize;" name="nama" class="form-control form-control-user" id="exampleInputNamaNasabah" placeholder="Nama">
                </div>
                <div class="form-group">
                  Nomor KTP Nasabah
                  <input type="number" min="0" name="ktp" class="form-control form-control-user" id="exampleInputNomorKtp" placeholder="321xxxxx">
                </div>
                <div class="form-group">
                  Nomor NPWP Nasabah
                  <input type="number" min="0" name="npwp" class="form-control form-control-user" id="exampleInputNpwpPelanggan" placeholder="99xxxxx">
                </div>
                <div class="form-group">
                  Nomor Telpon
                  <input required type="number" min="0" name="telpon" class="form-control form-control-user" id="exampleInput" placeholder="0818xxxxx">
                </div>
                <input type="submit" value="Tambah Nasabah" class="btn btn-primary btn-user btn-block">
              </form>      
            </div>
          </div>
        </div>
      </div>
    <!-- End of Main Content -->
@endsection