@extends('layouts.admin')

@section('title', 'Daftar Portfolio')

@section('content')
<div class="page-header mb-4">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2><i class="bi bi-briefcase"></i> Portfolio</h2>
            <p class="text-muted mb-0">Kelola dan atur semua portfolio Anda</p>
        </div>
        <a href="{{ route('portfolios.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Portfolio
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">

        @if($portfolios->count())
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th width="60">No</th>
                            <th width="120">Gambar</th>
                            <th>Deskripsi</th>
                            <th class="text-center" width="180">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($portfolios as $portfolio)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            {{-- GAMBAR --}}
                            <td>
                                <img
                                    src="{{ $portfolio->image }}"
                                    alt="Portfolio Image"
                                    class="img-thumbnail"
                                    style="width:80px;height:80px;object-fit:cover;"
                                >
                            </td>

                            {{-- DESKRIPSI --}}
                            <td>
                                <small class="text-muted">
                                    {{ Str::limit($portfolio->description, 70) }}
                                </small>
                            </td>

                            {{-- AKSI --}}
                            <td class="text-center">
                                <a href="{{ route('portfolios.show', $portfolio->id) }}"
                                   class="btn btn-sm btn-info"
                                   title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>

                                <a href="{{ route('portfolios.edit', $portfolio->id) }}"
                                   class="btn btn-sm btn-warning"
                                   title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                <form action="{{ route('portfolios.destroy', $portfolio->id) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Yakin ingin menghapus portfolio ini?')">
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
                <i class="bi bi-inbox fs-1 text-muted"></i>
                <p class="mt-3 text-muted">Belum ada data portfolio</p>
                <a href="{{ route('portfolios.create') }}" class="btn btn-primary">
                    Tambah Portfolio Pertama
                </a>
            </div>
        @endif

    </div>
</div>
@endsection