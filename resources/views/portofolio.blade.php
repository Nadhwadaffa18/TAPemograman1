@extends('layouts.app')

@section('title', 'Portofolio - Blog Fotografi Daffa')

@section('content')
<section class="portfolio">
    <div class="portfolio-header">
        <span class="section-subtitle">Portofolio</span>
        <h1>Karya Pilihan</h1>
        <p>
            Setiap foto adalah cerita yang saya abadikan
            melalui cahaya, komposisi, dan rasa.
        </p>
    </div>

    <div class="portfolio-grid">
        <div class="portfolio-item">
            <img src="https://picsum.photos/id/1015/800/600" alt="Karya 1">
        </div>

        <div class="portfolio-item tall">
            <img src="https://picsum.photos/id/1011/800/1000" alt="Karya 2">
        </div>

        <div class="portfolio-item">
            <img src="https://picsum.photos/id/1016/800/600" alt="Karya 3">
        </div>

        <div class="portfolio-item wide">
            <img src="https://picsum.photos/id/1024/1200/600" alt="Karya 4">
        </div>

        <div class="portfolio-item">
            <img src="https://picsum.photos/id/1027/800/600" alt="Karya 5">
        </div>

        <div class="portfolio-item">
            <img src="https://picsum.photos/id/1035/800/600" alt="Karya 6">
        </div>
    </div>
</section>
@endsection
