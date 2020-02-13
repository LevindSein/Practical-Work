@extends('admin.layout')
@section('content')

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Data User</h1>
          </div>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Tabel Data User</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="tableUser" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Username</th>
                      <th>Status</th>
                      <th>Hapus</th>
                      <th>Reset</th>
                    </tr>
                  </thead>
                  
                  <tbody>
                    <tr>
                      <td class="text-left">Fahni Amsyari</td>
                      <td class="text-center">Admin</td>
                      <td class="text-center">
                          <a href="#" class="d-none d-sm-inline-block btn btn-danger shadow-sm"><i
                              class="fas fa- fa-sm text-white-50"></i> Hapus</a>
                      </td>
                      <td class="text-center">
                          <a href="#" class="d-none d-sm-inline-block btn btn-primary shadow-sm"><i
                              class="fas fa- fa-sm text-white-50"></i> Reset</a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

@endsection