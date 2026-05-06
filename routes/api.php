<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\KosApiController;
use App\Http\Controllers\Api\BookingApiController;
use App\Http\Controllers\Api\PembayaranApiController;

/*
|--------------------------------------------------------------------------
| API Routes - LaKost Flutter Client
|--------------------------------------------------------------------------
| Tambahkan file ini ke routes/api.php
| Jalankan: php artisan install:api (jika belum ada)
|--------------------------------------------------------------------------
*/

// ── Auth (public) ──────────────────────────────────────────────────────────
Route::post('/login',  [AuthApiController::class, 'login']);
Route::post('/logout', [AuthApiController::class, 'logout'])->middleware('auth:sanctum');

// ── Protected Routes ───────────────────────────────────────────────────────
Route::middleware('auth:sanctum')->group(function () {

    Route::get('/user', function (Request $request) {
        return response()->json(['user' => $request->user()]);
    });

    // Kos
    Route::apiResource('kos',        KosApiController::class);

    // Booking
    Route::apiResource('booking',    BookingApiController::class);

    // Pembayaran
    Route::apiResource('pembayaran', PembayaranApiController::class);
});