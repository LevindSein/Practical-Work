<?php
use Illuminate\Http\Request;
use App\Tempat_usaha;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Redirector;
?>

@extends('admin.layout')
@section('content')
       <!-- Begin Page Content -->
       <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-center">
          <h1 class="h3 mb-0 text-gray-800">Otoritas Pegawai</h1>
        </div>

        <div class="row justify-content-center">
          <div class="col-lg-6">
            <div class="p-4">
              <form class="user" action="{{url('otoritasstore')}}" method="POST">
              @csrf             
                @for($i=0;$i<$ttlBlok;$i++)
                <?php
                $bloks=$blok[$i];
                $blokku = DB::table('tempat_usaha')
                    ->where('BLOK',$bloks->BLOK)
                    ->count();
                $user = DB::table('user')
                    ->select('ID_USER','NAMA_USER')
                    ->where('ROLE','admin')
                    ->get();
                $id_User = DB::table('tempat_usaha')
                    ->leftJoin('user','tempat_usaha.ID_USER','=','user.ID_USER')
                    ->select('tempat_usaha.ID_USER','user.NAMA_USER')
                    ->where('tempat_usaha.BLOK',$bloks->BLOK)
                    ->first();
                ?>

                <div class="form-group">
                  <label for="sel1">{{$bloks->BLOK}}&emsp;({{$blokku}} unit)</label>
                  <select class="form-control" name="userId[]" id="myDiv1">
                    <option selected hidden value="{{$id_User->ID_USER}}">{{$id_User->NAMA_USER}}</option>
                    @foreach($user as $u)
                    <option value="{{$u->ID_USER}}">{{$u->NAMA_USER}}</option>
                    @endforeach
                  </select>
                </div>
                @endfor
                <button type="submit" class="btn btn-primary btn-user btn-block">Simpan</button>
              </form>
              
            </div>
          </div>
        </div>
      </div>
    <!-- End of Main Content -->
@endsection