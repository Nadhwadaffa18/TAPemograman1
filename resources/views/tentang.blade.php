@extends('layouts.app')

@section('title', 'Tentang Kami - Studio Fotografi')

@section('content')
<section class="about">
    <div class="about-container">
        <div class="about-text">
            <span class="section-subtitle">Tentang Kami</span>
            <h1>Mengabadikan <span>Momen</span> Dengan Sentuhan Artistik</h1>
            <p>
                <strong>Studio</strong> adalah studio fotografi yang bergerak
                di bidang fotografi potret, event, dan dokumentasi kreatif.
                Kami percaya bahwa setiap foto memiliki cerita dan emosi
                yang layak diabadikan dalam satu frame terbaik.
            </p>

            <p>
                Dengan tim profesional, peralatan berkualitas,
                dan gaya visual yang konsisten,
                Studio siap membantu mengabadikan momen penting Anda
                melalui karya fotografi yang berkelas dan bermakna.
            </p>

            <a href="{{ route('kontak') }}" class="btn-primary">
                <i class="bi bi-chat-heart"></i> Hubungi Kami
            </a>

            <div class="about-stats">
                <div class="stat-item">
                    <h3>500+</h3>
                    <p>Proyek Selesai</p>
                </div>
                <div class="stat-item">
                    <h3>10+</h3>
                    <p>Tahun Pengalaman</p>
                </div>
                <div class="stat-item">
                    <h3>100%</h3>
                    <p>Klien Puas</p>
                </div>
            </div>
        </div>

        <div class="about-image">
            <img src="https://images.unsplash.com/photo-1554048612-b6a482bc67e5?w=600" alt="Studio Fotografi">
        </div>
    </div>
</section>
@endsection