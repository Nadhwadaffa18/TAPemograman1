@extends('layouts.app')

@section('title', 'Portofolio - Situs Fotografi')

@section('content')
<section class="portfolio">
    <div class="portfolio-header">
        <span class="section-subtitle">Portofolio</span>
        <h1>Karya Pilihan</h1>
        <p>Galeri proyek dan sesi foto terbaru. Klik item untuk melihat detail.</p>
    </div>

    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:18px;">
        <div></div>
        <a href="{{ route('portfolios.create') }}" class="btn-primary">Tambah Karya</a>
    </div>

    <div class="portfolio-grid">
        @forelse($items as $item)
            <div class="portfolio-item">
                <a href="{{ route('portfolios.show', $item) }}">
                    @if($item->image)
                        <img src="{{ asset('storage/'.$item->image) }}" alt="{{ $item->title }}">
                    @else
                        <img src="https://picsum.photos/800/600?random={{ $item->id }}" alt="{{ $item->title }}">
                    @endif
                </a>
                <div style="padding:12px 10px;display:flex;justify-content:space-between;align-items:center;">
                    <strong>{{ $item->title }}</strong>
                    <div>
                        <a href="{{ route('portfolios.edit', $item) }}" style="margin-right:8px;color:#444;">Edit</a>
                        <form action="{{ route('portfolios.destroy', $item) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background:transparent;border:none;color:#b33;cursor:pointer">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p>Belum ada portofolio. <a href="{{ route('portfolios.create') }}">Tambahkan sekarang</a>.</p>
        @endforelse
    </div>

    <div style="margin-top:26px;">{{ $items->links() }}</div>
</section>
@endsection
