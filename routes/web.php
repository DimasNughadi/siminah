<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SumbanganController;
use App\Http\Controllers\KontainerController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DonaturController;
use App\Http\Controllers\RewardController;
use App\Http\Controllers\RedeemController;
use App\Http\Controllers\LokasiController;


// Route::get('/', function () {
//     return view('before-login.login');
// });

//Login Admin CSR dan Admin Kelurahan
Route::get('/',[LoginController::class,'index'])->name('login');
Route::post('/ceklogin',[LoginController::class,'ceklogin'])->name('ceklogin');

Route::post('/logout',[LoginController::class,'logout'])->name('logout');

Route::middleware('role:admin_csr,admin_kelurahan')->group(function() {
    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');
    Route::get('/dashboard/fetchChartData/{lokasiId}', [DashboardController::class,'fetchChartData'])->name('dashboard.fetchChartData/{id}');
    
    //manajemen lokasi kontainer(csr)
    Route::get('/lokasi',[LokasiController::class,'index'])->name('lokasi');
    Route::get('/lokasi/create',[LokasiController::class,'create'])->name('lokasi.create');
    Route::post('/lokasi',[LokasiController::class,'store'])->name('lokasi.store');
    Route::get('/lokasi/edit/{id}',[LokasiController::class,'edit'])->name('lokasi.edit');
    Route::put('/lokasi/update/{id}',[LokasiController::class,'update'])->name('lokasi.update');
    Route::delete('/lokasi/delete/{id}',[LokasiController::class,'destroy'])->name('lokasi.destroy');

    //manajemen admin kelurahan(csr)
    Route::get('/admin',[AdminController::class,'index'])->name('admin');
    Route::get('/admin/create',[AdminController::class,'create'])->name('admin.create');
    Route::post('/admin',[AdminController::class,'store'])->name('admin.store');
    Route::get('/admin/edit/{id}',[AdminController::class,'edit'])->name('admin.edit');
    Route::put('/admin/update/{id}',[AdminController::class,'update'])->name('admin.update');
    Route::delete('/admin/delete/{id}',[AdminController::class,'destroy'])->name('admin.destroy');

    //manajemen admin kelurahan
    Route::get('/adminkelurahan',[AdminController::class,'index'])->name('admin');
    Route::get('/adminkelurahan/create',[AdminController::class,'create'])->name('admin.create');
    Route::post('/adminkelurahan',[AdminController::class,'store'])->name('admin.store');
    Route::get('/adminkelurahan/edit/{id}',[AdminController::class,'edit'])->name('admin.edit');
    Route::put('/adminkelurahan/update/{id}',[AdminController::class,'update'])->name('admin.update');
    Route::delete('/adminkelurahan/delete/{id}',[AdminController::class,'destroy'])->name('admin.destroy');
});


Route::middleware('role:admin_kelurahan')->group(function() {

    //kelola data donatur
    Route::get('/donatur',[donaturController::class,'index'])->name('donatur');
    Route::get('/donatur/create',[donaturController::class,'create'])->name('donatur.tambah');
    Route::get('/donatur/getById',[donaturController::class,'getById'])->name('donatur.getById');
    Route::post('/donatur',[donaturController::class,'store'])->name('donatur.store');
    Route::get('/donatur/edit/{id}',[donaturController::class,'edit'])->name('donatur.edit');
    Route::get('/donatur/detail/{id}',[donaturController::class,'detail'])->name('donatur.detail');
    Route::put('/donatur/update/{id}',[donaturController::class,'update'])->name('donatur.update');
    Route::delete('/donatur/delete/{id}',[donaturController::class,'destroy'])->name('donatur.destroy');
    
    //verifikasi sumbangan
    Route::get('/sumbangan',[SumbanganController::class,'index'])->name('sumbangan');
    Route::get('/sumbangan/edit/{id}/{created_at}', [SumbanganController::class, 'edit'])->name('sumbangan.edit');
    Route::put('/sumbangan/update/{id}/{created_at}',[SumbanganController::class,'update'])->name('sumbangan.update');
    
    //manajemen kontainer kelurahan
    Route::get('/kontainer',[KontainerController::class,'index'])->name('kontainer');
    Route::get('/kontainer/create',[KontainerController::class,'create'])->name('kontainer.create');
    Route::post('/kontainer',[KontainerController::class,'store'])->name('kontainer.store');
    Route::get('/kontainer/edit/{id}',[KontainerController::class,'edit'])->name('kontainer.edit');
    Route::put('/kontainer/update/{id}',[KontainerController::class,'update'])->name('kontainer.update');
    Route::delete('/kontainer/delete/{id}',[KontainerController::class,'destroy'])->name('kontainer.destroy');
    Route::put('/kontainer/updatePermintaan/{id}',[KontainerController::class,'updatePermintaan'])->name('kontainer.updatePermintaan');
    Route::post('/kontainer/storePermintaan/{id_kontainer}',[KontainerController::class,'storePermintaan'])->name('kontainer.storePermintaan');
    
    //manajemen reward (adm-kelurahan)
    Route::get('/reward',[RedeemController::class,'index'])->name('reward');
    Route::get('/reward/reward-list',[RewardController::class,'index'])->name('reward/reward-list');
});

