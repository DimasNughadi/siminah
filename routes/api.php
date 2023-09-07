<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\DonaturController;
use App\Http\Controllers\API\SumbanganController;
use App\Http\Controllers\API\RedeemController;
use App\Http\Controllers\API\RewardController;
use App\Http\Controllers\API\LokasiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('login', [DonaturController::class, 'login2'])->name('login');
Route::post('register', [DonaturController::class, 'store']);

Route::middleware('auth:sanctum')->group(function(){
    Route::prefix('donaturs')->group(function () {
        Route::get('/', [DonaturController::class, 'index']);
        Route::get('/{id}', [DonaturController::class, 'show']);
        Route::put('/{id}', [DonaturController::class, 'update']);
        Route::delete('/{id}', [DonaturController::class, 'destroy']);
    });

    Route::prefix('sumbangans')->group(function () {
        Route::get('/', [SumbanganController::class, 'index']);
        Route::post('/', [SumbanganController::class, 'store'])->name('sumbangans.store');
        Route::get('/{id}', [SumbanganController::class, 'show']);
		Route::get('new/{id}', [SumbanganController::class, 'showLatest']);
        Route::put('/{id}', [SumbanganController::class, 'update']);
        Route::delete('/{id}', [SumbanganController::class, 'destroy']);
    });

    Route::prefix('redeems')->group(function () {
        Route::get('/', [RedeemController::class, 'index']);
        Route::post('/', [RedeemController::class, 'store']);
        Route::get('/{id}', [RedeemController::class, 'show']);
        Route::put('/{id}', [RedeemController::class, 'update']);
        Route::delete('/{id}', [RedeemController::class, 'destroy']);
    });

    Route::prefix('rewards')->group(function () {
        Route::get('/', [RewardController::class, 'index']);
        Route::post('/', [RewardController::class, 'store']);
        Route::get('/{id}', [RewardController::class, 'show']);
        Route::put('/{id}', [RewardController::class, 'update']);
        Route::delete('/{id}', [RewardController::class, 'destroy']);
    });

    Route::prefix('lokasis')->group(function () {
        Route::get('/', [LokasiController::class, 'index']);
        Route::post('/', [LokasiController::class, 'store']);
        Route::get('/{id}', [LokasiController::class, 'show']);
        Route::put('/{id}', [LokasiController::class, 'update']);
        Route::delete('/{id}', [LokasiController::class, 'destroy']);
    });
	
	Route::get('cekToken', [DonaturController::class, 'cekToken']);
	Route::post('logout', [DonaturController::class, 'logout']);
});
