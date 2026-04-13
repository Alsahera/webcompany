<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KosController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PembayaranController;

/*
|--------------------------------------------------------------------------
| Web Routes - LaKost Platform
|--------------------------------------------------------------------------
*/

// ─── Root: Langsung Lempar ke Login ───────────────────────────────────────────
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
})->name('home'); // Nama 'home' ditambahkan agar login.blade.php tidak error

// ─── Autentikasi ─────────────────────────────────────────────────────────────
Route::get('/login',  [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ─── Area Terproteksi (Hanya Admin/User yang sudah Login) ────────────────────
Route::middleware('auth')->group(function () {

    // Dashboard dengan statistik singkat
    Route::get('/dashboard', function () {
        $stats = [
            'total_kos'      => \App\Models\Kos::count(),
            'total_booking'  => \App\Models\Booking::count(),
            'total_bayar'    => \App\Models\Pembayaran::where('status_bayar', 'lunas')->count(),
            'pending_bayar'  => \App\Models\Pembayaran::where('status_bayar', 'pending')->count(),
        ];
        $bookingTerbaru    = \App\Models\Booking::with('kos', 'user')->latest()->take(5)->get();
        $pembayaranTerbaru = \App\Models\Pembayaran::with('booking.kos')->latest()->take(5)->get();
        
        return view('dashboard', compact('stats', 'bookingTerbaru', 'pembayaranTerbaru'));
    })->name('dashboard');

    // Manajemen Data (CRUD)
    Route::resource('kos',         KosController::class);
    Route::resource('galeri',      GaleriController::class);
    Route::resource('booking',     BookingController::class);
    Route::resource('pembayaran',  PembayaranController::class);
});