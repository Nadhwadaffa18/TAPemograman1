@extends('layouts.app')

@section('title', 'Beranda - situs_fotografi.photo')

@section('content')
<section class="hero">
    <h1>Beberapa Karya Foto </h1>

    <p>
        Selamat datang di portofolio dan blog fotografi saya.
        Lihat karya saya dan hubungi saya untuk sesi pemotretan.
    </p>

    <a href="{{ route('portfolios.index') }}" class="btn-primary">Lihat Portofolio</a>
</section>
@endsection
