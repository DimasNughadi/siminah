<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Sumbangan;
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
        $sumbangan = Sumbangan::create($request->all());
        return response()->json($sumbangan, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
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
