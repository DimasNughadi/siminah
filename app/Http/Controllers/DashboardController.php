<?php

namespace App\Http\Controllers;

use stdClass;
use Carbon\Carbon;
use App\Models\Lokasi;
use App\Models\Donatur;
use App\Models\Kontainer;
use App\Models\Sumbangan;
use App\Models\Permintaan;
use Illuminate\Http\Request;
use App\Enums\KontainerStatus;
use App\Models\Adminkelurahan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{

    public function index()
    {
        $role=Auth::user()->role;

        $now = Carbon::now();
        $now->locale('id');
        
        $bulanTahun = $now->isoFormat('MMMM');
        $tanggal = $now->Format('d F Y');

        $currentMonth = [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()];
        $previousMonth = [Carbon::now()->subMonth()->startOfMonth(), Carbon::now()->subMonth()->endOfMonth()];

        $mapData = [];
        $chartData = [];

        $map = Kontainer::with('lokasi')
            ->leftJoin('sumbangan', function ($join) use ($currentMonth) {
                $join->on('kontainer.id_kontainer', '=', 'sumbangan.id_kontainer')
                    ->whereBetween('sumbangan.created_at', $currentMonth)
                    ->where('sumbangan.status', 'terverifikasi'); // Add this line to filter by status
            })
            ->groupBy('kontainer.id_kontainer')
            ->select(
                'kontainer.id_kontainer',
                Sumbangan::raw('COUNT(DISTINCT sumbangan.id_donatur) AS total_donatur'),
                Sumbangan::raw('COALESCE(ROUND(SUM(sumbangan.berat), 2), 0) AS total_berat')
            )
            ->get();

        foreach ($map as $item) {
            $kontainer = Kontainer::find($item->id_kontainer);
            if ($kontainer && $kontainer->lokasi) {
                $lokasi = $kontainer->lokasi;
                $mapData[] = [
                    'nama' => $lokasi->nama_kelurahan,
                    'lat' => $lokasi->latitude,
                    'lng' => $lokasi->longitude,
                    'total_donatur' => $item->total_donatur,
                    'total_berat' => $item->total_berat,
                ];
            }
        }

        $totalDonatur = Donatur::count();
        $totalDonaturBulanini = Donatur::whereBetween('created_at', $currentMonth)->count();
        $totalKontainer = Kontainer::count();
        $totalSumbangan = Sumbangan::whereBetween('created_at', $currentMonth)
            ->where('sumbangan.status', 'terverifikasi')
            ->sum('berat');

        $totalSumbanganBulanLalu = Sumbangan::whereBetween('created_at', $previousMonth)->sum('berat');

        $percentageChangeSumbangan = 0;
        if ($totalSumbanganBulanLalu != 0) {
            $percentageChangeSumbangan = (($totalSumbangan - $totalSumbanganBulanLalu) / $totalSumbanganBulanLalu) * 100;
        }
        $percentageChangeSumbangan = round($percentageChangeSumbangan, 2);
        
        $currentContainer = Permintaan::where('id_kontainer', 15)
                ->where('status_permintaan', 'berhasil')
                ->max('updated_at');

        (float)$totalKapasitasKontainer = Kontainer::where('id_lokasi', 15)->value('kapasitas');

        $totalSumbangan1 = Sumbangan::where('id_kontainer', 15)
            ->where(function ($query) use ($currentContainer) {
                $query->where('updated_at', '>=', $currentContainer)
                    ->orWhere('updated_at', '=', 'kontainer.created_at');
            })
            ->where('status', 'terverifikasi')
            ->sum('berat');

        $progress = [
            $totalSumbangan1,
            $totalKapasitasKontainer - $totalSumbangan1
        ];

        $percentageProgress = number_format(($totalSumbangan1 / $totalKapasitasKontainer) * 100, 2);

        $lokasi = Lokasi::get();
        $yourThresholdValue = 25;
        $hampirPenuh = Kontainer::with('lokasi')
            ->leftJoin('sumbangan', function ($join) use ($currentMonth) {
                $join->on('kontainer.id_kontainer', '=', 'sumbangan.id_kontainer')
                    ->whereBetween('sumbangan.created_at', $currentMonth);
            })
            ->select('kontainer.id_kontainer', Sumbangan::raw('COALESCE(SUM(sumbangan.berat), 0) AS total_berat'))
            ->where('sumbangan.status', 'terverifikasi')
            ->groupBy('kontainer.id_kontainer')
            ->havingRaw('total_berat >= ?', [$yourThresholdValue])
            ->count();

        $notifikasi = [];
        $kontainer->each(function ($item) use (&$notifikasi) {
            if ($item->sumbangan_sum_berat == null) {
                $item->sumbangan_sum_berat = 0;
                $item->sumbangan_persentase = 0;
            } else {
                $item->sumbangan_persentase = $item->sumbangan_sum_berat / $item->kapasitas * 100;
                if ($item->sumbangan_sum_berat >= $item->kapasitas * 3 / 4) {
                    $object = new stdClass();
                    $object->id_kontainer = $item->id_kontainer;
                    $object->id_lokasi = $item->id_lokasi;
                    // $object->status = 'hampir penuh'; 
                    $object->status = KontainerStatus::HAMPIR; 
                    $notifikasi[] = $object;
                }
            }
        });

        if ($role == 'admin_kelurahan') {

            $id_lokasi = Adminkelurahan::where('id_user', Auth::id())->value('id_lokasi');

            $id_kontainer = Kontainer::where('id_lokasi', $id_lokasi)->value('id_kontainer');
            
            $namaKel = Lokasi::where('id_lokasi', $id_lokasi)->value('nama_kelurahan');

            $totalSumbangan = Sumbangan::whereBetween('updated_at', $currentMonth)
                ->where('id_kontainer', $id_kontainer)
                ->where('sumbangan.status', 'terverifikasi')
                ->sum('berat');

            $totalSumbanganBulanLalu = Sumbangan::whereBetween('updated_at', $previousMonth)
                ->where('sumbangan.status', 'terverifikasi')
                ->sum('berat');

            $percentageChangeSumbangan = $totalSumbangan - $totalSumbanganBulanLalu;
            
            $totalDonatur = Sumbangan::where('id_kontainer', $id_kontainer)
                ->count();

            $donaturAktifBulanIni = Sumbangan::whereBetween('created_at', $currentMonth)
                ->where('id_kontainer', $id_kontainer)
                ->count();

            $pengajuanBelumVerif = Sumbangan::whereBetween('created_at', $currentMonth)
                ->where('id_kontainer', $id_kontainer)
                ->where('sumbangan.status', 'belum terverifikasi')
                ->count();

            $currentContainer = Permintaan::where('id_kontainer', $id_kontainer)
                ->where('status_permintaan', 'berhasil')
                ->max('updated_at');

            $top_donatur = Lokasi::join('kontainer', 'lokasi.id_lokasi', '=', 'kontainer.id_lokasi')
                ->join('sumbangan', 'kontainer.id_kontainer', '=', 'sumbangan.id_kontainer')
                ->join('donatur', 'sumbangan.id_donatur', '=', 'donatur.id_donatur')
                ->where('lokasi.id_lokasi', $id_lokasi)
                ->whereBetween('sumbangan.updated_at', $currentMonth)
                ->where('sumbangan.status', 'terverifikasi')
                ->groupBy('donatur.nama_donatur')
                ->select('donatur.nama_donatur', 
                         Sumbangan::raw('COALESCE(SUM(sumbangan.berat), 0) AS total_berat'))
                ->orderByDesc('total_berat')
                ->limit(5)
                ->get();

            $labels = $top_donatur->pluck('nama_donatur');
            $values = $top_donatur->pluck('total_berat');

            (float)$totalKapasitasKontainer = Kontainer::where('id_lokasi', $id_lokasi)->value('kapasitas');

            $totalSumbangan1 = Sumbangan::where('id_kontainer', $id_kontainer)
                ->where(function ($query) use ($currentContainer) {
                    $query->where('updated_at', '>=', $currentContainer)
                        ->orWhere('updated_at', '=', 'kontainer.created_at');
                })
                ->where('status', 'terverifikasi')
                ->sum('berat');

            $progress = [
                $totalSumbangan1,
                $totalKapasitasKontainer - $totalSumbangan1
            ];

            $percentageProgress = number_format(($totalSumbangan1 / $totalKapasitasKontainer) * 100, 2);

            $data = [
                'mapData' => json_encode($mapData),
                'chartData' => [
                    'labels' => $labels->toArray(),
                    'values' => $values->toArray()
                ],
                'totalDonatur' => $totalDonatur,
                'donaturAktifBulanIni' => $donaturAktifBulanIni,
                'totalSumbangan' => $totalSumbangan,
                'perbandinganSumbangan' => $percentageChangeSumbangan,
                'totalKontainer' => $totalKontainer,
                'bulanTahun' => $bulanTahun,
                'progress' => $progress,
                'percentageProgress' => $percentageProgress,
                'lokasi' => $lokasi,
                'pengajuanBelumVerif' => $pengajuanBelumVerif,
                'notifikasi' => $notifikasi,
                'namaKel' => $namaKel,
                'tanggal' => $tanggal
            ];

            return view('after-login.admin-kelurahan.dashboard.dashboard', $data);
        }else{

            $topLokasi = Lokasi::join('kontainer', 'lokasi.id_lokasi', '=', 'kontainer.id_lokasi')
                ->join('sumbangan', 'kontainer.id_kontainer', '=', 'sumbangan.id_kontainer')
                ->whereBetween('sumbangan.created_at', $currentMonth)
                ->where('sumbangan.status', 'terverifikasi')
                ->groupBy('lokasi.nama_kelurahan')
                ->select('lokasi.nama_kelurahan', Sumbangan::raw('COALESCE(SUM(sumbangan.berat), 0) AS total_berat'))
                ->orderByDesc('total_berat')
                ->limit(5)
                ->get();

            $labels = $topLokasi->pluck('nama_kelurahan');
            $values = $topLokasi->pluck('total_berat');
   
            $data = [
                'mapData' => json_encode($mapData),
                'chartData' => [
                    'labels' => $labels->toArray(),
                    'values' => $values->toArray()
                ],
                'totalDonatur' => $totalDonatur,
                'perbandinganDonatur' => $totalDonaturBulanini,
                'totalSumbangan' => $totalSumbangan,
                'perbandinganSumbangan' => $percentageChangeSumbangan,
                'totalKontainer' => $totalKontainer,
                'bulanTahun' => $bulanTahun,
                'progress' => $progress,
                'percentageProgress' => $percentageProgress,
                'lokasi' => $lokasi,
                'hampirPenuh' => $hampirPenuh,
                'notifikasi' => $notifikasi,
                'tanggal' => $tanggal
            ];

            return view('after-login.pengelola-csr.dashboard.dashboard', $data);
        }

    }

    public function fetchChartData($lokasiId)
    {
        $currentMonth = [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()];
        $previousMonth = [Carbon::now()->subMonth()->startOfMonth(), Carbon::now()->subMonth()->endOfMonth()];

        (float)$totalKapasitasKontainer = Kontainer::where('id_lokasi', $lokasiId)->value('kapasitas');

        $totalSumbangan1 = Sumbangan::where('id_kontainer', $lokasiId)
            ->whereBetween('created_at', $currentMonth)
            ->where('sumbangan.status', 'terverifikasi')
            ->sum('berat');

        $progress = [
            $totalSumbangan1,
            $totalKapasitasKontainer - $totalSumbangan1
        ];

        return response()->json($progress);
    }
    
}