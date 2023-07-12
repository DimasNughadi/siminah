<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Adminkelurahan;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Lokasi;
use App\Models\Kontainer;
use App\Models\Donatur;
use App\Models\Sumbangan;
use Carbon\Carbon;

class SumbanganController extends Controller
{

    public function index(request $Request)
    {
        //Sumbangan Belum Terverifikasi
        $idAdmin = Auth::user()->id;
        $idLokasi = Adminkelurahan::where('id_user','=',$idAdmin)->pluck('id_lokasi')->first();
        $verifikasiStatus = Sumbangan::where('status', 'belum terverifikasi')
        ->whereHas('kontainer.lokasi', function ($query) use ($idLokasi) {
            $query->where('id_lokasi', $idLokasi);
        })
        ->get();

        //Persentase Belum Terverifikasi
        
        return view('adminKelurahan.sumbangan.index',['verifikasiStatus' => $verifikasiStatus]);
    }
    public function totalDonasi_Lokasi()
    {   
    }
    public function edit($id)
    {
        $sumbangan = Sumbangan::find($id);
        return view('adminKelurahan.sumbangan.edit', ['sumbangan' => $sumbangan]);
    }
    public function update($id, Request $request)
    { 
        
        $this->validate($request, [
            'id_donatur' => 'required',
            'id_kontainer' => 'required',
            'tanggal' => 'required',
            'berat' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required',
            'poin_reward' => 'required',
        ]);
        $sumbangan = Sumbangan::findOrFail($id);
        $sumbangan->id_donatur = $request->id_donatur;
        $sumbangan->id_kontainer = $request->id_kontainer;
        $sumbangan->tanggal = $request->tanggal;
        $sumbangan->berat = $request->berat;
        $sumbangan->photo = $request->photo->hashName();
        $sumbangan->status = $request->status;
        $sumbangan->poin_reward = $request->poin_reward;
        $sumbangan->save();
        return redirect()->route('sumbangan');
    }
}