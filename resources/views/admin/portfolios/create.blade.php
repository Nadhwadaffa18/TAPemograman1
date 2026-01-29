@extends('layouts.admin')

@section('title', 'Tambah Portfolio Baru')

@section('content')
<div class="page-header">
    <h2><i class="bi bi-plus-circle"></i> Tambah Portfolio Baru</h2>
    <p>Isi form di bawah untuk menambah portfolio baru</p>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('portfolios.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="image" class="form-label">
                            <i class="bi bi-image"></i> Link Gambar
                            <span class="text-danger">*</span>
                        </label>

                        <input type="url"
                               class="form-control @error('image') is-invalid @enderror"
                               id="image"
                               name="image"
                               placeholder="https://example.com/gambar.jpg"
                               value="{{ old('image') }}"
                               required>

                        <small class="text-muted d-block mt-2">
                            <i class="bi bi-info-circle"></i>
                            Gunakan URL gambar publik (Cloudinary, Imgur, GitHub Raw)
                        </small>

                        @error('image')
                            <div class="invalid-feedback d-block mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="description" class="form-label">
                            <i class="bi bi-file-text"></i> Deskripsi
                            <span class="text-danger">*</span>
                        </label>

                        <textarea class="form-control @error('description') is-invalid @enderror"
                                  id="description"
                                  name="description"
                                  rows="6"
                                  required>{{ old('description') }}</textarea>

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
                            <i class="bi bi-check-circle"></i> Simpan Portfolio
                        </button>
                        <a href="{{ route('portfolios.index') }}" class="btn btn-secondary">
                            <i class="bi bi-x-circle"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection