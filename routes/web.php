<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KosController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\ClientController;

/*
|--------------------------------------------------------------------------
| Web Routes - LaKost Platform
|--------------------------------------------------------------------------
*/

// ─── Halaman Publik (Landing Page) ───────────────────────────────────────────
Route::get('/',        [PageController::class, 'home'])->name('home');
Route::get('/about',   [PageController::class, 'about'])->name('about');
Route::get('/team',    [PageController::class, 'team'])->name('team');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');

// ─── Autentikasi ─────────────────────────────────────────────────────────────
Route::get('/login',   [AuthController::class, 'showLogin'])->name('login');
Route::post('/login',  [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ─── Halaman Client Publik (TANPA login) ─────────────────────────────────────
Route::get('/daftar-kos', [ClientController::class, 'index'])->name('client.kos');
Route::get('/kos/{ko}', [ClientController::class, 'show'])->name('client.kos.show');

// ─── Area Terproteksi (butuh login) ──────────────────────────────────────────
Route::middleware('auth')->group(function () {

    // ── Dashboard Admin ───────────────────────────────────────────────────────
    Route::get('/dashboard', function () {
        $stats = [
            'total_kos'     => \App\Models\Kos::count(),
            'total_booking' => \App\Models\Booking::count(),
            'total_bayar'   => \App\Models\Pembayaran::where('status_bayar', 'lunas')->count(),
            'pending_bayar' => \App\Models\Pembayaran::where('status_bayar', 'pending')->count(),
        ];
        $bookingTerbaru    = \App\Models\Booking::with('kos', 'user')->latest()->take(5)->get();
        $pembayaranTerbaru = \App\Models\Pembayaran::with('booking.kos')->latest()->take(5)->get();
        return view('dashboard', compact('stats', 'bookingTerbaru', 'pembayaranTerbaru'));
    })->name('dashboard');

    // ── CRUD Admin Resources ──────────────────────────────────────────────────
    Route::prefix('admin')->group(function () {
        Route::resource('kos', KosController::class);
        Route::resource('galeri', GaleriController::class);
        Route::resource('booking', BookingController::class);
        Route::resource('pembayaran', PembayaranController::class);
    });

    // ── Halaman Client (Butuh Login) ──────────────────────────────────────────
    Route::get('/kos/{ko}/booking',
        [ClientController::class, 'bookingForm'])->name('client.booking.form');
    Route::post('/kos/{ko}/booking',
        [ClientController::class, 'bookingStore'])->name('client.booking.store');
    Route::get('/booking/{booking}/sukses',
        [ClientController::class, 'bookingSuccess'])->name('client.booking.success');
    Route::post('/booking/{booking}/upload-bukti',
        [ClientController::class, 'uploadBukti'])->name('client.booking.upload-bukti');
    Route::get('/booking-saya',
        [ClientController::class, 'myBookings'])->name('client.my-bookings');
});