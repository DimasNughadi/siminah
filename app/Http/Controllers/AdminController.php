<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Lokasi;
use App\Models\Adminkelurahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class AdminController extends Controller
{
    public function index()
    {
        $user = User::rightJoin('adminkelurahan','adminkelurahan.id_user','=','users.id')
        ->leftJoin('lokasi','lokasi.id_lokasi','=','adminkelurahan.id_lokasi')
        ->select('users.*','adminkelurahan.*','lokasi.nama_kelurahan')
       ->get();
        return view('after-login.admin-kelurahan.admin.index', ['user' => $user]);
    }

    public function create()
    {
        return view('after-login.admin-kelurahan.admin.tambah');
    }
    public function store(Request $request)
    {

            $this->validate($request, [
            'name' => 'required',
            'id_lokasi' => 'required',
            'alamat_rumah' => 'required',
            'no_hp' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);
        $user2 = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => 'emailpokoknya@gmail.com',
            'role' => 'admin_kelurahan',
            'password' => Hash::make($request->password),
        ]);
        Adminkelurahan::create([
            'id_user' => $user2->id,
            'id_lokasi' => $request->id_lokasi,
            'alamat_rumah' => $request->alamat_rumah,
            'no_hp'=> $request->no_hp,
        ]);

        return redirect()->route('admin');
    }
    public function edit($id)
    {
        $user = User::find($id);
        return view('after-login.admin-kelurahan.admin.edit', ['user' => $user]);
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'id_lokasi' => 'required',
            'alamat_rumah' => 'required',
            'no_hp' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        $user2 = Adminkelurahan::findOrFail($id);
        $user2->id_lokasi = $request->id_lokasi;
        $user2->alamat_rumah = $request->alamat_rumah;
        $user2->no_hp = $request->no_hp;

        return redirect()->route('admin');
    }
    public function destroy($id)
    {
        $user2= Adminkelurahan::findOrFail($id);
        $user2->delete();
        //$user = User::findOrFail($id);
        //$user->delete();
        return redirect()->route('admin');
    }
}
