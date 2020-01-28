@extends('admin.layout')
@section('content')

       <!-- Begin Page Content -->
       <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-center ">
          <h1 class="h3 mb-0 text-gray-800">Tambah Tagihan Air</h1>
        </div>

        <div class="row justify-content-center">
          <div class="col-lg-6">
            <div class="p-4">
              <form class="user">
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" id="exampleInputkodeKontrol" placeholder="Kode Kontrol">
                </div>
                <div class="form-group">
                  <input type="number" class="form-control form-control-user" id="exampleInputMeterBaruAir" placeholder="Meter baru air">
                </div>

                <a href="index.html" class="btn btn-primary btn-user btn-block">
                  TAMBAH
                </a>
              </form>
              
            </div>
          </div>
        </div>

    <!-- End of Main Content -->

@endsection