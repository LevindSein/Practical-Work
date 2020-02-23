@extends('admin.layout')
@section('content')

       <!-- Begin Page Content -->
       <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-center ">
          <h1 class="h3 mb-0 text-gray-800">Tambah Tagihan</h1>
        </div>

        <div class="row justify-content-center">
          <div class="col-lg-6">
            <div class="p-4">
              <form class="user">
                <div class="form-group">
                  <input type="text" readonly class="form-control form-control-user" id="exampleInputkodeKontrol" placeholder="A-1-001">
                </div>
                <div class="form-group">
                  <input type="text" readonly class="form-control form-control-user" id="exampleInputkodeNama" placeholder="Fahni Amsyari">
                </div>
                <div class="form-group">
                  <input type="number" class="form-control form-control-user" id="exampleInputMeterBaruAir" placeholder="Meter baru air">
                </div>
                <div class="form-group">
                  <input type="number" class="form-control form-control-user" id="exampleInputMeterBaruListrik" placeholder="Meter baru listrik">
                </div>
                <a href="index.html" class="btn btn-primary btn-user btn-block">
                  Tambah
                </a>
              </form>
              
            </div>
          </div>
        </div>

    <!-- End of Main Content -->

@endsection