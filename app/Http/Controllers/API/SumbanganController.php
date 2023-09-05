<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Reward;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RewardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rewards = Reward::all();
        return response()->json($rewards);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $reward = Reward::create($request->all());
        return response()->json($reward, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $reward = Reward::findOrFail($id);
        return response()->json($reward);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $reward = Reward::findOrFail($id);
        $reward->update($request->all());
        return response()->json($reward, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $reward = Reward::findOrFail($id);
        $reward->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
