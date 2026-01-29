<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --bg-dark: #0a0a0a;
            --bg-card: #141414;
            --bg-sidebar: #0d0d0d;
            --accent: #c9a962;
            --accent-hover: #e0c17d;
            --text-white: #ffffff;
            --text-light: #b0b0b0;
            --text-muted: #707070;
            --border-color: #2a2a2a;
            --danger: #ef4444;
            --success: #10b981;
            --warning: #f59e0b;
        }

        body {
            background-color: var(--bg-dark);
            font-family: 'Montserrat', sans-serif;
            color: var(--text-light);
            min-height: 100vh;
        }

        .wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 260px;
            background: var(--bg-sidebar);
            border-right: 1px solid var(--border-color);
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
            z-index: 1000;
        }

        .sidebar-brand {
            padding: 25px 20px;
            border-bottom: 1px solid var(--border-color);
            text-align: center;
        }

        .sidebar-brand h4 {
            color: var(--accent);
            font-weight: 700;
            margin: 0;
            font-size: 22px;
            letter-spacing: 1px;
        }

        .sidebar-brand small {
            color: var(--text-muted);
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .sidebar-nav {
            flex: 1;
            padding: 20px 0;
            overflow-y: auto;
        }

        .nav-section {
            padding: 0 15px;
            margin-bottom: 25px;
        }

        .nav-section-title {
            color: var(--text-muted);
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            padding: 10px 15px;
            margin-bottom: 5px;
        }

        .sidebar .nav-link {
            color: var(--text-light);
            padding: 12px 15px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-radius: 8px;
            margin: 2px 0;
            transition: all 0.3s ease;
            font-size: 14px;
        }

        .sidebar .nav-link i {
            width: 20px;
            font-size: 16px;
            color: var(--text-muted);
            transition: all 0.3s ease;
        }

        .sidebar .nav-link:hover {
            background: rgba(201, 169, 98, 0.1);
            color: var(--text-white);
        }

        .sidebar .nav-link:hover i {
            color: var(--accent);
        }

        .sidebar .nav-link.active {
            background: linear-gradient(135deg, var(--accent) 0%, #b8944d 100%);
            color: var(--bg-dark);
            font-weight: 600;
        }

        .sidebar .nav-link.active i {
            color: var(--bg-dark);
        }

        /* Sidebar Footer */
        .sidebar-footer {
            padding: 20px;
            border-top: 1px solid var(--border-color);
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 15px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            background: var(--accent);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--bg-dark);
            font-weight: 700;
        }

        .user-details h6 {
            margin: 0;
            color: var(--text-white);
            font-size: 14px;
        }

        .user-details small {
            color: var(--text-muted);
            font-size: 12px;
        }

        .btn-logout {
            width: 100%;
            background: transparent;
            border: 1px solid var(--border-color);
            color: var(--text-light);
            padding: 10px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.3s ease;
            font-size: 14px;
        }

        .btn-logout:hover {
            background: var(--danger);
            border-color: var(--danger);
            color: white;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 260px;
            padding: 30px;
            min-height: 100vh;
        }

        .page-header {
            margin-bottom: 30px;
        }

        .page-header h2 {
            font-size: 28px;
            font-weight: 700;
            color: var(--text-white);
            margin-bottom: 8px;
        }

        .page-header p {
            color: var(--text-muted);
            font-size: 14px;
        }

        /* Cards */
        .card {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            margin-bottom: 20px;
        }

        .card-header {
            background: transparent;
            border-bottom: 1px solid var(--border-color);
            padding: 20px;
            color: var(--text-white);
            font-weight: 600;
        }

        .card-body {
            padding: 25px;
        }

        /* Buttons */
        .btn-primary {
            background: linear-gradient(135deg, var(--accent) 0%, #b8944d 100%);
            border: none;
            color: var(--bg-dark);
            font-weight: 600;
            padding: 10px 20px;
            border-radius: 8px;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, var(--accent-hover) 0%, var(--accent) 100%);
            color: var(--bg-dark);
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            color: var(--text-light);
        }

        .btn-secondary:hover {
            background: var(--border-color);
            color: var(--text-white);
        }

        .btn-warning {
            background: var(--warning);
            border: none;
            color: var(--bg-dark);
        }

        .btn-danger {
            background: var(--danger);
            border: none;
            color: white;
        }

        .btn-success {
            background: var(--success);
            border: none;
            color: white;
        }

        /* Tables */
        .table {
            color: var(--text-light);
        }

        .table thead th {
            background: var(--bg-dark);
            color: var(--text-white);
            border-bottom: 1px solid var(--border-color);
            padding: 15px;
            font-weight: 600;
        }

        .table tbody td {
            padding: 15px;
            border-bottom: 1px solid var(--border-color);
            vertical-align: middle;
        }

        .table tbody tr:hover {
            background: rgba(201, 169, 98, 0.05);
        }

        /* Forms */
        .form-control, .form-select {
            background: var(--bg-dark);
            border: 1px solid var(--border-color);
            color: var(--text-white);
            padding: 12px 15px;
            border-radius: 8px;
        }

        .form-control:focus, .form-select:focus {
            background: var(--bg-dark);
            border-color: var(--accent);
            color: var(--text-white);
            box-shadow: 0 0 0 3px rgba(201, 169, 98, 0.1);
        }

        .form-control::placeholder {
            color: var(--text-muted);
        }

        .form-label {
            color: var(--text-white);
            font-weight: 500;
            margin-bottom: 8px;
        }

        /* Alerts */
        .alert {
            border: none;
            border-radius: 10px;
            padding: 15px 20px;
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
            border: 1px solid rgba(16, 185, 129, 0.2);
        }

        .alert-danger {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger);
            border: 1px solid rgba(239, 68, 68, 0.2);
        }

        /* Badge */
        .badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 500;
        }

        .badge-unread {
            background: var(--accent);
            color: var(--bg-dark);
        }

        .badge-read {
            background: var(--border-color);
            color: var(--text-light);
        }

        /* Portfolio Image */
        .portfolio-img {
            width: 80px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid var(--border-color);
        }

        /* Stats Card */
        .stats-card {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 20px;
            text-align: center;
        }

        .stats-card i {
            font-size: 32px;
            color: var(--accent);
            margin-bottom: 10px;
        }

        .stats-card h3 {
            color: var(--text-white);
            font-size: 28px;
            margin-bottom: 5px;
        }

        .stats-card p {
            color: var(--text-muted);
            margin: 0;
            font-size: 14px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
            .main-content {
                margin-left: 0;
            }
        }
    </style>
    @yield('styles')
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <nav class="sidebar">
            <div class="sidebar-brand">
                <h4><i class="bi bi-camera"></i> STUDIO</h4>
                <small>Admin Panel</small>
            </div>
            
            <div class="sidebar-nav">
                <div class="nav-section">
                    <div class="nav-section-title">Menu Utama</div>
                    <a class="nav-link {{ request()->routeIs('dashboard') || request()->routeIs('admin.dashboard') ? 'active' : '' }}" 
                       href="{{ route('dashboard') }}">
                        <i class="bi bi-speedometer2"></i>
                        <span>Dashboard</span>
                    </a>
                    <a class="nav-link {{ request()->routeIs('portfolios.*') ? 'active' : '' }}" 
                       href="{{ route('portfolios.index') }}">
                        <i class="bi bi-images"></i>
                        <span>Portfolio</span>
                    </a>
                    <a class="nav-link {{ request()->routeIs('services.*') ? 'active' : '' }}" 
                       href="{{ route('services.index') }}">
                        <i class="bi bi-gear"></i>
                        <span>Layanan & Harga</span>
                    </a>
                    <a class="nav-link {{ request()->routeIs('pesan.*') ? 'active' : '' }}" 
                       href="{{ route('pesan.index') }}">
                        <i class="bi bi-envelope"></i>
                        <span>Pesan Masuk</span>
                    </a>
                </div>

                <div class="nav-section">
                    <div class="nav-section-title">Lainnya</div>
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="bi bi-house"></i>
                        <span>Lihat Website</span>
                    </a>
                </div>
            </div>

            <div class="sidebar-footer">
                <div class="user-info">
                    <div class="user-avatar">
                        {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                    </div>
                    <div class="user-details">
                        <h6>{{ Auth::user()->name ?? 'Admin' }}</h6>
                        <small>Administrator</small>
                    </div>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-logout">
                        <i class="bi bi-box-arrow-left"></i>
                        Logout
                    </button>
                </form>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="main-content">
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-circle"></i> <strong>Terjadi Kesalahan!</strong>
                    <ul class="mb-0 mt-2">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
