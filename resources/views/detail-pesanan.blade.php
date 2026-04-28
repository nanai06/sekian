<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan - AYU-NE</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body { background: #f9f5f5; color: #3b1a1a; }

        .navbar { display: flex; align-items: center; justify-content: space-between; padding: 16px 40px; border-bottom: 1px solid #f5e0e0; background: white; position: sticky; top: 0; z-index: 100; }
        .nav-logo img { height: 36px; width: auto; object-fit: contain; }
        .nav-links { display: flex; gap: 36px; list-style: none; }
        .nav-links a { text-decoration: none; font-size: 14px; font-weight: 500; color: #7a4a4a; }
        .nav-links a:hover { color: #e07080; }
        .nav-right { display: flex; align-items: center; gap: 18px; }
        .search-box { display: flex; align-items: center; background: #f9f0f2; border-radius: 50px; padding: 8px 16px; gap: 8px; width: 220px; }
        .search-box input { border: none; background: transparent; outline: none; font-size: 13px; width: 100%; font-family: 'Poppins', sans-serif; }
        .search-box input::placeholder { color: #c4a0a0; }
        .nav-icon { position: relative; cursor: pointer; font-size: 20px; color: #7a4a4a; text-decoration: none; }
        .badge { position: absolute; top: -6px; right: -6px; background: #e07080; color: white; font-size: 9px; font-weight: 700; width: 16px; height: 16px; border-radius: 50%; display: flex; align-items: center; justify-content: center; }
        .avatar { width: 38px; height: 38px; border-radius: 50%; background: #f4a0aa; display: flex; align-items: center; justify-content: center; font-size: 16px; font-weight: 700; color: white; text-decoration: none; }

        /* CONTENT */
        .content { max-width: 620px; margin: 0 auto; padding: 32px 20px; }

        .page-header {
            display: flex; align-items: center; gap: 12px; margin-bottom: 24px;
        }
        .back-btn { font-size: 20px; color: #3b1a1a; text-decoration: none; font-weight: 600; }
        .page-title { font-size: 20px; font-weight: 800; color: #3b1a1a; }

        /* CARD */
        .card {
            background: white; border-radius: 16px;
            padding: 20px; margin-bottom: 14px;
            border: 1px solid #f5e0e0;
        }

        .card-title {
            font-size: 14px; font-weight: 700; color: #3b1a1a;
            margin-bottom: 14px;
        }

        /* PRODUK */
        .produk-item {
            display: flex; align-items: center; gap: 14px;
            padding-bottom: 14px; margin-bottom: 14px;
            border-bottom: 1px solid #f9f0f2;
        }
        .produk-item:last-child { border-bottom: none; padding-bottom: 0; margin-bottom: 0; }

        .produk-thumb {
            width: 56px; height: 56px; border-radius: 10px;
            background: #fdf0f2; display: flex; align-items: center;
            justify-content: center; font-size: 9px; color: #c4a0a0;
            text-align: center; line-height: 1.4; flex-shrink: 0;
        }

        .produk-name { font-size: 14px; font-weight: 600; color: #3b1a1a; margin-bottom: 3px; }
        .produk-qty { font-size: 12px; color: #9a6a6a; margin-bottom: 3px; }
        .produk-price { font-size: 14px; font-weight: 800; color: #3b1a1a; }

        /* INFO ROWS */
        .info-row {
            display: flex; align-items: flex-start; gap: 12px;
            margin-bottom: 6px;
        }
        .info-icon { font-size: 16px; flex-shrink: 0; margin-top: 1px; }
        .info-label { font-size: 14px; font-weight: 700; color: #3b1a1a; margin-bottom: 4px; }
        .info-text { font-size: 13px; color: #7a4a4a; line-height: 1.6; }
        .info-green { font-size: 13px; color: #2ecc71; font-weight: 600; }

        /* RINGKASAN */
        .summary-row {
            display: flex; justify-content: space-between;
            font-size: 13px; color: #7a4a4a; margin-bottom: 10px;
        }
        .summary-total {
            display: flex; justify-content: space-between;
            font-size: 15px; font-weight: 800; color: #3b1a1a;
            padding-top: 12px; border-top: 1px solid #f5e0e0; margin-top: 4px;
        }
    </style>
</head>
<body>

<nav class="navbar">
    <div class="nav-logo">
        <a href="{{ route('dashboard') }}"><img src="{{ asset('images/AYU-NE.png') }}" alt="AYU-NE"></a>
    </div>
    <ul class="nav-links">
        <li><a href="{{ route('dashboard') }}">Home</a></li>
        <li><a href="{{ route('ayu-belanja') }}">Ayu Belanja</a></li>
        <li><a href="{{ route('ayu-daur-ulang') }}">Ayu Daur Ulang</a></li>
        <li><a href="{{ route('ayu-koin') }}">Ayu Koin</a></li>
    </ul>
    <div class="nav-right">
        <div class="search-box"><span>🔍</span><input type="text" placeholder="Cari produk..."></div>
        <a href="{{ route('notifikasi') }}" class="nav-icon">🔔<div class="badge">•</div></a>
        <a href="{{ route('keranjang') }}" class="nav-icon">🛒<div class="badge">2</div></a>
        <a href="{{ route('profil') }}" class="avatar">A</a>
    </div>
</nav>

<div class="content">
    <div class="page-header">
        <a href="{{ route('pesanan-saya') }}" class="back-btn">←</a>
        <div class="page-title">Detail Pesanan</div>
    </div>

    <!-- PRODUK -->
    <div class="card">
        <div class="card-title">Produk</div>

        <div class="produk-item">
            <div class="produk-thumb">Product<br>Photo</div>
            <div>
                <div class="produk-name">5X Ceramide Barrier Repair</div>
                <div class="produk-qty">Qty: 1</div>
                <div class="produk-price">Rp 95.000</div>
            </div>
        </div>

        <div class="produk-item">
            <div class="produk-thumb">Product<br>Photo</div>
            <div>
                <div class="produk-name">5X Ceramide Barrier Repair</div>
                <div class="produk-qty">Qty: 1</div>
                <div class="produk-price">Rp 95.000</div>
            </div>
        </div>
    </div>

    <!-- ALAMAT PENGIRIMAN -->
    <div class="card">
        <div class="info-row">
            <div class="info-icon">📍</div>
            <div>
                <div class="info-label">Alamat Pengiriman</div>
                <div class="info-text">
                    Ayu Cantika (08123456789)<br>
                    Jl. Sudirman No. 123, RT 01/RW 02<br>
                    Jakarta Pusat, DKI Jakarta 10220
                </div>
            </div>
        </div>
    </div>

    <!-- PEMBAYARAN -->
    <div class="card">
        <div class="info-row">
            <div class="info-icon">🏦</div>
            <div>
                <div class="info-label">Pembayaran</div>
                <div class="info-text">Transfer Bank BCA</div>
                <div class="info-green">Status: Lunas</div>
            </div>
        </div>
    </div>

    <!-- KURIR -->
    <div class="card">
        <div class="info-row">
            <div class="info-icon">🚚</div>
            <div>
                <div class="info-label">Kurir</div>
                <div class="info-text">JNE REG</div>
                <div class="info-text">No Resi: JNE123456789012</div>
            </div>
        </div>
    </div>

    <!-- RINGKASAN PEMBAYARAN -->
    <div class="card">
        <div class="card-title">Ringkasan Pembayaran</div>
        <div class="summary-row"><span>Subtotal</span><span>Rp 95.000</span></div>
        <div class="summary-row"><span>Ongkir</span><span>Rp 15.000</span></div>
        <div class="summary-total"><span>Total</span><span>Rp 110.000</span></div>
    </div>
</div>

</body>
</html>