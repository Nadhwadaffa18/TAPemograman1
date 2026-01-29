@extends('layouts.admin')

@section('title', 'Kelola Layanan')

@section('content')
<div class="page-header mb-4">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2><i class="bi bi-grid-3x3-gap"></i> Kelola Layanan</h2>
            <p class="text-muted mb-0">Atur daftar layanan dan paket fotografi</p>
        </div>
        <a href="{{ route('services.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Tambah Layanan
        </a>
    </div>
</div>

{{-- LAYANAN UTAMA --}}
<div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0"><i class="bi bi-camera"></i> Layanan Utama</h5>
    </div>
    <div class="card-body">
        @php $layananUtama = $services->where('tipe', 'layanan'); @endphp
        
        @if($layananUtama->count())
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th width="60">Urutan</th>
                            <th width="60">Icon</th>
                            <th>Nama Layanan</th>
                            <th>Deskripsi</th>
                            <th>Harga</th>
                            <th width="80">Featured</th>
                            <th class="text-center" width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($layananUtama as $service)
                        <tr>
                            <td>
                                <span class="badge bg-secondary">{{ $service->urutan }}</span>
                            </td>
                            <td>
                                <i class="bi {{ $service->icon }}" style="font-size: 24px; color: var(--accent, #c9a962);"></i>
                            </td>
                            <td>
                                <strong>{{ $service->nama }}</strong>
                            </td>
                            <td>
                                <small class="text-muted">{{ Str::limit($service->deskripsi, 60) }}</small>
                            </td>
                            <td>
                                <strong>Rp {{ number_format($service->harga, 0, ',', '.') }}</strong>
                                @if($service->satuan)
                                    <small class="text-muted">/{{ $service->satuan }}</small>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($service->is_featured)
                                    <span class="badge bg-success"><i class="bi bi-star-fill"></i></span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('services.edit', $service->id) }}" 
                                   class="btn btn-sm btn-warning" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('services.destroy', $service->id) }}"
                                      method="POST" class="d-inline"
                                      onsubmit="return confirm('Yakin ingin menghapus layanan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-muted text-center py-3 mb-0">Belum ada layanan utama.</p>
        @endif
    </div>
</div>

{{-- PAKET LAYANAN --}}
<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="bi bi-box-seam"></i> Paket Layanan</h5>
    </div>
    <div class="card-body">
        @php $paketLayanan = $services->where('tipe', 'paket'); @endphp
        
        @if($paketLayanan->count())
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th width="60">Urutan</th>
                            <th width="60">Icon</th>
                            <th>Nama Paket</th>
                            <th>Deskripsi</th>
                            <th>Harga</th>
                            <th width="80">Featured</th>
                            <th class="text-center" width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($paketLayanan as $service)
                        <tr>
                            <td>
                                <span class="badge bg-secondary">{{ $service->urutan }}</span>
                            </td>
                            <td>
                                <i class="bi {{ $service->icon }}" style="font-size: 24px; color: var(--accent, #c9a962);"></i>
                            </td>
                            <td>
                                <strong>{{ $service->nama }}</strong>
                            </td>
                            <td>
                                <small class="text-muted">{{ Str::limit($service->deskripsi, 60) }}</small>
                            </td>
                            <td>
                                <strong>Rp {{ number_format($service->harga, 0, ',', '.') }}</strong>
                                @if($service->satuan)
                                    <small class="text-muted">/{{ $service->satuan }}</small>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($service->is_featured)
                                    <span class="badge bg-success"><i class="bi bi-star-fill"></i></span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('services.edit', $service->id) }}" 
                                   class="btn btn-sm btn-warning" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('services.destroy', $service->id) }}"
                                      method="POST" class="d-inline"
                                      onsubmit="return confirm('Yakin ingin menghapus paket ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-muted text-center py-3 mb-0">Belum ada paket layanan.</p>
        @endif
    </div>
</div>

{{-- Referensi Icon --}}
<div class="card mt-4 bg-light">
    <div class="card-body">
        <h6><i class="bi bi-info-circle"></i> Referensi Icon Bootstrap</h6>
        <p class="small text-muted mb-2">Gunakan nama icon dari Bootstrap Icons. Contoh:</p>
        <div class="d-flex flex-wrap gap-3">
            <span><i class="bi bi-camera"></i> bi-camera</span>
            <span><i class="bi bi-heart"></i> bi-heart</span>
            <span><i class="bi bi-gem"></i> bi-gem</span>
            <span><i class="bi bi-person-bounding-box"></i> bi-person-bounding-box</span>
            <span><i class="bi bi-calendar-event"></i> bi-calendar-event</span>
            <span><i class="bi bi-box-seam"></i> bi-box-seam</span>
            <span><i class="bi bi-image"></i> bi-image</span>
            <span><i class="bi bi-star"></i> bi-star</span>
        </div>
        <p class="small text-muted mt-2 mb-0">
            Lihat semua icon di: <a href="https://icons.getbootstrap.com/" target="_blank">icons.getbootstrap.com</a>
        </p>
    </div>
</div>
@endsection
