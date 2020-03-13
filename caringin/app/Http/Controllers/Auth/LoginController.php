<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Redirector;
use Illuminate\Http\Request;
use App\User;
use Exception;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index(){
        return view('admin.login');
    }

    public function storeUser(Request $request){
        $username = $request->get('username');
        $pass = md5($request->get('password'));

        $user = DB::table('user')
        ->where('nama_user',$username)
        ->first();

        if($user != null && $user->NAMA_USER == $username){
            if($pass == $user->PASSWORD){
                if($user->ROLE == "Super Admin" || $user->ROLE == "admin"){
                    return redirect()->route('showdashboard')->with('success','Login Berhasil');
                }
                else if($user->ROLE == "kasir"){
                    return redirect()->route('lapTagihanKasir')->with('success','Login Berhasil');
                }
                else if($user->ROLE == "manajer"){
                    return redirect()->route('showdashboardmanajer')->with('success','Login Berhasil');
                }
                else if($user->ROLE == "keuangan"){
                    return redirect()->route('index')->with('error','Login Gagal');
                }
                else{
                    return redirect()->route('index')->with('error','Login Gagal');    
                }
            }
            else{
                return redirect()->route('index')->with('error','Username atau Password Salah');
            }
        }
        else{
            return redirect()->route('index')->with('error','Login Gagal');
        }
    }
}
