@extends('layouts.admin')

@section('title', 'Detail Pesan')

@section('content')
<div class="page-header mb-4">
    <h2><i class="bi bi-envelope-open"></i> Detail Pesan</h2>
    <p>Pesan dari {{ $pesan->nama }}</p>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card mb-4">
            <div class="card-body">

                {{-- INFO PENGIRIM --}}
                <div class="d-flex align-items-center mb-4 pb-3 border-bottom">
                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                         style="width:60px;height:60px;font-size:24px;background: var(--accent) !important; color: #0a0a0a !important;">
                        {{ strtoupper(substr($pesan->nama, 0, 1)) }}
                    </div>
                    <div class="ms-3">
                        <h5 class="mb-1" style="color: #ffffff;">{{ $pesan->nama }}</h5>
                        <a href="mailto:{{ $pesan->email }}" style="color: #b0b0b0;">
                            <i class="bi bi-envelope"></i> {{ $pesan->email }}
                        </a>
                    </div>
                </div>

                {{-- ISI PESAN --}}
                <h6 class="mb-3" style="color: #b0b0b0;">
                    <i class="bi bi-chat-text"></i> Isi Pesan:
                </h6>
                <div class="p-4 rounded" style="line-height:1.8; background: #1a1a1a; color: #ffffff;">
                    {{ $pesan->pesan }}
                </div>

                {{-- PAKET YANG DIPILIH --}}
                @if($pesan->paket)
                <div class="mt-4 p-3" style="background: rgba(201, 169, 98, 0.1); border-left: 3px solid #c9a962;">
                    <h6 class="mb-2" style="color: #ffffff;">
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
                <h6 class="card-title" style="color: #ffffff;">
                    <i class="bi bi-info-circle"></i> Informasi
                </h6>

                <table class="table table-sm">
                    <tr>
                        <td style="color: #b0b0b0;">ID</td>
                        <td class="text-end" style="color: #ffffff;"><strong>{{ $pesan->id }}</strong></td>
                    </tr>
                    <tr>
                        <td style="color: #b0b0b0;">Paket</td>
                        <td class="text-end">
                            @if($pesan->paket)
                                <span class="badge bg-success">{{ ucfirst(str_replace('-', ' ', $pesan->paket)) }}</span>
                            @else
                                <span style="color: #707070;">-</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td style="color: #b0b0b0;">Diterima</td>
                        <td class="text-end" style="color: #ffffff;">
                            {{ $pesan->created_at ? $pesan->created_at->format('d F Y') : '-' }}
                        </td>
                    </tr>
                    <tr>
                        <td style="color: #b0b0b0;">Waktu</td>
                        <td class="text-end" style="color: #ffffff;">
                            {{ $pesan->created_at ? $pesan->created_at->format('H:i') : '-' }}
                        </td>
                    </tr>
                </table>

            </div>
        </div>

        <div class="card mt-3" style="background: #1a1a1a; border-left: 3px solid #17a2b8;">
            <div class="card-body">
                <h6 class="card-title" style="color: #17a2b8;">
                    <i class="bi bi-lightbulb"></i> Tips
                </h6>
                <p class="small mb-0" style="color: #b0b0b0;">
                    Klik "Balas Email" untuk membuka aplikasi email Anda dan membalas pesan ini secara langsung.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
