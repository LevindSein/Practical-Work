<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class tarifListrikController extends Controller
{
    public function show(){
        return view('admin.tarif-listrik');
    }
}
