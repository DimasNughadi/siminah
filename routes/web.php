<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

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
// Route::get('/', function () {
//     return view('login');
// });
// Testing
Route::get('/', function () {
    return view('test-component');
});
