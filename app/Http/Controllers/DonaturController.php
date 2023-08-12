<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Lokasi;
use App\Models\Kontainer;
use App\Models\Donatur;
use App\Models\Sumbangan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class DonaturController extends Controller
{
    public function index()
    {
        try {
            $id_lokasi = DB::table('adminkelurahan')
                ->where('id_user', Auth::id())
                ->value('id_lokasi');
            $donatur = Donatur::with([
                'sumbangan'
                => function ($query) {
                    $query->where('status', 'terverifikasi');
                }
            ])
                ->select('donatur.id_donatur', 'nama_donatur', 'kelurahan', 'donatur.photo', 'id_lokasi')
                ->withSum([
                    'sumbangan' => function ($query) {
                        $query->where('status', 'terverifikasi');
                    }
                ], 'berat')
                ->withCount('sumbangan as total_donasi')
                ->withMax('sumbangan as newest_tanggal', 'tanggal')
                ->join('sumbangan', 'donatur.id_donatur', '=', 'sumbangan.id_donatur')
                ->join('kontainer', 'sumbangan.id_kontainer', '=', 'kontainer.id_kontainer')
                ->where('id_lokasi', $id_lokasi)
                ->groupBy('donatur.photo', 'donatur.id_donatur', 'nama_donatur', 'kelurahan', 'id_lokasi')
                ->get();
                
            if (auth()->user()->role == 'admin_kelurahan') {
                return view('after-login.admin-kelurahan.donatur.index', ['donatur' => $donatur]);
            } else {
                return view('after-login.pengelola-csr.donatur.index', ['donatur' => $donatur]);
            }
        } catch (ModelNotFoundException | QueryException $exception) {
            return $this->sendError(
                'Error found',
                $exception->getMessage()
            );
        }
    }

    public function getById($id)
    {
        $donatur = Donatur::find($id);
        return view('after-login.admin-kelurahan.donatur.index' , ['donatur' => $donatur]);
    }

    public function create()
    {
        return view('after-login.admin-kelurahan.donatur.tambah');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'no_hp' => 'required',
            'nama_donatur' => 'required',
            'alamat_donatur' => 'required',
            'kelurahan' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'password' => 'required',
        ]);
        $photo = $request->file('photo');
        $photo->storeAs('public/donatur', $photo->hashName());
        Donatur::create([
            'no_hp' => $request->no_hp,
            'nama_donatur' => $request->nama_donatur,
            'alamat_donatur' => $request->alamat_donatur,
            'kelurahan' => $request->kelurahan,
            'photo' => $request->photo->hashName(),
            'password' => $request->password,
        ]);
        return redirect()->route('donatur');
    }
    public function edit($id)
    {
        // $donatur = Donatur::find($id);
        // return view('after-login.admin-kelurahan.donatur.edit', ['donatur' => $donatur]);
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'no_hp' => 'required',
            'nama_donatur' => 'required',
            'alamat_donatur' => 'required',
            'kelurahan' => 'required',
            'password' => 'required',
        ]);
        $donatur = Donatur::findOrFail($id);
        if ($request->hasFile('photo')) {

            $image_path = public_path('storage/public/donatur' . $donatur->photo);
            if (file_exists($image_path)) {
                Storage::delete('public/donatur/' . $donatur->photo);
            }
            $photo = $request->file('photo');
            $photo->storeAs('public/donatur', $photo->hashName());
            $donatur->photo = $request->photo->hashName();
        }
        $donatur->no_hp = $request->no_hp;
        $donatur->nama_donatur = $request->nama_donatur;
        $donatur->kelurahan = $request->kelurahan;
        $donatur->password = $request->password;
        $donatur->save();
        return redirect()->route('donatur');
    }
    public function destroy($id)
    {
        $donatur = Donatur::find($id);
        $donatur->delete();
        return redirect()->route('donatur');
    }

    public function detail($id)
    {
        $donatur = Donatur::get();
        $riwayat = Sumbangan::with(['kontainer','kontainer.lokasi'])
            ->where('id_donatur',$id)
            ->get();

        $total = Donatur::with([
            'sumbangan' => function ($query) {
                $query->where('status', 'terverifikasi');
            }
        ])
            ->select('donatur.id_donatur')
            ->withSum([
                'sumbangan' => function ($query) {
                    $query->where('status', 'terverifikasi');
                }
            ], 'berat')
            ->withCount('sumbangan as total_donasi')
            ->groupBy('donatur.id_donatur')
            ->find($id);
            dd($riwayat);
        return view('after-login.admin-kelurahan.donatur.detail', ['donatur' => $donatur, 'riwayat'=> $riwayat, 'total' => $total]);
    }
}