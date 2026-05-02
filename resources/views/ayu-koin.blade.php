<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.iconify.design/iconify-icon/2.1.0/iconify-icon.min.js"></script>
    <title>Ayu Koin - AYU-NE</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body { background: linear-gradient(180deg, #ffe8ed 0%, #fff5f5 50%, #ffe8ed 100%); color: #3b1a1a; }

        /* CONTENT */
        .content { padding: 48px 48px 36px 48px; }

        /* KOIN BANNER */
        .koin-banner {
        background: linear-gradient(135deg, #ffe8ed 0%, #f5a5b6 50%, #ffdde4 100%);
        border: 0.5px solid #b85c65;
        border-radius: 20px;
        padding: 28px 32px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 36px;
        box-shadow: 0 2px 12px rgba(184,92,101,0.08);
    }

        .koin-left { display: flex; flex-direction: column; gap: 6px; }

            .koin-label {
        display: flex; align-items: center; gap: 10px;
        font-size: 14px; font-weight: 600; color: #5D393B;
    }

        .koin-icon-wrap {
    width: 36px; height: 36px; border-radius: 50%;
    background: #f9a825;
    display: flex; align-items: center; justify-content: center;
    font-size: 18px;
    filter: drop-shadow(0 2px 6px rgba(184,92,101,0.3));
    border: 1.5px solid #F0D5D8;
    box-shadow: 0 2px 8px rgba(184,92,101,0.2);
}

        .koin-number { font-size: 48px; font-weight: 800; color: #5D393B; line-height: 1.1; }
        .koin-equiv { font-size: 13px; color: #7a4a4a; }

       .btn-tukar-voucher {
    padding: 13px 28px; background: white; border: none;
    border-radius: 50px; font-size: 14px; font-weight: 700;
    color: #5D393B; cursor: pointer; font-family: 'Poppins', sans-serif;
    box-shadow: 0 2px 12px rgba(184,92,101,0.15); transition: all 0.2s;
    white-space: nowrap; border: 1px solid #F0D5D8;
}
.btn-tukar-voucher:hover { background: #fdf0f2; }
        .btn-tukar-voucher:hover { background: #f9f0f2; }


/* VOUCHER SECTION */
        .section-title { font-size: 20px; font-weight: 800; color: #5D393B; margin-bottom: 20px; }

        .voucher-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px; margin-bottom: 40px; margin-top: 20px; }

        .voucher-card {
            border: 1px solid #e07080;
            border-radius: 18px;
            padding: 20px 18px 18px 18px;
            display: flex; flex-direction: column; gap: 8px;
            transition: all 0.2s;
            background: white;
            box-shadow: 0 4px 16px rgba(184,92,101,0.12);
            position: relative;
            overflow: visible;
            margin-top: 16px;
        }
        .voucher-card:hover {
            box-shadow: 0 8px 28px rgba(184,92,101,0.2);
            transform: translateY(-2px);
        }

        /* gradasi atas card */
        .voucher-card-top {
            background: linear-gradient(135deg, #fff0f3, #fddde4);
            padding: 14px 14px 16px 14px;
            margin: -20px -18px 12px -18px;
            border-bottom: 1px solid #e07080;
            border-radius: 16px 16px 0 0;
        }

        /* badge beneran nongol keluar di atas */
        .voucher-badge {
            position: absolute;
            top: -16px;
            left: 16px;
            padding: 5px 16px;
            border-radius: 20px;
            font-size: 11px; font-weight: 700;
            z-index: 2;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        }
        .badge-populer { background: #5D393B; color: white; }
        .badge-habis { background: #f57c00; color: white; }
        .badge-terbatas { background: #b85c65; color: white; }

        .voucher-title { font-size: 22px; font-weight: 800; color: #5D393B; margin-top: 8px; }
        .voucher-koin { font-size: 14px; font-weight: 700; color: #b85c65; }
        .voucher-min { font-size: 12px; color: #9a6a6a; }
        .voucher-exp { font-size: 12px; color: #9a6a6a; margin-bottom: 4px; }

        .btn-tukar {
            width: 100%; padding: 12px;
            background: white;
            color: #e07080;
            border: 2px solid #e07080;
            border-radius: 50px; font-size: 13px; font-weight: 700;
            cursor: pointer; font-family: 'Poppins', sans-serif; transition: all 0.2s;
            margin-top: auto;
        }
        .btn-tukar:hover {
            background: #e07080;
            color: white;
            transform: translateY(-1px);
        }

        /* DIVIDER */
        .divider { border: none; border-top: 1px solid #f5e0e0; margin: 8px 0 32px 0; }

        /* VOUCHER AKTIF */
        .tab-row {
            display: flex; align-items: center; gap: 0;
            margin-bottom: 20px; border-bottom: 1px solid #f5e0e0;
        }

        .tab-item {
            font-size: 14px; font-weight: 500; color: #9a6a6a;
            padding: 10px 0; margin-right: 28px; cursor: pointer;
            border-bottom: 2px solid transparent; transition: all 0.2s;
        }
        .tab-item.active { color: #b85c65; font-weight: 700; border-bottom: 2px solid #b85c65; }
        .tab-item:hover:not(.active) { color: #7a4a4a; }

        .voucher-list { margin-bottom: 40px; }

        .voucher-item {
    display: flex; align-items: center; justify-content: space-between;
    padding: 18px 20px; border: 1.5px dashed #f4a0aa;
    border-radius: 14px; margin-bottom: 12px; background: white;
    transition: all 0.2s; box-shadow: 0 1px 6px rgba(184,92,101,0.06);
}
.voucher-item:hover { background: #fff5f6; }

        .voucher-item-code { font-size: 13px; font-weight: 700; color: #7a4a4a; margin-bottom: 4px; }
        .voucher-item-disc { font-size: 16px; font-weight: 800; color: #5D393B; margin-bottom: 4px; }
        .voucher-item-info { font-size: 12px; color: #9a6a6a; }

        .btn-pakai {
    padding: 9px 22px; border: 1.5px solid #F0D5D8;
    border-radius: 50px; background: white; font-size: 13px;
    font-weight: 700; color: #5D393B; cursor: pointer;
    font-family: 'Poppins', sans-serif; transition: all 0.2s; white-space: nowrap;
}
.btn-pakai:hover { background: #fce4ec; border-color: #b85c65; color: #b85c65; }

        /* RIWAYAT */

        .riwayat-list { display: flex; flex-direction: column; gap: 10px; margin-bottom: 40px; }

        .riwayat-item {
            display: flex; align-items: center; gap: 16px;
            padding: 16px 20px;
            background: white;
            border-radius: 14px;
            border: 1px solid #F0D5D8;
            box-shadow: 0 1px 6px rgba(184,92,101,0.06);
            transition: all 0.2s;
        }
        .riwayat-item:hover { box-shadow: 0 4px 14px rgba(184,92,101,0.1); transform: translateY(-1px); }

        .riwayat-icon {
            width: 44px; height: 44px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .riwayat-icon.masuk { background: #e8f5e9; color: #2ecc71; }
        .riwayat-icon.keluar { background: #fce4ec; color: #e07080; }
        .riwayat-info { flex: 1; }
        .riwayat-nama { font-size: 14px; font-weight: 600; color: #5D393B; }
        .riwayat-tgl { font-size: 11px; color: #b4a0a0; margin-top: 3px; }

        .riwayat-koin {
            font-size: 13px; font-weight: 600; white-space: nowrap;
            padding: 6px 14px; border-radius: 50px;
        }
        .plus { color: #2ecc71; background: #e8f5e9; }
        .minus { color: #e07080; background: #fce4ec; }

        /* MODAL OVERLAY */
        .modal-overlay {
            display: none;
            position: fixed; inset: 0;
            background: rgba(59,26,26,0.35);
            z-index: 999;
            align-items: center;
            justify-content: center;
        }
        .modal-overlay.show { display: flex; }

        .modal-box {
            background: white;
            border-radius: 20px;
            padding: 32px 28px;
            width: 480px;
            max-width: 95vw;
            position: relative;
            box-shadow: 0 20px 60px rgba(0,0,0,0.15);
        }

        .modal-close {
            position: absolute; top: 16px; right: 20px;
            font-size: 20px; cursor: pointer; color: #9a6a6a;
            background: none; border: none; font-family: 'Poppins', sans-serif;
        }
        .modal-close:hover { color: #3b1a1a; }

        .modal-title { font-size: 18px; font-weight: 800; color: #3b1a1a; margin-bottom: 6px; }
        .modal-saldo { font-size: 13px; color: #9a6a6a; margin-bottom: 20px; }
        .modal-saldo span { color: #e07080; font-weight: 700; }

        /* PILIHAN KOIN */
        .koin-options {
            display: grid; grid-template-columns: 1fr 1fr;
            gap: 12px; margin-bottom: 20px;
        }

        .koin-option {
            padding: 16px; border: 1.5px solid #f0d5d5;
            border-radius: 14px; cursor: pointer; text-align: center;
            transition: all 0.2s; background: white;
        }
        .koin-option:hover { border-color: #f4a0aa; background: #fff5f6; }
        .koin-option.selected { border-color: #f4a0aa; background: #fff0f2; }

        .koin-option-num { font-size: 22px; font-weight: 800; color: #3b1a1a; }
        .koin-option-num span { font-size: 14px; font-weight: 500; color: #9a6a6a; }
        .koin-option-val { font-size: 12px; color: #2ecc71; font-weight: 600; margin-top: 3px; }

        /* SUMMARY BOX */
        .tukar-summary {
            background: #fdf8f8; border-radius: 12px;
            padding: 16px 18px; margin-bottom: 20px;
            font-size: 13px; color: #7a4a4a;
        }
        .summary-line {
            display: flex; justify-content: space-between;
            margin-bottom: 8px;
        }
        .summary-line:last-child { margin-bottom: 0; }
        .summary-line.total {
            font-size: 14px; font-weight: 800; color: #3b1a1a;
            margin-top: 10px; padding-top: 10px;
            border-top: 1px solid #f0d5d5;
        }
        .summary-line.total span:last-child { color: #2ecc71; }

        .btn-tukar-modal {
            width: 100%; padding: 15px; background: #f4a0aa; color: white;
            border: none; border-radius: 50px; font-size: 15px; font-weight: 700;
            cursor: pointer; font-family: 'Poppins', sans-serif;
            transition: background 0.2s; margin-bottom: 10px;
        }
        .btn-tukar-modal:hover { background: #e8858f; }

        .btn-batal-modal {
            width: 100%; padding: 13px; background: white; color: #7a4a4a;
            border: 1.5px solid #f0d5d5; border-radius: 50px; font-size: 14px; font-weight: 600;
            cursor: pointer; font-family: 'Poppins', sans-serif;
            transition: all 0.2s;
        }
        .btn-batal-modal:hover { border-color: #f4a0aa; color: #e07080; }

        /* SUCCESS MODAL */
        .modal-success { text-align: center; }
        .success-emoji { font-size: 48px; margin-bottom: 14px; }
        .success-modal-title { font-size: 20px; font-weight: 800; color: #3b1a1a; margin-bottom: 8px; }
        .success-modal-desc { font-size: 13px; color: #9a6a6a; margin-bottom: 20px; line-height: 1.6; }

        .voucher-code-box {
            background: #fff5f6; border: 1.5px dashed #f4a0aa;
            border-radius: 14px; padding: 18px; margin-bottom: 20px;
        }
        .voucher-code-text { font-size: 20px; font-weight: 800; color: #e07080; letter-spacing: 1px; margin-bottom: 4px; }
        .voucher-code-sub { font-size: 12px; color: #9a6a6a; }

        .btn-lihat-voucher {
            width: 100%; padding: 14px; background: #f4a0aa; color: white;
            border: none; border-radius: 50px; font-size: 14px; font-weight: 700;
            cursor: pointer; font-family: 'Poppins', sans-serif;
            transition: background 0.2s; margin-bottom: 10px;
        }
        .btn-lihat-voucher:hover { background: #e8858f; }

        .btn-kembali-modal {
            width: 100%; padding: 13px; background: white; color: #7a4a4a;
            border: 1.5px solid #f0d5d5; border-radius: 50px; font-size: 14px; font-weight: 600;
            cursor: pointer; font-family: 'Poppins', sans-serif; transition: all 0.2s;
        }
        .btn-kembali-modal:hover { border-color: #f4a0aa; }

        /* MODAL KONFIRMASI VOUCHER */
        .modal-konfirm-voucher {
            background: #fff5f6; border-radius: 14px;
            padding: 24px; margin-bottom: 20px; text-align: center;
        }
        .konfirm-diskon { font-size: 28px; font-weight: 800; color: #3b1a1a; margin-bottom: 4px; }
        .konfirm-koin { font-size: 15px; font-weight: 700; color: #e07080; margin-bottom: 6px; }
        .konfirm-info { font-size: 12px; color: #9a6a6a; }

        .konfirm-summary {
            margin-bottom: 20px;
        }
        .konfirm-row {
            display: flex; justify-content: space-between;
            font-size: 14px; padding: 12px 0;
            border-bottom: 1px solid #f5e0e0; color: #7a4a4a;
        }
        .konfirm-row span:last-child { font-weight: 600; color: #3b1a1a; }
        .konfirm-row.sisa span:last-child { color: #e07080; }

        /* MODAL PAKAI VOUCHER */
        .pakai-voucher-header {
            background: linear-gradient(135deg, #fce4ec, #f9f0f2);
            border-radius: 14px; padding: 20px; margin-bottom: 20px; text-align: center;
        }
        .pakai-voucher-code {
            font-size: 22px; font-weight: 800; color: #e07080;
            letter-spacing: 2px; margin-bottom: 6px;
        }
        .pakai-voucher-disc { font-size: 15px; font-weight: 700; color: #3b1a1a; margin-bottom: 4px; }
        .pakai-voucher-info { font-size: 12px; color: #9a6a6a; }

        .copy-row {
            display: flex; align-items: center; gap: 10px;
            background: #f9f5f5; border: 1.5px dashed #f4a0aa;
            border-radius: 12px; padding: 12px 16px; margin-bottom: 20px;
        }
        .copy-code-text {
            flex: 1; font-size: 16px; font-weight: 800;
            color: #e07080; letter-spacing: 1px;
        }
        .btn-copy {
            padding: 8px 16px; background: #f4a0aa; color: white;
            border: none; border-radius: 50px; font-size: 12px; font-weight: 700;
            cursor: pointer; font-family: 'Poppins', sans-serif; transition: all 0.2s;
            white-space: nowrap;
        }
        .btn-copy:hover { background: #e8858f; }
        .btn-copy.copied { background: #2ecc71; }

        .share-title {
            font-size: 13px; font-weight: 700; color: #3b1a1a;
            margin-bottom: 12px;
        }

        .share-buttons {
            display: grid; grid-template-columns: 1fr 1fr;
            gap: 10px; margin-bottom: 20px;
        }

        .btn-share {
            display: flex; align-items: center; justify-content: center;
            gap: 8px; padding: 12px; border-radius: 12px;
            font-size: 13px; font-weight: 600; cursor: pointer;
            border: none; font-family: 'Poppins', sans-serif; transition: all 0.2s;
        }

        .btn-share-wa {
            background: #e8f8ef; color: #25D366;
            border: 1.5px solid #c8eeda;
        }
        .btn-share-wa:hover { background: #d0f2e4; }

        .btn-share-ig {
            background: #fef0f5; color: #E1306C;
            border: 1.5px solid #f9d0e0;
        }
        .btn-share-ig:hover { background: #fde0ec; }

        .btn-share-tw {
            background: #e8f4fd; color: #1DA1F2;
            border: 1.5px solid #c8e4f8;
        }
        .btn-share-tw:hover { background: #d0eafc; }

        .btn-share-link {
            background: #f5f5f5; color: #555;
            border: 1.5px solid #e0e0e0;
        }
        .btn-share-link:hover { background: #ebebeb; }

        .divider-or {
            display: flex; align-items: center; gap: 12px;
            margin-bottom: 16px; color: #c4a0a0; font-size: 12px;
        }
        .divider-or::before, .divider-or::after {
            content: ''; flex: 1; border-top: 1px solid #f0d5d5;
        }

        /* TOAST */
        .toast {
            position: fixed; bottom: 32px; left: 50%; transform: translateX(-50%) translateY(20px);
            background: #3b1a1a; color: white; padding: 12px 24px;
            border-radius: 50px; font-size: 13px; font-weight: 600;
            opacity: 0; transition: all 0.3s; z-index: 9999; white-space: nowrap;
            pointer-events: none;
        }
        .toast.show { opacity: 1; transform: translateX(-50%) translateY(0); }

        /* SPARK EFFECT */
        .spark {
            position: absolute;
            pointer-events: none;
        }
        .spark svg {
            animation: sparkle 2s ease-in-out infinite;
        }
        .spark:nth-child(2) svg { animation-delay: 0.4s; }
        .spark:nth-child(3) svg { animation-delay: 0.8s; }
        .spark:nth-child(4) svg { animation-delay: 1.2s; }

        @keyframes sparkle {
            0%, 100% { opacity: 0.3; transform: scale(0.7) rotate(0deg); }
            50% { opacity: 1; transform: scale(1.1) rotate(15deg); }
        }

    </style>
</head>
<body>

{{-- Navbar diambil dari file layouts/navigation.blade.php --}}
@include('layouts.navigation')

<div class="content">

    <!-- KOIN BANNER -->
<!-- KOIN BANNER -->
    <div class="koin-banner" style="position: relative; overflow: hidden;">

        <!-- SPARK -->
        <div class="spark" style="top: 14px; right: 160px;">
            <svg width="28" height="28" viewBox="0 0 24 24"><path d="M12 2 L13.5 10 L22 12 L13.5 14 L12 22 L10.5 14 L2 12 L10.5 10 Z" fill="rgba(255,255,255,0.8)"/></svg>
        </div>
        <div class="spark" style="top: 40px; right: 120px;">
            <svg width="16" height="16" viewBox="0 0 24 24"><path d="M12 2 L13.5 10 L22 12 L13.5 14 L12 22 L10.5 14 L2 12 L10.5 10 Z" fill="rgba(255,255,255,0.6)"/></svg>
        </div>
        <div class="spark" style="bottom: 20px; right: 180px;">
            <svg width="20" height="20" viewBox="0 0 24 24"><path d="M12 2 L13.5 10 L22 12 L13.5 14 L12 22 L10.5 14 L2 12 L10.5 10 Z" fill="rgba(255,255,255,0.7)"/></svg>
        </div>
        <div class="spark" style="top: 20px; left: 220px;">
            <svg width="14" height="14" viewBox="0 0 24 24"><path d="M12 2 L13.5 10 L22 12 L13.5 14 L12 22 L10.5 14 L2 12 L10.5 10 Z" fill="rgba(255,255,255,0.5)"/></svg>
        </div>

        <div class="koin-left">
            <div class="koin-label">
                <div class="koin-icon-wrap">🪙</div>
                Ayu Koin Kamu
            </div>
            <div class="koin-number" id="koinNumber">{{ number_format($saldoKoin, 0, ',', '.') }}</div>
            <div class="koin-equiv">Setara Rp {{ number_format(floor($saldoKoin / 100) * 5000, 0, ',', '.') }} voucher</div>
        </div>
        <button class="btn-tukar-voucher" onclick="bukaTukarModal()">Tukar Jadi Voucher</button>
    </div>

    <!-- VOUCHER YANG BISA DITUKAR -->
<div class="section-title">Voucher yang Bisa Kamu Tukarkan</div>
    <div class="voucher-grid">

        <div class="voucher-card">
            <span class="voucher-badge badge-populer"> Terpopuler</span>
            <div class="voucher-card-top">
                <div class="voucher-title">Diskon 20%</div>
                <div class="voucher-koin">500 Koin</div>
            </div>
            <div class="voucher-min">Min. belanja Rp 100.000</div>
            <div class="voucher-exp">Berlaku hingga 31 Maret 2026</div>
            <button class="btn-tukar" onclick="bukaKonfirmVoucher(0)">Tukar Sekarang</button>
        </div>

        <div class="voucher-card">
            <div class="voucher-card-top">
                <span class="voucher-badge badge-terbatas"> Terbatas</span>
                <div class="voucher-title">Diskon 15%</div>
                <div class="voucher-koin">300 Koin</div>
            </div>
            <div class="voucher-min">Min. belanja Rp 75.000</div>
            <div class="voucher-exp">Berlaku hingga 28 Februari 2026</div>
            <button class="btn-tukar" onclick="bukaKonfirmVoucher(1)">Tukar Sekarang</button>
        </div>

        <div class="voucher-card">
            <span class="voucher-badge badge-habis"> Hampir Habis</span>
            <div class="voucher-card-top">
                <div class="voucher-title">Diskon 30%</div>
                <div class="voucher-koin">800 Koin</div>
            </div>
            <div class="voucher-min">Min. belanja Rp 150.000</div>
            <div class="voucher-exp">Berlaku hingga 15 Maret 2026</div>
            <button class="btn-tukar" onclick="bukaKonfirmVoucher(2)">Tukar Sekarang</button>
        </div>

        <div class="voucher-card">
            <div class="voucher-card-top">
                <div class="voucher-title">Diskon 10%</div>
                <div class="voucher-koin">200 Koin</div>
            </div>
            <div class="voucher-min">Min. belanja Rp 50.000</div>
            <div class="voucher-exp">Berlaku hingga 31 Maret 2026</div>
            <button class="btn-tukar" onclick="bukaKonfirmVoucher(3)">Tukar Sekarang</button>
        </div>

    </div>

    <hr class="divider">

    <!-- VOUCHER AKTIFKU -->
    <div class="section-title">Voucher Aktifku</div>
    <div class="tab-row">
        <div class="tab-item active" onclick="switchVoucher('aktif', this)">Aktif</div>
        <div class="tab-item" onclick="switchVoucher('digunakan', this)">Digunakan</div>
        <div class="tab-item" onclick="switchVoucher('kedaluwarsa', this)">Kedaluwarsa</div>
    </div>

    <div class="voucher-list" id="vAktif">
        <div class="voucher-item">
            <div>
                <div class="voucher-item-code">AYUBEAUTY20</div>
                <div class="voucher-item-disc">Diskon Rp 20.000</div>
                <div class="voucher-item-info">Min. belanja Rp 100.000 • Berlaku hingga 31 Maret 2026</div>
            </div>
            <button class="btn-pakai" onclick="bukaPakaiVoucher('AYUBEAUTY20', 'Diskon Rp 20.000', 'Min. belanja Rp 100.000 • Berlaku hingga 31 Maret 2026')">Pakai</button>
        </div>
        <div class="voucher-item">
            <div>
                <div class="voucher-item-code">AYUBEAUTY20</div>
                <div class="voucher-item-disc">Diskon Rp 20.000</div>
                <div class="voucher-item-info">Min. belanja Rp 100.000 • Berlaku hingga 31 Maret 2026</div>
            </div>
            <button class="btn-pakai" onclick="bukaPakaiVoucher('AYUBEAUTY20', 'Diskon Rp 20.000', 'Min. belanja Rp 100.000 • Berlaku hingga 31 Maret 2026')">Pakai</button>
        </div>
    </div>

    <div class="voucher-list" id="vDigunakan" style="display:none;">
        <div class="voucher-item" style="opacity:0.5;">
            <div>
                <div class="voucher-item-code">AYUDAUR10</div>
                <div class="voucher-item-disc">Diskon Rp 10.000</div>
                <div class="voucher-item-info">Digunakan pada 1 Maret 2026</div>
            </div>
            <span style="font-size:12px; color:#9a6a6a; font-weight:600;">Terpakai</span>
        </div>
    </div>

    <div class="voucher-list" id="vKedaluwarsa" style="display:none;">
        <div class="voucher-item" style="opacity:0.5;">
            <div>
                <div class="voucher-item-code">AYUFEB15</div>
                <div class="voucher-item-disc">Diskon 15%</div>
                <div class="voucher-item-info">Kedaluwarsa pada 28 Februari 2026</div>
            </div>
            <span style="font-size:12px; color:#9a6a6a; font-weight:600;">Kedaluwarsa</span>
        </div>
    </div>

    <hr class="divider">

    <!-- RIWAYAT AKTIVITAS -->
    <div class="section-title">Riwayat Aktivitas</div>
    <div class="tab-row">
        <div class="tab-item active" onclick="switchRiwayat('semua', this)">Semua</div>
        <div class="tab-item" onclick="switchRiwayat('masuk', this)">Masuk</div>
        <div class="tab-item" onclick="switchRiwayat('keluar', this)">Keluar</div>
    </div>


<div id="rSemua">
        <div class="riwayat-list">
            @forelse($coinHistories as $ch)
            <div class="riwayat-item" data-tipe="{{ $ch->tipe }}">
                <div class="riwayat-icon {{ $ch->tipe }}">
                    @if($ch->sumber === 'belanja')
                        <iconify-icon icon="mynaui:cart" width="22"></iconify-icon>
                    @elseif($ch->sumber === 'daur_ulang')
                        <iconify-icon icon="fontisto:recycle" width="22"></iconify-icon>
                    @else
                        <iconify-icon icon="mynaui:tag" width="22"></iconify-icon>
                    @endif
                </div>
                <div class="riwayat-info">
                    <div class="riwayat-nama">{{ $ch->keterangan ?? ucfirst(str_replace('_', ' ', $ch->sumber)) }}</div>
                    <div class="riwayat-tgl">{{ $ch->created_at->format('d M Y') }}</div>
                </div>
                <div class="riwayat-koin {{ $ch->tipe === 'masuk' ? 'plus' : 'minus' }}">
                    {{ $ch->tipe === 'masuk' ? '+' : '-' }}{{ $ch->jumlah }} Koin
                </div>
            </div>
            @empty
            <div style="text-align:center; padding:30px; color:#9a6a6a; font-size:13px;">
                Belum ada riwayat koin. Belanja atau daur ulang untuk dapat Ayu Koin!
            </div>
            @endforelse
        </div>
    </div>

    <div id="rMasuk" style="display:none;">
        <div class="riwayat-list">
            @foreach($coinHistories->where('tipe', 'masuk') as $ch)
            <div class="riwayat-item">
                <div class="riwayat-icon masuk">
                    @if($ch->sumber === 'belanja')
                        <iconify-icon icon="mynaui:cart" width="22"></iconify-icon>
                    @else
                        <iconify-icon icon="fontisto:recycle" width="22"></iconify-icon>
                    @endif
                </div>
                <div class="riwayat-info">
                    <div class="riwayat-nama">{{ $ch->keterangan }}</div>
                    <div class="riwayat-tgl">{{ $ch->created_at->format('d M Y') }}</div>
                </div>
                <div class="riwayat-koin plus">+{{ $ch->jumlah }} Koin</div>
            </div>
            @endforeach
        </div>
    </div>

    <div id="rKeluar" style="display:none;">
        <div class="riwayat-list">
            @foreach($coinHistories->where('tipe', 'keluar') as $ch)
            <div class="riwayat-item">
                <div class="riwayat-icon keluar">
                    <iconify-icon icon="mynaui:tag" width="22"></iconify-icon>
                </div>
                <div class="riwayat-info">
                    <div class="riwayat-nama">{{ $ch->keterangan }}</div>
                    <div class="riwayat-tgl">{{ $ch->created_at->format('d M Y') }}</div>
                </div>
                <div class="riwayat-koin minus">-{{ $ch->jumlah }} Koin</div>
            </div>
            @endforeach
        </div>
    </div>

</div>

<script>
    let saldoKoin = {{ $saldoKoin }};
    let selectedKoin = 200;
    let selectedVal = 10000;

    function formatRb(num) {
        return 'Rp ' + num.toLocaleString('id-ID');
    }

    function formatKoin(num) {
        return num.toLocaleString('id-ID') + ' Koin';
    }

    // Buka modal tukar
    function bukaTukarModal() {
        document.getElementById('modalTukar').classList.add('show');
        updateSummary();
    }

    function tutupModal() {
        document.getElementById('modalTukar').classList.remove('show');
    }

    function pilihKoin(el, koin, val) {
        document.querySelectorAll('.koin-option').forEach(o => o.classList.remove('selected'));
        el.classList.add('selected');
        selectedKoin = koin;
        selectedVal = val;
        updateSummary();
    }

    function updateSummary() {
        const sisa = saldoKoin - selectedKoin;
        document.getElementById('sumKoin').textContent = formatKoin(selectedKoin);
        document.getElementById('sumVal').textContent = formatRb(selectedVal);
        document.getElementById('sumSisa').textContent = formatKoin(sisa < 0 ? 0 : sisa);
        document.getElementById('sumDapat').textContent = 'Voucher ' + formatRb(selectedVal);
        document.getElementById('saldoLabel').textContent = saldoKoin.toLocaleString('id-ID') + ' Koin';
    }

    function konfirmasiTukar() {
        if (selectedKoin > saldoKoin) {
            alert('Koin kamu tidak cukup!');
            return;
        }

        // Potong saldo
        saldoKoin -= selectedKoin;
        document.getElementById('koinNumber').textContent = saldoKoin.toLocaleString('id-ID');

        // Update success modal
        const kodeVoucher = 'AYUVOUCHER' + selectedKoin;
        document.getElementById('successDesc').textContent = 'Voucher senilai ' + formatRb(selectedVal) + ' sudah masuk ke "Voucher Aktifku".';
        document.getElementById('voucherCode').textContent = kodeVoucher;
        document.getElementById('voucherSub').textContent = 'Voucher senilai ' + formatRb(selectedVal);

        tutupModal();
        document.getElementById('modalSuccess').classList.add('show');
    }

    function tutupSuccess() {
        document.getElementById('modalSuccess').classList.remove('show');
    }

    function lihatVoucher() {
        tutupSuccess();
        document.querySelector('[onclick="switchVoucher(\'aktif\', this)"]').click();
        document.getElementById('vAktif').scrollIntoView({ behavior: 'smooth' });
    }

    // Data voucher card
    const voucherData = [
        { diskon: 'Diskon 20%', koin: 500, info: 'Min. belanja Rp 100.000 · Berlaku hingga 31 Maret 2026', kode: 'AYUBEAUTY20', minBelanja: 'Min. belanja Rp 100.000' },
        { diskon: 'Diskon 15%', koin: 300, info: 'Min. belanja Rp 75.000 · Berlaku hingga 28 Februari 2026', kode: 'AYUBEAUTY15', minBelanja: 'Min. belanja Rp 75.000' },
        { diskon: 'Diskon 30%', koin: 800, info: 'Min. belanja Rp 150.000 · Berlaku hingga 15 Maret 2026', kode: 'AYUBEAUTY30', minBelanja: 'Min. belanja Rp 150.000' },
        { diskon: 'Diskon 10%', koin: 200, info: 'Min. belanja Rp 50.000 · Berlaku hingga 31 Maret 2026', kode: 'AYUBEAUTY10', minBelanja: 'Min. belanja Rp 50.000' },
    ];

    let selectedVoucherIdx = 0;

    function bukaKonfirmVoucher(idx) {
        selectedVoucherIdx = idx;
        const v = voucherData[idx];

        if (v.koin > saldoKoin) {
            alert('Koin kamu tidak cukup untuk voucher ini!');
            return;
        }

        document.getElementById('kvDiskon').textContent = v.diskon;
        document.getElementById('kvKoin').textContent = v.koin.toLocaleString('id-ID') + ' Koin';
        document.getElementById('kvInfo').textContent = v.info;
        document.getElementById('kvSaldo').textContent = saldoKoin.toLocaleString('id-ID') + ' Koin';
        document.getElementById('kvSisa').textContent = (saldoKoin - v.koin).toLocaleString('id-ID') + ' Koin';

        document.getElementById('modalKonfirmVoucher').classList.add('show');
    }

    function tutupKonfirmVoucher() {
        document.getElementById('modalKonfirmVoucher').classList.remove('show');
    }

    function prosesVoucherCard() {
        const v = voucherData[selectedVoucherIdx];

        // Potong saldo
        saldoKoin -= v.koin;
        document.getElementById('koinNumber').textContent = saldoKoin.toLocaleString('id-ID');

        // Isi success modal
        document.getElementById('successDesc').textContent = 'Voucher sudah masuk ke "Voucher Aktifku". Gunakan saat checkout!';
        document.getElementById('voucherCode').textContent = v.kode;
        document.getElementById('voucherSub').textContent = v.diskon + ' · ' + v.minBelanja;

        tutupKonfirmVoucher();
        document.getElementById('modalSuccess').classList.add('show');
    }

    function switchVoucher(tab, el) {
        ['vAktif','vDigunakan','vKedaluwarsa'].forEach(id => document.getElementById(id).style.display = 'none');
        document.querySelectorAll('.tab-row')[0].querySelectorAll('.tab-item').forEach(t => t.classList.remove('active'));
        const map = { aktif: 'vAktif', digunakan: 'vDigunakan', kedaluwarsa: 'vKedaluwarsa' };
        document.getElementById(map[tab]).style.display = 'block';
        el.classList.add('active');
    }

    function switchRiwayat(tab, el) {
        ['rSemua','rMasuk','rKeluar'].forEach(id => document.getElementById(id).style.display = 'none');
        document.querySelectorAll('.tab-row')[1].querySelectorAll('.tab-item').forEach(t => t.classList.remove('active'));
        const map = { semua: 'rSemua', masuk: 'rMasuk', keluar: 'rKeluar' };
        document.getElementById(map[tab]).style.display = 'block';
        el.classList.add('active');
    }

    let aktivVoucherKode = '';
    let aktivVoucherDiskon = '';
    let aktivVoucherInfo = '';

    function bukaPakaiVoucher(kode, diskon, info) {
        aktivVoucherKode = kode;
        aktivVoucherDiskon = diskon;
        aktivVoucherInfo = info;

        document.getElementById('pvKode').textContent = kode;
        document.getElementById('pvDiskon').textContent = diskon;
        document.getElementById('pvInfo').textContent = info;

        const btnCopy = document.getElementById('btnCopy');
        btnCopy.textContent = 'Salin Kode';
        btnCopy.classList.remove('copied');

        document.getElementById('modalPakaiVoucher').classList.add('show');
    }

    function tutupPakaiVoucher() {
        document.getElementById('modalPakaiVoucher').classList.remove('show');
    }

    function tampilToast(pesan) {
        const toast = document.getElementById('toastNotif');
        toast.textContent = pesan;
        toast.classList.add('show');
        setTimeout(() => toast.classList.remove('show'), 2500);
    }

    function salinKode() {
        navigator.clipboard.writeText(aktivVoucherKode).then(() => {
            const btn = document.getElementById('btnCopy');
            btn.textContent = '✓ Tersalin!';
            btn.classList.add('copied');
            tampilToast('✓ Kode ' + aktivVoucherKode + ' berhasil disalin!');
            setTimeout(() => {
                btn.textContent = 'Salin Kode';
                btn.classList.remove('copied');
            }, 2500);
        });
    }

    function shareWA() {
        const pesan = encodeURIComponent('Hei! Aku punya voucher diskon dari AYU-NE 🌿✨\nKode: *' + aktivVoucherKode + '*\n' + aktivVoucherDiskon + '\n' + aktivVoucherInfo + '\nBelanja produk eco-beauty di AYU-NE sekarang!');
        window.open('https://wa.me/?text=' + pesan, '_blank');
    }

    function shareIG() {
        salinKode();
        tampilToast('Kode disalin! Paste di caption Instagram kamu 📸');
    }

    function shareTW() {
        const pesan = encodeURIComponent('Dapet voucher ' + aktivVoucherDiskon + ' dari @AYUNE_official 🎉\nGunakan kode: ' + aktivVoucherKode + '\n' + aktivVoucherInfo + '\n#AYUNE #EcoBeauty #Skincare');
        window.open('https://twitter.com/intent/tweet?text=' + pesan, '_blank');
    }

    function salinLink() {
        const link = window.location.origin + '/ayu-belanja?voucher=' + aktivVoucherKode;
        navigator.clipboard.writeText(link).then(() => {
            tampilToast('✓ Link berhasil disalin!');
        });
    }

    function pakaiKeCheckout() {
        tutupPakaiVoucher();
        tampilToast('✓ Voucher ' + aktivVoucherKode + ' siap dipakai di checkout!');
        setTimeout(() => {
            window.location.href = "{{ route('checkout') }}";
        }, 1500);
    }

</script>

<!-- MODAL TUKAR VOUCHER -->
<div class="modal-overlay" id="modalTukar">
    <div class="modal-box" id="modalStep1">
        <button class="modal-close" onclick="tutupModal()">✕</button>
        <div class="modal-title">Tukar Koin Jadi Voucher</div>
        <div class="modal-saldo">Saldo kamu: <span id="saldoLabel">1.200 Koin</span></div>

        <div class="koin-options">
            <div class="koin-option selected" onclick="pilihKoin(this, 200, 10000)" data-koin="200" data-val="10000">
                <div class="koin-option-num">200 <span>Koin</span></div>
                <div class="koin-option-val">= Rp 10.000</div>
            </div>
            <div class="koin-option" onclick="pilihKoin(this, 500, 25000)" data-koin="500" data-val="25000">
                <div class="koin-option-num">500 <span>Koin</span></div>
                <div class="koin-option-val">= Rp 25.000</div>
            </div>
            <div class="koin-option" onclick="pilihKoin(this, 1000, 50000)" data-koin="1000" data-val="50000">
                <div class="koin-option-num">1.000 <span>Koin</span></div>
                <div class="koin-option-val">= Rp 50.000</div>
            </div>
            <div class="koin-option" onclick="pilihKoin(this, 2000, 100000)" data-koin="2000" data-val="100000">
                <div class="koin-option-num">2.000 <span>Koin</span></div>
                <div class="koin-option-val">= Rp 100.000</div>
            </div>
        </div>

        <div class="tukar-summary">
            <div class="summary-line"><span>Koin digunakan</span><span id="sumKoin">200 Koin</span></div>
            <div class="summary-line"><span>Nilai voucher</span><span id="sumVal">Rp 10.000</span></div>
            <div class="summary-line"><span>Sisa koin</span><span id="sumSisa">1.000 Koin</span></div>
            <div class="summary-line total"><span>Kamu dapat</span><span id="sumDapat">Voucher Rp 10.000</span></div>
        </div>

        <button class="btn-tukar-modal" onclick="konfirmasiTukar()">Tukar Sekarang</button>
        <button class="btn-batal-modal" onclick="tutupModal()">Batal</button>
    </div>
</div>

<!-- MODAL SUCCESS -->
<div class="modal-overlay" id="modalSuccess">
    <div class="modal-box modal-success">
        <div class="success-emoji">🎉</div>
        <div class="success-modal-title">Koin Berhasil Ditukar!</div>
        <div class="success-modal-desc" id="successDesc">Voucher senilai Rp 10.000 sudah masuk ke "Voucher Aktifku".</div>

        <div class="voucher-code-box">
            <div class="voucher-code-text" id="voucherCode">AYUVOUCHER200</div>
            <div class="voucher-code-sub" id="voucherSub">Voucher senilai Rp 10.000</div>
        </div>

        <button class="btn-lihat-voucher" onclick="lihatVoucher()">Lihat Voucher Aktifku</button>
        <button class="btn-kembali-modal" onclick="tutupSuccess()">Kembali ke Ayu Koin</button>
    </div>
</div>

<!-- MODAL KONFIRMASI TUKAR VOUCHER CARD -->
<div class="modal-overlay" id="modalKonfirmVoucher">
    <div class="modal-box">
        <button class="modal-close" onclick="tutupKonfirmVoucher()">✕</button>
        <div class="modal-title" style="margin-bottom:20px;">Konfirmasi Penukaran</div>

        <div class="modal-konfirm-voucher">
            <div class="konfirm-diskon" id="kvDiskon">Diskon 20%</div>
            <div class="konfirm-koin" id="kvKoin">500 Koin</div>
            <div class="konfirm-info" id="kvInfo">Min. belanja Rp 100.000 · Berlaku hingga 31 Maret 2026</div>
        </div>

        <div class="konfirm-summary">
            <div class="konfirm-row">
                <span>Saldo koin kamu</span>
                <span id="kvSaldo">1.000 Koin</span>
            </div>
            <div class="konfirm-row sisa">
                <span>Setelah penukaran</span>
                <span id="kvSisa">500 Koin</span>
            </div>
        </div>

        <button class="btn-tukar-modal" onclick="prosesVoucherCard()">Ya, Tukar Sekarang</button>
        <button class="btn-batal-modal" onclick="tutupKonfirmVoucher()">Batal</button>
    </div>
</div>

<!-- MODAL PAKAI VOUCHER -->
<div class="modal-overlay" id="modalPakaiVoucher">
    <div class="modal-box">
        <button class="modal-close" onclick="tutupPakaiVoucher()">✕</button>
        <div class="modal-title" style="margin-bottom:16px;">Gunakan Voucher</div>

        <!-- Preview Voucher -->
        <div class="pakai-voucher-header">
            <div style="font-size:28px; margin-bottom:8px;">🎟️</div>
            <div class="pakai-voucher-disc" id="pvDiskon">Diskon Rp 20.000</div>
            <div class="pakai-voucher-info" id="pvInfo">Min. belanja Rp 100.000 • Berlaku hingga 31 Maret 2026</div>
        </div>

        <!-- Copy Kode -->
        <div class="copy-row">
            <div class="copy-code-text" id="pvKode">AYUBEAUTY20</div>
            <button class="btn-copy" id="btnCopy" onclick="salinKode()">Salin Kode</button>
        </div>

        <!-- Share Section -->
        <div class="share-title">🔗 Bagikan ke Teman</div>
        <div class="share-buttons">
            <button class="btn-share btn-share-wa" onclick="shareWA()">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="#25D366"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                WhatsApp
            </button>
            <button class="btn-share btn-share-ig" onclick="shareIG()">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="#E1306C"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                Instagram
            </button>
            <button class="btn-share btn-share-tw" onclick="shareTW()">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="#1DA1F2"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                Twitter / X
            </button>
            <button class="btn-share btn-share-link" onclick="salinLink()">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#555" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 13a5 5 0 007.54.54l3-3a5 5 0 00-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 00-7.54-.54l-3 3a5 5 0 007.07 7.07l1.71-1.71"/></svg>
                Salin Link
            </button>
        </div>

        <div class="divider-or">atau</div>

        <button class="btn-tukar-modal" onclick="pakaiKeCheckout()">🛍️ Pakai di Checkout Sekarang</button>
        <button class="btn-batal-modal" onclick="tutupPakaiVoucher()">Tutup</button>
    </div>
</div>

<!-- TOAST NOTIF -->
<div class="toast" id="toastNotif">✓ Kode disalin!</div>

</body>
</html>