<?php

namespace App\Http\Controllers;

use App\Models\Adminkelurahan;
use Exception;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    public function index()
    {
        try {
            $user = User::rightJoin('adminkelurahan', 'adminkelurahan.id_user', '=', 'users.id')
                ->leftJoin('lokasi', 'lokasi.id_lokasi', '=', 'adminkelurahan.id_lokasi')
                ->select('users.*', 'adminkelurahan.*', 'lokasi.nama_kelurahan')
                ->where('id', Auth::id())
                ->get()[0];
            return view('after-login.admin-kelurahan.profil.index', ['user' => $user]);
        } catch (Exception $exception) {
            return redirect()->back()->with('message', 'Tidak berhasil membuka profil');

        }
    }

    public function edit()
    {
        try {
            $user = User::rightJoin('adminkelurahan', 'adminkelurahan.id_user', '=', 'users.id')
                ->leftJoin('lokasi', 'lokasi.id_lokasi', '=', 'adminkelurahan.id_lokasi')
                ->select('users.*', 'adminkelurahan.*', 'lokasi.nama_kelurahan')
                ->where('id', Auth::id())
                ->get()[0];
            return view('after-login.admin-kelurahan.profil.edit', ['user' => $user]);
        } catch (Exception $exception) {
            return redirect()->back()->with('message', 'Tidak berhasil membuka profil');

        }
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'password' => 'required',
        ]);
        try {
            $user = User::findOrFail($id);
            $user->password = Hash::make($request->password);
            $user->save();

            return redirect()->route('admin')->with('edit_alert', 'success');
        } catch (Exception $exception) {
            return redirect()->back()->with(
                ['edit_alert' => 'error']
            );
        }
    }
}