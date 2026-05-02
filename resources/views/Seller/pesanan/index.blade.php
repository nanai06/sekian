<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.iconify.design/iconify-icon/2.1.0/iconify-icon.min.js"></script>
    <title>Pesanan Masuk - AYU-NE</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --pk: #639922; --pk2: #4a7a1e; --pk-light: #eaf3de;
            --border: #c5e0a0; --text: #2d5016; --text2: #5a7a40;
            --grn: #4CAF7D; --grn-bg: #EAF3DE;
            --org: #E65100; --org-bg: #FFF3E0;
            --blu: #1565C0; --blu-bg: #E3F2FD;
        }
        * { margin:0; padding:0; box-sizing:border-box; font-family:'Poppins',sans-serif; }
        body { background:linear-gradient(180deg,#e8f5e0 0%,#f5fff5 50%,#e8f5e0 100%); color:var(--text); }
        .seller-page { max-width:1100px; margin:0 auto; padding:30px 40px 60px; }
        .page-header { display:flex; align-items:center; justify-content:space-between; margin-bottom:24px; }
        .page-title { font-size:24px; font-weight:800; }
        .page-title span { color:var(--pk); }
        .breadcrumb { font-size:12px; color:var(--text2); margin-bottom:4px; }
        .breadcrumb a { color:var(--pk); text-decoration:none; }
        .btn-back {
            display:inline-flex; align-items:center; gap:6px;
            padding:9px 18px; border:1.5px solid var(--border);
            border-radius:10px; font-size:13px; font-weight:600;
            color:var(--text2); background:white; text-decoration:none; transition:all 0.2s;
        }
        .btn-back:hover { border-color:var(--pk); color:var(--pk); }

        /* FILTER TABS */
        .filter-tabs {
            display:flex; gap:8px; margin-bottom:20px; flex-wrap:wrap;
        }
        .filter-tab {
            padding:8px 18px; border-radius:20px; font-size:12px; font-weight:600;
            text-decoration:none; border:1.5px solid var(--border);
            color:var(--text2); background:white; transition:all 0.2s;
            display:inline-flex; align-items:center; gap:6px;
        }
        .filter-tab:hover { border-color:var(--pk); color:var(--pk); }
        .filter-tab.active { background:var(--pk); color:white; border-color:var(--pk); }
        .filter-tab .count {
            background:rgba(255,255,255,0.25); padding:1px 7px;
            border-radius:10px; font-size:10px; font-weight:700;
        }
        .filter-tab.active .count { background:rgba(255,255,255,0.3); }
        .filter-tab:not(.active) .count { background:var(--pk-light); color:var(--pk); }

        /* ORDER LIST */
        .order-list-card {
            background:white; border:1px solid var(--border); border-radius:16px;
            box-shadow:0 2px 12px rgba(99,153,34,0.06); overflow:hidden;
        }
        .order-list-header {
            padding:18px 22px; border-bottom:1px solid var(--border);
            display:flex; justify-content:space-between; align-items:center;
        }
        .order-list-title { font-size:15px; font-weight:700; }

        .order-row {
            display:flex; align-items:center; gap:14px;
            padding:14px 22px; border-bottom:0.5px solid #e8f3de; transition:background 0.15s;
        }
        .order-row:last-child { border-bottom:none; }
        .order-row:hover { background:#f9fdf5; }
        .buyer-av {
            width:38px; height:38px; border-radius:10px;
            background:linear-gradient(135deg,#eaf3de,#c5e0a0);
            display:flex; align-items:center; justify-content:center;
            font-size:12px; font-weight:700; color:var(--pk); flex-shrink:0;
        }
        .order-main { flex:1; min-width:0; }
        .order-buyer { font-size:13px; font-weight:600; }
        .order-produk { font-size:11px; color:var(--text2); margin-top:2px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
        .order-tanggal { font-size:10px; color:#9ab87a; margin-top:2px; }
        .order-meta { display:flex; flex-direction:column; align-items:flex-end; gap:4px; flex-shrink:0; }
        .order-total { font-size:13px; font-weight:700; white-space:nowrap; }
        .order-items-count { font-size:10px; color:var(--text2); }
        .status-pill { display:inline-block; font-size:10px; font-weight:700; padding:3px 10px; border-radius:10px; white-space:nowrap; }
        .st-tunggu  { background:var(--org-bg); color:var(--org); }
        .st-proses  { background:#eaf3de; color:#639922; }
        .st-kirim   { background:var(--blu-bg); color:var(--blu); }
        .st-selesai { background:var(--grn-bg); color:#2d6a2d; }
        .st-batal   { background:#F3F1EE; color:#7a6a5f; }

        .empty-state { text-align:center; padding:60px 20px; }
        .empty-text { font-size:15px; font-weight:700; margin-bottom:6px; margin-top:12px; }
        .empty-sub { font-size:13px; color:var(--text2); }
        .pagination-wrap { display:flex; justify-content:center; margin-top:24px; }
    </style>
</head>
<body>
    <div class="seller-page">
        <div class="page-header">
            <div>
                <div class="breadcrumb">
                    <a href="{{ route('profil') }}">Profil</a> /
                    <a href="{{ route('seller.dashboard') }}">Dashboard</a> /
                    Pesanan Masuk
                </div>
                <div class="page-title">Pesanan <span>Masuk</span></div>
            </div>
            <a href="{{ route('seller.dashboard') }}" class="btn-back">
                <iconify-icon icon="solar:arrow-left-linear" width="15"></iconify-icon>
                Kembali
            </a>
        </div>

        {{-- FILTER TABS --}}
        @php $currentFilter = request('status', ''); @endphp
        <div class="filter-tabs">
            <a href="{{ route('seller.pesanan.index') }}"
               class="filter-tab {{ $currentFilter === '' ? 'active' : '' }}">
                Semua <span class="count">{{ $jumlahBaru + $jumlahDiproses + $jumlahDikirim }}</span>
            </a>
            <a href="{{ route('seller.pesanan.index', ['status' => 'menunggu_konfirmasi']) }}"
            class="filter-tab {{ $currentFilter === 'menunggu_konfirmasi' ? 'active' : '' }}">
                <iconify-icon icon="solar:bell-linear" width="13"></iconify-icon>
                Perlu Dikonfirmasi <span class="count">{{ $jumlahBaru }}</span>
            </a>
            <a href="{{ route('seller.pesanan.index', ['status' => 'diproses']) }}"
            class="filter-tab {{ $currentFilter === 'diproses' ? 'active' : '' }}">
                <iconify-icon icon="solar:box-linear" width="13"></iconify-icon>
                Perlu Dikirim <span class="count">{{ $jumlahDiproses }}</span>
            </a>
            <a href="{{ route('seller.pesanan.index', ['status' => 'dikirim']) }}"
            class="filter-tab {{ $currentFilter === 'dikirim' ? 'active' : '' }}">
                <iconify-icon icon="solar:delivery-linear" width="13"></iconify-icon>
                Sedang Dikirim <span class="count">{{ $jumlahDikirim }}</span>
            </a>
            <a href="{{ route('seller.pesanan.index', ['status' => 'selesai']) }}"
            class="filter-tab {{ $currentFilter === 'selesai' ? 'active' : '' }}">
                <iconify-icon icon="solar:check-circle-linear" width="13"></iconify-icon>
                Selesai
            </a>
        </div>

        {{-- ORDER LIST --}}
        <div class="order-list-card">
            <div class="order-list-header">
                <div class="order-list-title">
                    @if($currentFilter === 'menunggu_konfirmasi') Pesanan Perlu Dikonfirmasi
                    @elseif($currentFilter === 'diproses') Pesanan Perlu Dikirim
                    @elseif($currentFilter === 'dikirim') Pesanan Sedang Dikirim
                    @elseif($currentFilter === 'selesai') Pesanan Selesai
                    @else Semua Pesanan
                    @endif
                </div>
                <span style="font-size:12px; color:var(--text2);">{{ $pesanan->total() }} pesanan</span>
            </div>

            @if($pesanan->isEmpty())
                <div class="empty-state">
                    <iconify-icon icon="lsicon:order-filled" width="50" style="color:var(--pk); display:center; margin:0 auto;"></iconify-icon>
                    <div class="empty-text">
                        @if($currentFilter) Tidak ada pesanan dengan status ini
                        @else Belum ada pesanan masuk
                        @endif
                    </div>
                    <div class="empty-sub">Pesanan dari pembeli akan muncul di sini</div>
                </div>
            @else
                @foreach($pesanan as $order)
                    @php
                        $firstItem = $order->orderItems->first();
                        $product   = $firstItem?->product;
                        $buyerName = $order->buyer->name ?? 'Pembeli';
                        $initials  = strtoupper(substr($buyerName, 0, 2));
                        $itemCount = $order->orderItems->count();
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
                        <div class="order-main">
                            <div class="order-buyer">{{ $buyerName }}</div>
                            <div class="order-produk">
                                {{ $product->nama_produk ?? '-' }}
                                @if($itemCount > 1)
                                    <span style="color:var(--pk); font-weight:600;">+{{ $itemCount - 1 }} lainnya</span>
                                @endif
                            </div>
                            <div class="order-tanggal">{{ $order->created_at->format('d M Y, H:i') }}</div>
                        </div>
                        <div class="order-meta">
                            <div class="order-total">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</div>
                            <span class="status-pill {{ $sc }}">{{ $sl }}</span>
                            <div class="order-items-count">{{ $itemCount }} item</div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        <div class="pagination-wrap">
            {{ $pesanan->appends(request()->query())->links() }}
        </div>
    </div>
</body>
</html>
