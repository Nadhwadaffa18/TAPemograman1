@extends('layouts.app')

<<<<<<< HEAD
@section('title', 'Beranda - Studio Fotografi')

@section('content')
<section class="hero">
    <div class="hero-shapes">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>
    </div>
    
    <div class="hero-content">
        <span class="hero-badge">✨ Premium Photography</span>
        <h1>Abadikan <span>Momen</span> Berharga Anda</h1>
        <p>
            Selamat datang di studio fotografi kami. Kami menghadirkan 
            karya visual berkelas untuk mengabadikan setiap momen spesial dalam hidup Anda.
        </p>
        <div class="hero-buttons">
            <a href="{{ route('portofolio') }}" class="btn-primary">
                <i class="bi bi-images"></i> Lihat Portofolio
            </a>
            <a href="{{ route('kontak') }}" class="btn-secondary">
                <i class="bi bi-chat-dots"></i> Hubungi Kami
            </a>
        </div>
    </div>
=======
@section('title', 'Beranda - Blog Fotografi')

@push('styles')
    <link rel="stylesheet" href="{{ secure_asset('css/home.css') }}">
@endpush

@section('content')
<section class="hero">
    <h1>Beberapa Karya Foto Studio</h1>

    <p>
        Selamat datang di portofolio dan blog fotografi saya.
        Lihat karya saya dan hubungi saya untuk sesi pemotretan.
    </p>

    <a href="{{ url('/portofolio') }}" class="btn-primary">Lihat Portofolio</a>
>>>>>>> ca65ff439d42d0a5fd1da696e7d13b501fd1b587
</section>
@endsection