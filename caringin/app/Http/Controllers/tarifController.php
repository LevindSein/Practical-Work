<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class tarifController extends Controller
{
    public function showTAir(){
        return view('admin.tarif-air');
    }
    public function showTListrik(){
        return view('admin.tarif-listrik');
    }
    public function showTIpk(){
        return view('admin.tarif-ipk');
    }
    public function showTKeamanan(){
        return view('admin.tarif-keamanan');
    }
    public function showTKebersihan(){
        return view('admin.tarif-kebersihan');
    }
}
