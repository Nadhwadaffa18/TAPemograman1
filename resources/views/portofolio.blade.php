@extends('layouts.app')

@section('title', 'Portofolio - Studio Fotografi')

@section('content')
<section class="portfolio">
    <div class="portfolio-header">
        <span class="section-subtitle">Portofolio</span>
        <h1>Karya Pilihan Kami</h1>
        <p>
            Setiap foto adalah cerita yang kami abadikan
            melalui cahaya, komposisi, dan sentuhan artistik.
        </p>
    </div>

    <div class="portfolio-grid">
        @forelse($portfolios as $portfolio)
            <div class="portfolio-item">
                <img 
                    src="{{ $portfolio->image }}" 
                    alt="Portfolio"
                    loading="lazy"
                >
                <div class="portfolio-overlay">
                    <p class="portfolio-description">
                        {{ $portfolio->description }}
                    </p>
                </div>
            </div>
        @empty
            <div style="grid-column: 1/-1; text-align: center; padding: 60px 20px;">
                <i class="bi bi-images" style="font-size: 64px; color: rgba(255,255,255,0.3);"></i>
                <p style="color: rgba(255,255,255,0.6); margin-top: 20px; font-size: 18px;">
                    Belum ada portofolio yang ditambahkan
                </p>
            </div>
        @endforelse
    </div>
</section>
@endsection
