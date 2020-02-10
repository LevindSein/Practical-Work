<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class userController extends Controller
{
    public function showdatauser(){
        return view('admin.data-user');
    }
    public function tambahuser(){
        return view('admin.tambah-user');
    }
}
