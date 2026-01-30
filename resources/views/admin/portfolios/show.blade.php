@extends('layouts.admin')

@section('title', 'Detail Portfolio')

@section('content')
<div class="page-header mb-4">
    <h2><i class="bi bi-eye"></i> Detail Portfolio</h2>
    <p class="text-muted">Informasi lengkap portfolio</p>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card mb-4">
            <div class="card-body">

                {{-- GAMBAR --}}
                <img
                    src="{{ $portfolio->image }}"
                    alt="Portfolio Image"
                    class="img-fluid rounded mb-4"
                    style="max-height:450px;width:100%;object-fit:cover;"
                >

                {{-- DESKRIPSI --}}
                <h4>Deskripsi</h4>
                <p class="text-muted" style="line-height:1.8;">
                    {{ $portfolio->description }}
                </p>

                {{-- HARGA --}}
                @if($portfolio->price)
                <div class="mt-3">
                    <h4>Daftar Harga</h4>
                    <h3 class="text-success">
                        <i class="bi bi-currency-dollar"></i>
                        Rp {{ number_format($portfolio->price, 0, ',', '.') }}
                    </h3>
                </div>
                @endif

                <hr>

                {{-- TANGGAL --}}
                <div class="row small text-muted">
                    <div class="col-md-6">
                        <strong class="text-dark">Dibuat:</strong><br>
                        {{ $portfolio->created_at->format('d F Y H:i') }}
                    </div>
                    <div class="col-md-6">
                        <strong class="text-dark">Diperbarui:</strong><br>
                        {{ $portfolio->updated_at->format('d F Y H:i') }}
                    </div>
                </div>

                {{-- AKSI --}}
                <div class="d-flex gap-2 mt-4 pt-3 border-top">
                    <a href="{{ route('portfolios.edit', $portfolio->id) }}" class="btn btn-warning">
                        <i class="bi bi-pencil"></i> Edit
                    </a>

                    <form action="{{ route('portfolios.destroy', $portfolio->id) }}"
                          method="POST"
                          onsubmit="return confirm('Yakin ingin menghapus portfolio ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">
                            <i class="bi bi-trash"></i> Hapus
                        </button>
                    </form>

                    <a href="{{ route('portfolios.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>

            </div>
        </div>
    </div>

    {{-- INFO SAMPING --}}
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">
                    <i class="bi bi-info-circle"></i> Informasi
                </h6>

                <table class="table table-sm">
                    <tr>
                        <td class="text-muted">ID</td>
                        <td class="text-end"><strong>{{ $portfolio->id }}</strong></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Harga</td>
                        <td class="text-end">
                            @if($portfolio->price)
                                <strong class="text-success">Rp {{ number_format($portfolio->price, 0, ',', '.') }}</strong>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="text-muted">Status</td>
                        <td class="text-end">
                            <span class="badge bg-success">Aktif</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-muted">Gambar</td>
                        <td class="text-end">
                            <a href="{{ $portfolio->image }}" target="_blank">
                                Lihat Gambar
                            </a>
                        </td>
                    </tr>
                </table>

            </div>
        </div>
    </div>
</div>
@endsection