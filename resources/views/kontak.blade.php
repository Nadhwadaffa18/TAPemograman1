@extends('layouts.app')

@section('title', 'Kontak - situs_fotografi.photo')

@section('content')
<section class="contact">
    <div class="contact-wrapper">
        <div class="contact-info">
            <span class="section-subtitle">Kontak</span>
            <h1>Mari Bekerja Sama</h1>

            <p>
                Tertarik bekerja sama atau ingin
                melakukan sesi pemotretan?
                Silakan hubungi saya melalui form berikut.
            </p>

            <ul class="contact-list">
                <li>Email: situs_fotografi@email.com</li>
                <li>Instagram: @situs_fotografi.photo</li>
                <li>Lokasi: Indonesia</li>
            </ul>
        </div>

        <form class="contact-form">
            <input type="text" placeholder="Nama Anda" required>
            <input type="email" placeholder="Email Anda" required>
            <textarea placeholder="Pesan Anda" required></textarea>

            <button type="submit" class="btn-primary">Kirim Pesan</button>
        </form>
    </div>
</section>
@endsection
