<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.iconify.design/iconify-icon/2.1.0/iconify-icon.min.js"></script>
    <title>Dashboard Penjual - AYU-NE</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --surface: #FFF8F8;
            --border: #F0D5D8;
            --text: #5D393B;
            --text-secondary: #9E7178;
            --primary: #D4537E;
            --primary-deeper: #b85c65;
            --accent-purple: #7C3AED;
        }
        * { margin:0; padding:0; box-sizing:border-box; font-family:'Poppins',sans-serif; }
        body { background: linear-gradient(180deg, #ffe8ed 0%, #fff5f5 50%, #ffe8ed 100%); color:#3b1a1a; }

        /* LAYOUT */
        .seller-page { max-width:1200px; margin:0 auto; padding:30px 40px 60px; }
        .page-header { display:flex; align-items:center; justify-content:space-between; margin-bottom:28px; }
        .page-title { font-size:24px; font-weight:800; color:var(--text); }
        .page-title span { color:var(--primary); }
        .breadcrumb { font-size:12px; color:var(--text-secondary); }
        .breadcrumb a { color:var(--primary); text-decoration:none; }

        /* TOKO HEADER */
        .toko-header {
            background: linear-gradient(135deg, #f0e6ff 0%, #c8a5e8 50%, #e8d5f5 100%);
            border:1px solid #d4b8e8; border-radius:20px;
            padding:28px 32px; margin-bottom:24px;
            display:flex; align-items:center; justify-content:space-between;
            position:relative; overflow:hidden;
        }
        .toko-header::before {
            content:''; position:absolute; top:-30px; right:-30px;
            width:150px; height:150px; border-radius:50%;
            background:rgba(255,255,255,0.15);
        }
        .toko-header::after {
            content:''; position:absolute; bottom:-40px; right:80px;
            width:100px; height:100px; border-radius:50%;
            background:rgba(255,255,255,0.1);
        }
        .toko-info { display:flex; align-items:center; gap:18px; z-index:1; }
        .toko-avatar {
            width:64px; height:64px; border-radius:16px;
            background:rgba(255,255,255,0.4); border:2px solid rgba(255,255,255,0.6);
            display:flex; align-items:center; justify-content:center;
            font-size:28px; color:var(--accent-purple); flex-shrink:0;
        }
        .toko-nama { font-size:20px; font-weight:700; color:#2d1050; }
        .toko-status { display:inline-flex; align-items:center; gap:4px; font-size:11px; font-weight:600;
            padding:3px 10px; border-radius:20px; margin-top:4px; }
        .toko-status.aktif { background:rgba(76,175,125,0.2); color:#2d7a4f; }
        .toko-slug { font-size:11px; color:#6b4a8a; margin-top:2px; }
        .btn-kelola-toko {
            padding:10px 24px; background:white; border:none; border-radius:12px;
            font-size:13px; font-weight:600; color:var(--accent-purple);
            cursor:pointer; text-decoration:none; z-index:1;
            transition:all 0.2s; box-shadow:0 2px 8px rgba(124,58,237,0.15);
        }
        .btn-kelola-toko:hover { transform:translateY(-2px); box-shadow:0 4px 16px rgba(124,58,237,0.25); }

        /* STAT CARDS */
        .stat-grid { display:grid; grid-template-columns:repeat(4,1fr); gap:16px; margin-bottom:24px; }
        .stat-card {
            background:white; border:1px solid var(--border); border-radius:16px;
            padding:20px 22px; transition:all 0.2s;
            box-shadow:0 2px 12px rgba(184,92,101,0.06);
        }
        .stat-card:hover { transform:translateY(-3px); box-shadow:0 6px 20px rgba(184,92,101,0.12); }
        .stat-top { display:flex; align-items:center; justify-content:space-between; margin-bottom:12px; }
        .stat-icon {
            width:42px; height:42px; border-radius:12px;
            display:flex; align-items:center; justify-content:center; font-size:20px;
        }
        .stat-icon.pink { background:#FBEAF0; color:var(--primary); }
        .stat-icon.green { background:#EAF3DE; color:#4CAF7D; }
        .stat-icon.purple { background:#F0E6FF; color:var(--accent-purple); }
        .stat-icon.orange { background:#FFF3E0; color:#FF9800; }
        .stat-badge { font-size:10px; font-weight:600; padding:2px 8px; border-radius:10px; }
        .stat-badge.up { background:#EAF3DE; color:#639922; }
        .stat-badge.neutral { background:#F3F1EE; color:#7a6a5f; }
        .stat-angka { font-size:28px; font-weight:800; color:var(--text); line-height:1; margin-bottom:4px; }
        .stat-label { font-size:12px; color:var(--text-secondary); font-weight:500; }

        /* CONTENT GRID */
        .content-grid { display:grid; grid-template-columns:1.5fr 1fr; gap:20px; margin-bottom:24px; }

        /* CARD */
        .card {
            background:white; border:1px solid var(--border); border-radius:16px;
            padding:22px 24px; box-shadow:0 2px 12px rgba(184,92,101,0.06);
        }
        .card-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:16px; }
        .card-title { font-size:15px; font-weight:700; color:var(--text); }
        .card-link { font-size:12px; font-weight:500; color:var(--primary); text-decoration:none; }
        .card-link:hover { color:#993556; }

        /* PESANAN TABLE */
        .order-table { width:100%; border-collapse:collapse; }
        .order-table th {
            text-align:left; font-size:11px; font-weight:600; color:var(--text-secondary);
            padding:8px 10px; border-bottom:1px solid #F3F1EE; text-transform:uppercase; letter-spacing:0.5px;
        }
        .order-table td { padding:10px; font-size:12px; color:var(--text); border-bottom:0.5px solid #F3F1EE; }
        .order-table tr:last-child td { border-bottom:none; }
        .order-table .buyer-info { display:flex; align-items:center; gap:8px; }
        .buyer-avatar {
            width:30px; height:30px; border-radius:8px;
            background:linear-gradient(135deg,#FBEAF0,#F4C0D1);
            display:flex; align-items:center; justify-content:center;
            font-size:11px; font-weight:700; color:var(--primary); flex-shrink:0;
        }
        .status-pill {
            display:inline-block; font-size:10px; font-weight:600;
            padding:3px 10px; border-radius:20px;
        }
        .status-menunggu { background:#FFF3E0; color:#E65100; }
        .status-diproses { background:#FBEAF0; color:var(--primary); }
        .status-dikirim { background:#E3F2FD; color:#1565C0; }
        .status-selesai { background:#EAF3DE; color:#639922; }
        .status-batal { background:#F3F1EE; color:#7a6a5f; }

        /* PRODUK GRID */
        .produk-mini-grid { display:grid; grid-template-columns:repeat(2,1fr); gap:12px; }
        .produk-mini {
            border:1px solid #F3F1EE; border-radius:12px; padding:12px;
            transition:all 0.2s; cursor:pointer;
        }
        .produk-mini:hover { border-color:#FFBBC0; box-shadow:0 2px 8px rgba(184,92,101,0.08); }
        .produk-mini-img {
            width:100%; aspect-ratio:1; border-radius:8px;
            background:#FBEAF0; margin-bottom:8px; overflow:hidden;
            display:flex; align-items:center; justify-content:center; font-size:24px;
        }
        .produk-mini-img img { width:100%; height:100%; object-fit:cover; }
        .produk-mini-name { font-size:11px; font-weight:600; color:var(--text);
            display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden; line-height:1.4; }
        .produk-mini-price { font-size:12px; font-weight:700; color:var(--primary); margin-top:4px; }

        /* QUICK ACTIONS */
        .quick-actions { display:grid; grid-template-columns:repeat(2,1fr); gap:12px; margin-bottom:24px; }
        .quick-btn {
            display:flex; align-items:center; gap:12px;
            background:white; border:1px solid var(--border); border-radius:14px;
            padding:16px 20px; text-decoration:none; color:var(--text);
            transition:all 0.2s; cursor:pointer;
        }
        .quick-btn:hover { transform:translateY(-2px); box-shadow:0 4px 16px rgba(184,92,101,0.1); border-color:#FFBBC0; }
        .quick-icon {
            width:40px; height:40px; border-radius:10px;
            display:flex; align-items:center; justify-content:center; flex-shrink:0;
        }
        .quick-icon.pink { background:#FBEAF0; color:var(--primary); }
        .quick-icon.green { background:#EAF3DE; color:#4CAF7D; }
        .quick-icon.purple { background:#F0E6FF; color:var(--accent-purple); }
        .quick-icon.blue { background:#E3F2FD; color:#1976D2; }
        .quick-label { font-size:13px; font-weight:600; }
        .quick-sub { font-size:11px; color:var(--text-secondary); margin-top:1px; }

        /* EMPTY STATE */
        .empty-state { text-align:center; padding:32px 0; }
        .empty-icon { font-size:32px; margin-bottom:8px; }
        .empty-text { font-size:13px; color:var(--text-secondary); font-weight:500; }
        .empty-sub { font-size:11px; color:#b5a5a0; margin-top:4px; }

        /* FOOTER */
        footer { background:var(--surface); border-top:1px solid var(--border); }
        .footer-inner { display:grid; grid-template-columns:2fr 1fr 1fr 1fr; gap:48px; padding:60px 48px 40px; }
        .f-logo img { height:28px; width:auto; object-fit:contain; }
        .footer-brand .f-logo { font-size:22px; font-weight:800; font-style:italic; color:var(--text); margin-bottom:12px; }
        .footer-brand p { font-size:13px; color:var(--text-secondary); line-height:1.7; max-width:280px; }
        .footer-col h4 { font-size:12px; font-weight:700; letter-spacing:1.5px; text-transform:uppercase; color:var(--text); margin-bottom:16px; }
        .footer-col ul { list-style:none; }
        .footer-col li { margin-bottom:10px; }
        .footer-col a { font-size:13px; color:var(--text-secondary); transition:color 0.2s; text-decoration:none; }
        .footer-col a:hover { color:var(--text); }
        .footer-bottom {
            border-top:1px solid var(--border); padding:20px 48px;
            display:flex; justify-content:space-between; align-items:center;
            font-size:12px; color:var(--text-secondary);
        }
        .payment-icons { display:flex; gap:8px; align-items:center; }
        .pay-badge { background:white; border:1px solid var(--border); border-radius:6px; padding:4px 8px; font-size:10px; font-weight:700; color:var(--text); }
    </style>
</head>
<body>

    @include('layouts.navigation')

    <div class="seller-page">

        {{-- BREADCRUMB --}}
        <div class="page-header">
            <div>
                <div class="breadcrumb"><a href="{{ route('profil') }}">Profil</a> / Dashboard Penjual</div>
                <div class="page-title">Dashboard <span>Penjual</span> 🌸</div>
            </div>
            <a href="{{ route('profil') }}" style="font-size:13px; color:var(--primary); text-decoration:none; font-weight:500;">← Kembali ke Profil</a>
        </div>

        {{-- TOKO HEADER --}}
        <div class="toko-header">
            <div class="toko-info">
                <div class="toko-avatar">
                    <iconify-icon icon="solar:shop-bold" width="32"></iconify-icon>
                </div>
                <div>
                    <div class="toko-nama">{{ $store->nama_toko }}</div>
                    <div class="toko-slug">ayune.id/{{ $store->slug }}</div>
                    <span class="toko-status aktif">
                        <svg width="8" height="8" viewBox="0 0 8 8"><circle cx="4" cy="4" r="4" fill="#4CAF7D"/></svg>
                        Toko Aktif
                    </span>
                </div>
            </div>
            <a href="#" class="btn-kelola-toko">
                <iconify-icon icon="solar:settings-linear" width="16" style="vertical-align:middle; margin-right:4px;"></iconify-icon>
                Kelola Toko
            </a>
        </div>

        {{-- STATISTIK --}}
        <div class="stat-grid">
            <div class="stat-card">
                <div class="stat-top">
                    <div class="stat-icon pink">
                        <iconify-icon icon="solar:box-bold" width="22"></iconify-icon>
                    </div>
                    <span class="stat-badge neutral">Total</span>
                </div>
                <div class="stat-angka">{{ $totalProduk }}</div>
                <div class="stat-label">Produk Terdaftar</div>
            </div>

            <div class="stat-card">
                <div class="stat-top">
                    <div class="stat-icon green">
                        <iconify-icon icon="solar:cart-check-bold" width="22"></iconify-icon>
                    </div>
                    <span class="stat-badge up">Aktif</span>
                </div>
                <div class="stat-angka">{{ $produkAktif }}</div>
                <div class="stat-label">Produk Aktif</div>
            </div>

            <div class="stat-card">
                <div class="stat-top">
                    <div class="stat-icon purple">
                        <iconify-icon icon="solar:wallet-money-bold" width="22"></iconify-icon>
                    </div>
                    <span class="stat-badge up">💰</span>
                </div>
                <div class="stat-angka">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</div>
                <div class="stat-label">Total Pendapatan</div>
            </div>

            <div class="stat-card">
                <div class="stat-top">
                    <div class="stat-icon orange">
                        <iconify-icon icon="solar:star-bold" width="22"></iconify-icon>
                    </div>
                    <span class="stat-badge neutral">⭐</span>
                </div>
                <div class="stat-angka">{{ number_format($ratingToko, 1) }}</div>
                <div class="stat-label">Rating Toko</div>
            </div>
        </div>

        {{-- QUICK ACTIONS --}}
        <div class="quick-actions">
            <a href="#" class="quick-btn">
                <div class="quick-icon pink">
                    <iconify-icon icon="solar:add-square-bold" width="22"></iconify-icon>
                </div>
                <div>
                    <div class="quick-label">Tambah Produk</div>
                    <div class="quick-sub">Upload produk baru ke toko</div>
                </div>
            </a>
            <a href="#" class="quick-btn">
                <div class="quick-icon green">
                    <iconify-icon icon="solar:clipboard-list-bold" width="22"></iconify-icon>
                </div>
                <div>
                    <div class="quick-label">Pesanan Masuk <span style="color:var(--primary); font-size:11px;">({{ $pesananBaru }})</span></div>
                    <div class="quick-sub">Konfirmasi pesanan pembeli</div>
                </div>
            </a>
            <a href="#" class="quick-btn">
                <div class="quick-icon purple">
                    <iconify-icon icon="solar:chat-round-dots-bold" width="22"></iconify-icon>
                </div>
                <div>
                    <div class="quick-label">Chat Pembeli</div>
                    <div class="quick-sub">Balas pesan dari pembeli</div>
                </div>
            </a>
            <a href="#" class="quick-btn">
                <div class="quick-icon blue">
                    <iconify-icon icon="solar:chart-2-bold" width="22"></iconify-icon>
                </div>
                <div>
                    <div class="quick-label">Statistik Toko</div>
                    <div class="quick-sub">Lihat performa penjualan</div>
                </div>
            </a>
        </div>

        {{-- CONTENT: PESANAN + PRODUK --}}
        <div class="content-grid">

            {{-- PESANAN TERBARU --}}
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Pesanan Terbaru 📦</div>
                    <a href="#" class="card-link">Lihat Semua →</a>
                </div>

                @if($pesananMasuk->isEmpty())
                    <div class="empty-state">
                        <div class="empty-icon">📭</div>
                        <div class="empty-text">Belum ada pesanan masuk</div>
                        <div class="empty-sub">Pesanan dari pembeli akan muncul di sini</div>
                    </div>
                @else
                    <table class="order-table">
                        <thead>
                            <tr>
                                <th>Pembeli</th>
                                <th>Produk</th>
                                <th>Total</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pesananMasuk as $order)
                                @php
                                    $firstItem = $order->orderItems->first();
                                    $product = $firstItem?->product;
                                    $buyerName = $order->buyer->name ?? 'Pembeli';
                                    $buyerInitials = strtoupper(substr($buyerName, 0, 2));
                                    $statusClass = match($order->status) {
                                        'menunggu_konfirmasi' => 'status-menunggu',
                                        'diproses' => 'status-diproses',
                                        'dikirim' => 'status-dikirim',
                                        'selesai' => 'status-selesai',
                                        default => 'status-batal',
                                    };
                                    $statusLabel = ucfirst(str_replace('_', ' ', $order->status));
                                @endphp
                                <tr>
                                    <td>
                                        <div class="buyer-info">
                                            <div class="buyer-avatar">{{ $buyerInitials }}</div>
                                            <span>{{ Str::limit($buyerName, 12) }}</span>
                                        </div>
                                    </td>
                                    <td>{{ Str::limit($product->nama_produk ?? '-', 20) }}</td>
                                    <td style="font-weight:600;">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                                    <td><span class="status-pill {{ $statusClass }}">{{ $statusLabel }}</span></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>

            {{-- PRODUK SAYA --}}
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Produk Saya 🛍️</div>
                    <a href="#" class="card-link">Kelola →</a>
                </div>

                @if($produkTerbaru->isEmpty())
                    <div class="empty-state">
                        <div class="empty-icon">📦</div>
                        <div class="empty-text">Belum ada produk</div>
                        <div class="empty-sub">Yuk tambah produk pertamamu!</div>
                    </div>
                @else
                    <div class="produk-mini-grid">
                        @foreach($produkTerbaru as $produk)
                            <div class="produk-mini">
                                <div class="produk-mini-img">
                                    @if($produk->foto && str_starts_with($produk->foto, 'http'))
                                        <img src="{{ $produk->foto }}" alt="{{ $produk->nama_produk }}">
                                    @elseif($produk->foto)
                                        <img src="{{ asset('storage/'.$produk->foto) }}" alt="{{ $produk->nama_produk }}">
                                    @else
                                        🧴
                                    @endif
                                </div>
                                <div class="produk-mini-name">{{ $produk->nama_produk }}</div>
                                <div class="produk-mini-price">Rp {{ number_format($produk->harga, 0, ',', '.') }}</div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

    </div>

    {{-- FOOTER --}}
    <footer>
        <div class="footer-inner">
            <div class="footer-brand">
                <div class="f-logo"><img src="{{ asset('images/AYU-NE.png') }}"></div>
                <p>Platform eco-beauty sirkular pertama di Indonesia. Belanja preloved, daur ulang kemasan, dan raih reward.</p>
            </div>
            <div class="footer-col">
                <h4>Belanja</h4>
                <ul>
                    <li><a href="#">Skincare</a></li>
                    <li><a href="#">Makeup</a></li>
                    <li><a href="#">Alat Makeup</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Informasi</h4>
                <ul>
                    <li><a href="#">Tentang AYU-NE</a></li>
                    <li><a href="#">Cara Daur Ulang</a></li>
                    <li><a href="#">FAQ</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Bantuan</h4>
                <ul>
                    <li><a href="#">Hubungi Kami</a></li>
                    <li><a href="#">Pengiriman</a></li>
                    <li><a href="#">Titik Drop-Off</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <span>&copy; 2025 AYU-NE. Eco-beauty untuk bumi yang lebih sehat 🌿</span>
            <div class="payment-icons">
                <span class="pay-badge">VISA</span>
                <span class="pay-badge">GoPay</span>
                <span class="pay-badge">OVO</span>
                <span class="pay-badge">QRIS</span>
            </div>
        </div>
    </footer>

</body>
</html>
