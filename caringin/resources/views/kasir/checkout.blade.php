@extends('kasir.layout')
@section('content')
<?php
$id = implode(",",$ids);
?>

       <!-- Begin Page Content -->
       <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-center">
          <h1 class="h3 mb-0 text-gray-800">Checkout</h1>
        </div>

        <div class="row justify-content-center">
          <div class="col-lg-6">
            <div class="p-4">
            @foreach ($dataset as $d)
            <form class="user" action="{{url('storecheckout')}}" method="POST">
              @csrf
                <div class="form-group">
                  Nama Nasabah
                  <input readonly value="{{$dataku->NM_NASABAH}}" class="form-control form-control-user">
                </div>
                <div class="form-group">
                  No. Anggota
                  <input readonly value="{{$dataku->NO_ANGGOTA}}" class="form-control form-control-user">
                </div>
                <div class="form-group">
                  Tagihan Air
                  <input readonly value="Rp. {{number_format($d->ttlAir)}}" class="form-control form-control-user">
                </div>
                <div class="form-group">
                  Denda Air
                  <input readonly value="Rp. {{number_format($d->dendaAir)}}" class="form-control form-control-user">
                </div>
                <div class="form-group">
                  Tagihan Listrik
                  <input readonly value="Rp. {{number_format($d->ttlListrik)}}" class="form-control form-control-user">
                </div>
                <div class="form-group">
                  Denda Listrik
                  <input readonly value="Rp. {{number_format($d->dendaListrik)}}" class="form-control form-control-user">
                </div>
                <div class="form-group">
                  Tagihan IPK & Keamanan
                  <input readonly value="Rp. {{number_format($d->ttlIpkeamanan)}}" class="form-control form-control-user">
                </div>
                <div class="form-group">
                  Tagihan Kebersihan
                  <input readonly value="Rp. {{number_format($d->ttlKebersihan)}}" class="form-control form-control-user">
                </div>
                <div class="form-group">
                  Total Tagihan
                  <input readonly value="Rp. {{number_format($d->ttlTagihan + $d->dendaAir + $d->dendaListrik)}}" class="form-control form-control-user">
                </div>
                @endforeach
                <button type="submit" class="btn btn-primary btn-user btn-block" name="bayar[]" value="{{$id}}">Bayar</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    <!-- End of Main Content -->
@endsection