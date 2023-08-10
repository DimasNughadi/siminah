<?php

namespace App\Http\Controllers;

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

class SumbanganController extends Controller
{

    public function index(request $Request)
    {
        //Sumbangan Belum Terverifikasi
        $id_lokasi = DB::table('adminkelurahan')
            ->where('id_user', Auth::id())
            ->value('id_lokasi');
        $verifikasiStatus = Sumbangan::whereNotIn('status', ['Terverifikasi', 'terverifikasi']) //belum terverifikasi
            ->whereHas('kontainer.lokasi', function ($query) use ($id_lokasi) {
                $query->where('id_lokasi', $id_lokasi);
            })
            ->get();

        //Persentase Belum Terverifikasi
        $TotalTerverifikasi = Sumbangan::where('status', 'terverifikasi')
            ->whereHas('kontainer.lokasi', function ($query) use ($id_lokasi) {
                $query->where('id_lokasi', $id_lokasi);
            })
            ->count();
        $TotalSumbangan = Sumbangan::whereHas('kontainer.lokasi', function ($query) use ($id_lokasi) {
            $query->where('id_lokasi', $id_lokasi);
        })
            ->count();
        $persentase = $TotalTerverifikasi / $TotalSumbangan * 100;
        return view('after-login.admin-kelurahan.sumbangan.index', ['verifikasiStatus' => $verifikasiStatus, 'persentase' => $persentase]);
    }
    public function edit($id, $created_at)
    {
        $sumbangan = Sumbangan::where('created_at', $created_at)
            ->where('id_donatur', $id)
            ->first();
        return view('after-login.admin-kelurahan.sumbangan.edit', ['sumbangan' => $sumbangan]);
    }
    public function update($id, $created_at, Request $request)
    {
        $this->validate($request, [
            'status' => 'required',
        ]);
        Sumbangan::where('created_at', $created_at)
            ->where('id_donatur', $id)
            ->update(['status' => $request->status]); //atau ganti $request jadi terverifikasi
        return redirect()->route('sumbangan');
    }
}