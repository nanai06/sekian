<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AYU-NE — Eco Beauty Circular Platform</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #FFBBC0;
            --primary-dark: #E8A0A5;
            --primary-deeper: #b85c65;
            --bg: #FFFFFF;
            --surface: #FFF8F8;
            --text: #5D393B;
            --text-secondary: #9E7178;
            --border: #F0D5D8;
            --success: #4CAF7D;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Poppins', sans-serif;
            background: var(--bg);
            color: var(--text);
            overflow-x: hidden;
        }
        a { text-decoration: none; color: inherit; }

        .logo-img { height: 36px; width: auto; object-fit: contain; }
        .logo-img-sm { height: 28px; width: auto; object-fit: contain; }

        /* ── NAVBAR ── */
        nav {
            background: #FFFFFF;
            background-image: url("{{ asset('images/frame 310(2).png') }}");
            backdrop-filter: blur(1000px);
            background-size: cover;
            position: sticky; top: 0; z-index: 100;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
        }
        .nav-top {
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 50px; height: 75px;
        }
        .nav-left { display: flex; align-items: center; gap: 32px; }
        .nav-center { position: absolute; left: 50%; transform: translateX(-50%); }
        .nav-links { display: flex; gap: 28px; list-style: none; }
        .nav-links a {
            font-size: 13px; font-weight: 500; color: var(--text-secondary);
            letter-spacing: 0.3px; transition: color 0.2s; padding: 4px 0;
            border-bottom: 1.5px solid transparent;
        }
        .nav-links a:hover { color: var(--text); border-bottom-color: var(--primary); }
        .nav-right { display: flex; align-items: center; gap: 12px; }
        .btn-login {
            font-size: 13px; font-weight: 600; color: var(--text);
            border: 1.5px solid var(--border); padding: 7px 20px;
            border-radius: 100px; cursor: pointer; transition: all 0.2s;
            background: white; font-family: 'Poppins', sans-serif;
        }
        .btn-login:hover { border-color: var(--primary); background: var(--surface); }
        .btn-register {
            font-size: 13px; font-weight: 600; color: white;
            background: var(--primary-deeper); border: none;
            padding: 8px 20px; border-radius: 100px;
            cursor: pointer; transition: all 0.2s;
            font-family: 'Poppins', sans-serif;
        }
        .btn-register:hover { background: var(--text); }

        /* ── FOOTER ── */
        footer {
            background: var(--surface);
            border-top: 1px solid var(--border);
            
        }
        .footer-inner {
            display: grid; grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 48px; padding: 60px 48px 40px;
        }
        .footer-brand .f-logo {
            font-size: 22px; font-weight: 800; font-style: italic;
            color: var(--surface); margin-bottom: 12px;
        }
        .footer-brand .f-logo span { 
            color: var(--primary-deeper); 
        }
        .footer-brand p {
            font-size: 13px; color: var(--text-secondary);
            line-height: 1.7; max-width: 280px;
        }
        .footer-col h4 {
            font-size: 12px; font-weight: 700; letter-spacing: 1.5px;
            text-transform: uppercase; color: var(--text);
            margin-bottom: 16px;
        }
        .footer-col ul { list-style: none; }
        .footer-col li { margin-bottom: 10px; }
        .footer-col a {
            font-size: 13px; color: var(--text-secondary); transition: color 0.2s;
        }
        .footer-col a:hover { color: var(---text); }
        .footer-col p {
            font-size: 13px; color: var(---text-secondary); line-height: 1.8;
        }
        .footer-bottom {
            border-top: 1px solid var(--border);
            padding: 20px 48px; display: flex;
            justify-content: space-between; align-items: center;
            font-size: 12px; color: var(--text-secondary);
        }
        .payment-icons { display: flex; gap: 8px; align-items: center; }
        .pay-badge {
            background: white; border: 1px solid var(--border);
            border-radius: 6px; padding: 4px 8px; font-size: 10px;
            font-weight: 700; color: var(--text);
        }

        /* ── MAIN CONTENT ── */
        main { min-height: 60vh; }
    </style>

    @stack('styles')
</head>
<body>

    {{-- NAVBAR --}}
    <nav>
        <div class="nav-top">
            {{-- Logo kiri --}}
            <div class="nav-left">
                <a href="{{ route('landing') }}">
                    <img src="{{ asset('images/AYU-NE.png') }}" alt="AYU-NE" class="logo-img">
                </a>
            </div>

            {{-- Menu tengah --}}
            <div class="nav-center">
                <ul class="nav-links">
                    <li><a href="{{ route('landing') }}">Home</a></li>
                    <li><a href="{{ route('produk.index') }}">Belanja</a></li>
                    <li><a href="{{ route('lokasi-dropoff.index') }}">Daur Ulang</a></li>
                </ul>
            </div>

            {{-- Tombol kanan --}}
            <div class="nav-right">
                @guest
                    <a href="{{ route('login') }}" class="btn-login">Masuk</a>
                    <a href="{{ route('register') }}" class="btn-register">Daftar</a>
                @endguest
                @auth
                    <a href="{{ route('dashboard') }}" class="btn-register">Dashboard</a>
                @endauth
            </div>
        </div>
    </nav>

    {{-- KONTEN HALAMAN --}}
    <main>
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer>
        <div class="footer-inner">
            <div class="footer-brand">
                <div class="f-logo">
                    <img src="{{ asset('images/AYU-NE.png') }}" alt="AYU-NE" class="logo-img-sm">
                </div>
                <p>Platform eco-beauty sirkular pertama di Indonesia. Belanja preloved, daur ulang kemasan, dan raih reward — semuanya dalam satu ekosistem.</p>
            </div>
            <div class="footer-col">
                <h4>Belanja</h4>
                <ul>
                    <li><a href="#">Skincare</a></li>
                    <li><a href="#">Makeup</a></li>
                    <li><a href="#">Alat Makeup</a></li>
                    <li><a href="#">Isi Ulang</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Informasi</h4>
                <ul>
                    <li><a href="#">Tentang AYU-NE</a></li>
                    <li><a href="#">Cara Daur Ulang</a></li>
                    <li><a href="#">Ayu Koin</a></li>
                    <li><a href="#">Kebijakan Privasi</a></li>
                    <li><a href="#">FAQ</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Bantuan</h4>
                <ul>
                    <li><a href="#">Hubungi Kami</a></li>
                    <li><a href="#">Cara Pembelian</a></li>
                    <li><a href="#">Pengiriman</a></li>
                    <li><a href="#">Retur & Tukar</a></li>
                    <li><a href="#">Titik Drop-Off</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <span>© 2025 AYU-NE. Eco-beauty untuk bumi yang lebih sehat 🌿</span>
            <div class="payment-icons">
                <span class="pay-badge">VISA</span>
                <span class="pay-badge">GoPay</span>
                <span class="pay-badge">OVO</span>
                <span class="pay-badge">QRIS</span>
                <span class="pay-badge">BCA</span>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>