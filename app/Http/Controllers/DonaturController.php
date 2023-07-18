<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Lokasi;
use App\Models\Kontainer;
use App\Models\Donatur;
use App\Models\Sumbangan;
use Carbon\Carbon;

class DonaturController extends Controller
{
    public function index()
    {
        $donatur = Donatur::all();
        return view('after-login.admin-kelurahan.donatur.index', ['donatur' => $donatur]);
    }

    public function create()
    {
        return view('after-login.admin-kelurahan.donatur.tambah');
    }
    public function store(Request $request)
    {
            $this->validate($request, [
            'no_hp' => 'required',
            'nama_donatur' => 'required',
            'alamat_donatur' => 'required',
            'kelurahan' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'password' => 'required',
        ]);
        $photo = $request->file('photo');
        $photo->storeAs('public/donatur', $photo->hashName());
        donatur::create([
            'no_hp' => $request->no_hp,
            'nama_donatur' => $request->nama_donatur,
            'alamat_donatur' => $request->alamat_donatur,
            'kelurahan' => $request->kelurahan,
            'photo' => $request->photo->hashName(),
            'password' => $request->password,
        ]);
        return redirect()->route('donatur');
    }
    public function edit($id)
    {
        $donatur = donatur::find($id);
        return view('after-login.admin-kelurahan.donatur.edit', ['donatur' => $donatur]);
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'no_hp' => 'required',
            'nama_donatur' => 'required',
            'alamat_donatur' => 'required',
            'kelurahan' => 'required',
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'password' => 'required',
        ]);
        $donatur = donatur::findOrFail($id);
        if ($request->hasFile('photo')) {
    
            $image_path = public_path('storage/public/donatur' . $donatur->photo);
            if (file_exists($image_path)) {
              Storage::delete('public/donatur/' . $donatur->photo);
            }
            $photo = $request->file('photo');
            $photo->storeAs('public/donatur', $photo->hashName());
            $donatur->photo = $request->photo->hashName();
        }
        $donatur->no_hp = $request->no_hp;
        $donatur->nama_donatur = $request->nama_donatur;
        $donatur->kelurahan = $request->kelurahan;
        $donatur->password = $request->password;
        $donatur->save();
        return redirect()->route('donatur');
    }
    public function destroy($id)
    {
        $donatur = donatur::find($id);
        $donatur->delete();
        return redirect()->route('donatur');
    }
}