<header class="navbar">
    <div class="nav-wrap">
        <a href="{{ route('home') }}" class="brand">Studio</a>

        <div class="menu-toggle">
            <span></span>
            <span></span>
            <span></span>
        </div>

        <nav class="menu">
            <a class="{{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Beranda</a>
            <a class="{{ request()->routeIs('tentang') ? 'active' : '' }}" href="{{ route('tentang') }}">Tentang</a>
            <a class="{{ request()->routeIs('layanan') ? 'active' : '' }}" href="{{ route('layanan') }}">Layanan</a>
            <a class="{{ request()->routeIs('portofolio') ? 'active' : '' }}" href="{{ route('portofolio') }}">Portofolio</a>
            <a class="{{ request()->routeIs('kontak') ? 'active' : '' }}" href="{{ route('kontak') }}">Kontak</a>
            @auth
                <a href="{{ route('portfolios.index') }}" class="admin-link"><i class="bi bi-speedometer2"></i> Admin</a>
            @else
                <a href="{{ route('login') }}" class="login-link"><i class="bi bi-box-arrow-in-right"></i> Login</a>
            @endauth
        </nav>
    </div>
</header>
