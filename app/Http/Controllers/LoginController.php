<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function index(){
        return view('before-login.login');
    }

    public function ceklogin(Request $request){
        
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            // return response()->json(Response::HTTP_OK);
            return redirect()->route('dashboard')->with('success_alert' , 'Login berhasil');
        } else {
            // return response()->json(['error' => 'Invalid credentials'], Response::HTTP_UNAUTHORIZED);
            return redirect()->route('login')->with('error', 'Username or password is incorrect');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

}
