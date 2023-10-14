<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class LoginController extends Controller
{
    public function index()
    {
        try {
            if (Auth::check()) {
                if (isAdminCsr()) {
                    return redirect('/dashboard');
                } else if (isAdminKelurahan()) {
                    return redirect('/donatur');
                } else {
                    return view('authentication.login');
                }
            } else {
                return view('authentication.login');
            }
        } catch (Exception $exception) {
            return view('authentication.error')->with('message', 'Kontainer tidak berhasil dihapus');
        }
    }

    public function ceklogin(Request $request)
    {
        try {
            
            $credentials = $request->only('username', 'password');
            $remember = $request->has('remember'); // Check if 'remember' checkbox is checked

            if (Auth::attempt($credentials, $remember)) {
                $request->session()->regenerate();
                Session::put('id_user', Auth::user()->id);
                return redirect()->route('dashboard')->with('login_alert', 'success');
            } else {
                return redirect()->route('login')->with('login_alert', 'error');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('login_alert', 'error');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('logout_alert', 'success');
    }

}