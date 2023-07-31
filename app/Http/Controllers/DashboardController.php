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

class DashboardController extends Controller
{

    public function index()
    {
        // $role=Auth::user()->role;
        // if($role=='admin_kelurahan'){
        //    return 'ini dashboard admin kelurahan'; 
        // }else{
        //     return 'ini dashboard admin csr';
        // }
        
        $now = Carbon::now();

        $bulanTahun = $now->format('F Y');
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        $mapData = [];
        $chartData = [];

        $map = Kontainer::with('lokasi')
            ->leftJoin('sumbangan', function ($join) use ($startOfMonth, $endOfMonth) {
                $join->on('kontainer.id_kontainer', '=', 'sumbangan.id_kontainer')
                    ->whereBetween('sumbangan.created_at', [$startOfMonth, $endOfMonth]);
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
            ->groupBy('lokasi.nama_kelurahan')
            ->select('lokasi.nama_kelurahan', Sumbangan::raw('COALESCE(SUM(sumbangan.berat), 0) AS total_berat'))
            ->orderByDesc('total_berat')
            ->limit(5)
            ->get();

        $labels = $topLokasi->pluck('nama_kelurahan');
        $values = $topLokasi->pluck('total_berat');

        $totalDonatur = Donatur::count();
        $totalKontainer = Kontainer::count();
        $totalSumbangan = Sumbangan::whereBetween('created_at', [$startOfMonth, $endOfMonth])->sum('berat');

        $currentMonthCountDonatur = Donatur::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count();
        $previousMonthCountDonatur = Donatur::whereBetween('created_at', [
            Carbon::now()->subMonth()->startOfMonth(),
            Carbon::now()->subMonth()->endOfMonth()
        ])->count();

        $percentageChangeDonatur = 0;
        if ($previousMonthCountDonatur != 0) {
            $percentageChangeDonatur = ($currentMonthCountDonatur / $previousMonthCountDonatur) * 100 - 100;
        }
        $percentageChangeDonatur = round($percentageChangeDonatur, 2);

        $currentMonthSumbangan = Sumbangan::whereBetween('created_at', [$startOfMonth, $endOfMonth])->sum('berat');
        $previousMonthSumbangan = Sumbangan::whereBetween('created_at', [
            Carbon::now()->subMonth()->startOfMonth(),
            Carbon::now()->subMonth()->endOfMonth()
        ])->sum('berat');

        $percentageChangeSumbangan = 0;
        if ($previousMonthSumbangan != 0) {
            $percentageChangeSumbangan = (($currentMonthSumbangan - $previousMonthSumbangan) / $previousMonthSumbangan) * 100;
        }
        $percentageChangeSumbangan = round($percentageChangeSumbangan, 2);

        $data = [
            'mapData' => json_encode($mapData),
            'chartData' => [
                'labels' => $labels->toArray(),
                'values' => $values->toArray()
            ],
            'totalDonatur' => $totalDonatur,
            'perbandinganDonatur' => $percentageChangeDonatur,
            'totalSumbangan' => $totalSumbangan,
            'perbandinganSumbangan' => $percentageChangeSumbangan,
            'totalKontainer' => $totalKontainer,
            'bulanTahun' => $bulanTahun
        ];

        return view('after-login.pengelola-csr.dashboard.dashboard', $data);
    }
}