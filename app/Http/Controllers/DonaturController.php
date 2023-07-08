<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Lokasi;
use App\Models\Kontainer;
use App\Models\Donatur;
use App\Models\Sumbangan;
use Carbon\Carbon;

class DonaturController extends Controller
{

    public function index()
    {
        $data = [
            'title' => 'Kontainer'
        ];
        return view('pengelolaCSR.donatur.index');
    }
}