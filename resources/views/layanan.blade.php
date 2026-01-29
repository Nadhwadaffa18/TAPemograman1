@extends('layouts.app')

@section('title', 'Layanan - Studio Fotografi')

@section('content')
<section class="services">
    <div class="services-header">
        <span class="section-subtitle">Layanan Kami</span>
        <h1>Apa yang Kami Tawarkan</h1>
        <p>
            Setiap layanan dirancang untuk menghasilkan visual
            yang kuat, elegan, dan bermakna untuk kebutuhan Anda.
        </p>
    </div>

    <div class="services-grid">
        @forelse($layanan as $item)
        <div class="service-card {{ $item->is_featured ? 'featured' : '' }}">
            <div class="service-icon">
                <i class="bi {{ $item->icon }}"></i>
            </div>
            <h3>{{ $item->nama }}</h3>
            <p>{{ $item->deskripsi }}</p>
            <div class="service-price">
                Mulai dari <strong>Rp {{ number_format($item->harga, 0, ',', '.') }}</strong>@if($item->satuan)/{{ $item->satuan }}@endif
            </div>
            <a href="{{ route('kontak', ['paket' => Str::slug($item->nama)]) }}" class="service-btn">Pesan Sekarang</a>
        </div>
        @empty
        <div class="text-center" style="grid-column: span 3;">
            <p style="color: var(--text-muted);">Belum ada layanan tersedia.</p>
        </div>
        @endforelse
    </div>
</section>

<!-- Pricing Section -->
<section class="pricing">
    <div class="pricing-header">
        <span class="section-subtitle">Daftar Harga</span>
        <h2>Pilih Paket yang Sesuai</h2>
        <p>
            Kami menawarkan berbagai paket fotografi dengan harga yang kompetitif
            dan hasil berkualitas tinggi.
        </p>
    </div>

    <div class="pricing-grid">
        @forelse($paket as $item)
        <div class="pricing-card {{ $item->is_featured ? 'featured' : '' }}">
            <div class="pricing-badge">{{ $item->is_featured ? 'Best Deal' : 'Paket' }}</div>
            <div class="pricing-icon">
                <i class="bi {{ $item->icon }}"></i>
            </div>
            <h3>{{ $item->nama }}</h3>
            <div class="pricing-price">
                <span class="currency">Rp</span>
                <span class="amount">{{ number_format($item->harga, 0, ',', '.') }}</span>
                @if($item->satuan)
                <span class="per">/{{ $item->satuan }}</span>
                @endif
            </div>
            <ul class="pricing-features">
                @foreach(explode(',', $item->deskripsi) as $fitur)
                <li><i class="bi bi-check2"></i> {{ trim($fitur) }}</li>
                @endforeach
            </ul>
            <a href="{{ route('kontak', ['paket' => Str::slug($item->nama)]) }}" class="pricing-btn">Pesan Sekarang</a>
        </div>
        @empty
        <div class="text-center" style="grid-column: span 3;">
            <p style="color: var(--text-muted);">Belum ada paket tersedia.</p>
        </div>
        @endforelse
    </div>

    <!-- Additional Info -->
    <div class="pricing-info">
        <div class="info-card">
            <i class="bi bi-shield-check"></i>
            <h4>Garansi Kepuasan</h4>
            <p>Revisi hingga 2x jika hasil tidak sesuai</p>
        </div>
        <div class="info-card">
            <i class="bi bi-clock-history"></i>
            <h4>Pengerjaan Cepat</h4>
            <p>Hasil foto siap dalam 7-14 hari kerja</p>
        </div>
        <div class="info-card">
            <i class="bi bi-percent"></i>
            <h4>Paket Custom</h4>
            <p>Hubungi kami untuk penawaran khusus</p>
        </div>
    </div>
</section>
@endsection
