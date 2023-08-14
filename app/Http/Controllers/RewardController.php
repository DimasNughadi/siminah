<?php

namespace App\Http\Controllers;

use App\Http\Resources\RewardResource;
use App\Models\Reward;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RewardController extends Controller
{
    public function index()
    {
        try {
            $reward = Reward::get();
            return view(
                'after-login.admin-kelurahan.reward.detail', 
                ['reward' =>  RewardResource::collection($reward)]
            );
        } catch (QueryException | ModelNotFoundException $exception) {
            return view(
                'after-login.admin-kelurahan.reward.detail', 
                ['message' =>  'Tidak ada data']
            );  
        }
    }

    public function create()
    {
        return view('after-login.admin-kelurahan.reward.tambah');
    }

    public function store(Request $request)
    {   
        $this->validate($request, [
            //'id_reward' => 'required',
            'nama_reward' => 'required',
            'stok' => 'required',
            'jumlah_poin' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $gambar = $request->file('gambar');
        $gambar->storeAs('public/reward', $gambar->hashName());
        
        Reward::create([
            //'id_reward' => $request->id_reward,
            'nama_reward' => $request->nama_reward,
            'stok' => $request->jenis,
            'jumlah_poin' => $request->jumlah_poin,
            'gambar' => $request->gambar->hashName(),
        ]);
        return redirect()->route('reward/reward-list');
    }
    public function edit($id)
    {
        $reward = Reward::find($id);
        return view('after-login.adminkelurahan.reward.edit', ['reward' => $reward]);
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
             // 'id_reward' => 'required',
            'nama_reward' => 'required',
            'stok' => 'required',
            'jumlah_poin' => 'required',
        ]);
        $reward = Reward::findOrFail($id);
        // $data = [
        //     'nama_reward' => $reward->nama_reward
        // ];
        if ($request->hasFile('gambar')) {
            // $newNameOfImage = $request->file('gambar')->hashName() . $request->gambar->getClientOriginalExtension();
            $image_path = public_path('storage/public/reward' . $reward->gambar);
            if (file_exists($image_path)) {
                Storage::delete('public/reward/' . $reward->gambar);
            }
            $gambar = $request->file('gambar');
            $gambar->storeAs('public/reward', $gambar->hashName());
            // $data += ['gambar' => $gambar->hashName];
            $reward->gambar = $request->gambar->hashName();
        }
        $reward->nama_reward = $request->nama_reward;
        $reward->stok = $request->stok;
        $reward->jumlah_poin = $request->jumlah_poin;
        $reward->save();
        return redirect()->route('reward/reward-list');
    }
    public function destroy($id)
    {
        $reward = Reward::find($id);
        $reward->delete();
        return redirect()->route('reward/reward-list');
    }
}
