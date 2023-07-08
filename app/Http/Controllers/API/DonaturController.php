<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Donatur;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\Sanctum;

class DonaturController extends Controller
{

    public function login(Request $request)
    {
        $credentials = $request->only('no_hp', 'password');
        // dd($credentials);
        if (Auth::attempt($credentials)) {
            // Authentication successful
            $donatur = Auth::user()->createToken('API Token');
            return response()->json($donatur, Response::HTTP_OK);
        } else {
            // Authentication failed
            return response()->json(['error' => 'Invalid credentials'], Response::HTTP_UNAUTHORIZED);
        }
    }

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
        $data = $request->all();
        $data['password'] = Hash::make($request->input('password'));
        $donatur = Donatur::create($data);
        $token = $donatur->createToken('authToken')->plainTextToken;
        return response()->json(['donatur' => $donatur, 'token' => $token], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $donatur = Donatur::findOrFail($id);
        return response()->json($donatur, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $donatur = Donatur::findOrFail($id);

        $data = $request->all();
        if ($request->has('password')) {
            $data['password'] = Hash::make($request->input('password'));
        }

        $donatur->update($data);

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
