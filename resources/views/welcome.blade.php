<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>AYU-NE — Eco Beauty Circular Platform</title>

{{-- Google Fonts: font Poppins dengan berbagai ukuran --}}
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

{{-- Iconify: library ikon yang dipake di seluruh halaman --}}
<script src="https://code.iconify.design/iconify-icon/2.1.0/iconify-icon.min.js"></script>

<style>
  /* ==========================================
     ROOT VARIABLES
     Warna-warna utama seluruh halaman welcome
     Cukup ganti di sini kalau mau ganti tema warna
     ========================================== */
  :root {
    --primary: #FFBBC0;          /* pink muda utama */
    --primary-dark: #E8A0A5;     /* pink sedikit lebih gelap */
    --primary-deeper: #b85c65;   /* pink gelap untuk aksen & teks */
    --bg: #FFFFFF;               /* background putih */
    --surface: #FFF8F8;          /* background card/surface */
    --text: #5D393B;             /* warna teks utama */
    --text-secondary: #9E7178;   /* warna teks sekunder/abu */
    --border: #F0D5D8;           /* warna border */
    --success: #4CAF7D;          /* warna hijau untuk elemen eco */
  }

  /* Reset semua margin/padding bawaan browser */
  * { margin: 0; padding: 0; box-sizing: border-box; }

  /* Font utama Poppins, background putih, warna teks utama */
  body { font-family: 'Poppins', sans-serif; background: #fff; color: var(--text); overflow-x: hidden; }

  /* Semua link tidak bergaris bawah, warna mengikuti parent */
  a { text-decoration: none; color: inherit; }

  /* Logo ukuran normal di navbar */
  .logo-img { height: 36px; width: auto; object-fit: contain; }

  /* Logo ukuran kecil di footer */
  .logo-img-sm { height: 28px; width: auto; object-fit: contain; }

  /* ==========================================
     TRUST ITEMS
     Card kecil berisi statistik/kepercayaan
     Tampil di trust bar bawah hero slider
     ========================================== */
  .trust-item {
    display: flex; align-items: center; gap: 16px;
    padding: 24px 28px;
    background: rgba(255, 248, 248, 0.7);
    border: 1px solid var(--border);
    border-radius: 16px;
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    box-shadow: 0 4px 24px rgba(184, 92, 101, 0.08),
                inset 0 1px 0 rgba(255,255,255,0.8);
    transition: transform 0.2s, box-shadow 0.2s;
  }
  .trust-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 32px rgba(184, 92, 101, 0.15), 
                inset 0 1px 0 rgba(255,255,255,0.8);
  }
  .trust-icon { font-size: 32px; flex-shrink: 0; }
  .trust-title { font-weight: 600; color:var(--secondary-deeper); font-size: 13px; margin-bottom: 3px; }
  .trust-sub { color: var(--text-secondary); font-size: 11px; }

  /* ==========================================
     ANNOUNCEMENT BAR
     Bar hitam tipis di paling atas halaman
     ========================================== */
  .announcement {
    background: var(--text);
    color: #fff;
    text-align: center;
    font-size: 12px;
    font-weight: 500;
    padding: 8px 16px;
    letter-spacing: 0.5px;
  }
  .announcement a { color: var(--primary); text-decoration: underline; }

  /* ==========================================
     NAVBAR
     Navigasi sticky di atas halaman
     Background putih + gambar pattern
     Tombol Masuk & Daftar di kanan
     ========================================== */
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
  .nav-links { display: flex; gap: 28px; list-style: none; }
  .nav-links a {
    font-size: 13px; font-weight: 500; color: var(--text-secondary);
    letter-spacing: 0.3px; transition: color 0.2s; padding: 4px 0;
    border-bottom: 1.5px solid transparent;
  }
  .nav-links a:hover { color: var(--text); border-bottom-color: var(--primary); }

  /* Logo tengah navbar: absolute supaya tetap center */
  .nav-logo {
    position: absolute; left: 50%; transform: translateX(-50%);
    font-size: 24px; font-weight: 800; color: var(--text);
    font-style: italic; letter-spacing: -1px;
  }
  .nav-logo span { color: var(--primary-deeper); }
  .nav-right { display: flex; align-items: center; gap: 20px; }
  .nav-icon { font-size: 18px; cursor: pointer; color: var(--text-secondary); transition: color 0.2s; position: relative; }
  .nav-icon:hover { color: var(--text); }

  /* Badge angka di icon keranjang */
  .cart-badge {
    position: absolute; top: -6px; right: -6px;
    background: var(--primary-deeper); color: white;
    font-size: 9px; font-weight: 700; width: 16px; height: 16px;
    border-radius: 50%; display: flex; align-items: center; justify-content: center;
  }

  /* Tombol Masuk (outline) */
  .btn-login {
    font-size: 13px; font-weight: 600; color: var(--text);
    border: 1.5px solid var(--border); padding: 7px 20px;
    border-radius: 100px; cursor: pointer; transition: all 0.2s;
    background: white; font-family: 'Poppins', sans-serif;
  }
  .btn-login:hover { border-color: var(--primary); background: var(--surface); transform: translateY(-1px);}

  /* Tombol Daftar (solid pink) */
  .btn-daftar {
    font-size: 13px; font-weight: 600; color: white;
    background: var(--primary-deeper); border: 1.5px solid var(--primary-deeper);
    padding: 7px 20px; border-radius: 100px; cursor: pointer;
    transition: all 0.2s; font-family: 'Poppins', sans-serif; text-decoration: none;
  }
  .btn-daftar:hover { background: #9e4a52; border-color: #9e4a52; transform: translateY(-1px); }

  /* ==========================================
     HERO SLIDER
     Slider utama di bawah navbar
     3 slide dengan background berbeda
     Auto geser tiap 5 detik
     ========================================== */
  .hero-slider { position: relative; overflow: hidden; background: var(--surface); }

  /* Track yang bergeser kiri-kanan */
  .slides { display: flex; transition: transform 0.6s cubic-bezier(.77,0,.175,1); }

  /* Tiap slide: tinggi 460px, konten di tengah */
  .slide {
    min-width: 100%; height: 460px;
    display: flex; align-items: center; justify-content: center;
    position: relative; overflow: hidden;
  }
  .slide-bg {
    position: absolute; inset: 0;
    display: flex; align-items: center; justify-content: center;
    font-size: 13px; color: var(--text-secondary);
    flex-direction: column; gap: 8px;
  }

  /* Background tiap slide dengan gradient berbeda */
  .slide-1 { background: linear-gradient(135deg, #FFBBC0 0%, #FFEEEE 60%, #FFBBC0 100%); }  /* pink */
  .slide-2 { background: linear-gradient(135deg, #fde0d8ff 0%, #ffcabeff 60%, #ff8d70ff 100%); } /* peach */
  .slide-3 { background: linear-gradient(135deg, #dbf5e0ff 0%, #9dc69cff 60%, #598f4eff 100%); } /* hijau */

  /* Teks konten di kiri bawah slide */
  .slide-content { position: absolute; left: 8%; bottom: 60px; z-index: 2; }
  .slide-label { font-size: 11px; font-weight: 600; letter-spacing: 2px; color: var(--primary-deeper); text-transform: uppercase; margin-bottom: 10px; }
  .slide-title { font-size: 42px; font-weight: 800; color: var(--text); line-height: 1.15; margin-bottom: 16px; max-width: 480px; }

  /* Override warna khusus slide hijau (slide-3) */
  .slide-3 .slide-label { color: #2D5016; }
  .slide-3 .slide-title em { color: #4e7434ff; }
  .slide-3 .slide-title { color: #1f3e0bff; }
  .slide-3 .slide-sub { color: #2D5016; }
  .slide-3 .btn-slide { background: #2D5016; }
  .slide-3 .btn-slide:hover { background: #4e7434ff;}

  .slide-title em { font-style: italic; color: var(--primary-deeper); }
  .slide-sub { font-size: 15px; color: var(--text-secondary); margin-bottom: 28px; max-width: 380px; line-height: 1.6; }

  /* Tombol CTA di dalam slide */
  .btn-slide {
    background: var(--text); color: white; border: none;
    padding: 12px 32px; border-radius: 100px;
    font-family: 'Poppins', sans-serif; font-size: 14px; font-weight: 600;
    cursor: pointer; transition: all 0.2s; letter-spacing: 0.3px;
  }
  .btn-slide:hover { background: var(--primary-deeper); transform: translateY(-1px); }

  /* Gambar bulat di kanan slide */
  .slide-img-area {
    position: absolute; right: 6%; top: 50%; transform: translateY(-50%);
    width: 380px; height: 420px;
    display: flex; align-items: center; justify-content: center;
    border-radius: 500000px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
    filter: brightness(0.95) blur(0px);
  }
  .slide-img-area .placeholder-icon { font-size: 60px; }

  /* Dot navigasi slider di bawah tengah */
  .slider-nav {
    position: absolute; bottom: 20px; left: 50%; transform: translateX(-50%);
    display: flex; gap: 8px; z-index: 10;
  }
  .dot { width: 8px; height: 8px; border-radius: 100px; background: rgba(93,57,59,0.25); cursor: pointer; transition: all 0.3s; }
  .dot.active { background: var(--text); width: 24px; }

  /* Tombol panah kiri/kanan slider */
  .slider-arrow {
    position: absolute; top: 50%; transform: translateY(-50%);
    background: none; border: none; cursor: pointer; z-index: 10; transition: all 0.2s; padding: 0;
  }
  .slider-arrow:hover { transform: translateY(-50%) scale(1.1); }
  .arrow-left { left: 25px; }
  .arrow-right { right: 25px; }

  /* ==========================================
     TRUST BAR
     3 card statistik di bawah hero slider
     Grid 3 kolom
     ========================================== */
  .trust-bar {
    display: grid; grid-template-columns: repeat(3, 1fr);
    gap: 20px; padding: 32px 48px;
    background: white; margin: 0px 48px;
  }
  .trust-icon { font-size: 28px; color: var(--primary-deeper); font-weight: 700; }
  .trust-item {
    display: flex; align-items: center; gap: 14px;
    padding: 20px 32px; border-right: 1px solid var(--border); font-size: 13px;
  }
  .trust-item:last-child { border-right: none; }
  .trust-sub { color: var(--text-secondary); font-size: 11px; }

  /* ==========================================
     CATEGORY GRID
     Grid kategori produk: 3 kolom
     Hover menampilkan label & sub-label di atas foto
     Diklik redirect ke halaman login
     ========================================== */
  .section { padding: 60px 20px }
  .section-heading {
    text-align: center; font-size: 20px; font-weight: 800;
    letter-spacing: 3px; text-transform: uppercase;
    color: #854060; margin-bottom: 32px;
  }
  .category-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 14px; width: 100%; }

  /* Card kategori: foto background + overlay hover */
  .category-card {
    position: relative; overflow: hidden; border-radius: 16px; max-height: unset;
    aspect-ratio: 16/9; cursor: pointer; background: var(--surface);
    display: flex; align-items: center; justify-content: center;
    flex-direction: column; gap: 8px;
    border: 1px solid var(--border); transition: transform 0.3s, box-shadow 0.3s;
  }
  .category-card img {
    width: 100%; height: 100%; object-fit: cover;
    position: absolute; inset: 0; max-height: unset;
  }
  .category-card:hover { transform: translateY(-4px); box-shadow: 0 16px 40px rgba(255,187,192,0.3); }

  /* Card lebar 2 kolom untuk kategori "Isi Ulang & Daur Ulang" */
  .category-card.wide { aspect-ratio: 16/9; max-height: unset; grid-column: span 2; aspect-ratio: unset; min-height: unset; }

  .category-icon { font-size: 52px; }
  .category-label { font-size: 13px; font-weight: 600; color: var(--text); letter-spacing: 0.5px; }
  .category-sub { font-size: 11px; color: var(--text-secondary); }

  /* Overlay gelap saat hover */
  .category-overlay { position: absolute; inset: 0; background: rgba(93,57,59,0); transition: background 0.3s; border-radius: 16px; }
  .category-card:hover .category-overlay { background: rgba(93,57,59,0.04); }

  /* Label teks yang muncul saat hover menggunakan ::after dan ::before */
  .category-hover-label {
    position: absolute; inset: 0;
    background: rgba(93, 57, 59, 0); color: white;
    font-family: 'Poppins', sans-serif;
    display: flex; flex-direction: column;
    align-items: center; justify-content: center; gap: 30px;
    transition: all 0.3s; border-radius: 16px;
  }
  .category-hover-sub { position: absolute; bottom: 100px; left: 0; right: 0; text-align: center; font-size: 11px; }

  /* Label utama kategori (nama kategori) */
  .category-hover-label::after {
    content: attr(data-label); /* ambil teks dari atribut data-label */
    font-size: 16px; font-weight: 700; letter-spacing: 1px;
    opacity: 0; transition: opacity 0.3s;
  }

  /* Sub-label kategori (jumlah produk) */
  .category-hover-label::before {
    content: attr(data-sub); /* ambil teks dari atribut data-sub */
    font-size: 11px; font-weight: 400;
    opacity: 0; transition: opacity 0.3s; order: 2;
  }
  .category-hover-sub::after { content: attr(data-sub); opacity: 0; transition: opacity 0.3s; color: white; font-size: 11px; }

  /* Overlay muncul saat hover */
  .category-card:hover .category-hover-label { background: rgba(93, 57, 59, 0.45); }
  .category-card:hover .category-hover-label::after,
  .category-card:hover .category-hover-sub::after { opacity: 1; }

  /* ==========================================
     COLLECTION BANNER
     Banner besar di tengah halaman
     Background gambar dari asset
     ========================================== */
  .collection-banner {
    width: 100%; height: 400px;
    background: linear-gradient(135deg, #FFE4E6, #FFBBC0);
    display: flex; align-items: center; justify-content: center;
    flex-direction: column; gap: 8px; position: relative; overflow: hidden;
  }
  .collection-banner::before {
    content: ''; position: absolute; inset: 0;
    background: 
      radial-gradient(circle at 20% 50%, rgba(255,255,255,0.4) 0%, transparent 50%),
      radial-gradient(circle at 80% 20%, rgba(255,187,192,0.5) 0%, transparent 50%);
  }
  .banner-inner { text-align: center; position: relative; z-index: 1; }
  .banner-tag { font-size: 11px; letter-spacing: 3px; text-transform: uppercase; color: var(--primary-deeper); font-weight: 600; margin-bottom: 10px; }
  .banner-title { font-size: 48px; font-weight: 800; color: var(--text); font-style: italic; margin-bottom: 8px; }
  .banner-sub { font-size: 15px; color: #8b5667; margin-bottom: 24px; }
  .btn-banner {
    background: var(--text); color: white; border: none;
    padding: 12px 36px; border-radius: 100px;
    font-family: 'Poppins', sans-serif; font-size: 14px; font-weight: 600;
    cursor: pointer; transition: all 0.2s;
  }
  .btn-banner:hover { background: var(--primary-deeper); transform: translateY(-1px); }
  .banner-placeholder { font-size: 12px; color: var(--text-secondary); margin-top: 8px; }

  /* ==========================================
     PRODUK TERBARU
     Grid 5 kolom produk kosmetik
     Data masih hardcode/dummy
     Semua card diklik redirect ke halaman login
     ========================================== */
  .product-section { padding: 28px 48px 40px 48px; }
  .product-grid { display: grid; grid-template-columns: repeat(5, 1fr); gap: 16px; max-width: 12000px; }
  .section-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; margin-top: 20px; }
  .section-header h2 { font-size: 20px; font-weight: 700; }
  .section-header a { font-size: 13px; color: #e07080; text-decoration: none; font-weight: 500; }

  /* Card tiap produk */
  .product-card {
    flex: 0 0 220px; min-width: 220px; border-radius: 16px; overflow: hidden;
    border: 1.5px solid #f5e0e0; transition: box-shadow 0.2s; background: white; padding: 12px; cursor: pointer;
  }
  .product-card:hover { box-shadow: 0 4px 20px rgba(224,112,128,0.12); }
  .prod-header { display: flex; justify-content: space-between; align-items: baseline; margin-bottom: 24px; }
  .prod-title { font-size: 20px; font-weight: 700; color: #5D393B; }
  .view-all-link {
    font-size: 13px; font-weight: 500; color: #9E7178;
    border-bottom: 1px solid #F0D5D8; padding-bottom: 2px;
    cursor: pointer; transition: all 0.2s; text-decoration: none;
  }
  .view-all-link:hover { color: #5D393B; border-color: #5D393B; }

  /* Gambar produk: aspect ratio 2:3 (portrait) */
  .product-img-wrap img { width: 100%; height: 100%; object-fit: cover; position: absolute; inset: 0; }
  .product-img-wrap {
    position: relative; overflow: hidden; border-radius: 12px; background: transparent;
    aspect-ratio: 2/3; margin-bottom: 14px;
    display: flex; align-items: center; justify-content: center;
    border: 1px solid #F0D5D8; transition: transform 0.3s;
  }
  .product-card:hover .product-img-wrap { transform: scale(1.02); }
  .wishlist-btn:hover { background: white; transform: scale(1.1); }

  /* Tombol "Keranjang" yang muncul dari bawah saat hover */
  .btn-cart-hover {
    position: absolute; bottom: -54px; left: 0; right: 0;
    background: #5D393B; color: white; border: none;
    padding: 16px; font-family: 'Poppins', sans-serif;
    font-size: 12px; font-weight: 600; cursor: pointer;
    transition: bottom 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    letter-spacing: 1.5px; border-radius: 0 0 12px 12px;
    display: flex; align-items: center; justify-content: center; gap: 6px;
  }
  .btn-cart-hover iconify-icon { font-size: 24px; min-width: 18px; min-height: 18px; display: inline-flex; flex-shrink: 0; }
  .product-card:hover .btn-cart-hover { bottom: 0; }

  .p-brand { font-size: 10px; color: #9E7178; margin-bottom: 3px; }
  /* Nama produk: max 2 baris, sisanya dipotong */
  .p-name {
    font-size: 10px; font-weight: 600; color: #5D393B; margin-bottom: 4px; line-height: 1.4;
    display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;
    overflow: hidden; word-break: break-word;
  }
  /* Harga: harga diskon + harga asli dicoret + persentase diskon */
  .p-price { font-size: 13px; font-weight: 700; color: #5D393B; display: flex; flex-wrap: wrap; align-items: center; gap: 4px; }
  .p-original { font-size: 12px; font-weight: 400; color: var(--text-secondary); text-decoration: line-through; margin-left: 6px; }
  .p-discount { font-size: 10px; font-weight: 600; color: #4CAF7D; margin-left: 0; }
  .btn-keranjang:hover { background: #fce4ec; border-color: #f4a0aa; }

  /* ==========================================
     ECO BANNER
     Banner hijau berisi ajakan daur ulang
     + 4 statistik eco (masih hardcode)
     ========================================== */
  .eco-banner {
    margin: 0 48px 60px;
    background: linear-gradient(135deg, #a7e8c5 0%, #dffdeb 50%, #a7e8c5 100%);
    border-radius: 20px; padding: 48px 60px;
    display: grid; grid-template-columns: 1fr 1fr; gap: 48px; align-items: center;
  }
  .eco-title { font-size: 32px; font-weight: 700; color: var(--text); line-height: 1.3; margin-bottom: 14px; }
  .eco-title em { font-style: italic; color: var(--success); }
  .eco-sub { font-size: 15px; color: var(--text-secondary); line-height: 1.7; margin-bottom: 24px; }
  .btn-eco {
    background: var(--success); color: white; border: none;
    padding: 12px 32px; border-radius: 100px;
    font-family: 'Poppins', sans-serif; font-size: 14px; font-weight: 600;
    cursor: pointer; transition: all 0.2s;
  }
  .btn-eco:hover { background: #3d9e6a; transform: translateY(-1px); }

  /* Grid 2x2 statistik eco */
  .eco-stats { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
  .eco-stat { background: white; border-radius: 14px; padding: 20px; text-align: center; border: 1px solid #c8ecd8; }
  .eco-stat-num { font-size: 28px; font-weight: 800; color: var(--success); }
  .eco-stat-label { font-size: 12px; color: var(--text-secondary); }

  /* ==========================================
     FOOTER
     Grid 4 kolom: brand + 3 kolom link
     ========================================== */
  footer { background: var(--surface); border-top: 1px solid var(--border); }
  .footer-inner { display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 48px; padding: 60px 48px 40px; }
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

{{-- Simpan URL login ke variabel $loginUrl supaya bisa dipake berulang di bawah --}}
@php $loginUrl = route('login'); @endphp

{{-- ==========================================
     NAVBAR
     Logo kiri, nav link tengah, tombol Masuk & Daftar kanan
     Semua link mengarah ke halaman login karena ini halaman publik
     ========================================== --}}
<nav>
  <div class="nav-top">
    <div class="nav-left"><img src="{{ asset('images/AYU-NE.png') }}" alt="AYU-NE" class="logo-img"></div>
    <div class="nav-center">
      <ul class="nav-links">
        <li><a href="#slides">Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#produk">Product</a></li>
      </ul>
    </div>
    <div class="nav-right">
      {{-- Tombol Masuk → redirect ke halaman login --}}
      <a href="{{ route('login') }}" class="btn-login">Masuk</a>
      {{-- Tombol Daftar → redirect ke halaman register --}}
      <a href="{{ route('register') }}" class="btn-daftar">Daftar</a>
    </div>
  </div>
</nav>

{{-- ==========================================
     HERO SLIDER
     3 slide dengan tema berbeda:
       Slide 1: Daur Ulang & Ayu Koin (pink)
       Slide 2: Preloved & Jual (peach)
       Slide 3: Eco Beauty & Sirkular (hijau)
     Auto geser tiap 5 detik via setInterval di JS
     ========================================== --}}
<div class="hero-slider">

  {{-- Tombol panah kiri: memanggil prevSlide() --}}
  <button class="slider-arrow arrow-left" onclick="prevSlide()">
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

  {{-- Tombol panah kanan: memanggil nextSlide() --}}
  <button class="slider-arrow arrow-right" onclick="nextSlide()">
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

  {{-- Track slide: digeser pakai transform translateX via JS --}}
  <div class="slides" id="slides">

    {{-- SLIDE 1: Tema daur ulang, background pink --}}
    <div class="slide slide-1">
      <div class="slide-bg"></div>
      <div class="slide-content">
        <div class="slide-label">Daur Ulang • Ayu Koin</div>
        <h1 class="slide-title">Satu Lipstik Dapat<br><em>Selamanya di Bumi.</em></h1>
        <p class="slide-sub">Daur ulang kemasan kosmetikmu dan raih Ayu Koin yang bisa ditukar jadi voucher.</p>
        {{-- CTA redirect ke login --}}
        <a href="{{ $loginUrl }}" class="btn-slide">Daur Ulang Sekarang</a>
      </div>
      {{-- Foto bulat kanan slide --}}
      <div class="slide-img-area">
        <img src="https://images.unsplash.com/photo-1695634543240-882c7ee2c88a?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Slide 1 Image" style="width:100%; height:100%; border-radius:500000px; object-fit:cover;">
      </div>
    </div>

    {{-- SLIDE 2: Tema preloved, background peach --}}
    <div class="slide slide-2">
      <div class="slide-content">
        <div class="slide-label">Preloved • Terverifikasi</div>
        <h1 class="slide-title">Hidupkan Kembali<br><em>Produk Lamamu.</em></h1>
        <p class="slide-sub">Jual kosmetik yang nggak kepake. Beli produk berkualitas dengan harga lebih terjangkau.</p>
        <a href="{{ $loginUrl }}" class="btn-slide">Mulai Jual</a>
      </div>
      <div class="slide-img-area">
        <img src="https://images.unsplash.com/photo-1757990939518-61d786ea1684?q=80&w=658&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Slide 2 Image" style="width:100%; height:100%; border-radius:500000px; object-fit:cover;">
      </div>
    </div>

    {{-- SLIDE 3: Tema eco/hijau, warna teks di-override jadi gelap hijau --}}
    <div class="slide slide-3">
      <div class="slide-content">
        <div class="slide-label">Eco Beauty • Preloved</div>
        <h1 class="slide-title">Selamatkan Bumi<br>Melalui <em>Sirkular</em></h1>
        <p class="slide-sub">Ribuan produk kosmetik preloved tersertifikasi — terjangkau, aman, dan ramah lingkungan.</p>
        {{-- Scroll ke section produk --}}
        <button class="btn-slide" onclick="document.getElementById('produk').scrollIntoView({behavior:'smooth'})">Belanja Sekarang</button>
      </div>
      <div class="slide-img-area">
        <img src="https://plus.unsplash.com/premium_photo-1681154819565-91be109f4fd3?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Slide 1 Image" style="width:100%; height:100%; border-radius:500000px; object-fit:cover;">
      </div>
    </div>
  </div>

  {{-- Dot navigasi: diklik memanggil goSlide(index) --}}
  <div class="slider-nav" id="sliderNav">
    <div class="dot active" onclick="goSlide(0)"></div>
    <div class="dot" onclick="goSlide(1)"></div>
    <div class="dot" onclick="goSlide(2)"></div>
  </div>
</div>

{{-- ==========================================
     TRUST BAR
     3 card statistik tentang masalah sampah kosmetik
     Data masih hardcode
     ========================================== --}}
<div class="trust-bar">
  <div class="trust-item">
    <span class="trust-icon">77%</span>
    <div><div class="trust-title">sampah kosmetik tidak diolah</div><div class="trust-sub">Dikurasi langsung tim AYU-NE</div></div>
  </div>
  <div class="trust-item">
    <span class="trust-icon">82,5%</span>
    <div><div class="trust-title">Tidak tahu cara daur ulang</div><div class="trust-sub">100% secure checkout</div></div>
  </div>
  <div class="trust-item">
    <span class="trust-icon">100%</span>
    <div><div class="trust-title">Komitmen kami untuk bumi</div><div class="trust-sub">Setiap transaksi & daur ulang</div></div>
  </div>
</div>

{{-- ==========================================
     KATEGORI
     5 card kategori produk
     Hover menampilkan nama kategori & jumlah produk
     Diklik redirect ke halaman login
     ========================================== --}}
<div class="section">
  <div class="section-heading">Kategori</div>
  <div class="category-grid">

    {{-- Tiap card: foto + overlay hover + data-label + data-sub --}}
    <div class="category-card" onclick="window.location='{{ $loginUrl }}'">
      <div class="category-overlay"></div>
      <img src="https://images.unsplash.com/photo-1608571423902-eed4a5ad8108?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"/>
      <div class="category-hover-label" data-label="Skincare"></div>
      <div class="category-hover-sub" data-sub="50+ produk"></div>
    </div>

    <div class="category-card" onclick="window.location='{{ $loginUrl }}'">
      <div class="category-overlay"></div>
      <img src="https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9?q=80&w=1187&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"/>
      <div class="category-hover-label" data-label="Makeup"></div>
      <div class="category-hover-sub" data-sub="90+ produk"></div>
    </div>

    <div class="category-card" onclick="window.location='{{ $loginUrl }}'">
      <div class="category-overlay"></div>
      <img src="https://plus.unsplash.com/premium_photo-1677261482580-f133e0e14000?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"/>
      <div class="category-hover-label" data-label="Alat Makeup"></div>
      <div class="category-hover-sub" data-sub="30+ produk"></div>
    </div>

    {{-- Card lebar 2 kolom untuk kategori Daur Ulang --}}
    <div class="category-card wide" onclick="window.location='{{ $loginUrl }}'">
      <div class="category-overlay"></div>
      <img src="https://plus.unsplash.com/premium_photo-1736308936390-d84482f60c10?q=80&w=1074&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"/>
      <div class="category-hover-label" data-label="Isi Ulang & Daur Ulang"></div>
      <div class="category-hover-sub" data-sub="Kontribusi untuk bumi — dapat Ayu Koin!"></div>
    </div>

    <div class="category-card" onclick="window.location='{{ $loginUrl }}'">
      <div class="category-overlay"></div>
      <img src="https://plus.unsplash.com/premium_photo-1683842190248-5530320b8cab?q=80&w=784&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"/>
      <div class="category-hover-label" data-label="Terverifikasi"></div>
      <div class="category-hover-sub" data-sub="Jaminan kualitas"></div>
    </div>
  </div>
</div>

{{-- ==========================================
     COLLECTION BANNER
     Banner besar dengan gambar background dari asset lokal
     Tombol scroll ke section produk di bawah
     ========================================== --}}
<div class="collection-banner" style="background-image: url('{{ asset('images/banner1.png') }}'); background-size: cover; background-position: center;">
  <div class="banner-inner">
    <div class="banner-tag">Koleksi Pilihan</div>
    <div class="banner-title">Ayu Belanja</div>
    <div class="banner-sub">Preloved kosmetik berkualitas, harga bersahabat, Bumi lebih bahagia.</div>
    {{-- Scroll smooth ke section produk --}}
    <button class="btn-banner" onclick="document.getElementById('produk').scrollIntoView({behavior:'smooth'})">Lihat Koleksi</button>
  </div>
</div>

{{-- ==========================================
     PRODUK TERBARU
     Data masih hardcode/dummy
     Semua card & tombol keranjang redirect ke login
     TODO: sambungkan ke database produk
     ========================================== --}}
<div class="product-section" id="produk">
    <div class="prod-header">
        <div class="prod-title">Produk Terbaru 🌸</div>
        {{-- "Lihat Semua" redirect ke login --}}
        <a href="{{ route('login') }}" class="view-all-link">Lihat Semua →</a>
    </div>

    <div class="product-grid">

        {{-- Tiap card: diklik redirect ke login, tombol keranjang juga ke login --}}
        <div class="product-card" onclick="window.location='{{ route('login') }}'">
            <div class="product-img-wrap">
                <img src="https://images.unsplash.com/photo-1580870069867-74c57ee1bb07?w=400"/>
                {{-- event.stopPropagation() biar klik tombol ga trigger klik card juga --}}
                <button class="btn-cart-hover" onclick="event.stopPropagation(); window.location='{{ route('login') }}'">
                    <iconify-icon icon="mynaui:cart"></iconify-icon> KERANJANG
                </button>
            </div>
            <div class="p-brand">Some By Mi</div>
            <div class="p-name">AHA BHA PHA 30 Days Miracle Toner</div>
            <div class="p-price">Rp 89.000<span class="p-original">Rp 185.000</span><span class="p-discount">-52%</span></div>
        </div>

        <div class="product-card" onclick="window.location='{{ route('login') }}'">
            <div class="product-img-wrap">
                <img src="https://images.unsplash.com/photo-1586495777744-4413f21062fa?w=400"/>
                <button class="btn-cart-hover" onclick="event.stopPropagation(); window.location='{{ route('login') }}'">
                    <iconify-icon icon="mynaui:cart"></iconify-icon> KERANJANG
                </button>
            </div>
            <div class="p-brand">Wardah</div>
            <div class="p-name">Exclusive Matte Lip Cream No. 06</div>
            <div class="p-price">Rp 35.000<span class="p-original">Rp 75.000</span><span class="p-discount">-53%</span></div>
        </div>

        <div class="product-card" onclick="window.location='{{ route('login') }}'">
            <div class="product-img-wrap">
                <img src="https://plus.unsplash.com/premium_photo-1670514094627-9ed5a1e9c06f?w=400"/>
                <button class="btn-cart-hover" onclick="event.stopPropagation(); window.location='{{ route('login') }}'">
                    <iconify-icon icon="mynaui:cart"></iconify-icon> KERANJANG
                </button>
            </div>
            <div class="p-brand">The Ordinary</div>
            <div class="p-name">Niacinamide 10% + Zinc 1% Serum</div>
            <div class="p-price">Rp 110.000<span class="p-original">Rp 220.000</span><span class="p-discount">-50%</span></div>
        </div>

        <div class="product-card" onclick="window.location='{{ route('login') }}'">
            <div class="product-img-wrap">
                <img src="https://plus.unsplash.com/premium_photo-1677175230595-87f8721ff703?w=400"/>
                <button class="btn-cart-hover" onclick="event.stopPropagation(); window.location='{{ route('login') }}'">
                    <iconify-icon icon="mynaui:cart"></iconify-icon> KERANJANG
                </button>
            </div>
            <div class="p-brand">Maybelline</div>
            <div class="p-name">Fit Me Matte + Poreless Foundation</div>
            <div class="p-price">Rp 65.000<span class="p-original">Rp 130.000</span><span class="p-discount">-50%</span></div>
        </div>

        <div class="product-card" onclick="window.location='{{ route('login') }}'">
            <div class="product-img-wrap">
                <img src="https://images.unsplash.com/photo-1688614585803-0c00bde3828d?w=400"/>
                <button class="btn-cart-hover" onclick="event.stopPropagation(); window.location='{{ route('login') }}'">
                    <iconify-icon icon="mynaui:cart"></iconify-icon> KERANJANG
                </button>
            </div>
            <div class="p-brand">Emina</div>
            <div class="p-name">Emina Bright Stuff Face Wash</div>
            <div class="p-price">Rp 15.000<span class="p-original">Rp 32.000</span><span class="p-discount">-53%</span></div>
        </div>
    </div>
</div>

{{-- ==========================================
     ECO BANNER
     Banner hijau berisi ajakan daur ulang
     4 statistik eco (masih hardcode)
     Tombol redirect ke login
     ========================================== --}}
<div class="eco-banner">
  <div>
    <h2 class="eco-title">Daur ulang sekarang,<br>bumi berterima kasih <em>padamu.</em></h2>
    <p class="eco-sub">Kirim kemasan kosmetik kosong ke drop-off point terdekat dan dapatkan Ayu Koin yang bisa ditukar jadi voucher belanja.</p>
    <a href="{{ $loginUrl }}" class="btn-eco">Mulai Daur Ulang</a>
  </div>
  {{-- Grid 2x2 statistik eco (masih hardcode) --}}
  <div class="eco-stats">
    <div class="eco-stat"><div class="eco-stat-num">3.2T</div><div class="eco-stat-label">Kemasan Didaur Ulang</div></div>
    <div class="eco-stat"><div class="eco-stat-num">8.5K</div><div class="eco-stat-label">Pengguna Aktif</div></div>
    <div class="eco-stat"><div class="eco-stat-num">120+</div><div class="eco-stat-label">Titik Drop-Off</div></div>
    <div class="eco-stat"><div class="eco-stat-num">1.2M</div><div class="eco-stat-label">Ayu Koin Dibagikan</div></div>
  </div>
</div>

{{-- ==========================================
     FOOTER
     Grid 4 kolom: brand description + 3 kolom link
     ========================================== --}}
<footer>
  <div class="footer-inner">
    <div class="footer-brand">
      <div class="f-logo"><img src="{{ asset('images/AYU-NE.png') }}" alt="AYU-NE" class="logo-img-sm"></div>
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

</div>
</div>

<script>
  // ==========================================
  // HERO SLIDER
  // Variabel untuk ngatur posisi slide aktif
  // ==========================================

  let current = 0;  // index slide yang sedang ditampilkan
  const total = 3;  // total jumlah slide

  // Fungsi update posisi slider + dot aktif
  function updateSlider() {
    document.getElementById('slides').style.transform = `translateX(-${current * 100}%)`; // geser track
    document.querySelectorAll('.dot').forEach((d, i) => d.classList.toggle('active', i === current)); // update dot
  }

  // Fungsi lanjut ke slide berikutnya (dipanggil otomatis + klik panah kanan)
  function nextSlide() { current = (current + 1) % total; updateSlider(); }

  // Fungsi balik ke slide sebelumnya (dipanggil klik panah kiri)
  function prevSlide() { current = (current - 1 + total) % total; updateSlider(); }

  // Fungsi pindah ke slide tertentu (dipanggil klik dot)
  function goSlide(i) { current = i; updateSlider(); }

  // Auto geser tiap 5 detik
  setInterval(nextSlide, 5000);
</script>
</body>
</html>