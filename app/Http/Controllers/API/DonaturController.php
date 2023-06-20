<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Donatur;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DonaturController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $donaturs = Donatur::all();
        return response()->json($donaturs);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $donatur = Donatur::create($request->all());
        return response()->json($donatur, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $donatur = Donatur::create($request->all());
        return response()->json($donatur, Response::HTTP_CREATED);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $donatur = Donatur::findOrFail($id);
        $donatur->update($request->all());
        return response()->json($donatur, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $donatur = Donatur::findOrFail($id);
        $donatur->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
