<?php

namespace App\Exports;

use Exception;
use App\Models\Kontainer;
use App\Models\Sumbangan;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class SumbanganExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $start;
    protected $end;

    public function __construct($start, $end)
    {
        $this->start = $start;
        $this->end = $end;
    }
    public function collection()
    {
        try {
            $startExpload = explode('-', $this->start);
            $endExpload = explode('-', $this->end);
            $dayA= $startExpload[2];
            $dayB= $endExpload[2];
            $monthA = $startExpload[1];
            $monthB = $endExpload[1];
            $yearA = $startExpload[0];
            $yearB = $endExpload[0];

            $filteredLaporan = Kontainer::join('lokasi', 'kontainer.id_lokasi', '=', 'lokasi.id_lokasi')
                ->leftJoin('sumbangan', function ($join) {
                    $join->on('kontainer.id_kontainer', '=', 'sumbangan.id_kontainer')
                        ->where('sumbangan.status', '=', 'terverifikasi');
                })
                ->join('kecamatan', 'lokasi.id_kecamatan', '=', 'kecamatan.id_kecamatan')
                ->select('kontainer.id_kontainer', 'lokasi.nama_kelurahan', 'lokasi.is_kecamatan', 'kecamatan.nama_kecamatan')
                ->selectRaw('SUM(COALESCE(sumbangan.berat, 0)) as total_berat')
                ->selectRaw('COALESCE(COUNT(DISTINCT sumbangan.id_donatur), 0) as total_donatur')
                ->selectRaw('MAX(COALESCE(sumbangan.updated_at, "-")) as tanggal_laporan')
                ->selectRaw('YEAR(COALESCE(sumbangan.created_at, NOW())) as tahun, MONTH(COALESCE(sumbangan.created_at, NOW())) as bulan')
                ->whereBetween('sumbangan.created_at', ["$yearA-$monthA-$dayA", "$yearB-$monthB-$dayB"])
                ->groupBy('kontainer.id_kontainer', 'lokasi.nama_kelurahan', 'lokasi.is_kecamatan', 'kecamatan.nama_kecamatan', 'tahun', 'bulan')
                ->orderByDesc('total_berat')
                ->orderBy('tahun')
                ->orderBy('bulan')
                ->get();
                
                if ($filteredLaporan->isEmpty()) {
                    throw new Exception('No data found.');
                }
                $collection = collect($filteredLaporan)->map(function ($item) {
                    return [
                        'KECAMATAN' => $item['nama_kecamatan'],
                        'KELURAHAN' => $item['nama_kelurahan'],
                        'JUMLAH (KG)' => $item['total_berat'],
                        'JUMLAH DONATUR' => $item['total_donatur'],
                        'BULAN' => $item['bulan'],
                        'TANGGAL PELAPORAN' => substr($item['tanggal_laporan'], 0, 10),
                    ];
                });
        
                return $collection;
                
        } catch (Exception $exception) {
            return response()->json(['error' => 'An error occurred'], 500);
        }
    }

    public function headings(): array
    {
        return [
            'KECAMATAN',
            'KELURAHAN',
            'JUMLAH (KG)',
            'JUMLAH DONATUR',
            'BULAN',
            'TANGGAL PELAPORAN',
        ];
    }
}
