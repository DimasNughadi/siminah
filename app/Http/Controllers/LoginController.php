<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }
    public function ceklogin(Request $request){
        
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        if(!Auth::attempt([
            'username' => $request->username,
            'password' => $request->password,
        ])){
            return redirect()->route('login')->with('error','email atau password salah');
        }else{
            return redirect()->route('dashboard');
        };
    }
}
