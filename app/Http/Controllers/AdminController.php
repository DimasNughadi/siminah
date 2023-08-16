<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Lokasi;
use App\Models\Adminkelurahan;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        try {
            $user = User::rightJoin('adminkelurahan', 'adminkelurahan.id_user', '=', 'users.id')
                ->leftJoin('lokasi', 'lokasi.id_lokasi', '=', 'adminkelurahan.id_lokasi')
                ->select('users.*', 'adminkelurahan.*', 'lokasi.nama_kelurahan')
                ->orderByDesc('nama_admin')
                ->get();
            return view('after-login.pengelola-csr.admin.index', ['user' => $user]);
        } catch (Exception $exception) {
            return view(
                'after-login.pengelola-csr.admin.index',
                ['message' => 'Tidak ada data']
            );
        }

    }

    public function create()
    {
        try {
            $lokasi = Lokasi::get();
            return view('after-login.pengelola-csr.admin.tambah', ['lokasi' => $lokasi]);
        } catch (Exception $exception) {
            return view(
                'after-login.pengelola-csr.admin.index',
                ['message' => 'Gagal menambah admin']
            );
        }
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'no_hp' => 'required',
            'id_lokasi' => 'required',
            'alamat_rumah' => 'required',
            'username' => 'required',
            'email' => 'required',
        ]);
        try {
            $existingUser = User::where('username', $request->username)->first();
            if ($existingUser) {
                return redirect()->back()->with('error', 'Username sudah ada');
            } else {
                $nama_kelurahan = Lokasi::find($request->id_lokasi)->nama_kelurahan;
                $form_nama_kelurahan = strtolower(str_replace(' ', '', $nama_kelurahan));
                $user2 = User::create([
                    'name' => $request->name,
                    'username' => $request->username,
                    'email' => $request->email,
                    'role' => 'admin_kelurahan',
                    'password' => Hash::make('admin' . $form_nama_kelurahan),
                ]);
                Adminkelurahan::create([
                    'id_user' => $user2->id,
                    'id_lokasi' => $request->id_lokasi,
                    'nama_admin' => $request->name,
                    'alamat_rumah' => $request->alamat_rumah,
                    'no_hp' => $request->no_hp,
                ]);
                return redirect()->route('admin')->with('message', 'Admin berhasil ditambahkan');
            }
        } catch (Exception $exception) {
            return redirect()->back()->with('message', 'Tidak berhasil ditambahkan');
        }
    }
    public function edit($id)
    {
        try {
            $lokasi = Lokasi::get();
            $user = User::rightJoin('adminkelurahan', 'adminkelurahan.id_user', '=', 'users.id')
                ->leftJoin('lokasi', 'lokasi.id_lokasi', '=', 'adminkelurahan.id_lokasi')
                ->select('users.*', 'adminkelurahan.*', 'lokasi.nama_kelurahan')
                ->where('id', $id)
                ->get();
            return view('after-login.pengelola-csr.admin.edit', ['user' => $user, 'lokasi' => $lokasi]);
        } catch (Exception $exception) {
            return redirect()->back()->with('message', 'Data tidak ditemukan');
        }
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'id_lokasi' => 'required',
            'alamat_rumah' => 'required',
            'no_hp' => 'required',
            'email' => 'required',
            'username' => 'required',
        ]);
        try {
            $user = User::findOrFail($id);
            $user->name = $request->name;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->save();

            $user2 = Adminkelurahan::where('id_user', $id);
            $user2->id_lokasi = $request->id_lokasi;
            $user2->nama_admin = $request->name;
            $user2->alamat_rumah = $request->alamat_rumah;
            $user2->no_hp = $request->no_hp;
            $user2->save();
            return redirect()->route('admin')->with('message', 'Admin berhasil diedit');
        } catch (Exception $exception) {
            return redirect()->back()->with(
                ['message' => 'Tidak berhasil mengupdate data']
            );
        }
    }

    public function resetPassword($id)
    {
        try {
            $user = User::findOrFail($id);
            $id_lokasi = Adminkelurahan::where('id_user', $user->id)->id_lokasi;
            $nama_kelurahan = Lokasi::findOrFail($id_lokasi)->nama_kelurahan;
            $form_nama_kelurahan = strtolower(str_replace(' ', '', $nama_kelurahan));
            $user->password = Hash::make('admin' . $form_nama_kelurahan);
            $user->save();
            return redirect()->route('admin')->with('message', 'Password berhasil direset');
        } catch (Exception $exception) {
            return redirect()->back()->with(
                ['message' => 'Password tidak berhasil direset']
            );
        }
    }
    public function destroy($id)
    {
        try {
            $user2 = Adminkelurahan::where('id_user', $id);
            $user2->delete();
            $user = User::findOrFail($id);
            $user->delete();
            return redirect()->route('admin')->with('message', 'Admin berhasil dihapus');
        } catch (Exception $exception) {
            return redirect()->route('admin')->with(
                ['message' => 'Tidak berhasil menghapus data']
            );
        }
    }
}