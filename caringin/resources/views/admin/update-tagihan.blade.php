@extends('admin.layout')
@section('content')
       <!-- Begin Page Content -->
       <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-center">
          <h1 class="h3 mb-0 text-gray-800">Bayar Tagihan</h1>
        </div>

        <div class="row justify-content-center">
          <div class="col-lg-6">
            <div class="p-4">
            @foreach ($dataset as $data)
            <form class="user" action="{{url('bayartagihan/store',[$data->ID_TAGIHANKU])}}" method="POST">
              @csrf
                <div class="form-group">
                  Kode Kontrol
                  <input readonly value="{{$data->KD_KONTROL}}" type="text" name="kode" class="form-control form-control-user" id="exampleInputKode" placeholder="A-1-001">
                </div>
                <div class="form-group">
                  Nama Nasabah
                  <input readonly type="text" name="nama" class="form-control form-control-user" id="exampleInputNama">
                </div>
                <div class="form-group">
                  Total Tagihan
                  <input readonly value="{{$data->TTL_TAGIHAN}}" type="number" name="tagihan" class="form-control form-control-user" id="exampleInputTagihan" placeholder="Rp.">
                </div>
                <div class="form-group">
                  Realisasi Pembayaran
                  <input required type="number" name="bayar" class="form-control form-control-user" id="exampleInputBayar" placeholder="Rp.">
                </div>
                @endforeach
                <button type="submit" class="btn btn-primary btn-user btn-block">Bayar</button>
              </form>
            </div>
          </div>
        </div>

    <!-- End of Main Content -->
@endsection