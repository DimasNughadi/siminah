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
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{

    public function index()
    {
        $role=Auth::user()->role;

        $now = Carbon::now();
        $now->locale('id');
        
        $bulanTahun = $now->isoFormat('MMMM');

        $currentMonth = [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()];
        $previousMonth = [Carbon::now()->subMonth()->startOfMonth(), Carbon::now()->subMonth()->endOfMonth()];

        $mapData = [];
        $chartData = [];

        $map = Kontainer::with('lokasi')
            ->leftJoin('sumbangan', function ($join) use ($currentMonth) {
                $join->on('kontainer.id_kontainer', '=', 'sumbangan.id_kontainer')
                    ->whereBetween('sumbangan.created_at', $currentMonth);
            })
            ->groupBy('kontainer.id_kontainer')
            ->select('kontainer.id_kontainer', Sumbangan::raw('COUNT(DISTINCT sumbangan.id_donatur) AS total_donatur'), Sumbangan::raw('COALESCE(SUM(sumbangan.berat), 0) AS total_berat'))
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

        // Query untuk mengambil top 5 lokasi dengan sumbangan berat terbanyak
        $topLokasi = Lokasi::join('kontainer', 'lokasi.id_lokasi', '=', 'kontainer.id_lokasi')
            ->join('sumbangan', 'kontainer.id_kontainer', '=', 'sumbangan.id_kontainer')
            ->whereBetween('sumbangan.created_at', $currentMonth)
            ->groupBy('lokasi.nama_kelurahan')
            ->select('lokasi.nama_kelurahan', Sumbangan::raw('COALESCE(SUM(sumbangan.berat), 0) AS total_berat'))
            ->orderByDesc('total_berat')
            ->limit(5)
            ->get();

        $labels = $topLokasi->pluck('nama_kelurahan');
        $values = $topLokasi->pluck('total_berat');

        $totalDonatur = Donatur::count();
        $totalDonaturBulanini = Donatur::whereBetween('created_at', $currentMonth)->count();
        $totalKontainer = Kontainer::count();
        $totalSumbangan = Sumbangan::whereBetween('created_at', $currentMonth)->sum('berat');

        $currentMonthSumbangan = Sumbangan::whereBetween('created_at', $currentMonth)->sum('berat');
        $previousMonthSumbangan = Sumbangan::whereBetween('created_at', $previousMonth)->sum('berat');

        $percentageChangeSumbangan = 0;
        if ($previousMonthSumbangan != 0) {
            $percentageChangeSumbangan = (($currentMonthSumbangan - $previousMonthSumbangan) / $previousMonthSumbangan) * 100;
        }
        $percentageChangeSumbangan = round($percentageChangeSumbangan, 2);
        
        (float)$totalKapasitasKontainer = Kontainer::where('id_lokasi', 24)->value('kapasitas');

        $totalSumbangan1 = Sumbangan::where('id_kontainer', 24)
            ->whereBetween('created_at', $currentMonth)
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
                'notifikasi' => $notifikasi
            ];
    
            return view('after-login.admin-kelurahan.dashboard.dashboard', $data);
        }else{
   
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
                'notifikasi' => $notifikasi
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
            ->sum('berat');

        $progress = [
            $totalSumbangan1,
            $totalKapasitasKontainer - $totalSumbangan1
        ];

        return response()->json($progress);
    }
    
}