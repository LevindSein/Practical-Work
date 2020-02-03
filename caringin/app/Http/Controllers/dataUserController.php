<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class dataUserController extends Controller
{
    public function show(){
        return view('admin.data-user');
    }
}
