<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Redirector;
use Exception;
use Illuminate\Support\Facades\Session;

class userController extends Controller
{
    public function showdatauser(){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "Super Admin"){

        $dataset = DB::table('user')
        ->select('ID_USER','NAMA_USER','ROLE')
        ->get();
        return view('admin.data-user',['dataset'=>$dataset]);
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }

    public function hapusUser($id){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "Super Admin"){

        DB::table('user')->where('ID_USER',$id)->delete();
        return redirect()->route('datauser')->with('Success','Berhasil Dihapus');
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }

    public function resetPass($id){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "Super Admin"){

        $random = str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ1234567890!$%&?#');
        $password = substr($random, 0, 7);

        $pass = md5($password);
        
        DB::table('user')->where('ID_USER', $id)->update([
            'PASSWORD'=>$pass,
        ]);
        return redirect()->route('datauser')->with('pass','Password anda = '.$password);
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }

    public function tambahuser(){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "Super Admin"){

        return view('admin.tambah-user');
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }

    public function storeUser(Request $request){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "Super Admin"){

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
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }
}
