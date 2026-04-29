<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.iconify.design/iconify-icon/2.1.0/iconify-icon.min.js"></script>
    <title>Detail Produk - AYU-NE</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,600&family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }

        body {
            background: linear-gradient(180deg, #ffe8ed 0%, #fff5f5 50%, #ffe8ed 100%);
            color: #3b1a1a;
        }
    
        /* ── BREADCRUMB ── */
        .breadcrumb { padding: 14px 50px; display: flex; align-items: center; gap: 8px; font-size: 12px; color: #9E7178; }
        .breadcrumb a { color: #9E7178; text-decoration: none; transition: color 0.2s; }
        .breadcrumb a:hover { color: #e07080; }
        .breadcrumb .current { color: #5D393B; font-weight: 600; }

        /* ── LAYOUT ── */
        .content { padding: 0 50px 60px; display: flex; gap: 48px; align-items: flex-start; }

        /* ── KIRI: GAMBAR ── */
        .img-left { width: 420px; flex-shrink: 0; position: sticky; top: 30px; animation: fadeInLeft 0.45s ease both; padding-top: 20px; }

        @keyframes fadeInLeft  { from{opacity:0;transform:translateX(-16px)} to{opacity:1;transform:translateX(0)} }
        @keyframes fadeInRight { from{opacity:0;transform:translateX(16px)}  to{opacity:1;transform:translateX(0)} }

        .main-img {
            width: 100%; height: 460px;
            background: linear-gradient(145deg, #FFF0F4, #FFE4EC);
            border-radius: 20px; overflow: hidden;
            position: relative; margin-bottom: 14px;
            border: 1.5px solid #F0D5D8;
        }
        .main-img img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s ease; }
        .main-img:hover img { transform: scale(1.04); }

        .badge-v-img {
            position: absolute; top: 14px; left: 14px;
            background: #FFBBC0; color: #5D393B;
            font-size: 10px; font-weight: 700;
            padding: 4px 12px; border-radius: 100px; z-index: 2;
        }

        .thumb-row { display: flex; gap: 10px; }
        .thumb {
            flex: 1; height: 82px; border-radius: 12px;
            overflow: hidden; background: linear-gradient(145deg, #FFF0F4, #FFE4EC);
            border: 2px solid #F0D5D8; cursor: pointer; transition: all 0.2s;
        }
        .thumb img { width: 100%; height: 100%; object-fit: cover; }
        .thumb:hover { border-color: #FFBBC0; transform: translateY(-2px); }
        .thumb.active { border-color: #e07080; }

        /* ── KANAN: INFO ── */
        .info-right { flex: 1; padding-top: 4px; animation: fadeInRight 0.45s ease 0.1s both; }

        .top-row { display: flex; align-items: center; justify-content: space-between; margin-bottom: 14px; }

        .tag-verified { display: inline-flex; align-items: center; gap: 6px; background: #FFBBC0; color: #5D393B; font-size: 11px; font-weight: 700; padding: 5px 14px; border-radius: 100px; }

        .product-brand { font-size: 11px; color: #9E7178; text-transform: uppercase; letter-spacing: 0.1em; font-weight: 600; margin-bottom: 8px; }
        .product-name  { font-family: 'Poppins', sans-serif; font-size: 22px; font-weight: 800; color: #2A1520; margin-bottom: 14px; line-height: 1.3; }

        /* Rating */
        .rating-row { display: flex; align-items: center; gap: 10px; margin-bottom: 18px; flex-wrap: wrap; }
        .stars { display: flex; gap: 2px; }
        .star { font-size: 14px; color: #F5C842; }
        .star.empty { color: #F0D5D8; }
        .rating-num  { font-size: 13px; font-weight: 700; color: #5D393B; }
        .rating-sep  { width: 1px; height: 14px; background: #F0D5D8; }
        .rating-info { font-size: 12px; color: #9E7178; }

        /* ── HARGA — tanpa kotak, warna merah soft ── */
        .price-row {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }
        .price-now  { font-size: 26px; font-weight: 800; color: #e07080; }
        .price-old  { font-size: 14px; color: #9E7178; text-decoration: line-through; font-weight: 400; }
        .price-disc { background: #ffe8ed; color: #65d3a5; font-size: 11px; font-weight: 700; padding: 3px 10px; border-radius: 100px; }

        /* Divider */
        .divider { border: none; border-top: 1.5px solid #F0D5D8; margin: 20px 0; }

        .section-label { font-size: 13px; font-weight: 700; color: #5D393B; margin-bottom: 10px; display: flex; align-items: center; gap: 7px; }

        .kondisi-desc { font-size: 13px; color: #7a4a4a; line-height: 1.7; margin-bottom: 14px; }

        /* Detail Grid — efek timbul saat hover */
        .detail-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }

        .detail-item {
            background: white;
            border: 1.5px solid #F0D5D8;
            border-radius: 12px;
            padding: 12px 16px;
            transition: all 0.2s;
        }
        .detail-item:hover {
            box-shadow: 0 6px 18px rgba(184,92,101,0.13);
            border-color: #FFBBC0;
            transform: translateY(-2px);
        }

        .detail-key { font-size: 10px; color: #9E7178; text-transform: uppercase; letter-spacing: 0.06em; font-weight: 600; margin-bottom: 4px; }
        .detail-val { font-size: 13px; font-weight: 600; color: #5D393B; }

        /* Kualitas */
        .kualitas-section { margin: 18px 0; background: white; border: 1.5px solid #F0D5D8; border-radius: 14px; padding: 14px 16px; }
        .kualitas-top     { display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px; }
        .kualitas-title   { font-size: 12px; font-weight: 700; color: #5D393B; display: flex; align-items: center; gap: 6px; }
        .kualitas-persen  { font-size: 20px; font-weight: 800; color: #5D393B; }
        .kualitas-bar     { height: 10px; background: #F0D5D8; border-radius: 99px; overflow: hidden; margin-bottom: 8px; }
        .kualitas-fill    { height: 100%; border-radius: 99px; transition: width 1s ease; }
        .kualitas-fill.high   { background: linear-gradient(90deg, #4CAF7D, #81C784); }
        .kualitas-fill.medium { background: linear-gradient(90deg, #F5A623, #FFD54F); }
        .kualitas-fill.low    { background: linear-gradient(90deg, #e07080, #f5a5b6); }
        .kualitas-note        { font-size: 11px; color: #9E7178; }
        .kualitas-note.high   { color: #4CAF7D; font-weight: 600; }
        .kualitas-note.medium { color: #F5A623; font-weight: 600; }
        .kualitas-note.low    { color: #e07080; font-weight: 600; }

        /* Penjual */
        .seller-box { background: white; border: 1.5px solid #F0D5D8; border-radius: 16px; padding: 16px 18px; display: flex; align-items: center; justify-content: space-between; }
        .seller-left { display: flex; align-items: center; gap: 12px; }
        .seller-avatar { width: 44px; height: 44px; border-radius: 50%; background: linear-gradient(135deg, #FFBBC0, #e07080); display: flex; align-items: center; justify-content: center; font-size: 18px; font-weight: 700; color: white; flex-shrink: 0; }
        .seller-name  { font-size: 14px; font-weight: 700; color: #3b1a1a; margin-bottom: 3px; }
        .seller-meta  { display: flex; align-items: center; gap: 5px; flex-wrap: wrap; }
        .seller-stars { font-size: 12px; color: #F5C842; }
        .seller-info  { font-size: 11px; color: #9E7178; }
        .seller-badge { font-size: 10px; color: #4CAF7D; background: #e8f5e9; padding: 2px 8px; border-radius: 100px; font-weight: 600; }
        .btn-chat { display: flex; align-items: center; gap: 7px; padding: 10px 18px; border: 1.5px solid #F0D5D8; border-radius: 100px; background: white; font-size: 12px; font-weight: 600; color: #5D393B; cursor: pointer; font-family: 'Poppins', sans-serif; transition: all 0.2s; text-decoration: none; white-space: nowrap; }
        .btn-chat:hover { background: #FFF0F3; border-color: #FFBBC0; color: #e07080; }

        /* Tombol Aksi */
        .action-buttons { display: flex; gap: 12px; margin-top: 20px; }
        .btn-keranjang { flex: 1; padding: 14px; border: 2px solid #F0D5D8; border-radius: 100px; background: white; font-size: 13px; font-weight: 700; color: #5D393B; cursor: pointer; font-family: 'Poppins', sans-serif; transition: all 0.2s; text-decoration: none; text-align: center; display: flex; align-items: center; justify-content: center; gap: 8px; }
        .btn-keranjang:hover { background: #FFF0F3; border-color: #FFBBC0; color: #e07080; }
        .btn-beli { flex: 1; padding: 14px; background: #e07080; border: none; border-radius: 100px; font-size: 13px; font-weight: 700; color: white; cursor: pointer; font-family: 'Poppins', sans-serif; text-decoration: none; text-align: center; display: flex; align-items: center; justify-content: center; gap: 8px; box-shadow: 0 4px 16px rgba(224,112,128,0.35); transition: all 0.2s; }
        .btn-beli:hover { background: #c85070; transform: translateY(-1px); box-shadow: 0 6px 20px rgba(224,112,128,0.45); }

        .safe-note { display: flex; align-items: center; justify-content: center; gap: 6px; font-size: 11px; color: #9E7178; margin-top: 12px; }

        /* Toast */
        .toast { position: fixed; bottom: 28px; left: 50%; transform: translateX(-50%) translateY(90px); background: #3b1a1a; color: white; padding: 13px 26px; border-radius: 100px; font-size: 13px; font-weight: 500; z-index: 999; box-shadow: 0 8px 28px rgba(0,0,0,0.2); transition: transform 0.4s cubic-bezier(0.34,1.48,0.64,1); white-space: nowrap; }
        .toast.show { transform: translateX(-50%) translateY(0); }

    </style>
</head>
<body>

<div class="toast" id="toast"></div>

{{-- Navbar diambil dari file layouts/navigation.blade.php --}}
@include('layouts.navigation')

<!-- BREADCRUMB -->
<div class="breadcrumb">
    <a href="{{ route('dashboard') }}">Home</a>
    <span>›</span>
    <a href="{{ route('ayu-belanja') }}">Ayu Belanja</a>
    <span>›</span>
    <a href="{{ route('ayu-belanja') }}">Skincare</a>
    <span>›</span>
    <span class="current">{{ $product->nama_produk }}</span>
</div>

<!-- KONTEN -->
<div class="content">

    <!-- KIRI: GAMBAR -->
    <div class="img-left">
        <div class="main-img">
            <span class="badge-v-img">✓ Verified</span>
            @if(str_starts_with($product->foto, 'http'))
                <img id="mainImgEl" src="{{ $product->foto }}" alt="{{ $product->nama_produk }}">
            @else
                <img id="mainImgEl" src="{{ asset('storage/' . $product->foto) }}" alt="{{ $product->nama_produk }}">
            @endif
        </div>
    </div>

    <!-- KANAN: INFO -->
    <div class="info-right">

        <div class="top-row">
            <span class="tag-verified">✓ Terverifikasi</span>
        </div>

        <div class="product-brand">{{ $product->brand ?? strtoupper($product->kategori) }}</div>
        <div class="product-name">{{ $product->nama_produk }}</div>

        <div class="rating-row">
            <div class="stars">
                <span class="star">★</span><span class="star">★</span>
                <span class="star">★</span><span class="star">★</span>
                <span class="star empty">★</span>
            </div>
            <span class="rating-num">4.0</span>
            <div class="rating-sep"></div>
            <span class="rating-info">Rating Penjual</span>
        </div>

        @php
            $diskon = $product->harga_asli ? round(($product->harga_asli - $product->harga) / $product->harga_asli * 100) : 0;
        @endphp
        <div class="price-row">
            <span class="price-now">Rp {{ number_format($product->harga, 0, ',', '.') }}</span>
            @if($product->harga_asli)
                <span class="price-old">Rp {{ number_format($product->harga_asli, 0, ',', '.') }}</span>
                <span class="price-disc">-{{ $diskon }}%</span>
            @endif
        </div>

        <hr class="divider">

        <div class="section-label">
            <iconify-icon icon="fluent:clipboard-task-list-rtl-20-regular" width="16"></iconify-icon>
            Kondisi Produk
        </div>

        <div class="kondisi-desc">
            {{ $product->deskripsi }}
        </div>

        <!-- DETAIL GRID — efek tekan pink soft -->
        <div class="detail-grid">
            <div class="detail-item">
                <div class="detail-key">Kondisi</div>
                <div class="detail-val">{{ ucfirst($product->kondisi) }}</div>
            </div>
            <div class="detail-item">
                <div class="detail-key">Kategori</div>
                <div class="detail-val">{{ ucfirst($product->kategori) }}</div>
            </div>
        </div>

        <!-- KUALITAS -->
        <div class="kualitas-section">
            <div class="kualitas-top">
                <div class="kualitas-title">
                    <iconify-icon icon="ph:drop-half-bottom-bold" width="14" style="color:#4CAF7D;"></iconify-icon>
                    Kualitas Produk
                </div>
                <span class="kualitas-persen">80%</span>
            </div>
            <div class="kualitas-bar">
                <div class="kualitas-fill high" style="width:80%;"></div>
            </div>
            <div class="kualitas-note high">Kondisi sangat baik</div>
        </div>

        <hr class="divider">

        <div class="section-label">
            <iconify-icon icon="ph:storefront-bold" width="16"></iconify-icon>
            Info Penjual
        </div>

        <div class="seller-box">
            <div class="seller-left">
                <div class="seller-avatar">S</div>
                <div>
                    <div class="seller-name">Sarah Beauty Store</div>
                    <div class="seller-meta">
                        <span class="seller-stars">★★★★☆</span>
                        <span class="seller-info">(4.0) · 120 produk</span>
                        <span class="seller-badge">✓ Terpercaya</span>
                    </div>
                </div>
            </div>
            <a href="{{ route('chat-penjual') }}" class="btn-chat">
                <iconify-icon icon="ph:chat-circle-dots-bold" width="14"></iconify-icon>
                Chat Penjual
            </a>
        </div>

        <div class="action-buttons">
            <button class="btn-keranjang" onclick="tambahKeKeranjang({{ $product->id }})">
                <iconify-icon icon="mynaui:cart" width="17"></iconify-icon>
                Tambah ke Keranjang
            </button>
            <a href="{{ route('checkout', ['direct' => $product->id]) }}" class="btn-beli">
                <iconify-icon icon="fluent:shopping-bag-48-filled" width="17"></iconify-icon>
                Beli Sekarang
            </a>
        </div>

        <div class="safe-note">
            🔒 Pembayaran aman & produk terverifikasi oleh AYU-NE
        </div>

    </div>
</div>

<script>
    function changeImg(thumb, url) {
        document.querySelectorAll('.thumb').forEach(t => t.classList.remove('active'));
        thumb.classList.add('active');
        const img = document.getElementById('mainImgEl');
        img.style.opacity = '0'; img.style.transform = 'scale(0.97)'; img.style.transition = 'all 0.15s ease';
        setTimeout(() => { img.src = url; img.style.opacity = '1'; img.style.transform = 'scale(1)'; }, 150);
    }

    function toggleWishlist() {
        const btn = document.getElementById('wishlistBtn');
        const wished = btn.textContent.trim() === '❤️';
        btn.textContent = wished ? '🤍' : '❤️';
        btn.style.transform = 'scale(1.3)';
        setTimeout(() => btn.style.transform = '', 200);
        showToast(wished ? '💔 Dihapus dari wishlist' : '❤️ Ditambahkan ke wishlist!');
    }

    function showToast(msg) {
        const t = document.getElementById('toast');
        t.textContent = msg; t.classList.add('show');
        clearTimeout(t._timer); t._timer = setTimeout(() => t.classList.remove('show'), 2800);
    }

    function tambahKeKeranjang(productId) {
        fetch('{{ route("cart.store") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
            },
            body: JSON.stringify({ product_id: productId, quantity: 1 }),
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                showToast('🛒 ' + data.message);
            } else {
                showToast('❌ Gagal menambahkan ke keranjang');
            }
        })
        .catch(() => showToast('❌ Terjadi kesalahan'));
    }
</script>
</body>
</html>