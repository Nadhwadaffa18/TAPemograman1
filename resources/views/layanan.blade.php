@extends('layouts.app')

@section('title', 'Layanan - Blog Fotografi Daffa')

@section('content')
<section class="services">
    <div class="services-header">
        <span class="section-subtitle">Layanan</span>
        <h1>Apa yang Saya Tawarkan</h1>
        <p>
            Setiap layanan dirancang untuk menghasilkan visual
            yang kuat, elegan, dan bermakna.
        </p>
    </div>

    <div class="services-grid">
        <div class="service-card">
            <h3>Fotografi Potret</h3>
            <p>
                Pemotretan personal dan profesional dengan
                pendekatan artistik dan pencahayaan natural.
            </p>
        </div>

        <div class="service-card featured">
            <h3>Event & Dokumentasi</h3>
            <p>
                Mengabadikan momen penting secara autentik,
                emosional, dan bercerita.
            </p>
        </div>

        <div class="service-card">
            <h3>Produk & Komersial</h3>
            <p>
                Foto produk dengan komposisi rapi
                untuk kebutuhan branding dan promosi.
            </p>
        </div>
    </div>
</section>
@endsection
