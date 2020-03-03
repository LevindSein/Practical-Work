@extends('admin.layout')
@section('content')
       <!-- Begin Page Content -->
       <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-center">
          <h1 class="h3 mb-0 text-gray-800">Tambah Hari Libur</h1>
        </div>

        <div class="row justify-content-center">
          <div class="col-lg-6">
            <div class="p-4">
            <form class="user" action="storelibur" method="POST">
              @csrf
                 <div class="form-group">
                  Tanggal
                  <input required type="date" name="libur" class="form-control form-control-user" id="exampleInputLibur">
                </div>
                <div class="form-group">
                  Keterangan
                  <input required type="text" name="ket" class="form-control form-control-user" id="exampleInputKeterangan" placeholder="Libur Kenapa Ya ?">
                </div>
                <button type="submit" class="btn btn-primary btn-user btn-block">Tambah</button>
              </form>
              
            </div>
          </div>
        </div>
      </div>
    <!-- End of Main Content -->
@endsection