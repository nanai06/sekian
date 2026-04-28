<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.iconify.design/iconify-icon/2.1.0/iconify-icon.min.js"></script>
    <title>Ayu Belanja - AYU-NE</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }

        body {
            background: linear-gradient(180deg, #ffe8ed 0%, #fff5f5 50%, #ffe8ed 100%);
            color: #3b1a1a;
        }

        
        /* ── BANNER ── */
        .banner-section { position: relative; padding: 24px 40px 0 40px; }
        .banner-wrapper { position: relative; border-radius: 20px; overflow: hidden; height: 320px; width: 100%; }
        .banner-slide {
            min-width: 100%;
            height: 100%;
            background-size: cover;      /* ← biar foto ngepas/fit */
            background-position: center; /* ← biar foto centered */
            background-repeat: no-repeat;
            flex-shrink: 0;
        }
        .banner-slide.active { display: flex; }
        .banner-content { position: absolute; z-index: 2; left: 8%; bottom: 32px; max-width: 440px; }
        .banner-slides-track {
            display: flex;
            height: 100%;
            transition: transform 0.6s cubic-bezier(.77,0,.175,1); /* TAMBAHIN INI */
        }
        .banner-cta { display: inline-flex; align-items: center; background: #5D393B; color: white; font-size: 13px; font-weight: 600; padding: 10px 26px; border-radius: 100px; text-decoration: none; letter-spacing: 0.3px; transition: all 0.2s; }
        .banner-cta:hover { background: #b85c65 !important; color: white !important; transform: translateY(-1px); }
        .banner-arrow { position: absolute; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; z-index: 10; transition: all 0.2s; padding: 0; }
        .banner-arrow:hover { transform: translateY(-50%) scale(1.1); }
        .banner-arrow.left  { left: 20px; }
        .banner-arrow.right { right: 20px; }
        .banner-dots { position: absolute; bottom: 20px; left: 50%; transform: translateX(-50%); display: flex; gap: 8px; z-index: 5; }
        .banner-dot { width: 8px; height: 8px; border-radius: 100px; background: rgba(93,57,59,0.25); cursor: pointer; transition: all 0.3s; }
        .banner-dot.active { background: #5D393B; width: 24px; }

        /* ── HERO FEATURES — iconify icons ── */
        .hero-features { display: flex; gap: 16px; padding: 16px 40px 0 40px; }
        .feature-card { flex: 1; background: white; border: 1px solid #F0D5D8; border-radius: 16px; padding: 16px 20px; display: flex; align-items: center; gap: 14px; box-shadow: 0 2px 12px rgba(184,92,101,0.06); transition: all 0.2s; }
        .feature-card:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(184,92,101,0.12); border-color: #FFBBC0; }
        .feature-icon { width: 42px; height: 42px; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .feature-icon.green  { background: #e8f5e9; }
        .feature-icon.blue   { background: #e3f0fd; }
        .feature-icon.yellow { background: #fef6df; }
        .feature-text-title { font-size: 13px; font-weight: 700; color: #5D393B; margin-bottom: 2px; }
        .feature-text-sub   { font-size: 11px; color: #9E7178; }

        /* ── FILTER BAR ── */
        .filter-bar { background: white; border-bottom: 1px solid #f5e0e0; padding: 0 50px; display: flex; align-items: center; justify-content: space-between; height: 56px; gap: 16px; position: sticky; top: 75px; z-index: 99; box-shadow: 0 2px 8px rgba(184,92,101,0.04); margin-top: 16px; }
        .filter-tabs { display: flex; height: 100%; align-items: center; }
        .tab { padding: 0 18px; height: 100%; display: flex; align-items: center; gap: 7px; font-size: 12.5px; font-weight: 500; color: #9E7178; cursor: pointer; border-bottom: 2px solid transparent; transition: all 0.22s; white-space: nowrap; user-select: none; }
        .tab:hover { color: #5D393B; }
        .tab.active { color: #e07080; font-weight: 700; border-bottom-color: #e07080; }
        .tab-badge { background: #fff0f3; color: #e07080; font-size: 10px; font-weight: 700; padding: 2px 8px; border-radius: 100px; transition: all 0.22s; }
        .tab.active .tab-badge { background: #e07080; color: white; }
        .filter-right { display: flex; align-items: center; gap: 12px; }
        .toggle-wrap { display: flex; align-items: center; gap: 8px; font-size: 12px; font-weight: 500; color: #7a4a4a; cursor: pointer; white-space: nowrap; }
        .toggle { position: relative; width: 38px; height: 21px; }
        .toggle input { opacity: 0; width: 0; height: 0; }
        .toggle-slider { position: absolute; inset: 0; background: #f5e0e0; border-radius: 100px; transition: 0.3s; cursor: pointer; }
        .toggle-slider::before { content: ""; position: absolute; width: 15px; height: 15px; left: 3px; top: 3px; background: white; border-radius: 50%; transition: 0.3s; box-shadow: 0 1px 4px rgba(0,0,0,0.15); }
        .toggle input:checked + .toggle-slider { background: #e07080; }
        .toggle input:checked + .toggle-slider::before { transform: translateX(17px); }
        .sort-btn { display: flex; align-items: center; gap: 6px; padding: 8px 18px; border: 1px solid #f5e0e0; border-radius: 100px; font-size: 12px; font-weight: 600; color: #7a4a4a; background: white; cursor: pointer; font-family: 'Poppins', sans-serif; transition: all 0.2s; }
        .sort-btn:hover { border-color: #FFBBC0; color: #e07080; background: #fff5f7; }

        /* ── PRODUCTS ── */
        .products-section { padding: 28px 50px 60px; }
        .prod-header { display: flex; justify-content: space-between; align-items: baseline; margin-bottom: 22px; }
        .prod-title { font-size: 20px; font-weight: 700; color: #5D393B; }
        .prod-meta { display: flex; align-items: center; gap: 16px; }
        .products-count { font-size: 11px; font-weight: 600; color: #9E7178; letter-spacing: 0.06em; text-transform: uppercase; }
        .product-grid { display: grid; grid-template-columns: repeat(5, 1fr); gap: 16px; }

        /* ── PRODUCT CARD ── */
        .product-card { border-radius: 16px; overflow: hidden; border: 1.5px solid #f5e0e0; background: white; cursor: pointer; padding: 12px; transition: all 0.3s; animation: cardIn 0.5s ease both; text-decoration: none; display: block; color: inherit; }
        .product-card:hover { box-shadow: 0 4px 20px rgba(224,112,128,0.12); transform: translateY(-3px); border-color: #FFBBC0; }
        @keyframes cardIn { from{opacity:0;transform:translateY(24px)} to{opacity:1;transform:translateY(0)} }
        .product-card:nth-child(1){animation-delay:0.04s} .product-card:nth-child(2){animation-delay:0.08s}
        .product-card:nth-child(3){animation-delay:0.12s} .product-card:nth-child(4){animation-delay:0.16s}
        .product-card:nth-child(5){animation-delay:0.20s} .product-card:nth-child(6){animation-delay:0.24s}
        .product-card:nth-child(7){animation-delay:0.28s} .product-card:nth-child(8){animation-delay:0.32s}

        .product-img-wrap { position: relative; overflow: hidden; border-radius: 12px; aspect-ratio: 2/3; margin-bottom: 10px; border: 1px solid #F0D5D8; transition: transform 0.3s; }
        .product-card:hover .product-img-wrap { transform: scale(1.02); }
        .product-img-wrap img { width: 100%; height: 100%; object-fit: cover; position: absolute; inset: 0; }

        /* Hanya Best Seller badge (verified dihapus) */
        .badge-bs {
            position: absolute; top: 10px; left: 10px;
            display: inline-flex; align-items: center; gap: 4px;
            background: #f5a5b6; color: #5D393B;
            font-size: 9px; font-weight: 700; padding: 3px 10px;
            border-radius: 100px; z-index: 3;
        }

        .btn-cart-hover { position: absolute; bottom: -44px; left: 0; right: 0; background: #5D393B; color: white; border: none; padding: 12px; font-family: 'Poppins', sans-serif; font-size: 12px; font-weight: 600; cursor: pointer; transition: bottom 0.3s; letter-spacing: 0.5px; border-radius: 0 0 12px 12px; z-index: 4; }
        .product-card:hover .btn-cart-hover { bottom: 0; }

        .card-body { padding: 4px 2px 2px; }
        .p-brand { font-size: 10px; color: #9E7178; margin-bottom: 3px; font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em; }
        .p-name { font-size: 12px; font-weight: 600; color: #5D393B; margin-bottom: 6px; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; min-height: 34px; }

        /* Rating toko */
        .p-rating { display: flex; align-items: center; gap: 4px; margin-bottom: 8px; }
        .stars { display: flex; gap: 1px; }
        .star { font-size: 11px; color: #F5C842; }
        .star.empty { color: #f5e0e0; }
        .rating-count { font-size: 10px; color: #9E7178; font-weight: 500; }
        .rating-seller-label { font-size: 9px; color: #FFBBC0; font-weight: 600; background: #fff0f3; padding: 1px 6px; border-radius: 100px; }

        .p-price { font-size: 13px; font-weight: 700; color: #e07080; display: flex; flex-wrap: wrap; align-items: center; gap: 4px; margin-bottom: 10px; }
        .p-original { font-size: 11px; color: #9E7178; text-decoration: line-through; font-weight: 400; }
        .p-discount { font-size: 10px; font-weight: 700; color: #e07080; background: #ffe8ed; padding: 2px 6px; border-radius: 100px; }

        .kualitas-row { display: flex; align-items: center; justify-content: space-between; }
        .kualitas-bar { height: 4px; flex: 1; background: #f5e0e0; border-radius: 99px; overflow: hidden; margin-right: 7px; }
        .kualitas-fill { height: 100%; border-radius: 99px; transition: width 0.5s ease; }
        .kualitas-fill.high   { background: #4CAF7D; }
        .kualitas-fill.medium { background: #F5C842; }
        .kualitas-fill.low    { background: #e07080; }
        .kualitas-label { font-size: 10px; color: #9E7178; white-space: nowrap; font-weight: 500; }
        .kualitas-label.low { color: #e07080; font-weight: 700; }

        .product-card.hidden { display: none; }
        .empty-state { grid-column: 1/-1; text-align: center; padding: 70px 20px; color: #9E7178; }

        /* ── TOAST ── */
        .toast { position: fixed; bottom: 28px; left: 50%; transform: translateX(-50%) translateY(90px); background: #3b1a1a; color: white; padding: 13px 26px; border-radius: 100px; font-size: 13px; font-weight: 500; z-index: 999; box-shadow: 0 8px 28px rgba(0,0,0,0.2); transition: transform 0.4s cubic-bezier(0.34,1.48,0.64,1); white-space: nowrap; }
        .toast.show { transform: translateX(-50%) translateY(0); }

        @media (max-width: 1200px) { .product-grid { grid-template-columns: repeat(4,1fr); } }
        @media (max-width: 960px)  { .product-grid { grid-template-columns: repeat(3,1fr); } }
        @media (max-width: 640px)  { .product-grid { grid-template-columns: repeat(2,1fr); } .nav-links { display: none; } }
    </style>
</head>
<body>

<div class="toast" id="toast"></div>

    {{-- Navbar diambil dari file layouts/navigation.blade.php --}}
    @include('layouts.navigation')

<!-- BANNER -->
<div class="banner-section">
    <div class="banner-wrapper">
        <button class="banner-arrow left" onclick="prevBanner()">
            <svg width="52" height="52" viewBox="0 0 52 52" fill="none"><ellipse cx="26" cy="10" rx="7" ry="10" fill="white" opacity="0.5"/><ellipse cx="26" cy="42" rx="7" ry="10" fill="white" opacity="0.5"/><ellipse cx="10" cy="26" rx="10" ry="7" fill="white" opacity="0.5"/><ellipse cx="42" cy="26" rx="10" ry="7" fill="white" opacity="0.5"/><ellipse cx="15" cy="15" rx="7" ry="10" fill="white" opacity="0.5" transform="rotate(-45 15 15)"/><ellipse cx="37" cy="15" rx="7" ry="10" fill="white" opacity="0.5" transform="rotate(45 37 15)"/><ellipse cx="15" cy="37" rx="7" ry="10" fill="white" opacity="0.5" transform="rotate(45 15 37)"/><ellipse cx="37" cy="37" rx="7" ry="10" fill="white" opacity="0.5" transform="rotate(-45 37 37)"/><circle cx="26" cy="26" r="7" fill="white" opacity="0.5"/><path d="M28 20 L20 26 L28 32" stroke="#b85c65" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" fill="none"/></svg>
        </button>

        <div class="banner-slides-track" id="bannerTrack">
        <div class="banner-slide" style="background-image: url('{{ asset('images/banner5.png') }}');"></div>
        <div class="banner-slide" style="background-image: url('{{ asset('images/banner6.png') }}');"></div>
        <div class="banner-slide" style="background-image: url('{{ asset('images/banner7.png') }}');"></div>
        </div>

        <button class="banner-arrow right" onclick="nextBanner()">
            <svg width="52" height="52" viewBox="0 0 52 52" fill="none"><ellipse cx="26" cy="10" rx="7" ry="10" fill="white" opacity="0.5"/><ellipse cx="26" cy="42" rx="7" ry="10" fill="white" opacity="0.5"/><ellipse cx="10" cy="26" rx="10" ry="7" fill="white" opacity="0.5"/><ellipse cx="42" cy="26" rx="10" ry="7" fill="white" opacity="0.5"/><ellipse cx="15" cy="15" rx="7" ry="10" fill="white" opacity="0.5" transform="rotate(-45 15 15)"/><ellipse cx="37" cy="15" rx="7" ry="10" fill="white" opacity="0.5" transform="rotate(45 37 15)"/><ellipse cx="15" cy="37" rx="7" ry="10" fill="white" opacity="0.5" transform="rotate(45 15 37)"/><ellipse cx="37" cy="37" rx="7" ry="10" fill="white" opacity="0.5" transform="rotate(-45 37 37)"/><circle cx="26" cy="26" r="7" fill="white" opacity="0.5"/><path d="M24 20 L32 26 L24 32" stroke="#b85c65" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" fill="none"/></svg>
        </button>

        <div class="banner-dots">
            <div class="banner-dot active" onclick="goBanner(0)"></div>
            <div class="banner-dot" onclick="goBanner(1)"></div>
            <div class="banner-dot" onclick="goBanner(2)"></div>
        </div>
    </div>
</div>

<!-- HERO FEATURES — iconify icons -->
<div class="hero-features">
    <div class="feature-card">
        <div class="feature-icon green">
            <iconify-icon icon="ph:seal-check-bold" width="22" style="color:#4CAF7D;"></iconify-icon>
        </div>
        <div>
            <div class="feature-text-title">Terverifikasi</div>
            <div class="feature-text-sub">Setiap produk dicek kualitasnya</div>
        </div>
    </div>
    <div class="feature-card">
        <div class="feature-icon blue">
            <iconify-icon icon="ph:truck-bold" width="22" style="color:#4A90D9;"></iconify-icon>
        </div>
        <div>
            <div class="feature-text-title">Pengiriman Cepat</div>
            <div class="feature-text-sub">Sampai dalam 1–3 hari kerja</div>
        </div>
    </div>
    <div class="feature-card">
        <div class="feature-icon yellow">
            <iconify-icon icon="ph:tag-bold" width="22" style="color:#F5A623;"></iconify-icon>
        </div>
        <div>
            <div class="feature-text-title">Harga Hemat</div>
            <div class="feature-text-sub">Lebih murah dari toko biasa</div>
        </div>
    </div>
</div>

<!-- FILTER BAR — toggle Best Seller -->
<div class="filter-bar">
    <div class="filter-tabs">
        <div class="tab active" onclick="setTab('semua',this)">Semua <span class="tab-badge">20</span></div>
        <div class="tab" onclick="setTab('makeup',this)">Makeup <span class="tab-badge">6</span></div>
        <div class="tab" onclick="setTab('skincare',this)">Skincare <span class="tab-badge">8</span></div>
        <div class="tab" onclick="setTab('alat',this)">Alat Makeup <span class="tab-badge">3</span></div>
        <div class="tab" onclick="setTab('isulang',this)">Isi Ulang <span class="tab-badge">3</span></div>
    </div>
    <div class="filter-right">
        <label class="toggle-wrap">
            <label class="toggle">
                <input type="checkbox" id="toggleBestseller" onchange="applyFilter()">
                <span class="toggle-slider"></span>
            </label>
            <iconify-icon icon="ph:fire-bold" width="13" style="color:#e07080;"></iconify-icon>
            Best Seller
        </label>
        <button class="sort-btn" onclick="cycleSort()"><span id="sortLabel">↕ Terbaru</span></button>
    </div>
</div>

<!-- PRODUCTS -->
<div class="products-section">
    <div class="prod-header">
        <div class="prod-title">Produk Terbaru 🌸</div>
        <div class="prod-meta">
            <span class="products-count" id="countLabel">20 produk</span>
        </div>
    </div>

    <div class="product-grid" id="productGrid">

        @php
        $products = [
            // SKINCARE
            ['nama'=>'5X Ceramide Barrier Repair Moisture Gel','brand'=>'Skintific',          'harga'=>95000,  'harga_asli'=>190000,'diskon'=>50,'kategori'=>'skincare','populer'=>3, 'bestseller'=>false,'seller_rating'=>4.8,'ulasan'=>142,'kualitas'=>65,'img'=>'https://images.unsplash.com/photo-1608248543803-ba4f8c70ae0b?q=80&w=500&auto=format&fit=crop'],
            ['nama'=>'Brightening Face Toner',                 'brand'=>'Whitelab',           'harga'=>45000,  'harga_asli'=>90000, 'diskon'=>50,'kategori'=>'skincare','populer'=>7, 'bestseller'=>true, 'seller_rating'=>4.7,'ulasan'=>238,'kualitas'=>30,'img'=>'https://images.unsplash.com/photo-1556228720-195a672e8a03?q=80&w=500&auto=format&fit=crop'],
            ['nama'=>'Holyshield Sunscreen SPF 50',            'brand'=>'Somethinc',          'harga'=>75000,  'harga_asli'=>150000,'diskon'=>50,'kategori'=>'skincare','populer'=>5, 'bestseller'=>false,'seller_rating'=>4.9,'ulasan'=>87, 'kualitas'=>80,'img'=>'https://images.unsplash.com/photo-1599305090598-fe179d501227?q=80&w=500&auto=format&fit=crop'],
            ['nama'=>'Cica Beauty Serum',                      'brand'=>'Npure',              'harga'=>55000,  'harga_asli'=>110000,'diskon'=>50,'kategori'=>'skincare','populer'=>6, 'bestseller'=>false,'seller_rating'=>4.6,'ulasan'=>61, 'kualitas'=>55,'img'=>'https://images.unsplash.com/photo-1620916566398-39f1143ab7be?q=80&w=500&auto=format&fit=crop'],
            ['nama'=>'Moisturizing Gel Cream',                 'brand'=>'Skintific',          'harga'=>89000,  'harga_asli'=>178000,'diskon'=>50,'kategori'=>'skincare','populer'=>11,'bestseller'=>true, 'seller_rating'=>4.9,'ulasan'=>320,'kualitas'=>90,'img'=>'https://images.unsplash.com/photo-1556228578-8c89e6adf883?q=80&w=500&auto=format&fit=crop'],
            ['nama'=>'Niacinamide 10% + Zinc Serum',           'brand'=>'The Ordinary',       'harga'=>120000, 'harga_asli'=>210000,'diskon'=>43,'kategori'=>'skincare','populer'=>14,'bestseller'=>true, 'seller_rating'=>4.8,'ulasan'=>412,'kualitas'=>70,'img'=>'https://images.unsplash.com/photo-1620916566398-39f1143ab7be?q=80&w=500&auto=format&fit=crop'],
            ['nama'=>'Hydrating Face Wash',                    'brand'=>'Cetaphil',           'harga'=>65000,  'harga_asli'=>110000,'diskon'=>41,'kategori'=>'skincare','populer'=>15,'bestseller'=>false,'seller_rating'=>4.7,'ulasan'=>203,'kualitas'=>85,'img'=>'https://images.unsplash.com/photo-1556228720-195a672e8a03?q=80&w=500&auto=format&fit=crop'],
            ['nama'=>'Rose Water Toner Mist',                  'brand'=>'Sensatia Botanicals','harga'=>48000,  'harga_asli'=>85000, 'diskon'=>44,'kategori'=>'skincare','populer'=>16,'bestseller'=>false,'seller_rating'=>4.4,'ulasan'=>76, 'kualitas'=>45,'img'=>'https://images.unsplash.com/photo-1580870069867-74c57ee1bb07?q=80&w=500&auto=format&fit=crop'],
            // MAKEUP
            ['nama'=>'Instaperfect Matte Lipstick',            'brand'=>'Instaperfect',       'harga'=>35000,  'harga_asli'=>75000, 'diskon'=>53,'kategori'=>'makeup',  'populer'=>2, 'bestseller'=>false,'seller_rating'=>4.3,'ulasan'=>192,'kualitas'=>12,'img'=>'https://images.unsplash.com/photo-1586495777744-4413f21062fa?q=80&w=500&auto=format&fit=crop'],
            ['nama'=>'Fit Me Foundation',                      'brand'=>'Maybelline',         'harga'=>85000,  'harga_asli'=>130000,'diskon'=>35,'kategori'=>'makeup',  'populer'=>8, 'bestseller'=>true, 'seller_rating'=>4.5,'ulasan'=>311,'kualitas'=>90,'img'=>'https://plus.unsplash.com/premium_photo-1677175230595-87f8721ff703?q=80&w=500&auto=format&fit=crop'],
            ['nama'=>'Wardah Cushion SPF 40',                  'brand'=>'Wardah',             'harga'=>78000,  'harga_asli'=>130000,'diskon'=>40,'kategori'=>'makeup',  'populer'=>12,'bestseller'=>false,'seller_rating'=>4.6,'ulasan'=>185,'kualitas'=>40,'img'=>'https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9?q=80&w=500&auto=format&fit=crop'],
            ['nama'=>'Lip Matte Cream',                        'brand'=>'Implora',            'harga'=>22000,  'harga_asli'=>45000, 'diskon'=>51,'kategori'=>'makeup',  'populer'=>17,'bestseller'=>false,'seller_rating'=>4.2,'ulasan'=>88, 'kualitas'=>35,'img'=>'https://images.unsplash.com/photo-1586495777744-4413f21062fa?q=80&w=500&auto=format&fit=crop'],
            ['nama'=>'HD Loose Powder',                        'brand'=>'Make Over',          'harga'=>95000,  'harga_asli'=>160000,'diskon'=>41,'kategori'=>'makeup',  'populer'=>18,'bestseller'=>false,'seller_rating'=>4.5,'ulasan'=>134,'kualitas'=>50,'img'=>'https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9?q=80&w=500&auto=format&fit=crop'],
            ['nama'=>'Volume Mascara Waterproof',              'brand'=>'Maybelline',         'harga'=>55000,  'harga_asli'=>95000, 'diskon'=>42,'kategori'=>'makeup',  'populer'=>19,'bestseller'=>false,'seller_rating'=>4.6,'ulasan'=>167,'kualitas'=>60,'img'=>'https://plus.unsplash.com/premium_photo-1677175230595-87f8721ff703?q=80&w=500&auto=format&fit=crop'],
            // ALAT
            ['nama'=>'Makeup Brush Set 12pcs',                 'brand'=>'Focallure',          'harga'=>25000,  'harga_asli'=>50000, 'diskon'=>50,'kategori'=>'alat',    'populer'=>1, 'bestseller'=>false,'seller_rating'=>4.4,'ulasan'=>45, 'kualitas'=>70,'img'=>'https://images.unsplash.com/photo-1596462502278-27bfdc403348?q=80&w=500&auto=format&fit=crop'],
            ['nama'=>'Professional Brush Set 18pcs',           'brand'=>'Focallure',          'harga'=>45000,  'harga_asli'=>85000, 'diskon'=>47,'kategori'=>'alat',    'populer'=>13,'bestseller'=>false,'seller_rating'=>4.5,'ulasan'=>97, 'kualitas'=>80,'img'=>'https://images.unsplash.com/photo-1596462502278-27bfdc403348?q=80&w=500&auto=format&fit=crop'],
            ['nama'=>'Beauty Blender Sponge',                  'brand'=>'Beautyblender',      'harga'=>35000,  'harga_asli'=>60000, 'diskon'=>42,'kategori'=>'alat',    'populer'=>20,'bestseller'=>false,'seller_rating'=>4.7,'ulasan'=>210,'kualitas'=>90,'img'=>'https://images.unsplash.com/photo-1596462502278-27bfdc403348?q=80&w=500&auto=format&fit=crop'],
            // ISI ULANG
            ['nama'=>'Toner Refill 200ml',                     'brand'=>'Sensatia Botanicals','harga'=>30000,  'harga_asli'=>60000, 'diskon'=>50,'kategori'=>'isulang', 'populer'=>4, 'bestseller'=>false,'seller_rating'=>4.7,'ulasan'=>29, 'kualitas'=>80,'img'=>'https://images.unsplash.com/photo-1608248543803-ba4f8c70ae0b?q=80&w=500&auto=format&fit=crop'],
            ['nama'=>'Micellar Water Refill 400ml',            'brand'=>'Garnier',            'harga'=>40000,  'harga_asli'=>72000, 'diskon'=>44,'kategori'=>'isulang', 'populer'=>9, 'bestseller'=>false,'seller_rating'=>4.5,'ulasan'=>53, 'kualitas'=>75,'img'=>'https://images.unsplash.com/photo-1556228720-195a672e8a03?q=80&w=500&auto=format&fit=crop'],
            ['nama'=>'Rose Face Mist Refill 300ml',            'brand'=>'Garnier',            'harga'=>40000,  'harga_asli'=>72000, 'diskon'=>44,'kategori'=>'isulang', 'populer'=>9, 'bestseller'=>false,'seller_rating'=>4.5,'ulasan'=>53, 'kualitas'=>70,'img'=>'https://images.unsplash.com/photo-1580870069867-74c57ee1bb07?q=80&w=500&auto=format&fit=crop'],
        ];
        @endphp

        @foreach($products as $p)
        @php
            $k      = $p['kualitas'];
            $kKelas = $k >= 60 ? 'high' : ($k >= 30 ? 'medium' : 'low');
            $kTeks  = $k . '% kondisi';
            $fullStars  = floor($p['seller_rating']);
            $emptyStars = 5 - $fullStars;
        @endphp

        <a class="product-card"
           href="{{ route('detail-produk') }}"
           data-kategori="{{ $p['kategori'] }}"
           data-bestseller="{{ $p['bestseller'] ? 'true' : 'false' }}"
           data-harga="{{ $p['harga'] }}"
           data-populer="{{ $p['populer'] }}"
           data-nama="{{ strtolower($p['nama']) }}">

            <div class="product-img-wrap">
                <img src="{{ $p['img'] }}" alt="{{ $p['nama'] }}" loading="lazy">

                {{-- Hanya Best Seller badge, verified dihapus --}}
                @if($p['bestseller'])
                    <span class="badge-bs">
                        <iconify-icon icon="ph:fire-bold" width="10"></iconify-icon>
                        Best Seller
                    </span>
                @endif

                <button class="btn-cart-hover" type="button"
                        onclick="event.preventDefault(); addToCart(this)">
                    + KERANJANG
                </button>
            </div>

            <div class="card-body">
                <div class="p-brand">{{ $p['brand'] }}</div>
                <div class="p-name">{{ $p['nama'] }}</div>

                {{-- Rating toko/penjual --}}
                <div class="p-rating">
                    <div class="stars">
                        @for($i = 0; $i < $fullStars; $i++)<span class="star">★</span>@endfor
                        @for($i = 0; $i < $emptyStars; $i++)<span class="star empty">★</span>@endfor
                    </div>
                    <span class="rating-count">{{ $p['seller_rating'] }}</span>
                    <span class="rating-seller-label">Toko</span>
                </div>

                <div class="p-price">
                    Rp {{ number_format($p['harga'],0,',','.') }}
                    <span class="p-original">Rp {{ number_format($p['harga_asli'],0,',','.') }}</span>
                    <span class="p-discount">-{{ $p['diskon'] }}%</span>
                </div>

                <div class="kualitas-row">
                    <div class="kualitas-bar">
                        <div class="kualitas-fill {{ $kKelas }}" style="width:{{ $k }}%;"></div>
                    </div>
                    <span class="kualitas-label {{ $kKelas === 'low' ? 'low' : '' }}">{{ $kTeks }}</span>
                </div>
            </div>
        </a>
        @endforeach

    </div>
</div>

<script>
    // Banner slider
    let currentBanner = 0;
    const bannerDots = document.querySelectorAll('.banner-dot');
    const bannerTrack = document.getElementById('bannerTrack');
    const totalBanners = 3;
    let bannerTimer = setInterval(nextBanner, 4500);

    function goBanner(index) {
        bannerDots[currentBanner].classList.remove('active');
        currentBanner = index;
        bannerTrack.style.transform = `translateX(-${currentBanner * 100}%)`;
        bannerDots[currentBanner].classList.add('active');
        clearInterval(bannerTimer);
        bannerTimer = setInterval(nextBanner, 4500);
    }
    function nextBanner() { goBanner((currentBanner + 1) % totalBanners); }
    function prevBanner() { goBanner((currentBanner - 1 + totalBanners) % totalBanners); }
    
    // Filter & Sort
    let activeTab    = 'semua';
    let onlyBestseller = false;
    let searchQ      = '';
    let sortIdx      = 0;
    const sortModes  = ['terbaru','terendah','tertinggi','terpopuler'];
    const sortLabels = ['↕ Terbaru','↑ Termurah','↓ Termahal','🔥 Terpopuler'];

    function cards() { return Array.from(document.querySelectorAll('.product-card')); }

    function applyFilter() {
        onlyBestseller = document.getElementById('toggleBestseller').checked;
        let visible = 0;
        cards().forEach(c => {
            const ok = (activeTab === 'semua' || c.dataset.kategori === activeTab)
                    && (!onlyBestseller || c.dataset.bestseller === 'true')
                    && (!searchQ || c.dataset.nama.includes(searchQ));
            c.classList.toggle('hidden', !ok);
            if (ok) visible++;
        });
        document.getElementById('countLabel').textContent = visible + ' produk';
        const old = document.querySelector('.empty-state');
        if (old) old.remove();
        if (visible === 0) {
            document.getElementById('productGrid').insertAdjacentHTML('beforeend',
                '<div class="empty-state"><div style="font-size:48px">🔍</div><p style="margin-top:10px;font-size:14px;font-weight:600">Produk tidak ditemukan</p></div>'
            );
        }
        applySort();
    }

    function applySort() {
        const grid = document.getElementById('productGrid');
        const vis  = cards().filter(c => !c.classList.contains('hidden'));
        vis.sort((a,b) => {
            if (sortModes[sortIdx]==='terendah')   return +a.dataset.harga   - +b.dataset.harga;
            if (sortModes[sortIdx]==='tertinggi')  return +b.dataset.harga   - +a.dataset.harga;
            if (sortModes[sortIdx]==='terpopuler') return +b.dataset.populer - +a.dataset.populer;
            return 0;
        });
        vis.forEach(c => grid.appendChild(c));
    }

    function setTab(k, el) {
        activeTab = k;
        document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
        el.classList.add('active');
        applyFilter();
    }

    function cycleSort() {
        sortIdx = (sortIdx + 1) % sortModes.length;
        document.getElementById('sortLabel').textContent = sortLabels[sortIdx];
        applySort();
    }

    function cariProduk() {
        searchQ = document.getElementById('searchInput').value.toLowerCase();
        applyFilter();
    }

    function addToCart(btn) {
        const badge = document.getElementById('cartBadge');
        badge.textContent = +badge.textContent + 1;
        badge.style.transform = 'scale(1.5)';
        setTimeout(() => badge.style.transform = '', 200);
        showToast('🛒 Ditambahkan ke keranjang!');
    }

    function showToast(msg) {
        const t = document.getElementById('toast');
        t.textContent = msg; t.classList.add('show');
        clearTimeout(t._timer); t._timer = setTimeout(() => t.classList.remove('show'), 2800);
    }

    @if(session('success'))
        showToast('✅ {{ session("success") }}');
    @endif
</script>
</body>
</html>