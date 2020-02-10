<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Nasabah;
use App\Jasa_air;
use Illuminate\Support\Facades\DB;

class nasabahController extends Controller
{
    public function showdata(){
        return view('admin.data-nasabah');
    }
    public function showform(){
        return view('admin.tambah-nasabah');
    }
    public function updateNasabah(){
        return view('admin.update-nasabah');
    }
    public function showtempatusaha(){
        return view('admin.tempat-usaha');
    }
    public function showformtempat(){
        return view('admin.tambah-tempat');
    }
    public function updateTempat(){
        return view('admin.update-tempat');
    }
}
