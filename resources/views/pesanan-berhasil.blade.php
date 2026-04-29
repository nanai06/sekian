<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.iconify.design/iconify-icon/2.1.0/iconify-icon.min.js"></script>
    <title>Pesanan Berhasil - AYU-NE</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body { background: linear-gradient(180deg, #ffe8ed 0%, #fff5f5 50%, #ffe8ed 100%); color: #3b1a1a; }
        
        .steps-bar { background: white; border-bottom: 1px solid #f5e0e0; padding: 14px 50px; display: flex; align-items: center; gap: 8px; }
        .step { display: flex; align-items: center; gap: 8px; font-size: 13px; font-weight: 500; color: #9E7178; }
        .step.done { color: #4CAF7D; font-weight: 700; }
        .step-num { width: 26px; height: 26px; border-radius: 50%; background: #F0D5D8; color: #9E7178; font-size: 12px; font-weight: 700; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .step.done .step-num { background: #4CAF7D; color: white; }
        .step-arrow { color: #F0D5D8; font-size: 16px; }

        .success-wrap { min-height: calc(100vh - 75px - 55px); display: flex; align-items: center; justify-content: center; padding: 40px 20px; }
        .success-box { text-align: center; background: white; border: 1.5px solid #F0D5D8; border-radius: 28px; padding: 56px 52px; max-width: 540px; width: 100%; box-shadow: 0 8px 40px rgba(184,92,101,0.1); animation: popIn 0.5s cubic-bezier(0.34,1.3,0.64,1) both; }
        @keyframes popIn { from{opacity:0;transform:scale(0.9) translateY(20px)} to{opacity:1;transform:scale(1) translateY(0)} }

        .check-circle { width: 96px; height: 96px; border-radius: 50%; background: linear-gradient(135deg, #e8f5e9, #c8e6c9); border: 3px solid #4CAF7D; display: flex; align-items: center; justify-content: center; margin: 0 auto 28px; animation: bounceIn 0.6s 0.2s cubic-bezier(0.34,1.5,0.64,1) both; }
        @keyframes bounceIn { from{opacity:0;transform:scale(0.5)} to{opacity:1;transform:scale(1)} }

        .success-title { font-size: 26px; font-weight: 800; color: #2A1520; margin-bottom: 10px; }
        .order-id { display: inline-flex; align-items: center; gap: 6px; font-size: 13px; color: #9E7178; font-weight: 600; background: #fff0f3; border: 1px solid #F0D5D8; padding: 5px 16px; border-radius: 100px; margin-bottom: 18px; }
        .success-desc { font-size: 14px; color: #7a4a4a; line-height: 1.75; margin-bottom: 12px; }

        /* ── KOIN REWARD — emoji 🪙 ── */
        .koin-reward { display: flex; align-items: center; justify-content: center; gap: 8px; background: linear-gradient(135deg, #ffe8ed, #ffdde4); border: 1px solid #F0D5D8; border-radius: 14px; padding: 12px 20px; margin-bottom: 28px; font-size: 13px; font-weight: 600; color: #5D393B; }
        .koin-reward .koin-emoji { font-size: 22px; line-height: 1; }

        .info-cards { display: flex; gap: 12px; margin: 24px 0 32px; }
        .info-card { flex: 1; background: #FFF8F9; border: 1px solid #F0D5D8; border-radius: 14px; padding: 14px 12px; text-align: center; }
        .info-card-icon { width: 36px; height: 36px; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin: 0 auto 8px; }
        .info-card-icon.green  { background: #e8f5e9; }
        .info-card-icon.blue   { background: #e3f0fd; }
        .info-card-icon.yellow { background: #fef6df; }
        .info-card-label { font-size: 10px; color: #9E7178; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 3px; }
        .info-card-val   { font-size: 13px; font-weight: 700; color: #5D393B; }

        .action-buttons { display: flex; gap: 12px; justify-content: center; }
        .btn-lihat { display: flex; align-items: center; gap: 8px; padding: 14px 26px; background: #e07080; color: white; border: none; border-radius: 100px; font-size: 14px; font-weight: 700; cursor: pointer; font-family: 'Poppins', sans-serif; text-decoration: none; transition: all 0.2s; box-shadow: 0 4px 16px rgba(224,112,128,0.35); }
        .btn-lihat:hover { background: #c85070; transform: translateY(-1px); }
        .btn-lanjut { display: flex; align-items: center; gap: 8px; padding: 14px 26px; background: white; color: #5D393B; border: 1.5px solid #F0D5D8; border-radius: 100px; font-size: 14px; font-weight: 700; cursor: pointer; font-family: 'Poppins', sans-serif; text-decoration: none; transition: all 0.2s; }
        .btn-lanjut:hover { border-color: #FFBBC0; color: #e07080; background: #FFF8F9; }
    </style>
</head>
<body>

{{-- Navbar diambil dari file layouts/navigation.blade.php --}}
@include('layouts.navigation')

<div class="steps-bar">
    <div class="step done"><div class="step-num"><iconify-icon icon="ph:check-bold" width="12"></iconify-icon></div>Keranjang</div>
    <div class="step-arrow">›</div>
    <div class="step done"><div class="step-num"><iconify-icon icon="ph:check-bold" width="12"></iconify-icon></div>Checkout</div>
    <div class="step-arrow">›</div>
    <div class="step done"><div class="step-num"><iconify-icon icon="ph:check-bold" width="12"></iconify-icon></div>Selesai</div>
</div>

<div class="success-wrap">
    <div class="success-box">

        <div class="check-circle">
            <iconify-icon icon="ph:check-bold" width="44" style="color:#4CAF7D;"></iconify-icon>
        </div>

        <div class="success-title">Pesanan Berhasil Dibuat!</div>

        <div class="order-id">
            <iconify-icon icon="ph:receipt-bold" width="14" style="color:#e07080;"></iconify-icon>
            Order ID: #AYU-{{ $order ? str_pad($order->id, 5, '0', STR_PAD_LEFT) : '00000' }}
        </div>

        <div class="success-desc">
            Pesananmu sedang diproses oleh penjual.<br>
            Kami akan mengirim notifikasi saat pesanan dikirim.
        </div>

        {{-- Koin reward — emoji 🪙 --}}
        <div class="koin-reward">
            <span class="koin-emoji">🪙</span>
            Kamu mendapat <strong>+{{ $koinReward }} Ayu Koin</strong> dari pesanan ini! 🎉
        </div>

        <div class="info-cards">
            <div class="info-card">
                <div class="info-card-icon green">
                    <iconify-icon icon="ph:truck-bold" width="18" style="color:#4CAF7D;"></iconify-icon>
                </div>
                <div class="info-card-label">Total Bayar</div>
                <div class="info-card-val">Rp {{ $order ? number_format($order->total_bayar, 0, ',', '.') : '0' }}</div>
            </div>
            <div class="info-card">
                <div class="info-card-icon blue">
                    <iconify-icon icon="ph:bank-bold" width="18" style="color:#4A90D9;"></iconify-icon>
                </div>
                <div class="info-card-label">Pembayaran</div>
                <div class="info-card-val">{{ $order->metode_pengiriman ?? 'Midtrans' }}</div>
            </div>
            <div class="info-card">
                <div class="info-card-icon yellow">
                    <iconify-icon icon="ph:package-bold" width="18" style="color:#F5A623;"></iconify-icon>
                </div>
                <div class="info-card-label">Jumlah Produk</div>
                <div class="info-card-val">{{ $order ? $order->orderItems->count() : 0 }} item</div>
            </div>
        </div>

        <div class="action-buttons">
            <a href="{{ $order ? route('detail-pesanan', $order->id) : route('pesanan-saya') }}" class="btn-lihat">
                <iconify-icon icon="ph:package-bold" width="16"></iconify-icon>
                Lihat Pesanan
            </a>
            <a href="{{ route('ayu-belanja') }}" class="btn-lanjut">
                <iconify-icon icon="ph:storefront-bold" width="16"></iconify-icon>
                Lanjut Belanja
            </a>
        </div>

    </div>
</div>

</body>
</html>