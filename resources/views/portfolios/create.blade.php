@extends('layouts.app')

@section('title', 'Tambah Portofolio')

@section('content')
<section style="padding:40px 0">
    <h1>Tambah Karya</h1>

    <form action="{{ route('portfolios.store') }}" method="POST" enctype="multipart/form-data" style="max-width:720px;margin-top:18px;">
        @csrf

        <div style="margin-bottom:12px;">
            <label>Judul</label>
            <input type="text" name="title" value="{{ old('title') }}" required style="width:100%;padding:12px;border-radius:8px;border:1px solid #ddd;">
        </div>

        <div style="margin-bottom:12px;">
            <label>Deskripsi</label>
            <textarea name="description" rows="6" style="width:100%;padding:12px;border-radius:8px;border:1px solid #ddd;">{{ old('description') }}</textarea>
        </div>

        <div style="margin-bottom:12px;">
            <label>Gambar (opsional)</label>
            <input type="file" name="image" accept="image/*">
        </div>

        <button class="btn-primary" type="submit">Simpan</button>
        <a href="{{ route('portfolios.index') }}" style="margin-left:12px;color:#666">Batal</a>
    </form>
</section>
@endsection
