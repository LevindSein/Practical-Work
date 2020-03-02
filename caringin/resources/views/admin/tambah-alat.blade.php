@extends('admin.layout')
@section('content')
       <!-- Begin Page Content -->
  
       <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-center">
          <h1 class="h3 mb-0 text-gray-800">Tambah Alat</h1>
        </div>

        <div class="row justify-content-center">
          <div class="col-lg-6">
            <div class="p-4">
              <form class="user" action="storealat" method="POST">
              @csrf
                <div class="form-group">
                  Nomor Alat
                  <input required type="text" style="text-transform: uppercase;" name="noalat" class="form-control form-control-user" id="exampleInputNomor" placeholder="89A82xxx">
                </div>
                <div class="form-group row">
                  <div class="col-sm-2">Alat</div>
                  <div class="col-sm-10">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="alat" id="myRadioA" value="A" checked>
                      <label class="form-check-label" for="myRadioA">
                        Air
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="alat" id="myRadioL" value="L">
                      <label class="form-check-label" for="myRadioL">
                        Listrik
                      </label>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  Kondisi Meteran Awal
                  <input type="number" name="meteran" class="form-control form-control-user" id="exampleInputMeteran" placeholder="123xx">
                </div>
                <input type="submit" value="Tambah Alat" class="btn btn-primary btn-user btn-block">
              </form>      
            </div>
          </div>
        </div>
      </div>
    <!-- End of Main Content -->
@endsection