<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #4f46e5;
            --primary-dark: #4338ca;
            --primary-light: #6366f1;
            --secondary: #10b981;
            --danger: #ef4444;
            --warning: #f59e0b;
            --info: #3b82f6;
            --light-bg: #f9fafb;
            --border-color: #e5e7eb;
            --text-dark: #1f2937;
            --text-light: #6b7280;
        }

        body {
            background-color: var(--light-bg);
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            color: var(--text-dark);
            min-height: 100vh;
        }

        .wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Styling */
        .sidebar {
            width: 260px;
            background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 100%);
            color: white;
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            padding: 0;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
            z-index: 1000;
        }

        .sidebar-brand {
            padding: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
            font-size: 20px;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .sidebar-brand i {
            margin-right: 8px;
        }

        .sidebar .nav {
            padding: 20px 0;
        }

        .sidebar .nav-item {
            margin: 0;
        }

        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 14px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
            margin: 0;
            font-size: 15px;
        }

        .sidebar .nav-link i {
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .sidebar .nav-link:hover {
            color: white;
            background-color: rgba(255, 255, 255, 0.1);
            border-left-color: white;
        }

        .sidebar .nav-link.active {
            color: white;
            background-color: rgba(255, 255, 255, 0.15);
            border-left-color: white;
            font-weight: 600;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 260px;
            padding: 30px;
        }

        .page-header {
            margin-bottom: 30px;
        }

        .page-header h2 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
            color: var(--text-dark);
        }

        .page-header p {
            color: var(--text-light);
            font-size: 14px;
        }

        /* Cards */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
            margin-bottom: 20px;
        }

        .card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: transparent;
            border-bottom: 1px solid var(--border-color);
            padding: 20px;
            font-weight: 600;
        }

        .card-body {
            padding: 25px;
        }

        /* Buttons */
        .btn {
            border-radius: 8px;
            padding: 10px 16px;
            font-weight: 500;
            font-size: 14px;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-primary {
            background-color: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
        }

        .btn-secondary {
            background-color: #6b7280;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #4b5563;
            color: white;
        }

        .btn-warning {
            background-color: var(--warning);
            color: white;
        }

        .btn-warning:hover {
            background-color: #d97706;
            color: white;
        }

        .btn-danger {
            background-color: var(--danger);
            color: white;
        }

        .btn-danger:hover {
            background-color: #dc2626;
            color: white;
        }

        .btn-info {
            background-color: var(--info);
            color: white;
        }

        .btn-info:hover {
            background-color: #2563eb;
            color: white;
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 13px;
        }

        /* Alerts */
        .alert {
            border-radius: 10px;
            border: 1px solid transparent;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .alert-success {
            background-color: #ecfdf5;
            color: #065f46;
            border-color: #a7f3d0;
        }

        .alert-danger {
            background-color: #fef2f2;
            color: #7f1d1d;
            border-color: #fecaca;
        }

        .alert-warning {
            background-color: #fffbeb;
            color: #78350f;
            border-color: #fde68a;
        }

        .alert-info {
            background-color: #eff6ff;
            color: #0c2d6b;
            border-color: #bfdbfe;
        }

        .alert h6 {
            font-weight: 600;
            margin-bottom: 8px;
        }

        /* Tables */
        .table {
            font-size: 14px;
            margin-bottom: 0;
        }

        .table thead {
            background-color: #f3f4f6;
        }

        .table thead th {
            border-color: var(--border-color);
            font-weight: 600;
            color: var(--text-dark);
            padding: 12px 15px;
        }

        .table tbody td {
            border-color: var(--border-color);
            padding: 12px 15px;
            vertical-align: middle;
        }

        .table tbody tr:hover {
            background-color: #f9fafb;
        }

        .img-thumbnail {
            border-radius: 8px;
            border: 1px solid var(--border-color);
        }

        /* Badges */
        .badge {
            padding: 4px 10px;
            border-radius: 6px;
            font-weight: 500;
            font-size: 12px;
        }

        /* Form Elements */
        .form-control,
        .form-select {
            border-radius: 8px;
            border: 1px solid var(--border-color);
            padding: 10px 12px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        .form-label {
            font-weight: 500;
            color: var(--text-dark);
            margin-bottom: 8px;
            font-size: 14px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
                margin-bottom: 0;
            }

            .main-content {
                margin-left: 0;
                padding: 20px;
            }

            .page-header h2 {
                font-size: 24px;
            }

            .card-body {
                padding: 15px;
            }

            .table {
                font-size: 12px;
            }

            .table thead th,
            .table tbody td {
                padding: 8px 10px;
            }
        }

        /* Scrollbar Styling */
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 3px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.5);
        }
    </style>
    @yield('styles')
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <nav class="sidebar">
            <div class="sidebar-brand">
                <i class="bi bi-speedometer2"></i> Admin
            </div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link @if(Route::currentRouteName() === 'portfolios.index') active @endif" 
                       href="{{ route('portfolios.index') }}">
                        <i class="bi bi-briefcase"></i>
                        <span>Portfolio</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="bi bi-house"></i>
                        <span>Kembali ke Home</span>
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Main Content -->
        <main class="main-content">
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <h6><i class="bi bi-exclamation-circle"></i> Terjadi Kesalahan!</h6>
                    <ul class="mb-0" style="padding-left: 20px;">
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