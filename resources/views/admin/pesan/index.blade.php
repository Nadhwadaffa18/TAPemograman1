@extends('layouts.admin')

@section('title', 'Daftar Pesan Masuk')

@section('content')
<div class="page-header mb-4">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2><i class="bi bi-envelope"></i> Pesan Masuk</h2>
            <p class="text-muted mb-0">Kelola semua pesan dari pengunjung</p>
        </div>
        <span class="badge bg-primary fs-6">
            {{ $pesans->count() }} Pesan
        </span>
    </div>
</div>

<div class="card">
    <div class="card-body">

        @if($pesans->count())
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th width="50">No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Paket</th>
                            <th>Pesan</th>
                            <th>Tanggal</th>
                            <th class="text-center" width="120">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pesans as $pesan)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <strong>{{ $pesan->nama }}</strong>
                            </td>
                            <td>
                                <a href="mailto:{{ $pesan->email }}">
                                    {{ $pesan->email }}
                                </a>
                            </td>
                            <td>
                                @if($pesan->paket)
                                    <span class="badge bg-success">{{ ucfirst(str_replace('-', ' ', $pesan->paket)) }}</span>
                                @else
                                    <small class="text-muted">-</small>
                                @endif
                            </td>
                            <td>
                                <small class="text-muted">
                                    {{ Str::limit($pesan->pesan, 50) }}
                                </small>
                            </td>
                            <td>
                                <small class="text-muted">
                                    {{ $pesan->created_at ? $pesan->created_at->format('d M Y H:i') : '-' }}
                                </small>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('pesan.show', $pesan->id) }}"
                                   class="btn btn-sm btn-info"
                                   title="Lihat Detail">
                                    <i class="bi bi-eye"></i>
                                </a>

                                <form action="{{ route('pesan.destroy', $pesan->id) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Yakin ingin menghapus pesan ini?')">
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
            <div class="text-center py-5">
                <i class="bi bi-envelope-open fs-1 text-muted"></i>
                <p class="mt-3 text-muted">Belum ada pesan masuk</p>
            </div>
        @endif

    </div>
</div>
@endsection
