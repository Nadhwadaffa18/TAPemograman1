@extends('layouts.app')

@section('title', 'Promo - Studio Fotografi')

@push('styles')
    <link rel="stylesheet" href="{{ secure_asset('css/promo.css') }}">
@endpush

@section('content')
<section class="promo">
    <div class="promo-header">
        <span class="section-subtitle">Penawaran Spesial</span>
        <h1>Promo Menarik Untuk Anda</h1>
        <p>
            Nikmati diskon eksklusif dan penawaran terbatas untuk semua layanan fotografi kami.
            Jangan lewatkan kesempatan emas ini untuk mendapatkan hasil foto berkualitas dengan harga terbaik.
        </p>
    </div>

    <div class="promo-cards-wrapper">
        <div class="promo-card promo-card-primary">
            <div class="promo-badge">HOT DEAL</div>
            <div class="promo-icon">
                <i class="bi bi-camera"></i>
            </div>
            <h3>Paket Fotografi Prewedding</h3>
            <p class="promo-description">
                Abadikan momen indah sebelum pernikahan Anda dengan paket lengkap
                termasuk lokasi eksotis dan editing profesional.
            </p>
            <div class="promo-price">
                <span class="original-price">Rp 5.000.000</span>
                <span class="discount-price">Rp 3.500.000</span>
                <span class="discount-badge">-30%</span>
            </div>
            <p class="promo-validity">Berlaku hingga 28 Februari 2026</p>
            <a href="{{ route('kontak', ['paket' => 'fotografi-prewedding']) }}" class="promo-btn">
                <i class="bi bi-heart"></i> Pesan Sekarang
            </a>
        </div>

        <div class="promo-card promo-card-secondary">
            <div class="promo-badge">TERPOPULER</div>
            <div class="promo-icon">
                <i class="bi bi-image"></i>
            </div>
            <h3>Paket Fotografi Acara</h3>
            <p class="promo-description">
                Dokumentasikan acara spesial Anda dengan fotografi profesional yang menangkap
                setiap momen penting dan detail indah.
            </p>
            <div class="promo-price">
                <span class="original-price">Rp 3.000.000</span>
                <span class="discount-price">Rp 2.100.000</span>
                <span class="discount-badge">-30%</span>
            </div>
            <p class="promo-validity">Berlaku hingga 28 Februari 2026</p>
            <a href="{{ route('kontak', ['paket' => 'fotografi-acara']) }}" class="promo-btn">
                <i class="bi bi-calendar-event"></i> Pesan Sekarang
            </a>
        </div>

        <div class="promo-card promo-card-tertiary">
            <div class="promo-badge">NILAI TERBAIK</div>
            <div class="promo-icon">
                <i class="bi bi-person-circle"></i>
            </div>
            <h3>Paket Fotografi Potret</h3>
            <p class="promo-description">
                Dapatkan foto potret berkualitas tinggi dengan berbagai pilihan latar belakang
                dan gaya fotografi sesuai kepribadian Anda.
            </p>
            <div class="promo-price">
                <span class="original-price">Rp 1.500.000</span>
                <span class="discount-price">Rp 990.000</span>
                <span class="discount-badge">-34%</span>
            </div>
            <p class="promo-validity">Berlaku hingga 28 Februari 2026</p>
            <a href="{{ route('kontak', ['paket' => 'fotografi-potret']) }}" class="promo-btn">
                <i class="bi bi-camera-fill"></i> Pesan Sekarang
            </a>
        </div>
    </div>

    <div class="promo-benefits">
        <h2>Mengapa Memilih Studio?</h2>
        <div class="benefits-grid">
            <div class="benefit-item">
                <div class="benefit-icon">
                    <i class="bi bi-award"></i>
                </div>
                <h4>Profesional Berpengalaman</h4>
                <p>Tim fotografer berpengalaman lebih dari 10 tahun di industri fotografi.</p>
            </div>

            <div class="benefit-item">
                <div class="benefit-icon">
                    <i class="bi bi-camera-fill"></i>
                </div>
                <h4>Peralatan Terkini</h4>
                <p>Menggunakan kamera profesional dan peralatan fotografi terbaru.</p>
            </div>

            <div class="benefit-item">
                <div class="benefit-icon">
                    <i class="bi bi-pencil-square"></i>
                </div>
                <h4>Editing Profesional</h4>
                <p>Hasil editing berkualitas dengan sentuhan artistik yang memukau.</p>
            </div>

            <div class="benefit-item">
                <div class="benefit-icon">
                    <i class="bi bi-check-circle"></i>
                </div>
                <h4>Garansi Kepuasan</h4>
                <p>Kami berkomitmen memberikan hasil terbaik hingga Anda puas.</p>
            </div>

            <div class="benefit-item">
                <div class="benefit-icon">
                    <i class="bi bi-telephone"></i>
                </div>
                <h4>Layanan Konsultasi</h4>
                <p>Konsultasi gratis untuk memahami kebutuhan dan visi Anda.</p>
            </div>

            <div class="benefit-item">
                <div class="benefit-icon">
                    <i class="bi bi-lightning-charge"></i>
                </div>
                <h4>Pengiriman Cepat</h4>
                <p>Hasil foto dikirim dengan format digital berkualitas tinggi.</p>
            </div>
        </div>
    </div>

    <div class="promo-cta">
        <h2>Jangan Lewatkan Kesempatan Emas Ini!</h2>
        <p>Hubungi kami sekarang dan daftarkan acara Anda sebelum kuota promo habis.</p>
        <a href="{{ route('kontak') }}" class="cta-button">
            <i class="bi bi-chat-heart"></i> Hubungi Kami Sekarang
        </a>
    </div>
</section>
@endsection
