@extends('layouts.app')

@section('title', $item->title)

@section('content')
<section style="padding:40px 0">
    <a href="{{ route('portfolios.index') }}" style="color:#666">← Kembali</a>

    <h1 style="margin-top:12px">{{ $item->title }}</h1>

    @if($item->image)
        <div style="margin-top:18px">
            <img src="{{ asset('storage/'.$item->image) }}" alt="" style="width:100%;border-radius:12px;object-fit:cover;">
        </div>
    @endif

    <div style="margin-top:18px;font-size:16px;color:#444;line-height:1.8">
        {!! nl2br(e($item->description)) !!}
    </div>

    <div style="margin-top:18px">
        <a href="{{ route('portfolios.edit', $item) }}" class="btn-primary">Edit</a>
        <form action="{{ route('portfolios.destroy', $item) }}" method="POST" style="display:inline;margin-left:8px;">
            @csrf
            @method('DELETE')
            <button class="btn-primary" style="background:#b33;border-radius:8px;padding:10px 14px;border:none;">Hapus</button>
        </form>
    </div>
</section>
@endsection
