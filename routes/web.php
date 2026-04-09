<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
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

// ─── Halaman Publik ──────────────────────────────────────────────────────────
Route::get('/',        [PageController::class, 'home'])->name('home');
Route::get('/about',   [PageController::class, 'about'])->name('about');
Route::get('/team',    [PageController::class, 'team'])->name('team');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');

// ─── Autentikasi ─────────────────────────────────────────────────────────────
Route::get('/login',  [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout',[AuthController::class, 'logout'])->name('logout');

// ─── Area Terproteksi (butuh login) ──────────────────────────────────────────
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        $stats = [
            'total_kos'      => \App\Models\Kos::count(),
            'total_booking'  => \App\Models\Booking::count(),
            'total_bayar'    => \App\Models\Pembayaran::where('status_bayar', 'lunas')->count(),
            'pending_bayar'  => \App\Models\Pembayaran::where('status_bayar', 'pending')->count(),
        ];
        $bookingTerbaru   = \App\Models\Booking::with('kos', 'user')->latest()->take(5)->get();
        $pembayaranTerbaru = \App\Models\Pembayaran::with('booking.kos')->latest()->take(5)->get();
        return view('dashboard', compact('stats', 'bookingTerbaru', 'pembayaranTerbaru'));
    })->name('dashboard');

    // CRUD Resources
    Route::resource('kos',        KosController::class);
    Route::resource('galeri',     GaleriController::class);
    Route::resource('booking',    BookingController::class);
    Route::resource('pembayaran', PembayaranController::class);
});
