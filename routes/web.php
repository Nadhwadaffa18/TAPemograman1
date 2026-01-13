<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortfolioController;

Route::get('/', function () {
    return view('home');
});

Route::get('/tentang', function () {
    return view('tentang');
});

Route::get('/layanan', function () {
    return view('layanan');
});

// keep legacy path and redirect to resource index
Route::get('/portofolio', function () {
    return redirect()->route('portfolios.index');
});

Route::get('/kontak', function () {
    return view('kontak');
});

// Resource routes for CRUD
Route::resource('portfolios', PortfolioController::class);