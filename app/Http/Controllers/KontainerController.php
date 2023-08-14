<?php

namespace App\Http\Controllers;

use App\Http\Resources\KontainerResource;
use App\Models\Permintaan;
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
        if (auth()->user()->role == 'admin_kelurahan') {
            $id_lokasi = DB::table('adminkelurahan')
                ->where('id_user', Auth::id())
                ->value('id_lokasi');
            $id_kontainer = DB::table('kontainer') // 1 to 1 id_lokasi
                ->where('id_lokasi', $id_lokasi)
                ->value('id_kontainer');
            $kontainer = Kontainer::with('lokasi')
                ->where('kontainer.id_lokasi', $id_lokasi)
                ->withSum([
                    'sumbangan' => function ($query) use ($id_lokasi) {
                        $query->leftJoin('permintaan', 'kontainer.id_kontainer', '=', 'permintaan.id_kontainer')
                            ->where(function ($subquery) {
                                        $subquery->where('status', 'terverifikasi')
                                            ->where('sumbangan.updated_at', '>=', function ($subquery) {
                                                                    $subquery->selectRaw('COALESCE(MAX(CASE WHEN status_permintaan = "berhasil" THEN permintaan.updated_at ELSE NULL END), MAX(kontainer.updated_at))')
                                                                        ->from('kontainer')
                                                                        ->leftJoin('permintaan', 'kontainer.id_kontainer', '=', 'permintaan.id_kontainer')
                                                                        ->whereColumn('kontainer.id_kontainer', 'sumbangan.id_kontainer');
                                                                });
                                    });
                    }
                ], 'berat')
                ->get();
            //UNTUK HITUNG PERSENTASE
            $notifikasi = [];
            $kontainer->each(function ($item) use (&$notifikasi) {
                if ($item->sumbangan_sum_berat == null) {
                    $item->sumbangan_sum_berat = 0;
                    $item->sumbangan_persentase = 0;
                } else {
                    $item->sumbangan_persentase = $item->sumbangan_sum_berat / $item->kapasitas * 100;
                    if ($item->sumbangan_sum_berat >= $item->kapasitas * 3 / 4) {
                        $notifikasi[] = [
                            'id_kontainer' => $item->id_kontainer,
                            'id_lokasi' => $item->id_lokasi,
                            'status' => 'hampir penuh',
                        ];
                    }
                }
            });
            $permintaan = Permintaan::with('lokasi')->where('id_lokasi', $id_lokasi)->get();
            
            return view('after-login.admin-kelurahan.kontainer.index', ['kontainer' => $kontainer, 'notifikasi' => $notifikasi , 'permintaan'=>$permintaan ,'id_kontainer' => $id_kontainer]);
        } else {
            $kontainer = Kontainer::with('lokasi')
                ->withSum([
                    'sumbangan' => function ($query) {
                        $query->leftJoin('permintaan', 'kontainer.id_kontainer', '=', 'permintaan.id_kontainer')
                            ->where(function ($subquery) {
                                        $subquery->where('status', 'terverifikasi')
                                            ->where('sumbangan.updated_at', '>=', function ($subquery) {
                                                                    $subquery->selectRaw('COALESCE(MAX(CASE WHEN status_permintaan = "berhasil" THEN permintaan.updated_at ELSE NULL END), MAX(kontainer.updated_at))')
                                                                        ->from('kontainer')
                                                                        ->leftJoin('permintaan', 'kontainer.id_kontainer', '=', 'permintaan.id_kontainer')
                                                                        ->whereColumn('kontainer.id_kontainer', 'sumbangan.id_kontainer');
                                                                });
                                    });

                    }
                ], 'berat')
                ->withMax([
                    'sumbangan' => function ($query) {
                        $query->where('status', 'terverifikasi');
                    }
                ], 'updated_at')
                ->get();
            $kontainer->each(function ($item) {
                if ($item->sumbangan_sum_berat == null) {
                    $item->sumbangan_sum_berat = 0;
                    $item->sumbangan_persentase = 0;
                } else {
                    $item->sumbangan_persentase = $item->sumbangan_sum_berat / $item->kapasitas * 100;
                }
                if ($item->sumbangan_max_updated_at == null) {
                    $item->sumbangan_max_updated_at = 'belum pernah diisi';
                }
            });
            $permintaan = Permintaan::with('lokasi')->get();
            $notifikasi = [];
            $permintaan->each(function ($item) use (&$notifikasi) {
                if (in_array($item->status_permintaan, ['diajukan', 'Diajukan'])) {
                    $notifikasi[] = [
                        'id_permintaan' => $item->id_permintaan,
                        'nama_kelurahan' => $item->lokasi->nama_kelurahan,
                    ];
                }
            });
            return view('after-login.pengelola-csr.kontainer.index', ['kontainer' => $kontainer, 'permintaan' => $permintaan, 'notifikasi' => $notifikasi]);
        }
    }

    public function updatePermintaan($id)
    {
        $permintaan = Permintaan::findOrFail($id);
        $permintaan->status_permintaan = 'berhasil';
        $permintaan->save();
        return redirect()->route('kontainer');
    }

    public function storePermintaan($id_kontainer)
    {
        $existingRequest = Permintaan::where('id_kontainer', $id_kontainer)
            ->where('status_permintaan', 'diajukan')
            ->first();

        if ($existingRequest) {
            return redirect()->back()->with('error', 'Permintaan sudah ada yang diajukan.');
        }
        $id_admin = DB::table('adminkelurahan')
            ->where('id_user', Auth::id())
            ->value('id_admin_kelurahan');
        $id_lokasi = DB::table('kontainer')
            ->where('id_kontainer', $id_kontainer)
            ->value('id_lokasi');
        Permintaan::create([
            'id_kontainer' => $id_kontainer,
            'id_lokasi' => $id_lokasi,
            'id_admin_kelurahan' => $id_admin,
            'tanggal_permintaan' => Carbon::now()->startOfDay(),
            'status_kontainer' => 'penuh',
            'status_permintaan' => 'diajukan',
        ]);
        
        return redirect()->route('kontainer');
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