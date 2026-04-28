<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - AYU-NE</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }

        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #fce4ec 0%, #fff0f3 50%, #fef9f0 100%);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card {
            background: white;
            border-radius: 24px;
            padding: 40px 36px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 4px 30px rgba(0,0,0,0.06);
        }

        .logo {
            height: 36px;
            width: auto;
            object-fit: contain;
            margin: 0 auto 20px auto;
            display: block;
        }

        h1 {
            text-align: center;
            font-size: 22px;
            font-weight: 700;
            color: #3b1a1a;
            margin-bottom: 6px;
        }

        .subtitle {
            text-align: center;
            font-size: 13px;
            color: #b07070;
            margin-bottom: 28px;
        }

        label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #3b1a1a;
            margin-bottom: 7px;
        }

        .input-wrapper {
            position: relative;
            margin-bottom: 18px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 13px 16px;
            border: 1.5px solid #f0d5d5;
            border-radius: 12px;
            font-size: 13px;
            color: #3b1a1a;
            background: #fff;
            outline: none;
            transition: border 0.2s;
            font-family: 'Poppins', sans-serif;
        }

        input::placeholder { color: #d4a0a0; }
        input:focus { border-color: #e8a0a8; }

        .eye-icon {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            background: none;
            border: none;
            padding: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #eyeWrap {
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            transform-origin: center 11px;
        }

        .remember-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
        }

        .remember-row label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            font-weight: 500;
            color: #9a6a6a;
            margin-bottom: 0;
            cursor: pointer;
        }

        .remember-row input[type="checkbox"] {
            width: 16px;
            height: 16px;
            accent-color: #e07080;
            cursor: pointer;
        }

        .forgot-link {
            font-size: 12px;
            color: #e07080;
            text-decoration: none;
            font-weight: 600;
        }

        .forgot-link:hover { color: #c85060; }

        .btn-main {
            width: 100%;
            padding: 14px;
            background: #f4a0aa;
            color: white;
            font-size: 15px;
            font-weight: 700;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            transition: background 0.2s;
            font-family: 'Poppins', sans-serif;
        }

        .btn-main:hover { background: #e8858f; }

        .register-text {
            text-align: center;
            font-size: 13px;
            color: #b07070;
            margin-top: 16px;
        }

        .register-text a {
            color: #e07080;
            font-weight: 700;
            text-decoration: none;
        }

        .error-message {
            background: #ffe0e3;
            color: #c0404a;
            border-radius: 10px;
            padding: 10px 14px;
            font-size: 12px;
            margin-bottom: 16px;
        }

        .success-message {
            background: #e8f5e9;
            color: #2e7d32;
            border-radius: 10px;
            padding: 10px 14px;
            font-size: 12px;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
    </style>
</head>
<body>
<div class="card">

    <img src="{{ asset('images/AYU-NE.png') }}" alt="AYU-NE" class="logo">

    <h1>Selamat Datang!</h1>
    <p class="subtitle">Masuk ke akun AYU-NE kamu</p>

    {{-- Pesan sukses setelah register --}}
    @if(session('success'))
        <div class="success-message">
            ✅ {{ session('success') }}
        </div>
    @endif

    {{-- Pesan error validasi --}}
    @if($errors->any())
        <div class="error-message">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <label for="email">Email</label>
        <div class="input-wrapper">
            <input type="email" id="email" name="email" placeholder="nama@email.com" value="{{ old('email') }}" required autofocus>
        </div>

        <label for="password">Password</label>
        <div class="input-wrapper">
            <input type="password" id="password" name="password" placeholder="Masukkan password" required>
            <button type="button" class="eye-icon" onclick="togglePass()">
                <span id="eyeWrap">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                        <path id="eyePath" fill="#c9a0a0" d="M4.851 5.567L3.437 4.153L4.15 3.44l16.97 16.97l-.713.713l-2.388-2.388A10.45 10.45 0 0 1 12 19c-3.53 0-6.539-2.005-9.5-6.243a1.5 1.5 0 0 1 0-1.516a17.7 17.7 0 0 1 2.35-2.674m10.26 10.26l-1.607-1.606A3 3 0 0 1 9.111 10.13L7.647 8.666A5 5 0 0 0 12 17a4.98 4.98 0 0 0 3.11-1.173M12 5c3.53 0 6.539 2.005 9.5 6.241a1.5 1.5 0 0 1 0 1.516a17.8 17.8 0 0 1-1.9 2.348l-1.42-1.42a15.8 15.8 0 0 0 1.62-1.986C17.197 8.548 14.806 7 12 7a7.7 7.7 0 0 0-2.635.47l-1.534-1.535A10.2 10.2 0 0 1 12 5m-3.053 4.053l1.485 1.486a3 3 0 0 1 3.98 3.98l1.485 1.484A5 5 0 0 0 9 12c0-.829.207-1.61.571-2.294z"/>
                    </svg>
                </span>
            </button>
        </div>

        <div class="remember-row">
            <label>
                <input type="checkbox" name="remember"> Ingat saya
            </label>
            <a href="{{ route('password.request') }}" class="forgot-link">Lupa Password?</a>
        </div>

        <button type="submit" class="btn-main">Masuk</button>
    </form>

    <p class="register-text">Belum punya akun? <a href="{{ route('register') }}">Daftar</a></p>

</div>

<script>
    const iconOpen   = "M12 4.998c-3.53 0-6.539 2.005-9.5 6.243a1.5 1.5 0 0 0 0 1.516C5.461 17 8.47 19.004 12 19.004s6.539-2.005 9.5-6.243a1.5 1.5 0 0 0 0-1.516C18.539 7.003 15.53 4.998 12 4.998m0 10.006a3 3 0 1 1 0-6 3 3 0 0 1 0 6";
    const iconClosed = "M4.851 5.567L3.437 4.153L4.15 3.44l16.97 16.97l-.713.713l-2.388-2.388A10.45 10.45 0 0 1 12 19c-3.53 0-6.539-2.005-9.5-6.243a1.5 1.5 0 0 1 0-1.516a17.7 17.7 0 0 1 2.35-2.674m10.26 10.26l-1.607-1.606A3 3 0 0 1 9.111 10.13L7.647 8.666A5 5 0 0 0 12 17a4.98 4.98 0 0 0 3.11-1.173M12 5c3.53 0 6.539 2.005 9.5 6.241a1.5 1.5 0 0 1 0 1.516a17.8 17.8 0 0 1-1.9 2.348l-1.42-1.42a15.8 15.8 0 0 0 1.62-1.986C17.197 8.548 14.806 7 12 7a7.7 7.7 0 0 0-2.635.47l-1.534-1.535A10.2 10.2 0 0 1 12 5m-3.053 4.053l1.485 1.486a3 3 0 0 1 3.98 3.98l1.485 1.484A5 5 0 0 0 9 12c0-.829.207-1.61.571-2.294z";
    let isAnimating = false;

    function togglePass() {
        if (isAnimating) return;
        isAnimating = true;

        const wrap  = document.getElementById('eyeWrap');
        const path  = document.getElementById('eyePath');
        const input = document.getElementById('password');

        wrap.style.transform = 'scaleY(0.08)';
        setTimeout(() => {
            const isNowText = input.type === 'password';
            input.type = isNowText ? 'text' : 'password';
            path.setAttribute('d', isNowText ? iconOpen : iconClosed);
            wrap.style.transform = 'scaleY(1)';
            setTimeout(() => { isAnimating = false; }, 250);
        }, 250);
    }
</script>
</body>
</html>