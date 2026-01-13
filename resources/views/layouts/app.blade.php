<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

@include('partials.navbar')

<main>
    <div class="container" style="max-width:1200px;margin:40px auto;padding:0 20px;">
        @if(session('success'))
            <div class="flash-success" style="background:#e6f6ea;border:1px solid #cfe9d6;padding:12px 18px;border-radius:8px;margin-bottom:18px;color:#226622;">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </div>
</main>

@include('partials.footer')

</body>
</html>
