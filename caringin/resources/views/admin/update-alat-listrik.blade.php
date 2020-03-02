@extends('admin.layout')
@section('content')
       <!-- Begin Page Content -->
       <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-center">
          <h1 class="h3 mb-0 text-gray-800">Update Alat Listrik</h1>
        </div>

        <div class="row justify-content-center">
          <div class="col-lg-6">
            <div class="p-4">
            @foreach ($dataset as $data)
            <form class="user" action="{{url('update/storealatlistrik',[$data->ID_MLISTRIK])}}" method="POST">
              @csrf
              <div class="form-group">
                  Nomor Alat
                  <input value="{{$data->NOMTR_LISTRIK}}" required type="text" style="text-transform: uppercase;" name="noalat" class="form-control form-control-user" id="exampleInputNomor" placeholder="89A82xxx">
                </div>
                <div class="form-group">
                  Kondisi Meteran Akhir
                  <input required value="{{$data->MAKHIR_LISTRIK}}" type="number" name="meteranlistrik" class="form-control form-control-user" id="exampleInputMeteran" placeholder="123xx">
                </div>
                @endforeach
                <button type="submit" class="btn btn-primary btn-user btn-block">Simpan</button>
              </form>
              
            </div>
          </div>
        </div>
      </div>
    <!-- End of Main Content -->
@endsection