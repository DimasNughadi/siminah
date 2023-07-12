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

class KontainerController extends Controller
{
    public function index()
    {
        $kontainer = Kontainer::with('lokasi')->get();
        return view('pengelolaCSR.kontainer.index', ['kontainer' => $kontainer]);
    }

    public function create()
    {
        return view('pengelolaCSR.kontainer.tambah');
    }
    public function store(Request $request)
    {   
        $this->validate($request, [
            'id_lokasi' => 'required',
            'kapasitas' => 'required|numeric',
            'keterangan' => 'required',
        ]);
        
        Kontainer::create([
            'id_lokasi' => $request->id_lokasi,
            'kapasitas' => $request->kapasitas,
            'keterangan' => $request->keterangan,
        ]);
        return redirect()->route('kontainer');
    }
    public function edit($id)
    {
        $kontainer = Kontainer::find($id);
        return view('pengelolaCSR.kontainer.edit', ['kontainer' => $kontainer]);
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'id_lokasi' => 'required',
            'kapasitas' => 'required',
            'keterangan' => 'required',
        ]);

        $kontainer = Kontainer::findOrFail($id);
        $kontainer->id_lokasi = $request->id_lokasi;
        $kontainer->kapasitas = $request->kapasitas;
        $kontainer->keterangan = $request->keterangan;
        $kontainer->save();
        return redirect()->route('kontainer');
    }
    public function destroy($id)
    {
        $kontainer = Kontainer::find($id);
        $kontainer->delete();
        return redirect()->route('kontainer');
    }
}