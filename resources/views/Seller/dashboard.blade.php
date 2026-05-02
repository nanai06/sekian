<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.iconify.design/iconify-icon/2.1.0/iconify-icon.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js"></script>
    <title>Dashboard Penjual - AYU-NE</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --pk: #D4537E; --pk2: #b85c65; --pk-light: #FBEAF0; --pk-border: #F0D5D8;
            --tx: #2d5016; --tx2: #5a7a40; --sur: #f5fbf0;
            --grn: #4CAF7D; --grn-bg: #EAF3DE;
            --grn2: #639922; --grn2-bg: #f0f9e8; --grn-border: #c5e0a0;
            --pur: #7C3AED; --pur-bg: #F0E6FF;
            --org: #E65100; --org-bg: #FFF3E0;
            --blu: #1565C0; --blu-bg: #E3F2FD;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body { background: linear-gradient(180deg, #e8f5e0 0%, #f5fff5 50%, #e8f5e0 100%); color: #2d5016; }

        .seller-page { max-width: 1200px; margin: 0 auto; padding: 30px 40px 60px; }

        /* BREADCRUMB */
        .page-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 24px; }
        .page-title { font-size: 24px; font-weight: 800; color: #1f3e0b; }
        .page-title span { color: #4e7434; }
        .breadcrumb { font-size: 12px; color: var(--tx2); }
        .breadcrumb a { color: var(--grn2); text-decoration: none; }

        /* TOKO HEADER */
        .toko-bar {
            background: linear-gradient(135deg, #e6f3de 0%, #a5d791 50%, #e6f3de 100%);
            border-radius: 18px; padding: 20px 28px;
            display: flex; align-items: center; gap: 18px;
            margin-bottom: 18px; border: 1px solid #7aab3a;
            position: relative; overflow: hidden;
        }
        .toko-bar::before {
            content: ''; position: absolute; top: -20px; right: -20px;
            width: 120px; height: 120px; border-radius: 50%;
            background: rgba(255,255,255,0.12);
        }
        .toko-avatar {
            width: 60px; height: 60px; border-radius: 14px;
            background: rgba(255,255,255,0.4); border: 1.5px solid rgba(255,255,255,0.7);
            display: flex; align-items: center; justify-content: center;
            font-size: 28px; color: #639922; flex-shrink: 0; z-index: 1;
        }
        .toko-info { flex: 1; z-index: 1; }
        .toko-name { font-size: 18px; font-weight: 700; color: #2d5016; }
        .toko-url  { font-size: 11px; color: #4a7a1e; margin-top: 2px; }
        .toko-actions { display: flex; flex-direction: column; align-items: flex-end; gap: 10px; z-index: 1; flex-shrink: 0; }
        .toko-rating {
            display: flex; align-items: center; gap: 6px;
            background: rgba(255,255,255,0.45); border: 1px solid rgba(255,255,255,0.7);
            border-radius: 10px; padding: 6px 12px;
        }
        .rating-stars { display: flex; gap: 2px; }
        .star { font-size: 13px; }
        .rating-num { font-size: 14px; font-weight: 800; color: #2d5016; }
        .rating-lbl { font-size: 10px; color: #4a7a1e; font-weight: 500; }
        .btn-edit-profil {
            background: white; border: none; border-radius: 11px;
            padding: 9px 18px; font-size: 12px; font-weight: 600;
            color: #639922; cursor: pointer;
            box-shadow: 0 2px 8px rgba(99,153,34,0.15);
            text-decoration: none; display: inline-flex; align-items: center; gap: 6px;
            transition: all 0.2s;
        }
        .btn-edit-profil:hover { transform: translateY(-2px); box-shadow: 0 4px 16px rgba(99,153,34,0.25); }

        /* STATUS ROW */
        .status-row {
            background: white; border: 1px solid var(--grn-border);
            border-radius: 16px; padding: 18px 8px;
            display: grid; grid-template-columns: repeat(4, 1fr);
            gap: 0; margin-bottom: 18px;
        }
        .status-item {
            text-align: center; border-right: 1px solid var(--grn-border);
            padding: 4px 12px; text-decoration: none; display: block;
            transition: background 0.15s; border-radius: 8px;
        }
        .status-item:last-child { border-right: none; }
        .status-num { font-size: 30px; font-weight: 800; color: #2d5016; line-height: 1.1; }
        .status-num.has-alert { color: var(--grn2); }
        .status-lbl { font-size: 11px; color: var(--tx2); font-weight: 500; margin-top: 4px; line-height: 1.4; }
        .notif-badge {
            display: inline-block; background: var(--grn2); color: white;
            font-size: 9px; font-weight: 700; padding: 1px 5px;
            border-radius: 8px; margin-left: 3px; vertical-align: middle;
        }

        /* MENU KOTAK 2x2 */
        .menu-kotak {
            display: flex; flex-direction: column; align-items: center; justify-content: center;
            gap: 10px; text-decoration: none;
            background: #f5fbf0; border: 1px solid var(--grn-border);
            border-radius: 16px; padding: 24px 12px;
            transition: all 0.2s;
        }
        .menu-kotak:hover { transform: translateY(-3px); box-shadow: 0 6px 18px rgba(99,153,34,0.12); border-color: #a8d060; }
        .menu-kotak-ico {
            width: 60px; height: 60px; border-radius: 16px;
            display: flex; align-items: center; justify-content: center;
        }
        .menu-kotak-ico.grn  { color: #4e7434ff; }
        .menu-kotak-ico.grn2 { color: #4e7434ff; }
        .menu-kotak-ico.org  { color: #4e7434ff; }
        .menu-kotak-ico.blu  { color: #4e7434ff; }
        .menu-kotak-lbl { font-size: 13px; font-weight: 700; color: #2d5016; }

        /* MAIN GRID */
        .main-grid { display: grid; grid-template-columns: 1.3fr 1fr; gap: 18px; margin-bottom: 20px; }

        /* PERFORMA TOKO */
        .performa-card {
            background: white; border: 1px solid var(--grn-border); border-radius: 16px;
            padding: 20px 22px; box-shadow: 0 2px 12px rgba(99,153,34,0.06);
            display: flex; flex-direction: column;
        }
        .performa-hdr { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 30px; }
        .performa-title { font-size: 14px; font-weight: 700; color: #2d5016; }
        .performa-period {
            font-size: 10px; color: var(--tx2); background: #eaf3de;
            padding: 3px 10px; border-radius: 10px; font-weight: 500;
        }
        .performa-stats { display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px; margin-bottom: 14px; }
        .perf-stat { text-align: center; }
        .perf-stat-num { font-size: 18px; font-weight: 800; color: #2d5016; line-height: 1; }
        .perf-stat-lbl { font-size: 9px; color: var(--tx2); font-weight: 500; margin-top: 3px; }
        .chart-wrap { position: relative; flex: 1; min-height: 140px; }
        .performa-cta {
            display: flex; align-items: center; justify-content: center; gap: 6px;
            margin-top: 12px; padding: 8px; border-radius: 10px;
            background: #eaf3de; text-decoration: none;
            font-size: 11px; font-weight: 600; color: #639922;
            transition: all 0.15s;
        }
        .performa-cta:hover { background: #d4e8b0; }

        /* CARD UMUM */
        .card {
            background: white; border: 1px solid var(--grn-border); border-radius: 16px;
            padding: 20px 22px; box-shadow: 0 2px 12px rgba(99,153,34,0.06);
        }
        .card-hdr { display: flex; justify-content: space-between; align-items: center; margin-bottom: 14px; }
        .card-title { font-size: 14px; font-weight: 700; color: #2d5016; }
        .card-link { font-size: 12px; font-weight: 600; color: var(--grn2); text-decoration: none; }
        .card-link:hover { color: #4a7a1e; }

        /* PESANAN */
        .order-row {
            display: flex; align-items: center; gap: 10px;
            padding: 9px 0; border-bottom: 0.5px solid #e8f3de;
        }
        .order-row:last-child { border-bottom: none; }
        .buyer-av {
            width: 30px; height: 30px; border-radius: 8px;
            background: linear-gradient(135deg, #eaf3de, #c5e0a0);
            display: flex; align-items: center; justify-content: center;
            font-size: 10px; font-weight: 700; color: #639922; flex-shrink: 0;
        }
        .order-info { flex: 1; min-width: 0; }
        .order-buyer { font-size: 12px; font-weight: 600; color: #2d5016; }
        .order-prod  { font-size: 10px; color: var(--tx2); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .order-right { display: flex; flex-direction: column; align-items: flex-end; gap: 4px; }
        .order-total { font-size: 12px; font-weight: 700; color: #2d5016; white-space: nowrap; }
        .status-pill { display: inline-block; font-size: 9px; font-weight: 700;
            padding: 2px 9px; border-radius: 10px; white-space: nowrap; }
        .st-tunggu  { background: var(--org-bg); color: var(--org); }
        .st-proses  { background: #eaf3de; color: #639922; }
        .st-kirim   { background: var(--blu-bg); color: var(--blu); }
        .st-selesai { background: var(--grn-bg); color: #2d6a2d; }
        .st-batal   { background: #F3F1EE; color: #7a6a5f; }

        /* CTA TAMBAH PRODUK */
        .btn-tambah-produk {
            display: flex; align-items: center; justify-content: center; gap: 12px;
            background: linear-gradient(120deg, #eaf3de 0%, #d4eab8 100%);
            border: 1.5px dashed #7aab3a; border-radius: 16px;
            padding: 18px; text-decoration: none; margin-bottom: 20px;
            transition: all 0.2s;
        }
        .btn-tambah-produk:hover { border-color: #639922; box-shadow: 0 4px 16px rgba(99,153,34,0.12); }
        .btn-tambah-label { font-size: 14px; font-weight: 700; color: #639922; }
        .btn-tambah-sub   { font-size: 11px; color: var(--tx2); }

        /* EMPTY STATE */
        .empty { text-align: center; padding: 28px 0; }
        .empty-ico { font-size: 30px; margin-bottom: 6px; }
        .empty-txt { font-size: 13px; color: var(--tx2); font-weight: 500; }
        .empty-sub { font-size: 11px; color: #9ab87a; margin-top: 4px; }

        /* REKOMENDASI */
        .rek-title { font-size: 16px; font-weight: 700; color: #2d5016; margin-bottom: 12px; }
        .rek-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 14px; margin-bottom: 20px; }
        .rek-card {
            background: white; border: 1px solid var(--grn-border); border-radius: 16px;
            padding: 18px 20px; position: relative; box-shadow: 0 2px 12px rgba(99,153,34,0.06);
            transition: opacity 0.2s, transform 0.2s;
        }
        .rek-close {
            position: absolute; right: 14px; top: 14px;
            background: none; border: none; font-size: 14px;
            color: var(--tx2); cursor: pointer; line-height: 1;
            width: 22px; height: 22px; display: flex; align-items: center; justify-content: center;
            border-radius: 50%; transition: background 0.15s;
        }
        .rek-close:hover { background: #eaf3de; }
        .rek-icon { font-size: 22px; margin-bottom: 8px; }
        .rek-head { font-size: 12px; font-weight: 700; color: #2d5016; margin-bottom: 5px; line-height: 1.4; padding-right: 20px; }
        .rek-sub  { font-size: 11px; color: var(--tx2); margin-bottom: 14px; line-height: 1.5; }
        .rek-btns { display: flex; gap: 8px; flex-wrap: wrap; }
        .btn-outline {
            padding: 6px 14px; border-radius: 20px; font-size: 11px; font-weight: 600;
            border: 1.5px solid #639922; color: #639922; background: none; cursor: pointer;
            text-decoration: none; display: inline-block; transition: all 0.15s;
        }
        .btn-outline:hover { background: #eaf3de; }
        .btn-solid {
            padding: 6px 14px; border-radius: 20px; font-size: 11px; font-weight: 600;
            background: #639922; color: white; border: none; cursor: pointer;
            text-decoration: none; display: inline-block; transition: all 0.15s;
        }
        .btn-solid:hover { background: #4a7a1e; }

        /* FOOTER */
        footer { background: #f5fbf0; border-top: 1px solid var(--grn-border); }
        .footer-inner { display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 48px; padding: 60px 48px 40px; }
        .f-logo img { height: 28px; width: auto; object-fit: contain; }
        .footer-brand p { font-size: 13px; color: var(--tx2); line-height: 1.7; max-width: 280px; }
        .footer-col h4 { font-size: 12px; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; color: #2d5016; margin-bottom: 16px; }
        .footer-col ul { list-style: none; }
        .footer-col li { margin-bottom: 10px; }
        .footer-col a { font-size: 13px; color: var(--tx2); text-decoration: none; transition: color 0.2s; }
        .footer-col a:hover { color: #2d5016; }
        .footer-bottom {
            border-top: 1px solid var(--grn-border); padding: 20px 48px;
            display: flex; justify-content: space-between; align-items: center;
            font-size: 12px; color: var(--tx2);
        }
        .payment-icons { display: flex; gap: 8px; align-items: center; }
        .pay-badge { background: white; border: 1px solid var(--grn-border); border-radius: 6px; padding: 4px 8px; font-size: 10px; font-weight: 700; color: #2d5016; }
    </style>
</head>
<body>


    <div class="seller-page">

        {{-- BREADCRUMB --}}
        <div class="page-header">
            <div>
                <div class="breadcrumb"><a href="{{ route('profil') }}">Profil</a> / Dashboard Penjual</div>
                <div class="page-title">Dashboard <span>Penjual</span></div>
            </div>
            <a href="{{ route('profil') }}" style="font-size:13px; color:#4e7434; text-decoration:none; font-weight:500;">← Kembali ke Profil</a>
        </div>

        {{-- TOKO HEADER --}}
        <div class="toko-bar">
            {{-- Spark decorations --}}
            <div style="position:absolute; top:14px; right:160px;">
                <svg width="28" height="28" viewBox="0 0 24 24"><path d="M12 2 L13.5 10 L22 12 L13.5 14 L12 22 L10.5 14 L2 12 L10.5 10 Z" fill="rgba(255,255,255,0.8)"/></svg>
            </div>
            <div style="position:absolute; top:40px; right:120px;">
                <svg width="16" height="16" viewBox="0 0 24 24"><path d="M12 2 L13.5 10 L22 12 L13.5 14 L12 22 L10.5 14 L2 12 L10.5 10 Z" fill="rgba(255,255,255,0.6)"/></svg>
            </div>
            <div style="position:absolute; bottom:20px; right:180px;">
                <svg width="20" height="20" viewBox="0 0 24 24"><path d="M12 2 L13.5 10 L22 12 L13.5 14 L12 22 L10.5 14 L2 12 L10.5 10 Z" fill="rgba(255,255,255,0.7)"/></svg>
            </div>
            <div style="position:absolute; top:20px; left:220px;">
                <svg width="14" height="14" viewBox="0 0 24 24"><path d="M12 2 L13.5 10 L22 12 L13.5 14 L12 22 L10.5 14 L2 12 L10.5 10 Z" fill="rgba(255,255,255,0.5)"/></svg>
            </div>

            {{-- Section 1: Avatar --}}
            <div class="toko-avatar">
                <iconify-icon icon="solar:shop-bold" width="28"></iconify-icon>
            </div>

            {{-- Section 2: Nama toko --}}
            <div class="toko-info">
                <div class="toko-name">{{ $store->nama_toko }}</div>
                <div class="toko-url">ayune.id/{{ $store->slug }}</div>
            </div>

            {{-- Section 3: Rating + Tombol Edit Profil --}}
            <div class="toko-actions">
                <div class="toko-rating">
                    <div class="rating-stars">
                        @for($i = 1; $i <= 5; $i++)
                            <span class="star" style="color: {{ $i <= round($ratingToko) ? '#f59e0b' : '#c5d9a0' }};">★</span>
                        @endfor
                    </div>
                    <span class="rating-num">{{ number_format($ratingToko, 1) }}</span>
                    <span class="rating-lbl">/ 5.0</span>
                </div>
                <a href="{{ route('seller.toko.edit') }}" class="btn-edit-profil">
                    <iconify-icon icon="solar:pen-bold" width="14"></iconify-icon>
                    Edit Profil Toko
                </a>
            </div>
        </div>

        {{-- STATUS ROW --}}
        <div class="status-row">
            <a href="{{ route('seller.pesanan.index', ['status' => 'menunggu_konfirmasi']) }}" class="status-item">
                <div class="status-num {{ $pesananBaru > 0 ? 'has-alert' : '' }}">
                    {{ $pesananBaru }}
                    @if($pesananBaru > 0)<span class="notif-badge">!</span>@endif
                </div>
                <div class="status-lbl">Perlu Dikonfirmasi</div>
            </a>
            <a href="{{ route('seller.pesanan.index', ['status' => 'diproses']) }}" class="status-item">
                <div class="status-num {{ $pesananDiproses > 0 ? 'has-alert' : '' }}">{{ $pesananDiproses }}</div>
                <div class="status-lbl">Perlu Dikirim</div>
            </a>
            <a href="{{ route('seller.pesanan.index', ['status' => 'dikirim']) }}" class="status-item">
                <div class="status-num">{{ $pesananDikirim }}</div>
                <div class="status-lbl">Sedang Dikirim</div>
            </a>
            <a href="{{ route('seller.pesanan.index', ['status' => 'selesai']) }}" class="status-item">
                <div class="status-num">{{ $pesananPerluBalas }}</div>
                <div class="status-lbl">Penilaian Perlu Dibalas</div>
            </a>
        </div>

        {{-- MAIN GRID: Performa Toko + 4 Menu Kotak --}}
        <div class="main-grid">

            {{-- PERFORMA TOKO --}}
            <div class="performa-card">
                <div class="performa-hdr">
                    <div class="performa-title">Performa Toko</div>
                    <span class="performa-period">30 hari terakhir</span>
                </div>
                <div class="performa-stats">
                    <div class="perf-stat">
                        <div class="perf-stat-num" style="color:#4e7434ff;">Rp {{ number_format($totalPendapatan/1000, 0) }}rb</div>
                        <div class="perf-stat-lbl">Pendapatan</div>
                    </div>
                    <div class="perf-stat">
                        <div class="perf-stat-num" style="color: #6b4144;">{{ $pesananMasuk->count() }}</div>
                        <div class="perf-stat-lbl">Pesanan</div>
                    </div>
                    <div class="perf-stat">
                        <div class="perf-stat-num" style="color:#f59e0b;">{{ number_format($ratingToko, 1) }}★</div>
                        <div class="perf-stat-lbl">Rating</div>
                    </div>
                </div>
                <div class="chart-wrap">
                    <canvas id="perfChart"></canvas>
                </div>
                <a href="{{ route('seller.statistik') }}" class="performa-cta">
                    <iconify-icon icon="solar:chart-2-bold" width="14"></iconify-icon>
                    Lihat Statistik Lengkap →
                </a>
            </div>

            {{-- 4 MENU KOTAK --}}
            <div class="card" style="display:grid; grid-template-columns: repeat(2,1fr); gap:14px; padding:22px;">
                <a href="{{ route('seller.produk.index') }}" class="menu-kotak">
                    <div class="menu-kotak-ico grn">
                        <iconify-icon icon="solar:box-bold" width="40"></iconify-icon>
                    </div>
                    <span class="menu-kotak-lbl">Produk</span>
                </a>
                <a href="{{ route('seller.pesanan.index') }}" class="menu-kotak">
                    <div class="menu-kotak-ico grn2">
                        <iconify-icon icon="solar:clipboard-list-bold" width="40"></iconify-icon>
                    </div>
                    <span class="menu-kotak-lbl">Pesanan</span>
                </a>
                <a href="{{ route('seller.keuangan') }}" class="menu-kotak">
                    <div class="menu-kotak-ico org">
                        <iconify-icon icon="solar:wallet-money-bold" width="40"></iconify-icon>
                    </div>
                    <span class="menu-kotak-lbl">Keuangan</span>
                </a>
                <a href="{{ route('seller.chat.index') }}" class="menu-kotak">
                    <div class="menu-kotak-ico blu">
                        <iconify-icon icon="solar:chat-round-dots-bold" width="40"></iconify-icon>
                    </div>
                    <span class="menu-kotak-lbl">Chat Pembeli</span>
                </a>
            </div>
        </div>

        {{-- PESANAN TERBARU --}}
        <div class="card" style="margin-bottom: 20px;">
            <div class="card-hdr">
                <div class="card-title">Pesanan Terbaru</div>
                <a href="{{ route('seller.pesanan.index') }}" class="card-link">Lihat Semua →</a>
            </div>
            @if($pesananMasuk->isEmpty())
                <div class="empty">
                    <iconify-icon icon="lsicon:order-filled" width="50" style="color:#639922;"></iconify-icon>
                    <div class="empty-txt">Belum ada pesanan masuk</div>
                    <div class="empty-sub">Pesanan dari pembeli akan muncul di sini</div>
                </div>
            @else
                @foreach($pesananMasuk as $order)
                    @php
                        $firstItem = $order->orderItems->first();
                        $product   = $firstItem?->product;
                        $buyerName = $order->buyer->name ?? 'Pembeli';
                        $initials  = strtoupper(substr($buyerName, 0, 2));
                        $sc = match($order->status) {
                            'menunggu_konfirmasi' => 'st-tunggu',
                            'diproses'            => 'st-proses',
                            'dikirim'             => 'st-kirim',
                            'selesai'             => 'st-selesai',
                            default               => 'st-batal',
                        };
                        $sl = ucfirst(str_replace('_', ' ', $order->status));
                    @endphp
                    <div class="order-row">
                        <div class="buyer-av">{{ $initials }}</div>
                        <div class="order-info">
                            <div class="order-buyer">{{ Str::limit($buyerName, 14) }}</div>
                            <div class="order-prod">{{ Str::limit($product->nama_produk ?? '-', 28) }}</div>
                        </div>
                        <div class="order-right">
                            <div class="order-total">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</div>
                            <span class="status-pill {{ $sc }}">{{ $sl }}</span>
                        </div>
                    </div>
                @endforeach
            @endif
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

    <script>
        const perfCtx = document.getElementById('perfChart').getContext('2d');
        const chartRaw   = {!! json_encode($chartPenjualan) !!};
        const perfLabels = chartRaw.map(d => d.tanggal);
        const perfData   = chartRaw.map(d => d.total);

        new Chart(perfCtx, {
            type: 'bar',
            data: {
                labels: perfLabels,
                datasets: [{
                    label: 'Pendapatan',
                    data: perfData,
                    backgroundColor: 'rgba(99,153,34,0.15)',
                    borderColor: '#639922',
                    borderWidth: 2,
                    borderRadius: 6,
                    borderSkipped: false,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: ctx => 'Rp ' + ctx.raw.toLocaleString('id-ID')
                        }
                    }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: { font: { size: 9, family: 'Poppins' }, color: '#5a7a40' }
                    },
                    y: {
                        grid: { color: 'rgba(197,224,160,0.4)', drawBorder: false },
                        ticks: {
                            font: { size: 9, family: 'Poppins' }, color: '#5a7a40',
                            callback: val => 'Rp ' + (val/1000) + 'rb'
                        }
                    }
                }
            }
        });

        function tutupRek(id) {
            const el = document.getElementById(id);
            if (el) {
                el.style.opacity = '0';
                el.style.transform = 'scale(0.95)';
                setTimeout(() => el.style.display = 'none', 200);
            }
        }
    </script>

</body>
</html>