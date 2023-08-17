<?php

namespace App\Http\Controllers;
use App\Models\Redeem;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class RedeemController extends Controller
{
    public function index()
    {
        try {
            $id_lokasi = DB::table('adminkelurahan')
                ->where('id_user', Auth::id())
                ->value('id_lokasi');

            $redeem = Redeem::with('reward', 'donatur')->whereHas('donatur.sumbangan.kontainer', function ($query) use ($id_lokasi) {
                $query->where('id_lokasi', $id_lokasi);
            })
                ->joinSub(
                    Redeem::whereHas('donatur.sumbangan.kontainer', function ($query) use ($id_lokasi) {
                        $query->where('id_lokasi', $id_lokasi);
                    })
                        ->groupBy('id_donatur')->select('id_donatur', DB::raw('count(*) as redeem_count'))
                    ,
                    'redeem_count',
                    function ($join) {
                        $join->on('redeem.id_donatur', '=', 'redeem_count.id_donatur');
                    }
                )
                //->orderByDesc('sumbangan_sum_berat')
                ->get();
            return view(
                'after-login.admin-kelurahan.reward.index',
                ['redeem' => $redeem]
            );
        } catch (ModelNotFoundException | QueryException $exception) {
                return view(
                    'after-login.admin-kelurahan.reward.index',
                    ['message' => 'Tidak ada data']
                );
        }

    }

}