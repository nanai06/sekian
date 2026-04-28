<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Library ikon Iconify: digunakan untuk ikon lokasi, foto, scan, koin di step-card --}}
    <script src="https://code.iconify.design/iconify-icon/2.1.0/iconify-icon.min.js"></script>

    <title>Ayu Daur Ulang - AYU-NE</title>

    {{-- Google Fonts: font Poppins untuk semua teks di halaman --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        /* Scroll halus saat tombol "Selengkapnya" diklik → meluncur ke #konten-bawah */
        html {
            scroll-behavior: smooth;
        }

        /* Reset semua margin/padding bawaan browser */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        /* Background halaman: gradien pink vertikal, menempel saat scroll (fixed) */
        body {
            background: linear-gradient(180deg, #ffe8ed 0%, #fff5f5 50%, #ffe8ed 100%);
            background-attachment: fixed;
            color: #3b1a1a;
        }

        /* ==========================================
           HERO SECTION
           Layout 2 kolom: kiri = video animasi recycle,
           kanan = teks + tombol CTA
           ========================================== */
        .hero {
            background: linear-gradient(135deg, #fcfff5 0%, #e0ffec 60%, #c2ffd1 100%);
            position: relative;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            display: grid;
            grid-template-columns: 1fr 1fr;
            align-items: center;
            padding: 60px;
            gap: 40px;
            min-height: 90vh;
            box-sizing: border-box;
        }

        /* Overlay gradien transparan di bawah hero → transisi halus ke section berikutnya */
        .hero::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 120px;
            background: linear-gradient(to bottom, transparent 0%, #ffe6ec 100%);
            pointer-events: none;
        }

        /* Responsive: layar ≤1280px → padding & gap dikecilkan, judul lebih kecil */
        @media (max-width: 1280px) {
            .hero {
                padding: 40px;
                gap: 24px;
            }
            .hero-title {
                font-size: 32px;
            }
        }

        /* Responsive: layar ≤1024px → ubah ke 1 kolom, konten di-center */
        @media (max-width: 1024px) {
            .hero {
                grid-template-columns: 1fr;
                text-align: center;
                padding: 40px 30px;
                margin: 16px;
            }
            .hero-img-box {
                max-width: 300px;
                margin: 0 auto;
            }
        }

        /* Responsive: layar ≤768px → padding lebih kecil, judul lebih kecil lagi */
        @media (max-width: 768px) {
            .hero {
                margin: 12px;
                padding: 30px 20px;
                min-height: calc(100vh - 100px);
            }
            .hero-title {
                font-size: 26px;
            }
        }

        /* ==========================================
           SCROLL BUTTON
           Tombol "Selengkapnya" di bawah hero
           Diklik → scroll halus ke #konten-bawah
           ========================================== */
        .scroll-btn {
            position: absolute;
            bottom: 40px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            color: #7a4a4a;
            font-size: 13px;
            font-weight: 500;
            text-decoration: none;
            z-index: 10;
        }

        /* Animasi scale saat hover pada ikon panah scroll */
        .scroll-btn svg {
            transition: transform 0.3s ease;
        }

        .scroll-btn:hover svg {
            transform: scale(1.2);
        }

        /* Offset scroll agar konten tidak tertutup navbar (tinggi navbar ~75px) */
        #konten-bawah {
            scroll-margin-top: 75px;
        }

        /* Animasi bounce (naik-turun): dipakai untuk tombol scroll jika diaktifkan */
        @keyframes bounce {
            0%, 100% { transform: translateX(-50%) translateY(0); }
            50%       { transform: translateX(-50%) translateY(8px); }
        }

        /* Kotak video di sisi kiri hero: rata kanan agar video rapat ke tengah */
        .hero-img-box {
            height: 380px;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            font-size: 14px;
            margin-top: -70px;
        }

        /* Sisi kanan hero: teks + tombol, rata kiri secara vertikal */
        .hero-right {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
            padding-left: 20px;
            margin-top: -70px;
        }

        /* Tag kecil "Eco-Beauty" di atas judul */
        .hero-tag {
            font-size: 14px;
            color: #2D5016;
            font-weight: 500;
            margin-bottom: 16px;
        }

        /* Judul utama hero: bold besar, warna hijau tua */
        .hero-title {
            font-size: 48px;
            font-weight: 800;
            color: #1f3e0bff;
            line-height: 1.15;
            margin-bottom: 20px;
        }

        /* Deskripsi singkat di bawah judul */
        .hero-desc {
            font-size: 15px;
            color: #2D5016;
            line-height: 1.7;
            margin-bottom: 32px;
            max-width: 440px;
        }

        /* Tombol CTA utama: solid hijau tua → redirect ke halaman dropoff-lokasi */
        .btn-primary {
            background: #2D5016;
            color: white;
            border: none;
            padding: 16px 36px;
            border-radius: 50px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
            transition: background 0.2s;
            text-decoration: none;
            display: inline-block;
        }

        /* Hover tombol CTA: warna berubah ke hijau lebih terang */
        .btn-primary:hover { background: #639740; }

        /* ==========================================
           STEP SECTION
           4 kartu langkah cara daur ulang
           ========================================== */
        .step-section {
            padding: 60px 60px;
            background: transparent;
        }

        /* Judul section "Cara Daur Ulang" */
        .step-section h2 {
            font-size: 20px;
            font-weight: 700;
            color: #3b1a1a;
            margin-bottom: 40px;
            text-align: center;
        }

        /* Grid 4 kolom untuk 4 kartu langkah */
        .step-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 28px;
            max-width: 1330px;
            margin: 0 auto;
        }

        /* Kartu langkah: putih, sudut bulat, bayangan drop-shadow */
        .step-card {
            background: white;
            border: 1.5px solid #f5e0e0;
            border-radius: 20px;
            padding: 28px;
            display: flex;
            flex-direction: column;
            position: relative;
            filter: drop-shadow(0px 4px 12px rgba(0, 0, 0, 0.1));
        }

        /* Header kartu: nomor di kiri, ikon di kanan */
        .step-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 16px;
        }

        /* Nomor langkah: angka di tengah SVG bunga merah muda */
        .step-number {
            font-size: 24px;
            font-weight: 800;
            color: #3b1a1a;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 60px;
            height: 60px;
        }

        /* Ikon langkah: warna hijau muda transparan, ukuran besar */
        .step-icon {
            font-size: 50px;
            color: #6a9a6c63;
        }

        /* Judul kartu langkah */
        .step-card h3 {
            font-size: 17px;
            font-weight: 700;
            color: #5D393B;
            margin-bottom: 6px;
        }

        /* Deskripsi singkat di kartu langkah */
        .step-card p {
            font-size: 12px;
            color: #9E7178;
            line-height: 1.7;
        }

        /* ==========================================
           KEMASAN SECTION
           Slider jenis kemasan yang diterima
           Navigasi kiri-kanan dengan tombol panah
           ========================================== */
        .kemasan-section {
            padding: 0 20px 60px 20px;
        }

        /* Box wrapper kemasan: padding dalam, sudut bulat */
        .kemasan-box {
            border-radius: 20px;
            padding: 36px 20px;
        }

        /* Judul section kemasan */
        .kemasan-box h2 {
            font-size: 20px;
            font-weight: 700;
            color: #3b1a1a;
            margin-bottom: 30px;
            text-align: center;
        }

        /* Wrapper slider: tombol kiri + konten slider + tombol kanan */
        .kemasan-slider-wrap {
            display: flex;
            align-items: center;
            gap: 35px;
        }

        /* Area slider: overflow hidden agar hanya 1 page yang terlihat */
        .kemasan-slider {
            flex: 1;
            overflow: hidden;
        }

        /* Track slider: flex row → semua page berjejer horizontal
           Digeser via transform translateX oleh JS */
        .kemasan-track {
            display: flex;
            transition: transform 0.6s cubic-bezier(.77,0,.175,1);
        }

        /* Satu page slider: min-width 100% agar tiap page memenuhi lebar slider */
        .kemasan-page {
            min-width: 100%;
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        /* State aktif page: tampil normal, tidak ter-offset */
        .kemasan-page.active {
            position: relative;
            opacity: 1;
            pointer-events: all;
            display: flex;
            transform: translateX(0);
        }

        /* Animasi masuk dari kanan (saat slide ke kiri) */
        .kemasan-page.slide-from-right {
            transform: translateX(60px);
        }

        /* Animasi masuk dari kiri (saat slide ke kanan) */
        .kemasan-page.slide-from-left {
            transform: translateX(-60px);
        }

        /* Keyframe animasi geser dari kanan */
        @keyframes fromRight {
            0% { opacity: 0; transform: translateX(60px); }
            100% { opacity: 1; transform: translateX(0); }
        }

        /* Keyframe animasi geser dari kiri */
        @keyframes fromLeft {
            0% { opacity: 0; transform: translateX(-60px); }
            100% { opacity: 1; transform: translateX(0); }
        }

        /* Baris item kemasan: 4 item per baris, rata tengah */
        .kemasan-row {
            display: flex;
            gap: 14px;
            justify-content: center;
        }

        /* Satu item kemasan: putih, ikon + teks nama kemasan */
        .kemasan-item {
            background: white;
            border-radius: 12px;
            padding: 14px 18px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 15px;
            font-weight: 500;
            color: #3b1a1a;
            flex: 1;
            min-width: 0;
            min-height: 80px;
        }

        /* Badge ceklis/bunga di tiap item kemasan: lingkaran pink */
        .kemasan-check {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #f4a0aa;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 14px;
            flex-shrink: 0;
        }

        /* Tombol panah slider kiri & kanan: lingkaran putih dengan border hijau */
        .slider-arrow {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            justify-content: center;
            border: 1.5px solid #6a9a6c63;
            background: white;
            color: #316136;
            font-size: 18px;
            cursor: pointer;
            display: flex;
            align-items: center;
            flex-shrink: 0;
            transition: all 0.2s;
            line-height: 0;
            padding: 0;
        }

        /* Hover tombol panah: background hijau muda, ikon putih */
        .slider-arrow:hover {
            background: #6a9a6c63;
            color: white;
        }
    </style>
</head>
<body>
    {{-- Navbar diambil dari file layouts/navigation.blade.php --}}
    @include('layouts.navigation')

    <!-- ==========================================
         HERO SECTION
         Kiri: video animasi recycle (recycle.mp4)
         Kanan: tag, judul, deskripsi, tombol CTA
         ========================================== -->
    <div class="hero" style="position: relative;">

        {{-- Kotak video sisi kiri: autoplay loop tanpa suara --}}
        <div class="hero-img-box">
            <video autoplay loop muted playsinline
                style="width: 100%; height: 400px; object-fit: contain; border-radius: 9000px;">
                <source src="{{ asset('images/recycle.mp4') }}" type="video/mp4">
            </video>
        </div>

        {{-- Sisi kanan hero: teks + tombol CTA --}}
        <div class="hero-right">
            <p class="hero-tag">Eco-Beauty</p>
            <h1 class="hero-title">Cantik Dimulai dari Kepedulian</h1>
            <p class="hero-desc">Daur ulang kemasan kosmetikmu, dapatkan Ayu Koin & jadi bagian dari gerakan eco-beauty!</p>
            {{-- Tombol CTA: redirect ke halaman pilih lokasi drop-off --}}
            <a href="{{ route('dropoff-lokasi') }}" class="btn-primary">Daur Ulang Sekarang</a>
        </div>

        {{-- ==========================================
             TOMBOL SCROLL "Selengkapnya"
             SVG bunga pink transparan + teks
             Diklik → scroll halus ke #konten-bawah
             Harus berada di DALAM .hero agar posisi absolute bekerja
             ========================================== --}}
        <a class="scroll-btn" href="#konten-bawah">
            <svg width="52" height="52" viewBox="0 0 52 52" fill="none" xmlns="http://www.w3.org/2000/svg"
                style="filter: drop-shadow(0px 4px 12px rgba(255, 255, 255, 0.56));">
                {{-- Kelopak bunga: 8 ellipse + 1 lingkaran tengah, warna pink transparan --}}
                <ellipse cx="26" cy="10" rx="7" ry="10" fill="#F4A0AA" opacity="0.5"/>
                <ellipse cx="26" cy="42" rx="7" ry="10" fill="#F4A0AA" opacity="0.5"/>
                <ellipse cx="10" cy="26" rx="10" ry="7" fill="#F4A0AA" opacity="0.5"/>
                <ellipse cx="42" cy="26" rx="10" ry="7" fill="#F4A0AA" opacity="0.5"/>
                <ellipse cx="15" cy="15" rx="7" ry="10" fill="#F4A0AA" opacity="0.5" transform="rotate(-45 15 15)"/>
                <ellipse cx="37" cy="15" rx="7" ry="10" fill="#F4A0AA" opacity="0.5" transform="rotate(45 37 15)"/>
                <ellipse cx="15" cy="37" rx="7" ry="10" fill="#F4A0AA" opacity="0.5" transform="rotate(45 15 37)"/>
                <ellipse cx="37" cy="37" rx="7" ry="10" fill="#F4A0AA" opacity="0.5" transform="rotate(-45 37 37)"/>
                {{-- Lingkaran tengah bunga --}}
                <circle cx="26" cy="26" r="7" fill="#F4A0AA" opacity="0.5"/>
                {{-- Ikon panah bawah di tengah bunga --}}
                <path d="M20 23l6 6 6-6" stroke="#ffffff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <span style="color: #4c18405b; font-weight: 500;">Selengkapnya</span>
        </a>
    </div>

    <!-- ==========================================
         STEP SECTION
         4 kartu langkah cara daur ulang kemasan:
         1. Pilih lokasi drop-box
         2. Foto kemasan
         3. Scan barcode / input kode
         4. Dapat Ayu Koin
         ========================================== -->
    <div class="step-section" id="konten-bawah">
        <h2>Cara Daur Ulang</h2>
        <div class="step-grid">

            {{-- LANGKAH 1: Pilih Lokasi Drop-Box --}}
            <div class="step-card">
                <div class="step-header">
                    {{-- Nomor langkah: angka "1" di atas SVG bunga merah muda --}}
                    <div class="step-number">
                        <svg width="60" height="60" viewBox="0 0 52 52" fill="none" xmlns="http://www.w3.org/2000/svg" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 0;">
                            <ellipse cx="26" cy="10" rx="7" ry="10" fill="#ffe7ed" />
                            <ellipse cx="26" cy="42" rx="7" ry="10" fill="#ffe7ed" />
                            <ellipse cx="10" cy="26" rx="10" ry="7" fill="#ffe7ed" />
                            <ellipse cx="42" cy="26" rx="10" ry="7" fill="#ffe7ed" />
                            <ellipse cx="15" cy="15" rx="7" ry="10" fill="#ffe7ed" transform="rotate(-45 15 15)"/>
                            <ellipse cx="37" cy="15" rx="7" ry="10" fill="#ffe7ed" transform="rotate(45 37 15)"/>
                            <ellipse cx="15" cy="37" rx="7" ry="10" fill="#ffe7ed" transform="rotate(45 15 37)"/>
                            <ellipse cx="37" cy="37" rx="7" ry="10" fill="#ffe7ed" transform="rotate(-45 37 37)"/>
                            <circle cx="26" cy="26" r="7" fill="#ffe7ed"/>
                        </svg>
                        <span style="position: relative; z-index: 1;">1</span>
                    </div>
                    {{-- Ikon lokasi dari Iconify --}}
                    <div class="step-icon"><iconify-icon icon="mingcute:location-fill"></iconify-icon></div>
                </div>
                <h3>Pilih Lokasi Drop-Box</h3>
                <p>Temukan lokasi drop-box terdekat dari lokasimu melalui peta atau daftar partner</p>
            </div>

            {{-- LANGKAH 2: Foto / Upload Foto Kemasan --}}
            <div class="step-card">
                <div class="step-header">
                    {{-- Nomor langkah: angka "2" di atas SVG bunga merah muda --}}
                    <div class="step-number">
                        <svg width="60" height="60" viewBox="0 0 52 52" fill="none" xmlns="http://www.w3.org/2000/svg" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 0;">
                            <ellipse cx="26" cy="10" rx="7" ry="10" fill="#ffe7ed" />
                            <ellipse cx="26" cy="42" rx="7" ry="10" fill="#ffe7ed" />
                            <ellipse cx="10" cy="26" rx="10" ry="7" fill="#ffe7ed" />
                            <ellipse cx="42" cy="26" rx="10" ry="7" fill="#ffe7ed" />
                            <ellipse cx="15" cy="15" rx="7" ry="10" fill="#ffe7ed" transform="rotate(-45 15 15)"/>
                            <ellipse cx="37" cy="15" rx="7" ry="10" fill="#ffe7ed" transform="rotate(45 37 15)"/>
                            <ellipse cx="15" cy="37" rx="7" ry="10" fill="#ffe7ed" transform="rotate(45 15 37)"/>
                            <ellipse cx="37" cy="37" rx="7" ry="10" fill="#ffe7ed" transform="rotate(-45 37 37)"/>
                            <circle cx="26" cy="26" r="7" fill="#ffe7ed"/>
                        </svg>
                        <span style="position: relative; z-index: 1;">2</span>
                    </div>
                    {{-- Ikon kamera dari Iconify --}}
                    <div class="step-icon" style="font-size: 50.9px;"><iconify-icon icon="ic:baseline-add-a-photo"></iconify-icon></div>
                </div>
                <h3>Foto / Upload Foto Kemasan</h3>
                <p>Foto kemasan kosmetik bekasmu yang sudah habis dan bersih.</p>
            </div>

            {{-- LANGKAH 3: Scan Barcode / Input Kode --}}
            <div class="step-card">
                <div class="step-header">
                    {{-- Nomor langkah: angka "3" di atas SVG bunga merah muda --}}
                    <div class="step-number">
                        <svg width="60" height="60" viewBox="0 0 52 52" fill="none" xmlns="http://www.w3.org/2000/svg" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 0;">
                            <ellipse cx="26" cy="10" rx="7" ry="10" fill="#ffe7ed" />
                            <ellipse cx="26" cy="42" rx="7" ry="10" fill="#ffe7ed" />
                            <ellipse cx="10" cy="26" rx="10" ry="7" fill="#ffe7ed" />
                            <ellipse cx="42" cy="26" rx="10" ry="7" fill="#ffe7ed" />
                            <ellipse cx="15" cy="15" rx="7" ry="10" fill="#ffe7ed" transform="rotate(-45 15 15)"/>
                            <ellipse cx="37" cy="15" rx="7" ry="10" fill="#ffe7ed" transform="rotate(45 37 15)"/>
                            <ellipse cx="15" cy="37" rx="7" ry="10" fill="#ffe7ed" transform="rotate(45 15 37)"/>
                            <ellipse cx="37" cy="37" rx="7" ry="10" fill="#ffe7ed" transform="rotate(-45 37 37)"/>
                            <circle cx="26" cy="26" r="7" fill="#ffe7ed"/>
                        </svg>
                        <span style="position: relative; z-index: 1;">3</span>
                    </div>
                    {{-- Ikon scan barcode dari Iconify --}}
                    <div class="step-icon" style="font-size: 50.9px;"><iconify-icon icon="boxicons:scan-filled"></iconify-icon></div>
                </div>
                <h3>Scan Barcode / Input Kode</h3>
                <p>Scan barcode yang ada di drop box atau input kode manualnya.</p>
            </div>

            {{-- LANGKAH 4: Dapat Ayu Koin --}}
            <div class="step-card">
                <div class="step-header">
                    {{-- Nomor langkah: angka "4" di atas SVG bunga merah muda --}}
                    <div class="step-number">
                        <svg width="60" height="60" viewBox="0 0 52 52" fill="none" xmlns="http://www.w3.org/2000/svg" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 0;">
                            <ellipse cx="26" cy="10" rx="7" ry="10" fill="#ffe7ed" />
                            <ellipse cx="26" cy="42" rx="7" ry="10" fill="#ffe7ed" />
                            <ellipse cx="10" cy="26" rx="10" ry="7" fill="#ffe7ed" />
                            <ellipse cx="42" cy="26" rx="10" ry="7" fill="#ffe7ed" />
                            <ellipse cx="15" cy="15" rx="7" ry="10" fill="#ffe7ed" transform="rotate(-45 15 15)"/>
                            <ellipse cx="37" cy="15" rx="7" ry="10" fill="#ffe7ed" transform="rotate(45 37 15)"/>
                            <ellipse cx="15" cy="37" rx="7" ry="10" fill="#ffe7ed" transform="rotate(45 15 37)"/>
                            <ellipse cx="37" cy="37" rx="7" ry="10" fill="#ffe7ed" transform="rotate(-45 37 37)"/>
                            <circle cx="26" cy="26" r="7" fill="#ffe7ed"/>
                        </svg>
                        <span style="position: relative; z-index: 1;">4</span>
                    </div>
                    {{-- Ikon koin dari Iconify --}}
                    <div class="step-icon" style="font-size: 50.9px;"><iconify-icon icon="tabler:coin-filled"></iconify-icon></div>
                </div>
                <h3>Dapat Ayu Koin</h3>
                <p>Dapatkan Ayu Koin sebagai reward yang bisa ditukar dengan voucher belanja</p>
            </div>

        </div>
    </div>

    <!-- ==========================================
         KEMASAN SECTION
         Slider interaktif jenis kemasan yang diterima
         Navigasi kiri-kanan dengan tombol panah SVG
         Total 2 page, masing-masing 8 item (2 baris × 4)
         ========================================== -->
    <div class="kemasan-section">
        <div class="kemasan-box">
            <h2>Jenis Kemasan yang Diterima</h2>

            <div class="kemasan-slider-wrap">

                {{-- Tombol panah KIRI: geser slider ke page sebelumnya --}}
                <button class="slider-arrow left" onclick="slideKemasan(-1)">
                    <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M15 18l-6-6 6-6"/>
                    </svg>
                </button>

                {{-- Area konten slider: overflow hidden, hanya 1 page terlihat --}}
                <div class="kemasan-slider" id="kemasanSlider">
                    {{-- Track slider: digeser horizontal oleh JS via transform translateX --}}
                    <div class="kemasan-track" id="kemasanTrack">

                        {{-- PAGE 1: 8 jenis kemasan pertama --}}
                        <div class="kemasan-page">
                            <div class="kemasan-row">
                                <div class="kemasan-item"><div class="kemasan-check">✿</div>Botol Plastik</div>
                                <div class="kemasan-item"><div class="kemasan-check">✿</div>Botol Kaca</div>
                                <div class="kemasan-item"><div class="kemasan-check">✿</div>Tube</div>
                                <div class="kemasan-item"><div class="kemasan-check">✿</div>Pump Dispenser</div>
                            </div>
                            <div class="kemasan-row">
                                <div class="kemasan-item"><div class="kemasan-check">✿</div>Compact Case</div>
                                <div class="kemasan-item"><div class="kemasan-check">✿</div>Palette</div>
                                <div class="kemasan-item"><div class="kemasan-check">✿</div>Sachet</div>
                                <div class="kemasan-item"><div class="kemasan-check">✿</div>Lipstick Case</div>
                            </div>
                        </div>

                        {{-- PAGE 2: 8 jenis kemasan berikutnya --}}
                        <div class="kemasan-page">
                            <div class="kemasan-row">
                                <div class="kemasan-item"><div class="kemasan-check">✿</div>Mascara Tube</div>
                                <div class="kemasan-item"><div class="kemasan-check">✿</div>Foundation Bottle</div>
                                <div class="kemasan-item"><div class="kemasan-check">✿</div>Spray Bottle</div>
                                <div class="kemasan-item"><div class="kemasan-check">✿</div>Jar / Pot Krim</div>
                            </div>
                            <div class="kemasan-row">
                                <div class="kemasan-item"><div class="kemasan-check">✿</div>Cushion Case</div>
                                <div class="kemasan-item"><div class="kemasan-check">✿</div>Eyeshadow Palette</div>
                                <div class="kemasan-item"><div class="kemasan-check">✿</div>Blush Compact</div>
                                <div class="kemasan-item"><div class="kemasan-check">✿</div>Serum Bottle</div>
                            </div>
                        </div>

                    </div>
                </div>

                {{-- Tombol panah KANAN: geser slider ke page berikutnya --}}
                <button class="slider-arrow right" onclick="slideKemasan(1)">
                    <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 18l6-6-6-6"/>
                    </svg>
                </button>

            </div>
        </div>
    </div>

    <script>
    // ==========================================
    // SLIDER KEMASAN
    // Navigasi halaman kemasan dengan tombol kiri/kanan
    // currentPage: index halaman aktif (mulai dari 0)
    // ==========================================
    let currentPage = 0;
    const kemasanTrack = document.getElementById('kemasanTrack');
    const kemasanPages = document.querySelectorAll('.kemasan-page');
    const totalPages = kemasanPages.length;

    // Fungsi geser slider: dir = -1 (kiri) atau +1 (kanan)
    // Loop balik ke ujung jika melampaui batas
    function slideKemasan(dir) {
        currentPage += dir;
        if (currentPage < 0) currentPage = totalPages - 1;        // dari page 0 → ke page terakhir
        if (currentPage >= totalPages) currentPage = 0;           // dari page terakhir → ke page 0
        kemasanTrack.style.transform = `translateX(-${currentPage * 100}%)`;
    }

    // ==========================================
    // BANNER SLIDER (jika diaktifkan)
    // Auto-slide setiap 4 detik, navigasi via dot indicator
    // ==========================================
    let currentBanner = 0;
    const bannerDots = document.querySelectorAll('.banner-dot');
    const bannerTrack = document.getElementById('bannerTrack');
    const totalBanners = 3;
    let bannerTimer = setInterval(nextBanner, 4000); // timer auto-slide

    // Pindah ke banner tertentu by index, reset timer setelah manual click
    function goBanner(index) {
        bannerDots[currentBanner].classList.remove('active');
        currentBanner = index;
        bannerTrack.style.transform = `translateX(-${currentBanner * 100}%)`;
        bannerDots[currentBanner].classList.add('active');
        clearInterval(bannerTimer);
        bannerTimer = setInterval(nextBanner, 4000);
    }

    // Maju ke banner berikutnya, loop balik ke 0 setelah banner terakhir
    function nextBanner() {
        goBanner((currentBanner + 1) % totalBanners);
    }

    // Mundur ke banner sebelumnya, loop ke banner terakhir jika sudah di index 0
    function prevBanner() {
        goBanner((currentBanner - 1 + totalBanners) % totalBanners);
    }
    </script>
</body>
</html>