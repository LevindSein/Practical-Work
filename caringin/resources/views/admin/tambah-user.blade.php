@extends('admin.layout')
@section('content')

       <!-- Begin Page Content -->
       <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-center">
          <h1 class="h3 mb-0 text-gray-800">Tambah User</h1>
        </div>

        <div class="row justify-content-center">
          <div class="col-lg-6">
            <div class="p-4">
              <form class="user">
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" id="exampleInputNamaUser" placeholder="Nama User">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-user" id="exampleInputPasswordUser" placeholder="Password">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-user" id="exampleInputKonfirmasiPasswordUser" placeholder="Konfirmasi Password">
                </div>
                <div class="form-group">
                  <label for="sel1">Kategori User:</label>
                  <select class="form-control" id="sel1">
                    <option>Admin</option>
                    <option>Kasir</option>
                    <option>Bag. Keuangan</option>
                    <option>Manajer</option>
                  </select>
                </div>
                <a href="index.html" class="btn btn-primary btn-user btn-block">
                  Tambah User
                </a>
              </form>
              
            </div>
          </div>
        </div>
      </div>

    <!-- End of Main Content -->

@endsection