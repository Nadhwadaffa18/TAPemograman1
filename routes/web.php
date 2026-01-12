<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/tentang', function () {
    return view('tentang');
});

Route::get('/layanan', function () {
    return view('layanan');
});

Route::get('/portofolio', function () {
    return view('portofolio');
});

Route::get('/kontak', function () {
    return view('kontak');
});