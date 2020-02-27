@extends('admin.layout')
@section('content')
       <!-- Begin Page Content -->
  
       <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-center">
          <h1 class="h3 mb-0 text-gray-800">Tambah Alat Listrik</h1>
        </div>

        <div class="row justify-content-center">
          <div class="col-lg-6">
            <div class="p-4">
              <form class="user" action="storealatlistrik" method="POST">
              @csrf
                <div class="form-group">
                  Nomor Alat
                  <input required type="text" style="text-transform: uppercase;" name="noalat" class="form-control form-control-user" id="exampleInputNomorL" placeholder="89A82xxx">
                </div>
                <div class="form-group">
                  Kondisi Meteran Akhir
                  <input type="number" name="meteranlistrik" class="form-control form-control-user" id="exampleInputMeteran" placeholder="123xx">
                </div>
                <input type="submit" value="Tambah Alat" class="btn btn-primary btn-user btn-block">
              </form>      
            </div>
          </div>
        </div>

    <!-- End of Main Content -->
@endsection