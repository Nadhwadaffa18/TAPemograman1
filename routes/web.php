<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\PesanController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\AuthController;

// Public Routes
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/tentang', [PageController::class, 'tentang'])->name('tentang');
Route::get('/layanan', [PageController::class, 'layanan'])->name('layanan');
Route::get('/portofolio', [PageController::class, 'portofolio'])->name('portofolio');
Route::get('/kontak', [PageController::class, 'kontak'])->name('kontak');
Route::post('/kontak', [PageController::class, 'kontakStore'])->name('kontak.store');

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes - Protected by Auth Middleware
Route::prefix('admin')->middleware('auth')->group(function () {
    
    // Portfolio
    Route::name('portfolios.')->group(function () {
        Route::get('portfolios', [PortfolioController::class, 'index'])->name('index');
        Route::get('portfolios/create', [PortfolioController::class, 'create'])->name('create');
        Route::post('portfolios', [PortfolioController::class, 'store'])->name('store');
        Route::get('portfolios/{portfolio}', [PortfolioController::class, 'show'])->name('show');
        Route::get('portfolios/{portfolio}/edit', [PortfolioController::class, 'edit'])->name('edit');
        Route::put('portfolios/{portfolio}', [PortfolioController::class, 'update'])->name('update');
        Route::delete('portfolios/{portfolio}', [PortfolioController::class, 'destroy'])->name('destroy');
    });

    // Pesan
    Route::name('pesan.')->group(function () {
        Route::get('pesan', [PesanController::class, 'index'])->name('index');
        Route::get('pesan/{pesan}', [PesanController::class, 'show'])->name('show');
        Route::delete('pesan/{pesan}', [PesanController::class, 'destroy'])->name('destroy');
    });

    // Services
    Route::name('services.')->group(function () {
        Route::get('services', [ServiceController::class, 'index'])->name('index');
        Route::get('services/create', [ServiceController::class, 'create'])->name('create');
        Route::post('services', [ServiceController::class, 'store'])->name('store');
        Route::get('services/{service}/edit', [ServiceController::class, 'edit'])->name('edit');
        Route::put('services/{service}', [ServiceController::class, 'update'])->name('update');
        Route::delete('services/{service}', [ServiceController::class, 'destroy'])->name('destroy');
    });
});
