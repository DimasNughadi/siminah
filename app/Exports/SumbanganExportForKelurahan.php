<?php

namespace App\Exports;

use Exception;
use App\Models\Kontainer;
use App\Models\Sumbangan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class SumbanganExportForKelurahan implements FromCollection, WithHeadings
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
            $dayA = $startExpload[2];
            $dayB = $endExpload[2];
            $monthA = $startExpload[1];
            $monthB = $endExpload[1];
            $yearA = $startExpload[0];
            $yearB = $endExpload[0];
            $id_lokasi = DB::table('adminkelurahan')
                ->where('id_user', Auth::id())
                ->value('id_lokasi');
            $riwayat = Sumbangan::with('donatur', 'kontainer')
                ->whereHas('kontainer.lokasi', function ($query) use ($id_lokasi) {
                    $query->where('id_lokasi', $id_lokasi);
                })
                ->whereIn('status', ['terverifikasi', 'Terverifikasi', 'Ditolak', 'ditolak'])
                ->whereBetween('sumbangan.created_at', ["$yearA-$monthA-$dayA", "$yearB-$monthB-$dayB"])
                ->orderByDesc('created_at')
                ->get();
            if ($riwayat->isEmpty()) {
                throw new Exception('No data found.');
            }
            $collection = collect($riwayat)->map(function ($item) {
                return [
                    'NAMA' => $item['donatur']['nama_donatur'],
                    'BERAT SUMBANGAN (Kg)' => $item['berat'],
                    'WAKTU SUMBANGAN' => datetimeFormat($item['created_at']),
                    'WAKTU VERIFIKASI' => dateFormat($item['updated_at']),
                    'STATUS' => $item['status'],
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
            'NAMA',
            'BERAT SUMBANGAN (Kg)',
            'WAKTU SUMBANGAN',
            'WAKTU VERIFIKASI',
            'STATUS',
        ];
    }
}
