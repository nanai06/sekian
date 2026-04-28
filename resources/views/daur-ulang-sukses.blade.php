<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daur Ulang Berhasil - AYU-NE</title>

    {{-- Google Fonts: font Poppins --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        /* Reset semua margin/padding bawaan browser */
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }

        /* Background halaman: GIF animasi sukses dari folder public/images/
           min-height 100vh + flex column agar card bisa center vertikal */
        body {
            background: url('/images/Success.gif') center center / cover no-repeat fixed;
            color: #3b1a1a;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Wrapper halaman: membatasi lebar max 600px dan center horizontal */
        .page-wrap {
            width: 100%;
            max-width: 600px;
            margin: auto; /* auto atas-bawah + kiri-kanan → center di tengah layar */
            padding: 48px 0;
            text-align: center;
        }

        /* Card putih utama berisi semua konten sukses */
        .card {
            width: 100%;
            background: white;
            border-radius: 24px;
            padding: 40px 40px;
            box-shadow: 0 16px 48px rgba(174, 90, 103, 0.54);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px; /* jarak antar elemen dalam card */
        }

        /* ==========================================
           FLOWER BADGE (ANIMASI)
           SVG bunga hijau dengan centang di tengah
           Animasi popIn: muncul dari kecil ke besar sambil rotate
           ========================================== */
        .flower-wrap {
            animation: popIn 0.55s cubic-bezier(0.175, 0.885, 0.32, 1.275) both;
        }

        /* Animasi muncul: scale 0 → 1, rotate -15deg → 0deg */
        @keyframes popIn {
            0%   { transform: scale(0) rotate(-15deg); opacity: 0; }
            100% { transform: scale(1) rotate(0deg);   opacity: 1; }
        }

        /* Animasi centang: stroke-dashoffset 30 → 0 (seperti digambar pelan-pelan)
           Dimulai 0.55s setelah bunga muncul */
        .check-path {
            stroke-dasharray: 30;
            stroke-dashoffset: 30;
            animation: draw 0.5s 0.55s ease forwards;
        }

        @keyframes draw {
            to { stroke-dashoffset: 0; }
        }

        h1 {
            font-size: 25px;
            font-weight: 500px;
            color: #3b1a1a;
        }

        .subtitle {
            font-size: 14px;
            color: #9a6a6a;
            margin-top: -8px;
        }

        /* ==========================================
           KOIN BADGE
           Menampilkan jumlah Ayu Koin yang didapat
           Nilai diambil dari session('koin') yang diset di Controller
           ========================================== */
        .koin-badge {
            display: flex;
            align-items: center;
            gap: 10px;
            border-radius: 50px;
            padding: 12px 28px;
        }

        .koin-icon { font-size: 24px; line-height: 1; }

        /* Teks jumlah koin: warna emas */
        .koin-text {
            font-size: 18px;
            font-weight: 700;
            color: #c8830a;
        }

        /* ==========================================
           TOMBOL AKSI
           2 tombol: Daur Ulang Lagi + Lihat Ayu Koin
           ========================================== */
        .btns {
            display: flex;
            gap: 12px;
            justify-content: center;
            width: 100%;
            margin: 8px auto 0;
        }

        /* Base style tombol */
        .btn {
            padding: 12px 32px;
            border-radius: 50px;
            min-width: 0;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
            text-decoration: none;
            text-align: center;
            transition: all 0.2s;
            display: block;
        }

        /* Tombol utama: solid pink gradient → redirect ke ayu-daur-ulang */
        .btn-primary {
            background: linear-gradient(135deg, #f4a0aa 0%, #e07080 100%);
            color: white;
            border: none;
            box-shadow: 0 4px 16px rgba(224,112,128,0.3);
        }

        .btn-primary:hover {
            box-shadow: 0 6px 20px rgba(224,112,128,0.45);
            transform: translateY(-1px);
        }

        /* Tombol sekunder: outline pink → redirect ke ayu-koin */
        .btn-secondary {
            background: white;
            color: #e07080;
            border: 2px solid #f4a0aa;
        }

        .btn-secondary:hover { background: #fff5f7; }
    </style>
</head>
<body>
    {{-- Navbar diambil dari file layouts/navigation.blade.php --}}
    @include('layouts.navigation')

    <div class="page-wrap">
        <div class="card">

            {{-- ==========================================
                 FLOWER SVG ANIMASI
                 Bunga hijau dengan efek glow + outline
                 Centang di tengah muncul dengan animasi "draw"
                 ========================================== --}}
            <div class="flower-wrap">
                <svg width="130" height="130" viewBox="-8 -8 68 68" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        {{-- Gradient radial glow hijau di belakang bunga --}}
                        <radialGradient id="glow" cx="50%" cy="50%" r="50%">
                            <stop offset="0%" stop-color="#a8dfc0" stop-opacity="0.5"/>
                            <stop offset="60%" stop-color="#4e9169" stop-opacity="0.3"/>
                            <stop offset="100%" stop-color="#8fdfb2af" stop-opacity="0"/>
                        </radialGradient>
                        {{-- Filter outline hijau tipis di sekitar bunga --}}
                        <filter id="outline" x="-10%" y="-10%" width="120%" height="120%">
                            <feMorphology in="SourceAlpha" operator="dilate" radius="0.3" result="expanded"/>
                            <feFlood flood-color="#64A663" result="color"/>
                            <feComposite in="color" in2="expanded" operator="in" result="outline"/>
                            <feMerge>
                                <feMergeNode in="outline"/>
                                <feMergeNode in="SourceGraphic"/>
                            </feMerge>
                        </filter>
                    </defs>

                    {{-- Lingkaran glow di belakang bunga --}}
                    <circle cx="26" cy="26" r="30" fill="url(#glow)"/>

                    {{-- Kelopak bunga: 8 ellipse + 1 lingkaran tengah, semua filter outline --}}
                    <g filter="url(#outline)">
                        <ellipse cx="26" cy="10" rx="7" ry="10" fill="#D0E5CF"/>
                        <ellipse cx="26" cy="42" rx="7" ry="10" fill="#D0E5CF"/>
                        <ellipse cx="10" cy="26" rx="10" ry="7" fill="#D0E5CF"/>
                        <ellipse cx="42" cy="26" rx="10" ry="7" fill="#D0E5CF"/>
                        <ellipse cx="15" cy="15" rx="7" ry="10" fill="#D0E5CF" transform="rotate(-45 15 15)"/>
                        <ellipse cx="37" cy="15" rx="7" ry="10" fill="#D0E5CF" transform="rotate(45 37 15)"/>
                        <ellipse cx="15" cy="37" rx="7" ry="10" fill="#D0E5CF" transform="rotate(45 15 37)"/>
                        <ellipse cx="37" cy="37" rx="7" ry="10" fill="#D0E5CF" transform="rotate(-45 37 37)"/>
                        <circle cx="26" cy="26" r="11" fill="#D0E5CF"/>
                    </g>

                    {{-- Centang di tengah bunga: animasi "draw" (digambar pelan) --}}
                    <path class="check-path" d="M20 26 L24 30 L32 20" stroke="#64A663" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>

            <h1>Daur Ulang Berhasil!</h1>
            <p class="subtitle">Terima kasih sudah peduli lingkungan 🌿</p>

            {{-- Badge koin: nilai diambil dari session('koin')
                 Session diset di RecyclingController@prosesQR
                 Default 10 kalau session kosong --}}
            <div class="koin-badge">
                <span class="koin-icon">🪙</span>
                <span class="koin-text">+ {{ session('koin', 10) }} AK</span>
            </div>

            {{-- Dua tombol aksi setelah berhasil --}}
            <div class="btns">
                {{-- Tombol kiri: redirect ke halaman ayu-daur-ulang (daur ulang lagi) --}}
                <a href="{{ route('ayu-daur-ulang') }}" class="btn btn-primary">Daur Ulang Lagi</a>
                {{-- Tombol kanan: redirect ke halaman ayu-koin (lihat saldo koin) --}}
                <a href="{{ route('ayu-koin') }}" class="btn btn-secondary">Lihat Ayu Koin Saya</a>
            </div>

        </div>
    </div>
</body>
</html>