@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="page-header">
    <h2><i class="bi bi-speedometer2"></i> Dashboard</h2>
    <p>Statistik pengunjung website Anda</p>
</div>

<!-- Stats Cards -->
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="stats-card">
            <i class="bi bi-people"></i>
            <h3>{{ number_format($totalVisitors) }}</h3>
            <p>Total Kunjungan</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stats-card">
            <i class="bi bi-calendar-day"></i>
            <h3>{{ number_format($todayVisitors) }}</h3>
            <p>Hari Ini</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stats-card">
            <i class="bi bi-calendar-week"></i>
            <h3>{{ number_format($weekVisitors) }}</h3>
            <p>Minggu Ini</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stats-card">
            <i class="bi bi-person-check"></i>
            <h3>{{ number_format($uniqueVisitors) }}</h3>
            <p>Pengunjung Unik</p>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Top Pages -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-bar-chart"></i> Halaman Terpopuler
            </div>
            <div class="card-body">
                @if($topPages->count() > 0)
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Halaman</th>
                                <th>Kunjungan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($topPages as $page)
                            <tr>
                                <td>/{{ $page->page_visited }}</td>
                                <td><span class="badge bg-primary">{{ $page->visits }}</span></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <p class="text-muted text-center py-4">Belum ada data kunjungan</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Device & Browser Stats -->
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header">
                <i class="bi bi-phone"></i> Perangkat
            </div>
            <div class="card-body">
                @if($devices->count() > 0)
                <div class="device-stats">
                    @foreach($devices as $device)
                    <div class="device-item d-flex justify-content-between align-items-center mb-3">
                        <span>
                            @if($device->device == 'Mobile')
                                <i class="bi bi-phone"></i>
                            @elseif($device->device == 'Tablet')
                                <i class="bi bi-tablet"></i>
                            @else
                                <i class="bi bi-laptop"></i>
                            @endif
                            {{ $device->device }}
                        </span>
                        <span class="badge bg-secondary">{{ $device->count }}</span>
                    </div>
                    @endforeach
                </div>
                @else
                <p class="text-muted text-center py-4">Belum ada data</p>
                @endif
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <i class="bi bi-globe"></i> Browser
            </div>
            <div class="card-body">
                @if($browsers->count() > 0)
                <div class="browser-stats">
                    @foreach($browsers as $browser)
                    <div class="browser-item d-flex justify-content-between align-items-center mb-3">
                        <span>
                            @if($browser->browser == 'Chrome')
                                <i class="bi bi-browser-chrome"></i>
                            @elseif($browser->browser == 'Firefox')
                                <i class="bi bi-browser-firefox"></i>
                            @elseif($browser->browser == 'Safari')
                                <i class="bi bi-browser-safari"></i>
                            @elseif($browser->browser == 'Edge')
                                <i class="bi bi-browser-edge"></i>
                            @else
                                <i class="bi bi-globe"></i>
                            @endif
                            {{ $browser->browser }}
                        </span>
                        <span class="badge bg-secondary">{{ $browser->count }}</span>
                    </div>
                    @endforeach
                </div>
                @else
                <p class="text-muted text-center py-4">Belum ada data</p>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Recent Visitors -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-clock-history"></i> Pengunjung Terbaru
            </div>
            <div class="card-body">
                @if($recentVisitors->count() > 0)
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Waktu</th>
                                <th>IP Address</th>
                                <th>Halaman</th>
                                <th>Perangkat</th>
                                <th>Browser</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentVisitors as $visitor)
                            <tr>
                                <td>{{ $visitor->visited_at->diffForHumans() }}</td>
                                <td><code>{{ $visitor->ip_address }}</code></td>
                                <td>/{{ $visitor->page_visited }}</td>
                                <td>
                                    @if($visitor->device == 'Mobile')
                                        <i class="bi bi-phone"></i>
                                    @elseif($visitor->device == 'Tablet')
                                        <i class="bi bi-tablet"></i>
                                    @else
                                        <i class="bi bi-laptop"></i>
                                    @endif
                                    {{ $visitor->device }}
                                </td>
                                <td>{{ $visitor->browser }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <p class="text-muted text-center py-4">Belum ada pengunjung tercatat</p>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection

@section('styles')
<style>
    .stats-card {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 25px;
        text-align: center;
        transition: all 0.3s ease;
    }
    
    .stats-card:hover {
        transform: translateY(-5px);
        border-color: var(--accent);
    }
    
    .stats-card i {
        font-size: 36px;
        color: var(--accent);
        margin-bottom: 15px;
    }
    
    .stats-card h3 {
        color: var(--text-white);
        font-size: 32px;
        font-weight: 700;
        margin-bottom: 5px;
    }
    
    .stats-card p {
        color: var(--text-muted);
        margin: 0;
        font-size: 14px;
    }

    .device-item, .browser-item {
        color: #ffffff;
    }

    .device-item i, .browser-item i {
        margin-right: 8px;
        color: var(--accent);
    }

    .device-item span, .browser-item span {
        color: #ffffff;
    }

    code {
        background: var(--bg-dark);
        padding: 2px 8px;
        border-radius: 4px;
        color: var(--accent);
    }

    .badge.bg-primary {
        background: var(--accent) !important;
        color: var(--bg-dark);
    }

    .badge.bg-secondary {
        background: var(--border-color) !important;
        color: #ffffff !important;
    }
</style>
@endsection
