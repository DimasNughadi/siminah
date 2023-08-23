<?php

namespace App\Http\Controllers;

use App\Models\Kontainer;
use App\Models\Lokasi;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class LokasiController extends Controller
{
    public function index()
    {
        try {
            $lokasi = Lokasi::all();
            return view('after-login.pengelola-csr.lokasi.index', ['lokasi' => $lokasi]);
        } catch (Exception $exception) {
            return redirect()->back()->with('message', 'Tidak ada data');
        }
    }

    public function create()
    {
        try {
            return view('after-login.pengelola-csr.lokasi.tambah');
        } catch (Exception $exception) {
            return redirect()->back()->with('message', 'Halaman tidak ditemukan');
        }
    }
    public function store(Request $request)
    {

        try {
            $this->validate($request, [
                'nama_kelurahan' => 'required',
                'latitude' => 'required',
                'longitude' => 'required',
                'deskripsi' => 'required',
            ]);
            $lokasi = Lokasi::create([
                'nama_kelurahan' => $request->nama_kelurahan,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'deskripsi' => $request->deskripsi,
            ]);

            Kontainer::create([
                'id_lokasi' => $lokasi->id_lokasi,
                'kapasitas' => '30',
                'keterangan' => '-',
            ]);
            return redirect()->route('lokasi');
        } catch (Exception $exception) {
            return redirect()->back()->with('message', 'Lokasi tidak berhasil ditambahkan');
        }
    }
    public function edit($id)
    {
        try {
            $lokasi = lokasi::find($id);
            return view('after-login.pengelola-csr.lokasi.edit', ['lokasi' => $lokasi]);
        } catch (Exception $exception) {
            return redirect()->back()->with('message', 'Lokasi tidak ditemukan');
        }
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
        try {
            $lokasi = Lokasi::findOrFail($id);
            $lokasi->nama = $request->nama;
            $lokasi->nama_kelurahan = $request->nama_kelurahan;
            $lokasi->latitude = $request->latitude;
            $lokasi->longitude = $request->longitude;
            $lokasi->deskripsi = $request->deskripsi;
            $lokasi->save();
            return redirect()->route('lokasi');
        } catch (Exception $exception) {
            return redirect()->back()->with('message', 'Lokasi tidak berhasil diupdate');
        }
    }
    public function destroy($id)
    {
        try {
            $lokasi = Lokasi::find($id);
            $lokasi->delete();
            return redirect()->route('lokasi');
        } catch (Exception $exception) {
            return redirect()->back()->with('message', 'Lokasi tidak berhasil dihapus');
        }
    }
}