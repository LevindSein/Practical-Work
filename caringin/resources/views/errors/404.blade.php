@extends('errors::minimal')

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- 404 Error Text -->
<div class="text-center">
  <div class="error mx-auto" data-text="404">404</div>
  <p class="lead text-gray-800 mb-5">Page Not Found</p>
  <p class="text-gray-500 mb-0">Halaman yang anda cari tidak ditemukan</p>
</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

@section('title', __('Not Found'))
@section('code', '404')
@section('message', __('Not Found'))
