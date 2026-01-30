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
</section>
@endsection
