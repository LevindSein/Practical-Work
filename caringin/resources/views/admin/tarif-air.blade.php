@extends('admin.layout')
@section('content')

        <!-- Begin Page Content -->
        <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-center">
          <h1 class="h3 mb-0 text-gray-800">Tarif Air</h1>
        </div>

        <div class="row justify-content-center">
          <div class="col-lg-6">
            <div class="p-4">
              <form class="user">
                <div class="form-group">
                  Tarif Air 1
                  <input type="number" class="form-control form-control-user" id="exampleInputTarifAir" placeholder="Rp.">
                </div>
                <div class="form-group">
                  Tarif Air 2 (diatas 10 M<sup>3</sup>)
                  <input type="number" class="form-control form-control-user" id="exampleInputTarifAir" placeholder="Rp.">
                </div>
                <div class="form-group">
                  Tarif Beban Air
                  <input type="number" class="form-control form-control-user" id="exampleInputTarifBebanAir" placeholder="Rp.">
                </div>
                <div class="form-group">
                  Tarif Pemeliharaan Air
                  <input type="number" class="form-control form-control-user" id="exampleInputTarifPemeliharaanAir" placeholder="Rp.">
                </div>
                <div class="form-group">
                  Tarif Air Kotor
                  <input type="number" class="form-control form-control-user" id="exampleInputTarifAirKotor" placeholder="%">
                </div>
                <div class="form-group">
                  PPN Air
                  <input type="number" class="form-control form-control-user" id="exampleInputPpnAir" placeholder="%">
                </div>

                <a href="index.html" class="btn btn-primary btn-user btn-block">
                  Save
                </a>
              </form>
              
            </div>
          </div>
        </div>

      </div>
      <!-- End of Main Content -->
@endsection