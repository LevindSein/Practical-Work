@extends('admin.layout')
@section('content')
       <!-- Begin Page Content -->
       <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-center">
          <h1 class="h3 mb-0 text-gray-800">Tambah Nasabah</h1>
        </div>

        <div class="row justify-content-center">
          <div class="col-lg-6">
            <div class="p-4">
              <form class="user">
                <div class="form-group">
                  Nama Nasabah
                  <input type="text" class="form-control form-control-user" id="exampleInputNamaNasabah" placeholder="Nama">
                </div>
                <div class="form-group">
                  Blok
                  <input type="text" class="form-control form-control-user" id="exampleInputKodeBlok" placeholder="Misal: A-1">
                </div>
                <div class="form-group">
                  No. Los
                  <input type="text" class="form-control form-control-user" id="exampleInputBanyakLos" placeholder="Misal: 1, 2, 2A">
                </div>
                <div class="form-group">
                  <label for="sel1">Status Kepemilikan</label>
                  <select class="form-control" id="exampleInputStatus">
                    <option value="pemilik">Pemilik</option>
                    <option value="penyewa">Penyewa</option>
                  </select>
                </div>
                <div class="form-group">
                  Bentuk Usaha
                  <input type="text" class="form-control form-control-user" id="exampleInputBentukUsaha" placeholder="">
                </div>
                <div class="form-group">
                  Nomor KTP Nasabah
                  <input type="number" class="form-control form-control-user" id="exampleInputNomorKtp" placeholder="">
                </div>
                <div class="form-group">
                  Nomor NPWP Nasabah
                  <input type="number" class="form-control form-control-user" id="exampleInputNpwpPelanggan" placeholder="">
                </div>
                <div class="form-group">
                  <label for="sel1">Kategori Tarif IPK</label>
                  <select class="form-control" id="exampleInputStatus">
                    <option>0</option>
                    <option>200000</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="sel1">Kategori Tarif Keamanan</label>
                  <select class="form-control" id="exampleInputStatus">
                    <option>0</option>
                    <option>200000</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="sel1">Kategori Tarif Kebersihan</label>
                  <select class="form-control" id="exampleInputStatus">
                    <option>0</option>
                    <option>100000</option>
                  </select>
                </div>
                <div class="form-group row">
                  <div class="col-sm-2">Fasilitas</div>
                  <div class="col-sm-10">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck1">
                      <label class="form-check-label" for="gridCheck1">
                        Air
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck2">
                      <label class="form-check-label" for="gridCheck2">
                        Listrik
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck3">
                      <label class="form-check-label" for="gridCheck3">
                        IPK & Keamanan
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck4">
                      <label class="form-check-label" for="gridCheck4">
                        Kebersihan
                      </label>
                    </div>
                  </div>
                </div>

                <a href="index.html" class="btn btn-primary btn-user btn-block">
                  Tambah Nasabah
                </a>
              </form>
              
            </div>
          </div>
        </div>

    <!-- End of Main Content -->
@endsection