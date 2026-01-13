@extends('layouts.app')

@section('title', 'Tentang Saya - Blog Fotografi Daffa')

@section('content')
<section class="about">
    <div class="about-container">
        <div class="about-text">
            <h1>Tentang </h1>
            <p>
                seorang fotografer yang berfokus pada
                fotografi potret, event, dan dokumentasi kreatif.
                Fotografi bagi saya bukan hanya gambar,
                tetapi cerita yang diabadikan dalam satu frame.
            </p>

            <p>
                Dengan pengalaman dan gaya visual yang konsisten,
                saya siap membantu mengabadikan momen terbaik Anda
                melalui karya fotografi yang berkelas dan bermakna.
            </p>

            <a href="/kontak" class="btn-primary">Hubungi Saya</a>
        </div>

        <div class="about-image">
            <img src="{{ asset('images/profile.jpg') }}" alt="Foto ">
        </div>
