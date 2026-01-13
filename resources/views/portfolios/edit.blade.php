@extends('layouts.app')

@section('title', 'Edit Portofolio')

@section('content')
<section style="padding:40px 0">
    <a href="{{ route('portfolios.index') }}" style="color:#666">← Kembali</a>

    <h1 style="margin-top:12px">Edit: {{ $item->title }}</h1>

    <form action="{{ route('portfolios.update', $item) }}" method="POST" enctype="multipart/form-data" style="max-width:720px;margin-top:18px;">
        @csrf
        @method('PUT')

        <div style="margin-bottom:12px;">
            <label>Judul</label>
            <input type="text" name="title" value="{{ old('title', $item->title) }}" required style="width:100%;padding:12px;border-radius:8px;border:1px solid #ddd;">
        </div>

        <div style="margin-bottom:12px;">
            <label>Deskripsi</label>
            <textarea name="description" rows="6" style="width:100%;padding:12px;border-radius:8px;border:1px solid #ddd;">{{ old('description', $item->description) }}</textarea>
        </div>

        @if($item->image)
            <div style="margin-bottom:12px">
                <img src="{{ asset('storage/'.$item->image) }}" alt="" style="max-width:240px;border-radius:8px;display:block;margin-bottom:8px;">
            </div>
        @endif

        <div style="margin-bottom:12px;">
            <label>Ganti Gambar (opsional)</label>
            <input type="file" name="image" accept="image/*">
        </div>

        <button class="btn-primary" type="submit">Perbarui</button>
        <a href="{{ route('portfolios.index') }}" style="margin-left:12px;color:#666">Batal</a>
    </form>
</section>
@endsection
@extends('layouts.app')

@section('title', 'Edit Portofolio')

@section('content')
<section style="padding:40px 0">
    <h1>Edit Karya</h1>

    <form action="{{ route('portfolios.update', $item) }}" method="POST" enctype="multipart/form-data" style="max-width:720px;margin-top:18px;">
        @csrf
        @method('PUT')

        <div style="margin-bottom:12px;">
            <label>Judul</label>
            <input type="text" name="title" value="{{ old('title', $item->title) }}" required style="width:100%;padding:12px;border-radius:8px;border:1px solid #ddd;">
        </div>

        <div style="margin-bottom:12px;">
            <label>Deskripsi</label>
            <textarea name="description" rows="6" style="width:100%;padding:12px;border-radius:8px;border:1px solid #ddd;">{{ old('description', $item->description) }}</textarea>
        </div>

        <div style="margin-bottom:12px;">
            <label>Gambar (opsional, unggah untuk mengganti)</label>
            <input type="file" name="image" accept="image/*">
            @if($item->image)
                <div style="margin-top:8px"><img src="{{ asset('storage/'.$item->image) }}" alt="" style="max-width:200px;border-radius:8px"></div>
            @endif
        </div>

        <button class="btn-primary" type="submit">Perbarui</button>
        <a href="{{ route('portfolios.index') }}" style="margin-left:12px;color:#666">Batal</a>
    </form>
</section>
@endsection
