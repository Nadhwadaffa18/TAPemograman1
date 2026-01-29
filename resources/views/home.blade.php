@extends('layouts.app')

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
</section>
@endsection
