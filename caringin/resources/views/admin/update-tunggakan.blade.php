@extends('admin.layout')
@section('content')
       <!-- Begin Page Content -->
       <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-center">
          <h1 class="h3 mb-0 text-gray-800">Bayar Tunggakan</h1>
        </div>

        <div class="row justify-content-center">
          <div class="col-lg-6">
            <div class="p-4">
            <form class="user">
                <div class="form-group">
                  Kode Kontrol
                  <input readonly type="text" name="kode" class="form-control form-control-user" id="exampleInputKode" placeholder="A-1-001">
                </div>
                <div class="form-group">
                  Nama Nasabah
                  <input readonly type="text" name="nama" class="form-control form-control-user" id="exampleInputNama" placeholder="Fahni Amsyari">
                </div>
                <div class="form-group">
                  Total Tunggakan
                  <input readonly type="number" name="tunggakan" class="form-control form-control-user" id="exampleInputTagihan" placeholder="Rp.">
                </div>
                <div class="form-group">
                  Realisasi Pembayaran
                  <input required type="number" name="bayar" class="form-control form-control-user" id="exampleInputBayar" placeholder="Rp.">
                </div>
                <button type="submit" class="btn btn-primary btn-user btn-block">Bayar</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    <!-- End of Main Content -->
@endsection