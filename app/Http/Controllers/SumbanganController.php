<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Models\Adminkelurahan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Lokasi;
use App\Models\Kontainer;
use App\Models\Donatur;
use App\Models\Sumbangan;
use Carbon\Carbon;
use Nette\IOException;

class SumbanganController extends Controller
{

    public function index(request $Request)
    {
        try {
            if (auth()->user()->role == 'admin_kelurahan') {
                //Sumbangan Belum Terverifikasi
                $id_lokasi = DB::table('adminkelurahan')
                    ->where('id_user', Auth::id())
                    ->value('id_lokasi');
                $riwayat = Sumbangan::with('donatur', 'kontainer')->whereHas('kontainer.lokasi', function ($query) use ($id_lokasi) {
                    $query->where('id_lokasi', $id_lokasi);
                })->whereIn('status', ['terverifikasi', 'Terverifikasi', 'Ditolak', 'ditolak'])->orderByDesc('created_at')->take(10)->get();
                $verifikasiStatus = Sumbangan::with('donatur')->whereNotIn('status', ['terverifikasi', 'Terverifikasi', 'Ditolak', 'ditolak']) //belum terverifikasi
                    ->whereHas('kontainer.lokasi', function ($query) use ($id_lokasi) {
                        $query->where('id_lokasi', $id_lokasi);
                    })
                    ->orderBy('created_at')
                    ->get();
                //Persentase Terverifikasi
                $TotalTerverifikasi = Sumbangan::where('status', 'terverifikasi')
                    ->whereHas('kontainer.lokasi', function ($query) use ($id_lokasi) {
                        $query->where('id_lokasi', $id_lokasi);
                    })
                    ->count();
                $TotalSumbangan = Sumbangan::whereHas('kontainer.lokasi', function ($query) use ($id_lokasi) {
                    $query->where('id_lokasi', $id_lokasi);
                })
                    ->count();
                if ($TotalSumbangan == 0) {
                    $persentase = 0;
                } else {
                    $persentase = $TotalTerverifikasi / $TotalSumbangan * 100;
                }
                $verifikasiStatus->each(function ($item) {
                    if (in_array($item->verifikasiStatus, [''])) {
                        $item->status = 'belum verifikasi';
                    }
                });

                return view('after-login.admin-kelurahan.sumbangan.index', ['verifikasiStatus' => $verifikasiStatus, 'persentase' => $persentase, 'riwayat' => $riwayat]);
            } else {
                $laporan = $laporan = Kontainer::join('lokasi', 'kontainer.id_lokasi', '=', 'lokasi.id_lokasi')
                    ->leftJoin('sumbangan', 'kontainer.id_kontainer', '=', 'sumbangan.id_kontainer')
                    ->select('kontainer.id_kontainer', 'lokasi.nama_kelurahan')
                    ->selectRaw('SUM(CASE WHEN sumbangan.status = "terverifikasi" THEN COALESCE(sumbangan.berat, 0) ELSE 0 END) as total_berat')
                    ->selectRaw('COUNT(DISTINCT CASE WHEN sumbangan.status = "terverifikasi" THEN COALESCE(sumbangan.id_donatur, 0) END) as total_donatur')
                    ->selectRaw('MAX(CASE WHEN sumbangan.status = "terverifikasi" THEN sumbangan.updated_at ELSE "-" END) as tanggal_laporan')
                    ->groupBy('kontainer.id_kontainer', 'lokasi.nama_kelurahan')
                    ->orderByDesc('total_berat')
                    ->get();
                return view('after-login.pengelola-csr.sumbangan.index', ['laporan' => $laporan]);
            }
        } catch (Exception $exception) {
            return redirect()->back()->with('message', 'Tidak ada data');
        }
    }
    public function edit($id, $created_at)
    {
        try {
            $sumbangan = Sumbangan::where('created_at', $created_at)
                ->where('id_donatur', $id)
                ->first();
            return view('after-login.admin-kelurahan.sumbangan.edit', ['sumbangan' => $sumbangan]);
        } catch (ModelNotFoundException | QueryException $exception) {
            return redirect()->back()->with('message', 'Halaman tidak ditemukan');
        }
    }
    public function update($id, $created_at, Request $request)
    {
        $this->validate($request, [
            'status' => 'required',
        ]);
        try {
            if ($request->status === 'ditolak') {
                $this->validate($request, [
                    'keterangan' => 'required|string',
                ]);
                Sumbangan::where('created_at', $created_at)
                    ->where('id_donatur', $id)
                    ->update(['status' => $request->status, 'keterangan' => $request->keterangan]);
                return redirect()->route('sumbangan');
            } else {
                Sumbangan::where('created_at', $created_at)
                    ->where('id_donatur', $id)
                    ->update(['status' => $request->status]);
                return redirect()->route('sumbangan');
            }

        } catch (Exception $exception) {
            return redirect()->back()->with('message', 'Sumbangan tidak berhasil diupdate');
        }
    }
}