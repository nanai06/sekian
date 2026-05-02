<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.iconify.design/iconify-icon/2.1.0/iconify-icon.min.js"></script>
    <title>Keuangan Toko - AYU-NE</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --pk: #639922; --pk2: #4a7a1e; --pk-light: #eaf3de;
            --border: #c5e0a0; --text: #2d5016; --text2: #5a7a40;
            --org: #E65100; --org-bg: #FFF3E0;
        }
        * { margin:0; padding:0; box-sizing:border-box; font-family:'Poppins',sans-serif; }
        body { background:linear-gradient(180deg,#e8f5e0 0%,#f5fff5 50%,#e8f5e0 100%); color:var(--text); }
        .page { max-width:1100px; margin:0 auto; padding:30px 40px 60px; }
        .breadcrumb { font-size:12px; color:var(--text2); margin-bottom:4px; }
        .breadcrumb a { color:var(--pk); text-decoration:none; }
        .page-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:24px; }
        .page-title { font-size:24px; font-weight:800; }
        .page-title span { color:var(--pk); }
        .btn-back {
            display:inline-flex; align-items:center; gap:6px;
            padding:9px 18px; border:1.5px solid var(--border);
            border-radius:10px; font-size:13px; font-weight:600;
            color:var(--text2); background:white; text-decoration:none; transition:all 0.2s;
        }
        .btn-back:hover { border-color:var(--pk); color:var(--pk); }

        /* SALDO CARDS */
        .saldo-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:14px; margin-bottom:24px; }
        .saldo-card {
            background:white; border:1px solid var(--border); border-radius:16px;
            padding:22px; box-shadow:0 2px 12px rgba(99,153,34,0.06);
        }
        .saldo-card.highlight {
            background:linear-gradient(135deg, #e6f3de 0%, #a5d79184 50%, #e6f3de 100%);
            border-color:#7aab3a;
        }
        .saldo-icon { font-size:20px; margin-bottom:8px; }
        .saldo-num { font-size:24px; font-weight:800; color:var(--text); line-height:1; margin-bottom:4px; }
        .saldo-lbl { font-size:11px; color:var(--text2); font-weight:500; }
        .saldo-sub { font-size:10px; color: #668545; margin-top:4px; }

        /* RIWAYAT */
        .riwayat-card {
            background:white; border:1px solid var(--border); border-radius:16px;
            box-shadow:0 2px 12px rgba(99,153,34,0.06); overflow:hidden;
        }
        .riwayat-header {
            padding:18px 22px; border-bottom:1px solid var(--border);
            display:flex; justify-content:space-between; align-items:center;
        }
        .riwayat-title { font-size:15px; font-weight:700; }

        .trx-row {
            display:flex; align-items:center; gap:14px;
            padding:14px 22px; border-bottom:0.5px solid #e8f3de;
            transition:background 0.15s;
        }
        .trx-row:last-child { border-bottom:none; }
        .trx-row:hover { background:#f9fdf5; }

        .trx-icon {
            width:40px; height:40px; border-radius:10px;
            background:var(--pk-light); display:flex; align-items:center; justify-content:center;
            font-size:18px; flex-shrink:0;
        }
        .trx-main { flex:1; min-width:0; }
        .trx-buyer { font-size:13px; font-weight:600; color:var(--text); }
        .trx-produk { font-size:11px; color:var(--text2); margin-top:2px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
        .trx-tanggal { font-size:10px; color:#9ab87a; margin-top:2px; }
        .trx-amount { font-size:14px; font-weight:700; color:#2d6a2d; flex-shrink:0; white-space:nowrap; }

        .empty-state { text-align:center; padding:48px 20px; }
        .empty-text { font-size:14px; font-weight:600; color:var(--text); margin-top:10px; }
        .empty-sub { font-size:12px; color:var(--text2); margin-top:4px; }

        .pagination-wrap { display:flex; justify-content:center; margin-top:24px; }
    </style>
</head>
<body>

    <div class="page">
        <div class="page-header">
            <div>
                <div class="breadcrumb">
                    <a href="{{ route('profil') }}">Profil</a> /
                    <a href="{{ route('seller.dashboard') }}">Dashboard Penjual</a> /
                    Keuangan
                </div>
                <div class="page-title">Keuangan <span>Toko</span></div>
            </div>
            <a href="{{ route('seller.dashboard') }}" class="btn-back">
                <iconify-icon icon="solar:arrow-left-linear" width="15"></iconify-icon>
                Kembali
            </a>
        </div>

        {{-- SALDO CARDS --}}
        {{-- Card 1: Total Pendapatan --}}
        <div class="saldo-grid">
            <div class="saldo-card highlight">
                <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:10px;">
                    <div class="saldo-num">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</div>
                    <iconify-icon icon="solar:wallet-money-bold" width="38" style="color:#639922; opacity:0.5;"></iconify-icon>
                </div>
                <div class="saldo-lbl">Total Pendapatan</div>
                <div class="saldo-sub">Dari {{ $jumlahTransaksi }} transaksi selesai</div>
            </div>
            <div class="saldo-card">
                <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:10px;">
                    <div class="saldo-num">Rp {{ number_format($pendapatanBulanIni, 0, ',', '.') }}</div>
                    <iconify-icon icon="solar:calendar-bold" width="38" style="color:#639922; opacity:0.5;"></iconify-icon>
                </div>
                <div class="saldo-lbl">Pendapatan Bulan Ini</div>
                <div class="saldo-sub">{{ now()->isoFormat('MMMM Y') }}</div>
            </div>
            <div class="saldo-card">
                <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:10px;">
                    <div class="saldo-num" style="color:#639922;">Rp {{ number_format($pendingIncome, 0, ',', '.') }}</div>
                    <iconify-icon icon="solar:clock-circle-bold" width="38" style="color:#639922; opacity:0.5;"></iconify-icon>
                </div>
                <div class="saldo-lbl">Menunggu Selesai</div>
                <div class="saldo-sub">Pesanan belum selesai</div>
            </div>
        </div>

        {{-- RIWAYAT TRANSAKSI --}}
        <div class="riwayat-card">
            <div class="riwayat-header">
                <div class="riwayat-title">Riwayat Transaksi</div>
                <span style="font-size:12px; color:var(--text2);">{{ $riwayatTransaksi->total() }} transaksi</span>
            </div>

            @if($riwayatTransaksi->isEmpty())
                <div class="empty-state">
                    <iconify-icon icon="solar:wallet-money-bold" width="48" style="color:var(--border);"></iconify-icon>
                    <div class="empty-text">Belum ada transaksi selesai</div>
                    <div class="empty-sub">Pendapatan dari pesanan selesai akan muncul di sini</div>
                </div>
            @else
                @foreach($riwayatTransaksi as $trx)
                    @php
                        $firstItem = $trx->orderItems->first();
                        $product   = $firstItem?->product;
                        $buyerName = $trx->buyer->name ?? 'Pembeli';
                        $itemCount = $trx->orderItems->count();
                    @endphp
                    <div class="trx-row">
                        <div class="trx-icon">✅</div>
                        <div class="trx-main">
                            <div class="trx-buyer">{{ $buyerName }}</div>
                            <div class="trx-produk">
                                {{ $product->nama_produk ?? '-' }}
                                @if($itemCount > 1)
                                    <span style="color:var(--pk); font-weight:600;">+{{ $itemCount - 1 }} lainnya</span>
                                @endif
                            </div>
                            <div class="trx-tanggal">{{ $trx->created_at->format('d M Y, H:i') }}</div>
                        </div>
                        <div class="trx-amount">+Rp {{ number_format($trx->total_harga, 0, ',', '.') }}</div>
                    </div>
                @endforeach
            @endif
        </div>

        <div class="pagination-wrap">
            {{ $riwayatTransaksi->links() }}
        </div>
    </div>

</body>
</html>
