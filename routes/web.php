<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

/*
|--------------------------------------------------------------------------
| Web Routes - KosFinder Platform
|--------------------------------------------------------------------------
*/

// Halaman Utama
Route::get('/', [PageController::class, 'home'])->name('home');

// Halaman About
Route::get('/about', [PageController::class, 'about'])->name('about');

// Halaman Team
Route::get('/team', [PageController::class, 'team'])->name('team');

// Halaman Contact
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
