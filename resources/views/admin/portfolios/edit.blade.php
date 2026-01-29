@extends('layouts.admin')

@section('title', 'Edit Portfolio')

@section('content')
<div class="page-header">
    <h2><i class="bi bi-pencil"></i> Edit Portfolio</h2>
    <p>Perbarui informasi portfolio Anda</p>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('portfolios.update', $portfolio->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Gambar via LINK --}}
                    <div class="mb-4">
                        <label for="image" class="form-label">
                            <i class="bi bi-image"></i> Link Gambar
                        </label>

                        @if($portfolio->image)
                            <div class="mb-3">
                                <img src="{{ $portfolio->image }}"
                                     alt="Portfolio"
                                     class="img-thumbnail"
                                     style="width:80px;height:80px;object-fit:cover;">
                                <p class="small text-muted mt-2">
                                    <i class="bi bi-info-circle"></i> Gambar saat ini
                                </p>
                            </div>
                        @endif

                        <input type="url"
                               class="form-control @error('image') is-invalid @enderror"
                               id="image"
                               name="image"
                               placeholder="https://example.com/gambar.jpg"
                               value="{{ old('image', $portfolio->image) }}">

                        <small class="text-muted d-block mt-2">
                            <i class="bi bi-info-circle"></i>
                            Masukkan URL gambar (contoh: https://...)
                        </small>

                        @error('image')
                            <div class="invalid-feedback d-block mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Deskripsi --}}
                    <div class="mb-4">
                        <label for="description" class="form-label">
                            <i class="bi bi-file-text"></i> Deskripsi
                            <span class="text-danger">*</span>
                        </label>

                        <textarea class="form-control @error('description') is-invalid @enderror"
                                  id="description"
                                  name="description"
                                  rows="6"
                                  required>{{ old('description', $portfolio->description) }}</textarea>

                        <small class="text-muted d-block mt-2">
                            <i class="bi bi-info-circle"></i> Minimal 10 karakter
                        </small>

                        @error('description')
                            <div class="invalid-feedback d-block mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2 pt-3 border-top">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle"></i> Perbarui Portfolio
                        </button>
                        <a href="{{ route('portfolios.index') }}" class="btn btn-secondary">
                            <i class="bi bi-x-circle"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card bg-light border-warning">
            <div class="card-body">
                <h6 class="card-title">
                    <i class="bi bi-exclamation-triangle"></i> Catatan
                </h6>
                <ul class="small text-muted mb-0" style="padding-left: 20px;">
                    <li>Gunakan link gambar yang valid</li>
                    <li>Disarankan dari CDN / hosting publik</li>
                    <li>Contoh: Imgur, Cloudinary, GitHub Raw</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection