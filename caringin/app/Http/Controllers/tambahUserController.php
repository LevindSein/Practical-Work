<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class tambahUserController extends Controller
{
    public function show(){
        return view('admin.tambah-user');
    }
}
