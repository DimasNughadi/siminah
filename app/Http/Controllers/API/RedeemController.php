<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Redeem;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RedeemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $redeems = Redeem::all();
        return response()->json($redeems);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $redeem = Redeem::create($request->all());
        return response()->json($redeem, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $redeem = Redeem::findOrFail($id);
        return response()->json($redeem);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $redeem = Redeem::findOrFail($id);
        $redeem->update($request->all());
        return response()->json($redeem, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $redeem = Redeem::findOrFail($id);
        $redeem->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
