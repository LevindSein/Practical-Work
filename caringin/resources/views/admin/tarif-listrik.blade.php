@extends('admin.layout')
@section('content')
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-center">
            <h1 class="h3 mb-0 text-gray-800">Tarif Listrik</h1>
          </div>
  
          <div class="row justify-content-center">
            <div class="col-lg-6">
              <div class="p-4">
                <form class="user">
                  <div class="form-group">
                    Tarif Listrik
                    <input type="number" class="form-control form-control-user" id="exampleInputTarifListrik" placeholder="Rp.">
                  </div>
                  <div class="form-group">
                    Pengali Listrik
                    <input type="number" class="form-control form-control-user" id="exampleInputTarifPengaliListrik" placeholder="">
                  </div>
                  <div class="form-group">
                    Tarif Beban Daya
                    <input type="number" class="form-control form-control-user" id="exampleInputTarifBebanDayaListrik" placeholder="Watt">
                  </div>
                  <div class="form-group">
                    Rek. Min
                    <input type="number" class="form-control form-control-user" id="exampleInputTarifBebanRekMin" placeholder="Watt">
                  </div>
                  <div class="form-group">
                    PPN Listrik
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
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

@endsection