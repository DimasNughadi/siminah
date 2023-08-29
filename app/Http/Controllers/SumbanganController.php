<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\Lokasi;
use Nette\IOException;
use App\Models\Donatur;
use Barryvdh\DomPDF\PDF;
use App\Models\Kontainer;
use App\Models\Sumbangan;
use Illuminate\Http\Request;
use App\Models\Adminkelurahan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
                $riwayat = Sumbangan::with('donatur', 'kontainer')
                    ->whereHas('kontainer.lokasi', function ($query) use ($id_lokasi) {
                        $query->where('id_lokasi', $id_lokasi);
                    })
                    ->whereIn('status', ['terverifikasi', 'Terverifikasi', 'Ditolak', 'ditolak'])
                    ->orderByDesc('created_at')
                    ->take(10)
                    ->get();
                $verifikasiStatus = Sumbangan::with('donatur')
                    ->whereNotIn('status', ['terverifikasi', 'Terverifikasi', 'Ditolak', 'ditolak']) //belum terverifikasi
                    ->whereHas('kontainer.lokasi', function ($query) use ($id_lokasi) {
                        $query->where('id_lokasi', $id_lokasi);
                    })
                    ->orderBy('created_at')
                    ->get();
                //Persentase Terverifikasi
                $TotalTerverifikasi = Sumbangan::whereIn('status', ['terverifikasi', 'Terverifikasi', 'Ditolak', 'ditolak'])
                    ->whereHas('kontainer.lokasi', function ($query) use ($id_lokasi) {
                        $query->where('id_lokasi', $id_lokasi);
                    })->count();
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
                // dd($verifikasiStatus);
                return view('after-login.admin-kelurahan.sumbangan.index', ['verifikasiStatus' => $verifikasiStatus, 'persentase' => $persentase, 'riwayat' => $riwayat]);
            } else {
                $laporan = Kontainer::join('lokasi', 'kontainer.id_lokasi', '=', 'lokasi.id_lokasi')
                    ->leftJoin('sumbangan', function ($join) {
                        $join->on('kontainer.id_kontainer', '=', 'sumbangan.id_kontainer')
                            ->where('sumbangan.status', '=', 'terverifikasi');
                    })
                    ->select('kontainer.id_kontainer', 'lokasi.nama_kelurahan')
                    ->selectRaw('SUM(COALESCE(sumbangan.berat, 0)) as total_berat')
                    ->selectRaw('COUNT(DISTINCT COALESCE(sumbangan.id_donatur, 0)) as total_donatur')
                    ->selectRaw('MAX(COALESCE(sumbangan.updated_at, "-")) as tanggal_laporan')
                    ->selectRaw('YEAR(COALESCE(sumbangan.updated_at, NOW())) as tahun, MONTH(COALESCE(sumbangan.updated_at, NOW())) as bulan')
                    ->groupBy('kontainer.id_kontainer', 'lokasi.nama_kelurahan', 'tahun', 'bulan')
                    ->orderByDesc('total_berat')
                    ->orderBy('tahun')
                    ->orderBy('bulan')
                    ->get();
                
                return view('after-login.pengelola-csr.sumbangan.index', ['laporan' => $laporan]);
            }
        } catch (Exception $exception) {
            if (auth()->user()->role == 'admin_kelurahan') {
                return view('after-login.admin-kelurahan.sumbangan.index')->with('message', 'Tidak ada data');
            } else {
                return view('after-login.pengelola-csr.sumbangan.index')->with('message', 'Tidak ada data');
            }
        }
    }
    public function edit($id, $created_at)
    {
        try {
            $sumbangan = Sumbangan::where('created_at', $created_at)
                ->where('id_donatur', $id)
                ->first();
            return view('after-login.admin-kelurahan.sumbangan.edit', ['sumbangan' => $sumbangan])->with('verifikasi_alert', 'success');
        } catch (ModelNotFoundException | QueryException $exception) {
            return redirect()->back()->with('verifikasi_alert', 'error');
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
                return redirect()->route('sumbangan')->with('verifikasi_alert', 'tolak');
            } else {
                Sumbangan::where('created_at', $created_at)
                    ->where('id_donatur', $id)
                    ->update(['status' => $request->status]);
                return redirect()->route('sumbangan')->with('verifikasi_alert', 'success');
            }
        } catch (Exception $exception) {
            return redirect()->back()->with('verifikasi_alert', 'error');
        }
    }
}