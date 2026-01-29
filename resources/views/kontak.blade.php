@extends('layouts.app')

@section('title', 'Kontak - Studio Fotografi')

@section('content')
<section class="contact">
    <div class="contact-wrapper">
        <div class="contact-info">
            <span class="section-subtitle">Hubungi Kami</span>
            <h1>Mari Bekerja Sama</h1>

            <p>
                Tertarik bekerja sama atau ingin melakukan sesi pemotretan?
                Silakan hubungi kami melalui form atau kontak di bawah ini.
            </p>

            <ul class="contact-list">
                <li>
                    <i class="bi bi-envelope"></i>
                    studio@email.com
                </li>
                <li>
                    <i class="bi bi-instagram"></i>
                    @studio
                </li>
                <li>
                    <i class="bi bi-geo-alt"></i>
                    Indonesia
                </li>
                <li>
                    <i class="bi bi-telephone"></i>
                    +62 812 3456 7890
                </li>
            </ul>
        </div>

        <form class="contact-form" action="{{ route('kontak.store') }}" method="POST">
            @csrf
            
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="bi bi-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            <div class="form-group">
                <label for="nama">Nama Lengkap</label>
                <input type="text" id="nama" name="nama" placeholder="Masukkan nama Anda" value="{{ old('nama') }}" required>
                @error('nama')<small style="color:#e17055;display:block;margin-top:5px;">{{ $message }}</small>@enderror
            </div>
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Masukkan email Anda" value="{{ old('email') }}" required>
                @error('email')<small style="color:#e17055;display:block;margin-top:5px;">{{ $message }}</small>@enderror
            </div>

            <div class="form-group">
                <label for="paket">Pilih Paket Layanan</label>
                <select id="paket" name="paket" required>
                    <option value="" disabled {{ !request('paket') && !old('paket') ? 'selected' : '' }}>-- Pilih Paket --</option>
                    @foreach($services as $service)
                    @php $slug = Str::slug($service->nama); @endphp
                    <option value="{{ $slug }}" {{ (request('paket') == $slug || old('paket') == $slug) ? 'selected' : '' }}>
                        {{ $service->nama }} - Rp {{ number_format($service->harga, 0, ',', '.') }}@if($service->satuan)/{{ $service->satuan }}@endif
                    </option>
                    @endforeach
                    <option value="custom" {{ (request('paket') == 'custom' || old('paket') == 'custom') ? 'selected' : '' }}>Paket Custom (Konsultasi)</option>
                </select>
                @error('paket')<small style="color:#e17055;display:block;margin-top:5px;">{{ $message }}</small>@enderror
            </div>
            
            <div class="form-group">
                <label for="pesan">Pesan</label>
                <textarea id="pesan" name="pesan" placeholder="Tulis pesan Anda di sini..." required>{{ old('pesan') }}</textarea>
                @error('pesan')<small style="color:#e17055;display:block;margin-top:5px;">{{ $message }}</small>@enderror
            </div>

            <button type="submit" class="btn-primary">
                <i class="bi bi-send"></i> Kirim Pesan
            </button>
        </form>
    </div>
</section>
@endsection
