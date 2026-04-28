<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Iconify: library ikon yang dipake di seluruh halaman --}}
    <script src="https://code.iconify.design/iconify-icon/2.1.0/iconify-icon.min.js"></script>

    <title>Dashboard - AYU-NE</title>

    {{-- Google Fonts: font Poppins dengan berbagai ukuran --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        /* ==========================================
           ROOT VARIABLES
           Warna-warna utama yang dipake di seluruh halaman,
           cukup ganti di sini kalau mau ganti tema warna
           ========================================== */
        :root {
            --surface: #FFF8F8;        /* warna background card/surface */
            --border: #F0D5D8;         /* warna border */
            --text: #5D393B;           /* warna teks utama */
            --text-secondary: #9E7178; /* warna teks sekunder/abu */
            --primary-deeper: #b85c65; /* warna pink gelap untuk aksen */
        }

        /* Reset semua margin/padding bawaan browser */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        /* Background halaman: gradient pink muda */
        body {
            background: linear-gradient(180deg, #ffe8ed 0%, #fff5f5 50%, #ffe8ed 100%);
            color: #3b1a1a;
        }

        /* ==========================================
           BANNER SLIDER
           Wrapper utama banner di bagian atas halaman
           ========================================== */
        .banner-section {
            position: relative;
            padding: 24px 40px 0 40px;
        }

        /* Box banner: overflow hidden biar slide ga keliatan di luar area */
        .banner-wrapper {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            height: 260px; /* tinggi banner, wajib ada agar slider berfungsi */
        }

        /* Track yang bergeser kiri-kanan saat slide berpindah */
        .banner-slides-track {
            display: flex;
            height: 100%;
            transition: transform 0.6s cubic-bezier(.77,0,.175,1); /* animasi geser halus */
        }

        /* Tiap slide banner: gambar background cover */
        .banner-slide {
            min-width: 100%; /* setiap slide selebar container */
            height: 100%;
            background-size: cover;
            background-position: center;
        }

        .banner-slide.active {
            display: flex;
        }

        .banner-slide h2 {
            font-size: 32px;
            font-weight: 800;
            color: white;
            margin-bottom: 12px;
        }

        .banner-slide p {
            font-size: 15px;
            color: rgba(255,255,255,0.9);
        }

        /* Tombol panah kiri/kanan di atas banner */
        .banner-arrow {
            position: absolute; top: 50%; transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            z-index: 10;
            transition: all 0.2s;
            padding: 0;
        }
        .banner-arrow:hover { transform: translateY(-50%) scale(1.1); }
        .banner-arrow.left { left: 16px; }
        .banner-arrow.right { right: 16px; }

        /* Dot navigasi banner di bagian bawah tengah */
        .banner-dots {
            position: absolute;
            bottom: 16px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 8px;
        }

        /* Tiap dot: bulat kecil, aktif jadi lebih lebar */
        .banner-dot {
            width: 8px;
            height: 8px;
            border-radius: 10px;
            background: rgba(255,255,255,0.5);
            cursor: pointer;
            transition: background 0.3s;
        }

        .banner-dot.active {
            background: #895353;
            width: 24px; /* dot aktif jadi lonjong */
        }

        /* ==========================================
           INFO BAR
           Baris berisi kartu Ayu Koin + shortcut menu
           ========================================== */
        .info-bar {
            display: flex;
            gap: 20px;
            padding: 20px 48px;
            align-items: stretch;
        }

        /* Kartu saldo Ayu Koin user */
        .koin-card {
            background: linear-gradient(135deg, #ffe8ed 0%, #f5a5b6 50%, #ffdde4 100%);
            width : 250px;
            border: 1px solid #F0D5D8;
            border-radius: 16px;
            padding: 20px 28px;
            text-align: center;
            box-shadow: 0 2px 12px rgba(184,92,101,0.08);
            min-width: 160px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 4px;
            border: 0.5px solid #b85c65;
        }

        /* Baris atas kartu koin: emoji + angka */
        .koin-top {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-bottom: 2px;
            margin-right: 10px;
        }

        /* Emoji koin */
        .koin-top span:first-child {
            font-size: 35px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 1.5px solid #F0D5D8;
            box-shadow: 0 2px 8px rgba(184,92,101,0.2);
            background: rgba(255,255,255,0.3);
        }

        .koin-top span:first-child {
            display: inline-flex;
            filter: drop-shadow(0 2px 6px rgba(184,92,101,0.3));
        }

        /* Angka saldo koin (masih hardcode: 150) */
        .koin-angka {
            font-size: 45px;
            font-weight: 800;
            color: #5D393B;
        }

        .koin-label {
            font-size: 11px;
            color: #5D393B;
            margin-bottom: 10px;
            margin-top: -10px;
        }

        /* Link "Tukar Koin" di bawah kartu */
        .koin-link {
            font-size: 12px;
            font-weight: 600;
            color: #b85c65;
            text-decoration: none;
            border-top: 1px solid #F0D5D8;
            padding-top: 10px;
            display: block;
        }
        .koin-link:hover { color: #9e4a52; }

        /* ==========================================
           SHORTCUT GRID
           3 card kecil: Produk Dijual, Produk Terjual, Daur Ulang
           Diklik langsung redirect ke halaman terkait
           ========================================== */
        .shortcut-grid {
            display: flex;
            gap: 16px;
            flex: 1; /* memenuhi sisa ruang di info-bar */
        }

        .shortcut-bottom {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 8px;
        }

        /* Tiap card shortcut */
        .shortcut-item {
            flex: 1;
            background: white;
            border: 1px solid #F0D5D8;
            border-radius: 16px;
            padding: 18px 20px;
            text-decoration: none;
            color: inherit;
            display: flex;
            flex-direction: column;
            gap: 4px;
            transition: all 0.2s;
            box-shadow: 0 2px 12px rgba(184,92,101,0.06);
        }

        /* Hover effect card shortcut */
        .shortcut-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(184,92,101,0.12);
            border-color: #FFBBC0;
        }

        .shortcut-icon { font-size: 22px; margin-bottom: 4px; opacity: 0.8; }

        /* Angka besar + ikon di dalam card shortcut */
        .shortcut-num {
            font-size: 40px;
            font-weight: 800;
            color: #5D393B;
            line-height: 1;
            flex-direction: raw;
            margin-left: 20px;
            flex: 2;
            display: flex;
            align-items: center;
            gap: 240px;
        }

        .shortcut-label {
            font-size: 12px;
            font-weight: 600;
            color: #5D393B;
            margin-left: 20px;
        }

        .shortcut-sub {
            font-size: 10px;
            color: #9E7178;
            margin-left: 20px;
        }

        /* ==========================================
           PRODUK TERBARU
           Grid 5 kolom produk kosmetik
           Data masih hardcode/dummy, belum dari database
           ========================================== */
        .product-section {
            padding: 28px 48px 40px 48px;
        }

        /* Grid 5 kolom produk */
        .product-grid { 
            display: grid; 
            grid-template-columns: repeat(5, 1fr); 
            gap: 16px;
            max-width: 12000px;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            margin-top: 20px;
        }

        .section-header h2 { font-size: 20px; font-weight: 700; }

        .section-header a {
            font-size: 13px;
            color: #e07080;
            text-decoration: none;
            font-weight: 500;
        }

        /* Card tiap produk */
        .product-card {
            flex: 0 0 220px;
            min-width: 220px;
            border-radius: 16px;
            overflow: hidden;
            border: 1.5px solid #f5e0e0;
            transition: box-shadow 0.2s;
            background: white;
            padding: 12px;
            cursor: pointer;
        }

        .product-card:hover {
            box-shadow: 0 4px 20px rgba(224,112,128,0.12);
        }

        /* Header produk: judul + link lihat semua */
        .prod-header {
            display: flex; justify-content: space-between; align-items: baseline;
            margin-bottom: 24px;
        }
        .prod-title { font-size: 20px; font-weight: 700; color: #5D393B; }
        .view-all-link {
            font-size: 13px; font-weight: 500; color: #9E7178;
            border-bottom: 1px solid #F0D5D8; padding-bottom: 2px;
            cursor: pointer; transition: all 0.2s; text-decoration: none;
        }
        .view-all-link:hover { color: #5D393B; border-color: #5D393B; }

        /* Gambar produk: aspect ratio 2:3 (portrait) */
        .product-img-wrap img {
            width: 100%; 
            height: 100%;
            object-fit: cover;
            position: absolute; 
            inset: 0;
        }
        .product-img-wrap {
            position: relative; overflow: hidden; border-radius: 12px;
            background: transparent; 
            aspect-ratio: 2/3;
            margin-bottom: 14px;
            display: flex; align-items: center; justify-content: center;
            border: 1px solid #F0D5D8;
            transition: transform 0.3s;
        }
        .product-card:hover .product-img-wrap { transform: scale(1.02); }

        .wishlist-btn:hover { background: white; transform: scale(1.1); }

        /* Tombol "Keranjang" yang muncul saat hover produk */
        .btn-cart-hover {
            position: absolute; bottom: -54px; left: 0; right: 0;
            background: #5D393B; color: white; border: none;
            padding: 16px; font-family: 'Poppins', sans-serif;
            font-size: 12px; font-weight: 600; cursor: pointer;
            transition: bottom 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            letter-spacing: 1.5px;
            border-radius: 0 0 12px 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }
        .btn-cart-hover iconify-icon {
            font-size: 24px;
            min-width: 18px;
            min-height: 18px;
            display: inline-flex;
            flex-shrink: 0;
        }
        /* Tombol muncul dari bawah saat hover */
        .product-card:hover .btn-cart-hover { bottom: 0; }

        .p-brand { font-size: 10px; color: #9E7178; margin-bottom: 3px; }

        /* Nama produk: max 2 baris, sisanya dipotong */
        .p-name { 
            font-size: 10px; font-weight: 600; color: #5D393B; 
            margin-bottom: 4px; line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            word-break: break-word;
        }

        /* Harga: harga diskon + harga asli dicoret + persentase diskon */
        .p-price { 
            font-size: 13px; font-weight: 700; color: #5D393B;
            display: flex; flex-wrap: wrap; align-items: center; gap: 4px;
        }
        .p-original { 
            font-size: 12px; font-weight: 400; color: var(--text-secondary); 
            text-decoration: line-through; margin-left: 6px; 
        }
        .p-discount { font-size: 10px; font-weight: 600; color: #4CAF7D; margin-left: 0; }
        .btn-keranjang:hover { background: #fce4ec; border-color: #f4a0aa; }

        /* ==========================================
           DAUR ULANG SECTION
           Kiri: banner ajakan mulai daur ulang
           Kanan: riwayat aktivitas daur ulang user
           Data riwayat dari tabel daur_ulang via DashboardController
           ========================================== */
        .daur-section {
            margin: 28px 48px 40px 48px;
        }

        .daur-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 14px;
        }

        .daur-title {
            font-size: 20px;
            font-weight: 700;
            color: #5D393B;
            margin-bottom: 15px;
        }

        /* Box utama daur ulang: grid 2 kolom (kiri:kanan = 1:2) */
        .daur-box {
            background: white;
            border-radius: 18px;
            margin-bottom: 90px;
            border: 1px solid #F0D5D8;
            overflow: hidden;
            width: 100%;
            display: grid;
            grid-template-columns: 1fr 2fr; /* kiri lebih kecil, kanan lebih lebar */
            box-shadow: 0 2px 12px rgba(184,92,101,0.06);
        }

        /* Sisi kiri: background hijau, berisi ajakan daur ulang */
        .daur-left {
            background: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 50%, #e8f5e9 100%);
            padding: 28px 24px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .daur-left h3 {
            font-size: 17px; font-weight: 700; color: #2D5016;
            margin-bottom: 8px; margin-left: 20px; line-height: 1.6;
        }

        .daur-left p {
            font-size: 12px; color: #4a7c2f; line-height: 1.7;
            margin-bottom: 18px; margin-left: 20px;
        }

        .daur-emoji { font-size: 28px; margin-bottom: 12px; margin-left: 20px; }

        /* Tombol "Mulai Daur Ulang" → redirect ke /ayu-daur-ulang */
        .btn-daur {
            background: #4CAF7D;
            color: white; border: none;
            padding: 10px 110px; border-radius: 100px;
            font-family: 'Poppins', sans-serif; font-size: 12px; font-weight: 600;
            margin-left: 20px; cursor: pointer; text-decoration: none;
            display: inline-block; width: fit-content;
        }

        /* Sisi kanan: riwayat daur ulang, bisa di-scroll */
        .daur-right {
            padding: 20px 24px;
            max-height: 300px;
            overflow: hidden;
        }

        /* Scrollbar kustom warna pink */
        .daur-right::-webkit-scrollbar { width: 4px; }
        .daur-right::-webkit-scrollbar-track { background: #fff5f5; border-radius: 10px; }
        .daur-right::-webkit-scrollbar-thumb { background: #f4a0aa; border-radius: 10px; }

        /* Judul "Riwayat Terbaru" sticky di atas saat scroll */
        .daur-right-title {
            font-size: 12px; font-weight: 700; color: #5D393B;
            margin-bottom: 14px;
            position: sticky; top: 0;
            background: white; padding-bottom: 8px; z-index: 1;
        }

        /* Tampilan saat belum ada riwayat daur ulang */
        .daur-empty { text-align: center; padding: 32px 0; color: #9E7178; }
        .daur-empty-icon { font-size: 32px; margin-bottom: 8px; }
        .daur-empty-text { font-size: 13px; font-weight: 500; }
        .daur-empty-sub { font-size: 11px; margin-top: 4px; }

        /* ==========================================
           FOOTER
           ========================================== */
        footer { background: var(--surface); border-top: 1px solid var(--border); }
        .footer-inner {
            display: grid; grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 48px; padding: 60px 48px 40px;
        }
        .f-logo img { height: 28px; width: auto; object-fit: contain; }
        .footer-brand .f-logo { font-size: 22px; font-weight: 800; font-style: italic; color: var(--text); margin-bottom: 12px; }
        .footer-brand .f-logo span { color: var(--primary-deeper); }
        .footer-brand p { font-size: 13px; color: var(--text-secondary); line-height: 1.7; max-width: 280px; }
        .footer-col h4 { font-size: 12px; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; color: var(--text); margin-bottom: 16px; }
        .footer-col ul { list-style: none; }
        .footer-col li { margin-bottom: 10px; }
        .footer-col a { font-size: 13px; color: var(--text-secondary); transition: color 0.2s; }
        .footer-col a:hover { color: var(--text); }
        .footer-bottom {
            border-top: 1px solid var(--border); padding: 20px 48px;
            display: flex; justify-content: space-between; align-items: center;
            font-size: 12px; color: var(--text-secondary);
        }
        .payment-icons { display: flex; gap: 8px; align-items: center; }
        .pay-badge { background: white; border: 1px solid var(--border); border-radius: 6px; padding: 4px 8px; font-size: 10px; font-weight: 700; color: var(--text); }
    </style>
</head>
<body>

    {{-- Navbar diambil dari file layouts/navigation.blade.php --}}
    @include('layouts.navigation')

    {{-- ==========================================
         BANNER SLIDER
         3 slide banner promosi, auto geser tiap 4 detik
         Gambar diambil dari folder public/images/
         ========================================== --}}
    <div class="banner-section" style="position: relative;">
        <div class="banner-wrapper">

            {{-- Tombol panah kiri: memanggil fungsi prevBanner() --}}
            <button class="banner-arrow left" onclick="prevBanner()">
                <svg width="52" height="52" viewBox="0 0 52 52" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <ellipse cx="26" cy="10" rx="7" ry="10" fill="white" opacity="0.5"/>
                    <ellipse cx="26" cy="42" rx="7" ry="10" fill="white" opacity="0.5"/>
                    <ellipse cx="10" cy="26" rx="10" ry="7" fill="white" opacity="0.5"/>
                    <ellipse cx="42" cy="26" rx="10" ry="7" fill="white" opacity="0.5"/>
                    <ellipse cx="15" cy="15" rx="7" ry="10" fill="white" opacity="0.5" transform="rotate(-45 15 15)"/>
                    <ellipse cx="37" cy="15" rx="7" ry="10" fill="white" opacity="0.5" transform="rotate(45 37 15)"/>
                    <ellipse cx="15" cy="37" rx="7" ry="10" fill="white" opacity="0.5" transform="rotate(45 15 37)"/>
                    <ellipse cx="37" cy="37" rx="7" ry="10" fill="white" opacity="0.5" transform="rotate(-45 37 37)"/>
                    <circle cx="26" cy="26" r="7" fill="white" opacity="0.5"/>
                    <path d="M28 20 L20 26 L28 32" stroke="#b85c65" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
                </svg>
            </button>

            {{-- Track slide: digeser pakai transform translateX via JS --}}
            <div class="banner-slides-track" id="bannerTrack">
                <div class="banner-slide" style="background-image: url('{{ asset('images/banner3.png') }}');"></div>
                <div class="banner-slide" style="background-image: url('{{ asset('images/banner2.png') }}');"></div>
                <div class="banner-slide" style="background-image: url('{{ asset('images/banner4.png') }}');"></div>
            </div>

            {{-- Tombol panah kanan: memanggil fungsi nextBanner() --}}
            <button class="banner-arrow right" onclick="nextBanner()">
                <svg width="52" height="52" viewBox="0 0 52 52" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <ellipse cx="26" cy="10" rx="7" ry="10" fill="white" opacity="0.5"/>
                    <ellipse cx="26" cy="42" rx="7" ry="10" fill="white" opacity="0.5"/>
                    <ellipse cx="10" cy="26" rx="10" ry="7" fill="white" opacity="0.5"/>
                    <ellipse cx="42" cy="26" rx="10" ry="7" fill="white" opacity="0.5"/>
                    <ellipse cx="15" cy="15" rx="7" ry="10" fill="white" opacity="0.5" transform="rotate(-45 15 15)"/>
                    <ellipse cx="37" cy="15" rx="7" ry="10" fill="white" opacity="0.5" transform="rotate(45 37 15)"/>
                    <ellipse cx="15" cy="37" rx="7" ry="10" fill="white" opacity="0.5" transform="rotate(45 15 37)"/>
                    <ellipse cx="37" cy="37" rx="7" ry="10" fill="white" opacity="0.5" transform="rotate(-45 37 37)"/>
                    <circle cx="26" cy="26" r="7" fill="white" opacity="0.5"/>
                    <path d="M24 20 L32 26 L24 32" stroke="#b85c65" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
                </svg>
            </button>

            {{-- Dot navigasi: diklik memanggil goBanner(index) --}}
            <div class="banner-dots">
                <div class="banner-dot active" onclick="goBanner(0)"></div>
                <div class="banner-dot" onclick="goBanner(1)"></div>
                <div class="banner-dot" onclick="goBanner(2)"></div>
            </div>
        </div>
    </div>

    {{-- ==========================================
         INFO BAR
         Kiri: kartu saldo Ayu Koin user (masih hardcode 150)
         Kanan: 3 shortcut card
           - Produk Dijual (belum connect ke data)
           - Produk Terjual (belum connect ke data)
           - Daur Ulang → redirect ke /ayu-daur-ulang
         ========================================== --}}
    <div class="info-bar">

        {{-- Kartu Ayu Koin --}}
        <div class="koin-card">
            <div class="koin-top">
                <span>🪙</span>
                <span class="koin-angka">{{ $saldoKoin }}</span>
            </div>
            <div class="koin-label">Ayu Koin</div>
            <a href="#" class="koin-link">Tukar Koin →</a> {{-- TODO: arahkan ke halaman tukar koin --}}
        </div>

        {{-- 3 Shortcut Card --}}
        <div class="shortcut-grid">

            {{-- Card 1: Produk Dijual (belum connect ke data) --}}
            <a href="#" class="shortcut-item">
                <div class="shortcut-num">{{ $totalProdukDijual }}
                    <iconify-icon icon="fluent:shopping-bag-48-filled" width="50" style="opacity:0.5;"></iconify-icon>
                </div>
                <div class="shortcut-label">Produk Dijual</div>
                <div class="shortcut-sub">2 bulan ini</div>
                <div class="shortcut-bottom"></div>
            </a>

            {{-- Card 2: Produk Terjual (belum connect ke data) --}}
            <a href="#" class="shortcut-item">
                <div class="shortcut-num">{{ $totalProdukTerjual }}
                    <iconify-icon icon="streamline-block:shopping-bag" width="45" style="opacity:0.5;"></iconify-icon>
                </div>
                <div class="shortcut-label">Produk Terjual</div>
                <div class="shortcut-sub">1 minggu ini</div>
                <div class="shortcut-bottom"></div>
            </a>

            {{-- Card 3: Daur Ulang → redirect ke halaman ayu-daur-ulang --}}
            <a href="{{ route('ayu-daur-ulang') }}" class="shortcut-item">
                <div class="shortcut-num">{{ $totalDaurUlang }}
                    <iconify-icon icon="fontisto:recycle" width="50" style="opacity:0.5;"></iconify-icon>
                </div>
                <div class="shortcut-label">Daur Ulang</div>
                <div class="shortcut-sub">2 bulan ini</div>
                <div class="shortcut-bottom"></div>
            </a>
        </div>
    </div>

    {{-- ==========================================
         PRODUK TERBARU
         Data masih hardcode/dummy
         TODO: sambungkan ke database produk
         ========================================== --}}
    <div class="product-section">
        <div class="prod-header">
            <div class="prod-title">Produk Terbaru 🌸</div>
            <a href="#" class="view-all-link">Lihat Semua →</a>
        </div>

        <div class="product-grid">

            {{-- Tiap product-card berisi: gambar, brand, nama, harga --}}
            <div class="product-card">
                <div class="product-img-wrap">
                    <img src="https://images.unsplash.com/photo-1586495777744-4413f21062fa?q=80&w=715&auto=format&fit=crop"/>
                    <button class="btn-cart-hover">
                        <iconify-icon icon="mynaui:cart"></iconify-icon> 
                        KERANJANG
                    </button>
                </div>
                <div class="p-brand">Wardah</div>
                <div class="p-name">Wardah Instaperfect Matte Lipstick</div>
                <div class="p-price">Rp 35.000<span class="p-original">Rp 75.000</span><span class="p-discount">-53%</span></div>
            </div>

            <div class="product-card">
                <div class="product-img-wrap">
                    <img src="https://images.unsplash.com/photo-1688614585803-0c00bde3828d?q=80&w=1171&auto=format&fit=crop"/>
                    <button class="btn-cart-hover">
                        <iconify-icon icon="mynaui:cart"></iconify-icon> 
                        KERANJANG
                    </button>
                </div>
                <div class="p-brand">Emina</div>
                <div class="p-name">Emina Bright Stuff Face Wash</div>
                <div class="p-price">Rp 15.000<span class="p-original">Rp 32.000</span><span class="p-discount">-53%</span></div>
            </div>

            <div class="product-card">
                <div class="product-img-wrap">
                    <img src="https://plus.unsplash.com/premium_photo-1670514094627-9ed5a1e9c06f?q=80&w=686&auto=format&fit=crop"/>
                    <button class="btn-cart-hover">
                        <iconify-icon icon="mynaui:cart"></iconify-icon> 
                        KERANJANG
                    </button>
                </div>
                <div class="p-brand">Somethinc</div>
                <div class="p-name">Somethinc Niacinamide Serum</div>
                <div class="p-price">Rp 75.000<span class="p-original">Rp 150.000</span><span class="p-discount">-50%</span></div>
            </div>

            <div class="product-card">
                <div class="product-img-wrap">
                    <img src="https://plus.unsplash.com/premium_photo-1677175230595-87f8721ff703?q=80&w=784&auto=format&fit=crop"/>
                    <button class="btn-cart-hover">
                        <iconify-icon icon="mynaui:cart"></iconify-icon> 
                        KERANJANG
                    </button>
                </div>
                <div class="p-brand">Maybelline</div>
                <div class="p-name">Fit Me Matte + Poreless Foundation</div>
                <div class="p-price">Rp 65.000<span class="p-original">Rp 130.000</span><span class="p-discount">-50%</span></div>
            </div>

            <div class="product-card">
                <div class="product-img-wrap">
                    <img src="https://images.unsplash.com/photo-1586495777744-4413f21062fa?q=80&w=715&auto=format&fit=crop"/>
                    <button class="btn-cart-hover">
                        <iconify-icon icon="mynaui:cart"></iconify-icon> 
                        KERANJANG
                    </button>
                </div>
                <div class="p-brand">Wardah</div>
                <div class="p-name">Wardah Instaperfect Matte Lipstick</div>
                <div class="p-price">Rp 35.000<span class="p-original">Rp 75.000</span><span class="p-discount">-53%</span></div>
            </div>

            <div class="product-card">
                <div class="product-img-wrap">
                    <img src="https://images.unsplash.com/photo-1586495777744-4413f21062fa?q=80&w=715&auto=format&fit=crop"/>
                    <button class="btn-cart-hover">
                        <iconify-icon icon="mynaui:cart"></iconify-icon> 
                        KERANJANG
                    </button>
                </div>
                <div class="p-brand">Wardah</div>
                <div class="p-name">Wardah Instaperfect Matte Lipstick</div>
                <div class="p-price">Rp 35.000<span class="p-original">Rp 75.000</span><span class="p-discount">-53%</span></div>
            </div>

            <div class="product-card">
                <div class="product-img-wrap">
                    <img src="https://images.unsplash.com/photo-1586495777744-4413f21062fa?q=80&w=715&auto=format&fit=crop"/>
                    <button class="btn-cart-hover">
                        <iconify-icon icon="mynaui:cart"></iconify-icon> 
                        KERANJANG
                    </button>
                </div>
                <div class="p-brand">Wardah</div>
                <div class="p-name">Wardah Instaperfect Matte Lipstick</div>
                <div class="p-price">Rp 35.000<span class="p-original">Rp 75.000</span><span class="p-discount">-53%</span></div>
            </div>

            <div class="product-card">
                <div class="product-img-wrap">
                    <img src="https://images.unsplash.com/photo-1688614585803-0c00bde3828d?q=80&w=1171&auto=format&fit=crop"/>
                    <button class="btn-cart-hover">
                        <iconify-icon icon="mynaui:cart"></iconify-icon> 
                        KERANJANG
                    </button>
                </div>
                <div class="p-brand">Emina</div>
                <div class="p-name">Emina Bright Stuff Face Wash</div>
                <div class="p-price">Rp 15.000<span class="p-original">Rp 32.000</span><span class="p-discount">-53%</span></div>
            </div>

            <div class="product-card">
                <div class="product-img-wrap">
                    <img src="https://plus.unsplash.com/premium_photo-1670514094627-9ed5a1e9c06f?q=80&w=686&auto=format&fit=crop"/>
                    <button class="btn-cart-hover">
                        <iconify-icon icon="mynaui:cart"></iconify-icon> 
                        KERANJANG
                    </button>
                </div>
                <div class="p-brand">Somethinc</div>
                <div class="p-name">Somethinc Niacinamide Serum</div>
                <div class="p-price">Rp 75.000<span class="p-original">Rp 150.000</span><span class="p-discount">-50%</span></div>
            </div>

            <div class="product-card">
                <div class="product-img-wrap">
                    <img src="https://plus.unsplash.com/premium_photo-1677175230595-87f8721ff703?q=80&w=784&auto=format&fit=crop"/>
                    <button class="btn-cart-hover">
                        <iconify-icon icon="mynaui:cart"></iconify-icon> 
                        KERANJANG
                    </button>
                </div>
                <div class="p-brand">Maybelline</div>
                <div class="p-name">Fit Me Matte + Poreless Foundation</div>
                <div class="p-price">Rp 65.000<span class="p-original">Rp 130.000</span><span class="p-discount">-50%</span></div>
            </div>

        </div>
    </div>

    {{-- ==========================================
         AKTIVITAS DAUR ULANG
         Kiri : banner ajakan + tombol mulai daur ulang
         Kanan: riwayat 5 aktivitas daur ulang terbaru user
         
         Data $riwayat dikirim dari DashboardController@index:
         DaurUlang::where('user_id', Auth::id())->latest()->take(5)->get()
         ========================================== --}}
    <div class="daur-section">
        <div class="daur-header">
            <div class="daur-title">Aktivitas Daur Ulang ♻️</div>
        </div>

        <div class="daur-box">

            {{-- KIRI: Banner ajakan daur ulang --}}
            <div class="daur-left">
                <div class="daur-emoji">🌿</div>
                <h3>Daur ulang <em>sekarang,</em><br>bumi berterima kasih!</h3>
                <p>
                    Kumpulkan kemasan kosmetik kosong,<br>
                    drop ke lokasi terdekat, scan QR,<br>
                    dan dapat Ayu Koin!
                </p>
                {{-- Tombol redirect ke halaman ayu-daur-ulang --}}
                <a href="{{ route('ayu-daur-ulang') }}" class="btn-daur">Mulai Daur Ulang</a>
            </div>

            {{-- KANAN: Riwayat daur ulang --}}
            <div style="display:flex; flex-direction:column; overflow:hidden;">

                {{-- Judul sticky di atas, tidak ikut scroll --}}
                <div style="padding: 20px 24px 12px 24px; border-bottom: 1px solid #F0D5D8; background:white;">
                    <div class="daur-right-title" style="margin-bottom:0;">Riwayat Terbaru</div>
                </div>

                {{-- Area konten yang bisa di-scroll --}}
                <div style="padding: 0 24px; max-height: 240px; overflow-y: auto;">
                    <style>
                        /* Scrollbar kustom warna pink */
                        .scroll-riwayat::-webkit-scrollbar { width: 4px; }
                        .scroll-riwayat::-webkit-scrollbar-track { background: #fff5f5; border-radius: 10px; }
                        .scroll-riwayat::-webkit-scrollbar-thumb { background: #f4a0aa; border-radius: 10px; }
                    </style>
                    <div class="scroll-riwayat" style="max-height:240px; overflow-y:auto; padding: 0 24px;">

                        {{-- Cek apakah user sudah pernah daur ulang --}}
                        @if($riwayatDaurUlang->isEmpty())
                            {{-- Tampilan kosong kalau belum ada riwayat --}}
                            <div class="daur-empty">
                                <div class="daur-empty-icon">♻️</div>
                                <div class="daur-empty-text">Belum ada aktivitas daur ulang</div>
                                <div class="daur-empty-sub">Yuk mulai daur ulang sekarang!</div>
                            </div>
                        @else
                            {{-- Loop tiap riwayat: foto kemasan + tanggal + koin didapat --}}
                            @foreach($riwayatDaurUlang as $item)
                            <div style="display:flex; align-items:center; gap:12px; padding:10px 0; border-bottom:1px solid #F0D5D8;">

                                {{-- Foto kemasan pertama yang diupload user --}}
                               @php $fotos = json_decode($item->foto_kemasan, true); 
                               $foto = str_replace('\/', '/', $fotos[0] ?? '');
                               @endphp
                                <img src="{{ asset('storage/' . ($fotos[0] ?? '')) }}"
                                style="width:44px; height:44px; border-radius:10px; object-fit:cover; border:1px solid #F0D5D8; flex-shrink:0;">
                                <div style="flex:1; min-width:0;">
                                    <div style="font-size:13px; font-weight:600; color:#5D393B;">Daur Ulang Kemasan</div>
                                    <div style="font-size:11px; color:#9E7178;">{{ $item->created_at->format('d M Y, H:i') }}</div>
                                </div>

                                {{-- Koin yang didapat dari aktivitas ini --}}
                                <div style="display:flex; align-items:center; gap:4px; flex-shrink:0;">
                                    <span style="font-size:13px;">🪙</span>
                                    <span style="font-size:13px; font-weight:700; color:#c8830a;">+{{ $item->koin_diberikan }} AK</span>
                                </div>
                            </div>
                            @endforeach
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ==========================================
         FOOTER
         ========================================== --}}
    <footer>
        <div class="footer-inner">
            <div class="footer-brand">
                <div class="f-logo"><img src="{{ asset('images/AYU-NE.png') }}"></div>
                <p>Platform eco-beauty sirkular pertama di Indonesia. Belanja preloved, daur ulang kemasan, dan raih reward — semuanya dalam satu ekosistem.</p>
            </div>
            <div class="footer-col">
                <h4>Belanja</h4>
                <ul>
                    <li><a href="#">Skincare</a></li>
                    <li><a href="#">Makeup</a></li>
                    <li><a href="#">Alat Makeup</a></li>
                    <li><a href="#">Isi Ulang</a></li>
                    <li><a href="#">Produk Terverifikasi</a></li>
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

    <script>
        // ==========================================
        // BANNER SLIDER
        // Variabel untuk ngatur posisi banner aktif
        // ==========================================

        let currentBanner = 0; // index banner yang sedang ditampilkan
        const bannerDots = document.querySelectorAll('.banner-dot'); // semua dot navigasi
        const bannerTrack = document.getElementById('bannerTrack'); // track yang bergeser
        const totalBanners = 3; // total jumlah banner
        let bannerTimer = setInterval(nextBanner, 4000); // auto geser tiap 4 detik

        // Fungsi untuk pindah ke banner tertentu berdasarkan index
        function goBanner(index) {
            bannerDots[currentBanner].classList.remove('active'); // nonaktifin dot lama
            currentBanner = index;
            bannerTrack.style.transform = `translateX(-${currentBanner * 100}%)`; // geser track
            bannerDots[currentBanner].classList.add('active'); // aktifin dot baru
            clearInterval(bannerTimer); // reset timer biar ga dobel
            bannerTimer = setInterval(nextBanner, 4000); // mulai timer baru
        }

        // Fungsi untuk lanjut ke banner berikutnya (dipanggil otomatis tiap 4 detik)
        function nextBanner() {
            goBanner((currentBanner + 1) % totalBanners);
        }

        // Fungsi untuk balik ke banner sebelumnya (dipanggil klik tombol panah kiri)
        function prevBanner() {
            goBanner((currentBanner - 1 + totalBanners) % totalBanners);
        }
    </script>

</body>
</html>