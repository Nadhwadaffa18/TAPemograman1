@extends('layouts.admin')

@section('title', 'Detail Pesan')

@section('content')
<div class="page-header mb-4">
    <h2><i class="bi bi-envelope-open"></i> Detail Pesan</h2>
    <p class="text-muted">Pesan dari {{ $pesan->nama }}</p>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card mb-4">
            <div class="card-body">

                {{-- INFO PENGIRIM --}}
                <div class="d-flex align-items-center mb-4 pb-3 border-bottom">
                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                         style="width:60px;height:60px;font-size:24px;">
                        {{ strtoupper(substr($pesan->nama, 0, 1)) }}
                    </div>
                    <div class="ms-3">
                        <h5 class="mb-1">{{ $pesan->nama }}</h5>
                        <a href="mailto:{{ $pesan->email }}" class="text-muted">
                            <i class="bi bi-envelope"></i> {{ $pesan->email }}
                        </a>
                    </div>
                </div>

                {{-- ISI PESAN --}}
                <h6 class="text-muted mb-3">
                    <i class="bi bi-chat-text"></i> Isi Pesan:
                </h6>
                <div class="bg-light p-4 rounded" style="line-height:1.8;">
                    {{ $pesan->pesan }}
                </div>

                {{-- PAKET YANG DIPILIH --}}
                @if($pesan->paket)
                <div class="mt-4 p-3 border-warning" style="background: rgba(201, 169, 98, 0.1); border-left: 3px solid var(--accent, #c9a962);">
                    <h6 class="mb-2">
                        <i class="bi bi-box-seam"></i> Paket yang Diminati:
                    </h6>
                    <span class="badge bg-success fs-6">{{ ucwords(str_replace('-', ' ', $pesan->paket)) }}</span>
                </div>
                @endif

                {{-- AKSI --}}
                <div class="d-flex gap-2 mt-4 pt-3 border-top">
                    <a href="mailto:{{ $pesan->email }}?subject=Re: Pesan dari Website" 
                       class="btn btn-primary">
                        <i class="bi bi-reply"></i> Balas Email
                    </a>

                    <form action="{{ route('pesan.destroy', $pesan->id) }}"
                          method="POST"
                          onsubmit="return confirm('Yakin ingin menghapus pesan ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">
                            <i class="bi bi-trash"></i> Hapus
                        </button>
                    </form>

                    <a href="{{ route('pesan.index') }}" class="btn btn-secondary">
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
                        <td class="text-end"><strong>{{ $pesan->id }}</strong></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Paket</td>
                        <td class="text-end">
                            @if($pesan->paket)
                                <span class="badge bg-success">{{ ucfirst(str_replace('-', ' ', $pesan->paket)) }}</span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="text-muted">Diterima</td>
                        <td class="text-end">
                            {{ $pesan->created_at ? $pesan->created_at->format('d F Y') : '-' }}
                        </td>
                    </tr>
                    <tr>
                        <td class="text-muted">Waktu</td>
                        <td class="text-end">
                            {{ $pesan->created_at ? $pesan->created_at->format('H:i') : '-' }}
                        </td>
                    </tr>
                </table>

            </div>
        </div>

        <div class="card mt-3 bg-light border-info">
            <div class="card-body">
                <h6 class="card-title">
                    <i class="bi bi-lightbulb"></i> Tips
                </h6>
                <p class="small text-muted mb-0">
                    Klik "Balas Email" untuk membuka aplikasi email Anda dan membalas pesan ini secara langsung.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
