<?php

namespace App\Http\Controllers;

use App\Http\Resources\RewardResource;
use App\Models\Reward;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class RewardController extends Controller
{
    public function index()
    {
        try {
            $reward = Reward::get(); 
            return view(
                'after-login.admin-kelurahan.reward.detail',
                ['reward' => RewardResource::collection($reward)]
            );
        } catch (QueryException | ModelNotFoundException $exception) {
            return view(
                'after-login.admin-kelurahan.reward.detail',
                ['message' => 'Tidak ada data']
            );
        }
    }

    public function create()
    {
        return view('after-login.admin-kelurahan.reward.tambah');
    }

    public function store(Request $request)
    {
        // dd($request);
        $validator = Validator::make($request->all(), [
            //'id_reward' => 'required',
            'nama_reward' => 'required',
            'stok' => 'required',
            'jumlah_poin' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if($validator->fails()){
            return view(
                'after-login.admin-kelurahan.reward.detail',
                ['message' => 'Halaman tidak ditemukan']
            );
        }
        try {
            $gambar = $request->file('gambar');
            $gambar->storeAs('public/reward', $gambar->hashName());
            Reward::create([
                //'id_reward' => $request->id_reward,
                'nama_reward' => $request->nama_reward,
                'stok' => $request->stok,
                'jumlah_poin' => $request->jumlah_poin,
                'gambar' => $request->gambar->hashName(),
            ]);
            return redirect()->route('reward/reward-list')->with('tambah_alert', 'success');
        } catch (QueryException | ModelNotFoundException $exception) {
            return view(
                'after-login.admin-kelurahan.reward.detail',
                ['message' => 'Tidak berhasil menambah data']
            )->with('tambah_alert', 'error');
        }
    }
    public function edit($id)
    {
        try {
            $reward = Reward::find($id);
            return view('after-login.admin-kelurahan.reward.edit', ['reward' => $reward]);
        } catch (QueryException | ModelNotFoundException $exception) {
            return view(
                'after-login.admin-kelurahan.reward.detail',
                ['message' => 'Tidak bisa diedit']
            );
        }
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            //'id_reward' => 'required',
            'nama_reward' => 'required',
            'stok' => 'required',
            'jumlah_poin' => 'required',
        ]);
        if($validator->fails()){
            return view(
                'after-login.admin-kelurahan.reward.detail',
                ['message' => 'Data tidak lengkap']
            );
        }
        try {
            $reward = Reward::findOrFail($id);
            if ($request->hasFile('gambar')) {
                $image_path = public_path('storage/public/reward' . $reward->gambar);
                if (file_exists($image_path)) {
                    Storage::delete('public/reward/' . $reward->gambar);
                }
                $gambar = $request->file('gambar');
                $gambar->storeAs('public/reward', $gambar->hashName());
                $reward->gambar = $request->gambar->hashName();
            }
            $reward->nama_reward = $request->nama_reward;
            $reward->stok = $request->stok;
            $reward->jumlah_poin = $request->jumlah_poin;
            $reward->save();
            return redirect()->route('reward/reward-list')->with('edit_alert', 'success');
        } catch (QueryException | ModelNotFoundException $exception) {
            return view(
                'after-login.admin-kelurahan.reward.detail',
                ['message' => 'Tidak berhasil diedit']
            )->with('edit_alert', 'error');
        }
    }
    public function destroy($id)
    {
        try {
            $reward = Reward::find($id);
            $reward->delete();
            return redirect()->route('reward/reward-list')->with('delete_alert', 'success');    
        } catch (ModelNotFoundException | QueryException $exception) {
            return view(
                'after-login.admin-kelurahan.reward.detail',
                ['message' => 'Tidak berhasil dihapus']
            );
        }
    }
}