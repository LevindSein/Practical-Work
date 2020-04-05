@extends('kasir.layout')
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
            <form class="user" action="{{url('printstruk',[$data->ID_TAGIHANKU])}}" method="POST">
              @csrf
                <div class="form-group">
                  Kode Kontrol
                  <input readonly value="{{$data->KD_KONTROL}}" type="text" name="kode" class="form-control form-control-user" id="exampleInputKode" placeholder="A-1-001">
                </div>
                <div class="form-group">
                  Nama Nasabah
                  <input readonly value="{{$data->NM_NASABAH}}" type="text" name="nama" class="form-control form-control-user" id="exampleInputNama">
                </div>
                <div class="form-group">
                  Tagihan Air
                  <input readonly value="Rp. {{number_format($data->SELISIH_AIR + $data->DENDA_AIR)}}" class="form-control form-control-user" placeholder="Rp.">
                </div>
                <div class="form-group">
                  Tagihan Listrik
                  <input readonly value="Rp. {{number_format($data->SELISIH_LISTRIK + $data->DENDA_LISTRIK)}}" class="form-control form-control-user" placeholder="Rp.">
                </div>
                <div class="form-group">
                  Tagihan IPK & Keamanan
                  <input readonly value="Rp. {{number_format($data->SELISIH_IPKEAMANAN)}}" class="form-control form-control-user" placeholder="Rp.">
                </div>
                <div class="form-group">
                  Tagihan Kebersihan
                  <input readonly value="Rp. {{number_format($data->SELISIH_KEBERSIHAN)}}" class="form-control form-control-user" placeholder="Rp.">
                </div>
                <div class="form-group">
                  Total Tagihan
                  <input readonly value="Rp. {{number_format($data->SELISIH + $data->DENDA)}}" name="tagihan" class="form-control form-control-user" id="exampleInputTagihan" placeholder="Rp.">
                </div>
                <div class="form-group">
                  Realisasi
                  <input type="text" pattern="^[\d,]+$" name="realisasi" class="form-control form-control-user" id="exampleInputRealisasi"
                  <?php if($data->STT_CICIL == 0){ ?> readonly="readonly" value="{{number_format($data->SELISIH + $data->DENDA)}}" <?php } ?>>
                </div>
                @endforeach
                <button type="submit" class="btn btn-primary btn-user btn-block">Bayar</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    <!-- End of Main Content -->
@endsection

@section('js')
<script>
  document.getElementById('exampleInputRealisasi').addEventListener('input', event =>
  event.target.value = (parseInt(event.target.value.replace(/[^\d]+/gi, '')) || 0).toLocaleString('en-US'));
</script>
@endsection