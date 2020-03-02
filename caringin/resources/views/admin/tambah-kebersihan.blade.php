@extends('admin.layout')
@section('content')
       <!-- Begin Page Content -->
       <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-center">
          <h1 class="h3 mb-0 text-gray-800">Tambah Tarif Kebersihan</h1>
        </div>

        <div class="row justify-content-center">
          <div class="col-lg-6">
            <div class="p-4">
            <form class="user" action="storekebersihan" method="POST">
              @csrf
                <div class="form-group">
                  Tarif Kebersihan
                  <input required type="number" name="tarif" class="form-control form-control-user" id="exampleInputNomorKtp" placeholder="Rp.">
                </div>
                <button type="submit" class="btn btn-primary btn-user btn-block">Tambah</button>
              </form>
              
            </div>
          </div>
        </div>
      </div>
    <!-- End of Main Content -->
@endsection