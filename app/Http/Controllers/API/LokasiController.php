<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Lokasi;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LokasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lokasis = Lokasi::all();
        return response()->json($lokasis);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $lokasis = Lokasi::create($request->all());
        return response()->json($lokasis, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $lokasis = Lokasi::findOrFail($id);
        return response()->json($lokasis, Response::HTTP_CREATED);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $lokasis = Lokasi::findOrFail($id);
        $lokasis->update($request->all());
        return response()->json($lokasis, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $lokasis = Lokasi::findOrFail($id);
        $lokasis->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
