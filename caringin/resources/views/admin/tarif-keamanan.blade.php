@extends('admin.layout')
@section('content')

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tarif Keamanan</h1>
          </div>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
              <h6 class="m-0 font-weight-bold text-primary">Kategori Tarif</h6>

              <!--Modal Tambah Kategori-->
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"
                data-whatever="@getbootstrap">Tambah Kategori</button>

              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Tambah Kategori</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form>
                        <div class="form-group">
                          <label for="recipient-name" class="col-form-label">Tarif Keamanan</label>
                          <input type="text" class="form-control" id="recipient-name">
                        </div>
                      </form>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                      <button type="button" class="btn btn-primary">Simpan</button>
                    </div>
                  </div>
                </div>
                <!--Modal Close-->
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Kategori</th>
                      <th>Tarif (Unit)</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Kategori</th>
                      <th>Tarif (Unit)</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <tr>
                      <td class="text-center">1</td>
                      <td>50,000</td>
                      <td class="text-center">
                        <a href="#" class="d-none d-sm-inline-block btn btn-primary shadow-sm"><i
                            class="fas fa- fa-sm text-white-50"></i> Update</a>
                      </td>
                    </tr>
                    <tr>
                      <td class="text-center">2</td>
                      <td>90,000</td>
                      <td class="text-center">
                        <a href="#" class="d-none d-sm-inline-block btn btn-primary shadow-sm"><i
                            class="fas fa- fa-sm text-white-50"></i> Update</a>
                      </td>
                      <tr>
                        <td class="text-center">3</td>
                        <td>108,000</td>
                        <td class="text-center">
                          <a href="#" class="d-none d-sm-inline-block btn btn-primary shadow-sm"><i
                              class="fas fa- fa-sm text-white-50"></i> Update</a>
                        </td>
                      </tr>
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