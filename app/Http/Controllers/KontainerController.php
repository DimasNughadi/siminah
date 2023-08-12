<?php

namespace App\Http\Controllers;

use App\Http\Resources\KontainerResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $id_lokasi = DB::table('adminkelurahan')
            ->where('id_user', Auth::id())
            ->value('id_lokasi');
        if (auth()->user()->role == 'admin_kelurahan') {
            $kontainer = Kontainer::with('lokasi')
                ->where('kontainer.id_lokasi', $id_lokasi)
                ->withSum([
                    'sumbangan' => function ($query) use ($id_lokasi) {
                        $query->leftJoin('permintaan', 'kontainer.id_kontainer', '=', 'permintaan.id_kontainer')       
                        ->where(function ($subquery) {
                                        $subquery->where('status', 'terverifikasi')
                                            ->where('sumbangan.updated_at', '>=', function ($subquery) {
                                                                    $subquery->selectRaw('COALESCE(MAX(CASE WHEN status_permintaan = "diterima" THEN permintaan.updated_at ELSE NULL END), MAX(kontainer.updated_at))')
                                                                        ->from('kontainer')
                                                                        ->leftJoin('permintaan', 'kontainer.id_kontainer', '=', 'permintaan.id_kontainer')
                                                                        ->whereColumn('kontainer.id_kontainer', 'sumbangan.id_kontainer');
                                                                });
                                    });
                    }
                ], 'berat')
                ->get();
            return view('after-login.admin-kelurahan.kontainer.index', ['kontainer' => $kontainer]);
        } else {
            $kontainers = Kontainer::where('id_lokasi', $id_lokasi)->get();
            return view('after-login.pengelola-csr.kontainer.index', ['kontainer' => $kontainers]);
        }
    }

    public function create()
    {
        return view('after-login.pengelola-csr.kontainer.tambah');
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
        return view('after-login.pengelola-csr.kontainer.edit', ['kontainer' => $kontainer]);
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