<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Studio Fotografi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --bg-dark: #0a0a0a;
            --bg-card: #141414;
            --bg-lighter: #1e1e1e;
            --accent: #c9a962;
            --accent-hover: #e0c17d;
            --text-white: #ffffff;
            --text-light: #b0b0b0;
            --text-muted: #707070;
            --border-color: #2a2a2a;
            --danger: #e74c3c;
        }

        body {
            background: var(--bg-dark);
            font-family: 'Montserrat', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-container {
            width: 100%;
            max-width: 420px;
        }

        .login-card {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            padding: 50px 40px;
        }

        .login-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .login-header .brand {
            font-family: 'Playfair Display', serif;
            font-size: 28px;
            color: var(--accent);
            margin-bottom: 10px;
            letter-spacing: 2px;
        }

        .login-header p {
            color: var(--text-muted);
            font-size: 13px;
            letter-spacing: 1px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--text-light);
            margin-bottom: 10px;
        }

        .form-group input {
            width: 100%;
            padding: 16px 20px;
            background: var(--bg-lighter);
            border: 1px solid var(--border-color);
            font-size: 14px;
            font-family: inherit;
            color: var(--text-white);
            transition: all 0.3s ease;
        }

        .form-group input:focus {
            outline: none;
            border-color: var(--accent);
            background: var(--bg-dark);
        }

        .form-group input::placeholder {
            color: var(--text-muted);
        }

        .form-check {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 25px;
        }

        .form-check input[type="checkbox"] {
            width: 18px;
            height: 18px;
            accent-color: var(--accent);
            cursor: pointer;
        }

        .form-check label {
            font-size: 13px;
            color: var(--text-light);
            cursor: pointer;
        }

        .btn-login {
            width: 100%;
            padding: 16px;
            background: var(--accent);
            color: var(--bg-dark);
            border: none;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-login:hover {
            background: var(--accent-hover);
            transform: translateY(-2px);
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 30px;
            color: var(--text-muted);
            font-size: 13px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .back-link:hover {
            color: var(--accent);
        }

        .back-link i {
            margin-right: 5px;
        }

        .alert {
            padding: 15px 20px;
            margin-bottom: 25px;
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-danger {
            background: rgba(231, 76, 60, 0.1);
            color: var(--danger);
            border: 1px solid rgba(231, 76, 60, 0.3);
        }

        .alert-success {
            background: rgba(46, 204, 113, 0.1);
            color: #2ecc71;
            border: 1px solid rgba(46, 204, 113, 0.3);
        }

        /* Decorative elements */
        .login-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--accent);
        }

        .login-card {
            position: relative;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <div class="brand">ADMIN</div>
                <p>Masuk ke Dashboard</p>
            </div>

            @if($errors->any())
                <div class="alert alert-danger">
                    <i class="bi bi-exclamation-circle"></i>
                    {{ $errors->first() }}
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success">
                    <i class="bi bi-check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" 
                           placeholder="Masukkan email admin" 
                           value="{{ old('email') }}" required autofocus>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" 
                           placeholder="Masukkan password" required>
                </div>

                <div class="form-check">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Ingat saya</label>
                </div>

                <button type="submit" class="btn-login">
                    <i class="bi bi-box-arrow-in-right"></i>
                    Masuk
                </button>
            </form>

            <a href="{{ route('home') }}" class="back-link">
                <i class="bi bi-arrow-left"></i> Kembali ke Website
            </a>
        </div>
    </div>
</body>
</html>
