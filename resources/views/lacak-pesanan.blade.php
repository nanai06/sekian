<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lacak Pesanan - AYU-NE</title>
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
        .content { max-width: 580px; margin: 0 auto; padding: 32px 20px; }

        .page-header { display: flex; align-items: center; gap: 12px; margin-bottom: 20px; }
        .back-btn { font-size: 20px; color: #3b1a1a; text-decoration: none; font-weight: 600; }
        .page-title { font-size: 20px; font-weight: 800; color: #3b1a1a; }

        /* MAP */
        .map-box {
            width: 100%; height: 200px; background: #fdf0f2;
            border-radius: 16px; display: flex; align-items: center;
            justify-content: center; font-size: 13px; color: #c4a0a0;
            margin-bottom: 12px; border: 1px solid #f5e0e0;
        }

        .map-legend {
            display: flex; gap: 20px; margin-bottom: 20px; flex-wrap: wrap;
        }

        .legend-item { display: flex; align-items: center; gap: 6px; font-size: 12px; color: #7a4a4a; }
        .legend-dot { width: 10px; height: 10px; border-radius: 50%; }

        /* CARD */
        .card { background: white; border-radius: 16px; padding: 20px; margin-bottom: 14px; border: 1px solid #f5e0e0; }
        .card-title { font-size: 15px; font-weight: 700; color: #3b1a1a; margin-bottom: 20px; }

        /* TIMELINE */
        .timeline { display: flex; flex-direction: column; gap: 0; }

        .timeline-item { display: flex; gap: 14px; position: relative; }

        .timeline-left {
            display: flex; flex-direction: column; align-items: center;
            width: 28px; flex-shrink: 0;
        }

        .tl-dot {
            width: 28px; height: 28px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 14px; flex-shrink: 0; z-index: 1;
        }

        .tl-dot.done { background: #2ecc71; color: white; }
        .tl-dot.active { background: #fdf0f2; border: 2px solid #f4a0aa; color: #f4a0aa; font-size: 10px; }
        .tl-dot.pending { background: #f5f5f5; border: 2px solid #e0e0e0; }

        .tl-line {
            width: 2px; flex: 1; min-height: 24px;
            background: #f0d5d5; margin: 4px 0;
        }

        .tl-line.done-line { background: #2ecc71; }

        .timeline-right { padding-bottom: 20px; padding-top: 2px; }
        .tl-title { font-size: 14px; font-weight: 600; color: #3b1a1a; margin-bottom: 3px; }
        .tl-title.pending { color: #b4a0a0; font-weight: 500; }
        .tl-desc { font-size: 12px; color: #9a6a6a; }

        /* KURIR INFO */
        .kurir-card { background: #fdf8f8; border-radius: 14px; padding: 18px; border: 1px solid #f5e0e0; }
        .kurir-title { font-size: 14px; font-weight: 700; color: #3b1a1a; margin-bottom: 10px; }
        .kurir-row { font-size: 13px; color: #7a4a4a; margin-bottom: 4px; }
        .kurir-resi { font-weight: 700; color: #3b1a1a; }
        .kurir-phone { display: flex; align-items: center; gap: 6px; font-size: 13px; color: #7a4a4a; margin-top: 6px; margin-bottom: 10px; }
        .estimasi-label { font-size: 12px; color: #9a6a6a; margin-bottom: 3px; }
        .estimasi-value { font-size: 13px; font-weight: 700; color: #e07080; }
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
        <div class="page-title">Lacak Pesanan</div>
    </div>

    <!-- MAP -->
    <div class="map-box">Google Maps / Live Tracking Map</div>
    <div class="map-legend">
        <div class="legend-item"><div class="legend-dot" style="background:#f4a0aa;"></div> Titik asal (penjual)</div>
        <div class="legend-item"><div class="legend-dot" style="background:#3498db;"></div> Posisi kurir real-time</div>
        <div class="legend-item"><div class="legend-dot" style="background:#2ecc71;"></div> Titik tujuan (pembeli)</div>
    </div>

    <!-- STATUS PENGIRIMAN -->
    <div class="card">
        <div class="card-title">Status Pengiriman</div>
        <div class="timeline">

            <div class="timeline-item">
                <div class="timeline-left">
                    <div class="tl-dot done">✓</div>
                    <div class="tl-line done-line"></div>
                </div>
                <div class="timeline-right">
                    <div class="tl-title">Pesanan Dibuat</div>
                </div>
            </div>

            <div class="timeline-item">
                <div class="timeline-left">
                    <div class="tl-dot done">✓</div>
                    <div class="tl-line done-line"></div>
                </div>
                <div class="timeline-right">
                    <div class="tl-title">Dikemas</div>
                </div>
            </div>

            <div class="timeline-item">
                <div class="timeline-left">
                    <div class="tl-dot done">✓</div>
                    <div class="tl-line done-line"></div>
                </div>
                <div class="timeline-right">
                    <div class="tl-title">Dikirim</div>
                </div>
            </div>

            <div class="timeline-item">
                <div class="timeline-left">
                    <div class="tl-dot active">●</div>
                    <div class="tl-line"></div>
                </div>
                <div class="timeline-right">
                    <div class="tl-title">Dalam Perjalanan</div>
                    <div class="tl-desc">Paket sedang dalam perjalanan ke alamatmu</div>
                </div>
            </div>

            <div class="timeline-item">
                <div class="timeline-left">
                    <div class="tl-dot pending"></div>
                </div>
                <div class="timeline-right">
                    <div class="tl-title pending">Tiba</div>
                </div>
            </div>

        </div>
    </div>

    <!-- INFORMASI KURIR -->
    <div class="kurir-card">
        <div class="kurir-title">Informasi Kurir</div>
        <div class="kurir-row">Kurir: <span class="kurir-resi">JNE REG</span></div>
        <div class="kurir-row">No Resi: <span class="kurir-resi">JNE123456789012</span></div>
        <div class="kurir-phone">📞 0812-3456-7890</div>
        <div class="estimasi-label">Estimasi tiba:</div>
        <div class="estimasi-value">Hari ini, 17:00 – 19:00</div>
    </div>
</div>

</body>
</html>