<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SumbanganController;
use App\Http\Controllers\KontainerController;
use App\Http\Controllers\DonaturController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/contoh', function () {
    return view('pengelolaCSR/dashboard/dashboard');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/sumbangan', [SumbanganController::class, 'index'])->name('sumbangan');
Route::get('/kontainer', [SumbanganController::class, 'index'])->name('kontainer');
Route::get('/donatur', [SumbanganController::class, 'index'])->name('donatur');
// Route::get('/', function () {
//     return view('login');
// });
// Testing
Route::get('/', function () {
    return view('test-component');
});
