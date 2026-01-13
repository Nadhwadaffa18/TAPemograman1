<header class="navbar">
    <div class="container nav-wrap">
        <div class="brand">Situs Fotografi</div>

       <nav class="menu">
            <a class="{{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">BERANDA</a>
            <a href="{{ url('/tentang') }}">TENTANG</a>
            <a href="{{ url('/layanan') }}">LAYANAN</a>
            <a href="{{ url('/portofolio') }}">PORTOFOLIO</a>
            <a href="{{ url('/kontak') }}">KONTAK</a>
        </nav>

    </div>
</header>
