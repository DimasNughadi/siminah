<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Sumbangan;
use App\Models\Kontainer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SumbanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sumbangans = Sumbangan::all();
        return response()->json($sumbangans);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id_lokasi = $request->input('id_lokasi');

        $id_kontainer = Kontainer::where('id_lokasi', $id_lokasi)->value('id_kontainer');

        $data = [
            'id_donatur' => $request->input('id_donatur'),
            'id_kontainer' => $id_kontainer,
            'tanggal' => $request->input('tanggal'),
            'berat' => $request->input('berat'),
            'photo' => $request->input('photo'),
            'status' => $request->input('status'),
            'keterangan' => $request->input('keterangan'),
            'poin_reward' => $request->input('poin_reward'),
        ];

        try {
			$sumbangan = Sumbangan::create($data);
			return response()->json($sumbangan, Response::HTTP_CREATED);
		} catch (\Exception $e) {
			return response()->json(['error' => 'Failed to insert data.'], Response::HTTP_INTERNAL_SERVER_ERROR);
		}
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id_donatur)
	{
		try {
			$sumbanganDonatur = Sumbangan::where('id_donatur', $id_donatur)
				->orderBy('created_at', 'desc')
				->get();
			
			if (!$sumbanganDonatur) {
				return response()->json(['message' => 'Sumbangan tidak ditemukan'], 404);
			}

			return response()->json($sumbanganDonatur, Response::HTTP_OK);
		} catch (Exception $exception) {
			return response()->json(['message' => 'Terjadi kesalahan'], Response::HTTP_INTERNAL_SERVER_ERROR);
		}
	}
	
	public function showLatest(string $id_donatur)
	{
		try {
			$latestSumbangan = Sumbangan::where('id_donatur', $id_donatur)
				->orderBy('created_at', 'desc')
				->first();

			if (!$latestSumbangan) {
				return response()->json(['message' => 'Sumbangan tidak ditemukan'], 404);
			}

			// Parse and format the created_at timestamp
			$created_at = \Carbon\Carbon::parse($latestSumbangan->created_at)->locale('id')->isoFormat('dddd, D MMMM YYYY - HH:mm:ss');

			// Parse and format the updated_at timestamp
			$updated_at = \Carbon\Carbon::parse($latestSumbangan->updated_at)->locale('id')->isoFormat('dddd, D MMMM YYYY - HH:mm:ss');

			// Replace the original values with formatted values
			$latestSumbangan->created_at = $created_at;
			$latestSumbangan->updated_at = $updated_at;

			return response()->json($latestSumbangan, Response::HTTP_OK);
		} catch (Exception $exception) {
			return response()->json(['message' => 'Terjadi kesalahan'], Response::HTTP_INTERNAL_SERVER_ERROR);
		}
	}
	
	public function showAll_id(string $id)
    {
        $sumbangan = Sumbangan::findOrFail($id);
        return response()->json($sumbangan, Response::HTTP_CREATED);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $sumbangan = Sumbangan::findOrFail($id);
        $sumbangan->update($request->all());
        return response()->json($sumbangan, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sumbangan = Sumbangan::findOrFail($id);
        $sumbangan->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}