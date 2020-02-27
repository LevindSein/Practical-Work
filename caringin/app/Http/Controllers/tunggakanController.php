<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class tunggakanController extends Controller
{
    public function bayarTunggakan(){
        return view('admin.update-tunggakan');
    }
}
