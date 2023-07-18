<?php

namespace App\Http\Controllers;
use App\Models\Lokasi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class LokasiController extends Controller
{
    public function index()
    {
        $lokasi = Lokasi::all();
        return view('after-login.pengelola-csr.lokasi.index', ['lokasi' => $lokasi]);
    }

    public function create()
    {
        return view('after-login.pengelola-csr.lokasi.tambah');
    }
    public function store(Request $request)
    {

            $this->validate($request, [
            'nama_kelurahan' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'deskripsi' => 'required',
        ]);
        Lokasi::create([
            'nama_kelurahan' => $request->nama_kelurahan,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('lokasi');
    }
    public function edit($id)
    {
        $lokasi = lokasi::find($id);
        return view('after-login.pengelola-csr.lokasi.edit', ['lokasi' => $lokasi]);
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'id_lokasi' => 'required',
            'nama_kelurahan' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'deskripsi' => 'required',
        ]);

        $lokasi = Lokasi::findOrFail($id);
        $lokasi->nama = $request->nama;
        $lokasi->nama_kelurahan = $request->nama_kelurahan;
        $lokasi->latitude = $request->latitude;
        $lokasi->longitude = $request->longitude;
        $lokasi->deskripsi = $request->deskripsi;
        $lokasi->save();
        return redirect()->route('lokasi');
    }
    public function destroy($id)
    {
        $lokasi = Lokasi::find($id);
        $lokasi->delete();
        return redirect()->route('lokasi');
    }
}
