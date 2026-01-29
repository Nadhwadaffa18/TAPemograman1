@extends('layouts.admin')

@section('title', 'Tambah Layanan')

@section('content')
<div class="page-header mb-4">
    <h2><i class="bi bi-plus-lg"></i> Tambah Layanan Baru</h2>
    <p class="text-muted">Tambahkan layanan atau paket fotografi baru</p>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('services.store') }}" method="POST">
                    @csrf

                    <div class="row mb-3">
                        <div class="col-md-8">
                            <label for="nama" class="form-label">Nama Layanan *</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                                   id="nama" name="nama" value="{{ old('nama') }}" 
                                   placeholder="Contoh: Fotografi Potret" required>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="tipe" class="form-label">Tipe *</label>
                            <select class="form-select @error('tipe') is-invalid @enderror" id="tipe" name="tipe" required>
                                <option value="layanan" {{ old('tipe') == 'layanan' ? 'selected' : '' }}>Layanan Utama</option>
                                <option value="paket" {{ old('tipe') == 'paket' ? 'selected' : '' }}>Paket</option>
                            </select>
                            @error('tipe')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="icon" class="form-label">Icon Bootstrap *</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-camera" id="icon-preview"></i></span>
                                <input type="text" class="form-control @error('icon') is-invalid @enderror" 
                                       id="icon" name="icon" value="{{ old('icon', 'bi-camera') }}" 
                                       placeholder="bi-camera" required>
                            </div>
                            @error('icon')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="harga" class="form-label">Harga (Rp) *</label>
                            <input type="number" class="form-control @error('harga') is-invalid @enderror" 
                                   id="harga" name="harga" value="{{ old('harga') }}" 
                                   placeholder="500000" min="0" required>
                            @error('harga')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="satuan" class="form-label">Satuan (opsional)</label>
                            <input type="text" class="form-control @error('satuan') is-invalid @enderror" 
                                   id="satuan" name="satuan" value="{{ old('satuan') }}" 
                                   placeholder="produk, jam, dll">
                            @error('satuan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi *</label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                  id="deskripsi" name="deskripsi" rows="4" 
                                  placeholder="Tuliskan deskripsi layanan atau fitur-fitur paket..." required>{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Untuk paket, pisahkan setiap fitur dengan koma.</small>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label for="urutan" class="form-label">Urutan Tampil</label>
                            <input type="number" class="form-control @error('urutan') is-invalid @enderror" 
                                   id="urutan" name="urutan" value="{{ old('urutan', 0) }}" min="0">
                            @error('urutan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-8 d-flex align-items-end">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" value="1" 
                                       {{ old('is_featured') ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_featured">
                                    <strong>Featured</strong> - Tampilkan sebagai layanan utama/unggulan
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-lg"></i> Simpan Layanan
                        </button>
                        <a href="{{ route('services.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card bg-light">
            <div class="card-body">
                <h6><i class="bi bi-lightbulb"></i> Tips</h6>
                <ul class="small text-muted mb-0">
                    <li class="mb-2"><strong>Layanan Utama:</strong> Ditampilkan di bagian atas halaman layanan dengan card.</li>
                    <li class="mb-2"><strong>Paket:</strong> Ditampilkan di bagian bawah dengan daftar harga lengkap.</li>
                    <li class="mb-2"><strong>Featured:</strong> Layanan/paket yang ditandai featured akan memiliki highlight khusus.</li>
                    <li><strong>Urutan:</strong> Angka kecil akan ditampilkan lebih dulu.</li>
                </ul>
            </div>
        </div>

        <div class="card mt-3 bg-light">
            <div class="card-body">
                <h6><i class="bi bi-collection"></i> Contoh Icon</h6>
                <div class="d-flex flex-wrap gap-2 small">
                    <code>bi-camera</code>
                    <code>bi-heart</code>
                    <code>bi-gem</code>
                    <code>bi-person-bounding-box</code>
                    <code>bi-calendar-event</code>
                    <code>bi-box-seam</code>
                    <code>bi-image</code>
                    <code>bi-star</code>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Preview icon saat mengetik
    document.getElementById('icon').addEventListener('input', function() {
        const iconPreview = document.getElementById('icon-preview');
        iconPreview.className = 'bi ' + this.value;
    });
</script>
@endsection
