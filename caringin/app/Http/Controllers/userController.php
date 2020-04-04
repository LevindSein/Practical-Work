<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Redirector;
use Exception;

class userController extends Controller
{
    public function showdatauser(){
        return view('admin.data-user');
    }
    public function tambahuser(){
        return view('admin.tambah-user');
    }
    public function storeUser(Request $request){
        $username = $request->get('username');
        $role = $request->get('role');
        $random = str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ1234567890!$%&?#');
        $password = substr($random, 0, 7);

        $pass = md5($password);
        
        $data = new User([
            'nama_user'=>$username,
            'password'=>$pass,
            'role'=>$role
        ]);
        $data->save();
        return redirect()->route('datauser')->with('pass','Password anda = '.$password);
    }
}
