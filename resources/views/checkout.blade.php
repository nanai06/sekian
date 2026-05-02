<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.iconify.design/iconify-icon/2.1.0/iconify-icon.min.js"></script>
    <title>Checkout - AYU-NE</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body { background: linear-gradient(180deg, #ffe8ed 0%, #fff5f5 50%, #ffe8ed 100%); color: #3b1a1a; }

        /* ── STEP BAR ── */
        .steps-bar { background: white; border-bottom: 1px solid #f5e0e0; padding: 14px 50px; display: flex; align-items: center; gap: 8px; }
        .step { display: flex; align-items: center; gap: 8px; font-size: 13px; font-weight: 500; color: #9E7178; }
        .step.active { color: #e07080; font-weight: 700; }
        .step.done   { color: #4CAF7D; }
        .step-num { width: 26px; height: 26px; border-radius: 50%; background: #F0D5D8; color: #9E7178; font-size: 12px; font-weight: 700; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .step.active .step-num { background: #e07080; color: white; }
        .step.done   .step-num { background: #4CAF7D; color: white; }
        .step-arrow { color: #F0D5D8; font-size: 16px; }

        /* ── LAYOUT ── */
        .content { padding: 28px 50px 60px; display: flex; gap: 32px; align-items: flex-start; }
        .checkout-left { flex: 1; display: flex; flex-direction: column; gap: 20px; }
        .page-title { font-size: 24px; font-weight: 800; color: #2A1520; display: flex; align-items: center; gap: 10px; }

        .section-box { background: white; border: 1.5px solid #F0D5D8; border-radius: 20px; padding: 24px 28px; box-shadow: 0 2px 12px rgba(184,92,101,0.05); }
        .section-header { display: flex; align-items: center; gap: 10px; margin-bottom: 20px; }
        .section-icon { width: 36px; height: 36px; border-radius: 10px; background: #FFF0F3; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .section-title { font-size: 15px; font-weight: 700; color: #5D393B; }

        .form-label { display: block; font-size: 11px; font-weight: 700; color: #9E7178; letter-spacing: 0.06em; text-transform: uppercase; margin-bottom: 7px; }
        .form-input { width: 100%; padding: 12px 16px; border: 1.5px solid #F0D5D8; border-radius: 12px; font-size: 13px; font-family: 'Poppins', sans-serif; color: #3b1a1a; background: white; outline: none; transition: all 0.2s; margin-bottom: 16px; }
        .form-input:focus { border-color: #FFBBC0; box-shadow: 0 0 0 3px rgba(224,112,128,0.08); }
        .form-input::placeholder { color: #C4A0A8; }
        textarea.form-input { resize: vertical; min-height: 90px; }
        .row-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }

        /* ── KURIR ── */
        .kurir-option { display: flex; align-items: center; justify-content: space-between; padding: 14px 18px; border: 1.5px solid #F0D5D8; border-radius: 14px; margin-bottom: 10px; cursor: pointer; transition: all 0.2s; }
        .kurir-option:last-child { margin-bottom: 0; }
        .kurir-option:hover { border-color: #FFBBC0; background: #FFF8F9; }
        .kurir-option.selected { border-color: #e07080; background: #FFF0F3; }
        .kurir-left { display: flex; align-items: center; gap: 14px; }
        .radio-circle { width: 20px; height: 20px; border-radius: 50%; border: 2px solid #F0D5D8; display: flex; align-items: center; justify-content: center; flex-shrink: 0; transition: all 0.2s; }
        .radio-circle.checked { border-color: #e07080; background: #e07080; }
        .radio-circle.checked::after { content: ''; width: 8px; height: 8px; background: white; border-radius: 50%; }
        .kurir-name { font-size: 14px; font-weight: 700; color: #3b1a1a; margin-bottom: 2px; }
        .kurir-hari { font-size: 12px; color: #9E7178; }
        .kurir-harga { font-size: 14px; font-weight: 700; color: #e07080; }

        /* ── VOUCHER ── */
        .voucher-input-wrap { display: flex; align-items: center; border: 1.5px solid #F0D5D8; border-radius: 12px; overflow: hidden; background: white; transition: all 0.2s; margin-bottom: 14px; }
        .voucher-input-wrap:focus-within { border-color: #FFBBC0; box-shadow: 0 0 0 3px rgba(224,112,128,0.08); }
        .voucher-input-wrap input { flex: 1; border: none; outline: none; padding: 12px 16px; font-size: 13px; font-family: 'Poppins', sans-serif; color: #3b1a1a; text-transform: uppercase; }
        .voucher-input-wrap input::placeholder { color: #C4A0A8; text-transform: none; }
        .btn-pakai { padding: 12px 20px; background: #e07080; color: white; font-size: 12px; font-weight: 700; border: none; cursor: pointer; font-family: 'Poppins', sans-serif; transition: background 0.2s; white-space: nowrap; }
        .btn-pakai:hover { background: #c85070; }
        .voucher-applied { display: none; align-items: center; gap: 8px; background: #e8f5e9; border: 1.5px solid #4CAF7D; border-radius: 12px; padding: 10px 16px; font-size: 12px; font-weight: 600; color: #2e7d32; }
        .voucher-applied.show { display: flex; }
        .voucher-remove { margin-left: auto; cursor: pointer; color: #9E7178; font-size: 16px; }
        .voucher-remove:hover { color: #e07080; }

        /* ── KOIN ── */
        .koin-toggle { display: flex; align-items: center; justify-content: space-between; padding: 14px 18px; border: 1.5px solid #F0D5D8; border-radius: 14px; cursor: pointer; transition: all 0.2s; background: white; margin-top: 14px; }
        .koin-toggle.active { border-color: #e07080; background: #FFF0F3; }
        .koin-toggle:hover { border-color: #FFBBC0; background: #FFF8F9; }
        .koin-toggle-left { display: flex; align-items: center; gap: 12px; }
        .koin-toggle-icon { width: 38px; height: 38px; border-radius: 10px; background: linear-gradient(135deg, #ffe8ed, #f5a5b6); display: flex; align-items: center; justify-content: center; }
        .koin-toggle-title { font-size: 13px; font-weight: 700; color: #3b1a1a; }
        .koin-toggle-sub   { font-size: 11px; color: #9E7178; }
        .koin-discount-label { font-size: 12px; font-weight: 700; color: #e07080; }
        .koin-switch { position: relative; width: 40px; height: 22px; }
        .koin-switch input { opacity: 0; width: 0; height: 0; }
        .koin-slider { position: absolute; inset: 0; background: #F0D5D8; border-radius: 100px; transition: 0.3s; cursor: pointer; }
        .koin-slider::before { content:""; position:absolute; width:16px; height:16px; left:3px; top:3px; background:white; border-radius:50%; transition:0.3s; box-shadow:0 1px 3px rgba(0,0,0,0.15); }
        .koin-switch input:checked + .koin-slider { background: #e07080; }
        .koin-switch input:checked + .koin-slider::before { transform: translateX(18px); }

        /* ── PEMBAYARAN — kategori + sub pilihan ── */
        .bayar-kategori { display: flex; gap: 10px; margin-bottom: 18px; flex-wrap: wrap; }
        .bayar-tab {
            display: flex; align-items: center; gap: 7px;
            padding: 9px 18px; border: 1.5px solid #F0D5D8;
            border-radius: 100px; font-size: 12px; font-weight: 600;
            color: #9E7178; cursor: pointer; transition: all 0.2s; background: white;
        }
        .bayar-tab:hover { border-color: #FFBBC0; color: #e07080; background: #FFF8F9; }
        .bayar-tab.active { border-color: #e07080; background: #FFF0F3; color: #e07080; }

        .bayar-panel { display: none; }
        .bayar-panel.show { display: block; }

        .bayar-option { display: flex; align-items: center; gap: 14px; padding: 13px 16px; border: 1.5px solid #F0D5D8; border-radius: 14px; margin-bottom: 9px; cursor: pointer; transition: all 0.2s; }
        .bayar-option:last-child { margin-bottom: 0; }
        .bayar-option:hover { border-color: #FFBBC0; background: #FFF8F9; }
        .bayar-option.selected { border-color: #e07080; background: #FFF0F3; }
        .bayar-icon { width: 40px; height: 40px; border-radius: 10px; background: white; border: 1px solid #F0D5D8; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .bayar-name { font-size: 13px; font-weight: 700; color: #3b1a1a; margin-bottom: 1px; }
        .bayar-sub  { font-size: 11px; color: #9E7178; }

        /* QRIS box */
        .qris-box { text-align: center; padding: 24px; border: 1.5px dashed #F0D5D8; border-radius: 16px; }
        .qris-box .qris-img { width: 140px; height: 140px; margin: 0 auto 12px; background: #f9f0f2; border-radius: 12px; display: flex; align-items: center; justify-content: center; }
        .qris-box .qris-label { font-size: 13px; font-weight: 700; color: #5D393B; margin-bottom: 4px; }
        .qris-box .qris-sub   { font-size: 11px; color: #9E7178; }

        /* ── RINGKASAN (lebih besar) ── */
        .checkout-right { width: 480px; flex-shrink: 0; position: sticky; top: 100px; }
        .summary-box { background: white; border: 1.5px solid #F0D5D8; border-radius: 24px; padding: 36px; box-shadow: 0 6px 28px rgba(184,92,101,0.1); }
        .summary-title { font-size: 22px; font-weight: 800; color: #2A1520; margin-bottom: 24px; display: flex; align-items: center; gap: 10px; }

        .summary-produk { display: flex; align-items: center; gap: 16px; margin-bottom: 18px; padding-bottom: 18px; border-bottom: 1px solid #F0D5D8; }
        .summary-produk:last-of-type { border-bottom: none; padding-bottom: 0; margin-bottom: 0; }
        .summary-thumb { width: 72px; height: 72px; border-radius: 14px; background: linear-gradient(145deg, #FFF0F4, #FFE4EC); border: 1.5px solid #F0D5D8; flex-shrink: 0; overflow: hidden; }
        .summary-thumb img { width: 100%; height: 100%; object-fit: cover; }
        .summary-produk-nama  { font-size: 14px; font-weight: 600; color: #5D393B; line-height: 1.4; flex: 1; }
        .summary-produk-harga { font-size: 15px; font-weight: 800; color: #e07080; white-space: nowrap; }

        .summary-divider { border: none; border-top: 1.5px dashed #F0D5D8; margin: 20px 0; }

        .summary-row { display: flex; justify-content: space-between; align-items: center; font-size: 14px; color: #9E7178; margin-bottom: 13px; }
        .summary-row span:last-child { font-weight: 600; color: #3b1a1a; }
        .summary-row.diskon span:last-child { color: #4CAF7D; font-weight: 700; }

        .summary-total { display: flex; justify-content: space-between; align-items: center; font-size: 22px; font-weight: 800; margin-bottom: 26px; padding-top: 4px; }
        .summary-total span:first-child { color: #5D393B; }
        .summary-total span:last-child  { color: #e07080; }

        .btn-pesan { display: flex; align-items: center; justify-content: center; gap: 9px; width: 100%; padding: 17px; background: #e07080; color: white; border: none; border-radius: 100px; font-size: 16px; font-weight: 700; cursor: pointer; font-family: 'Poppins', sans-serif; text-decoration: none; text-align: center; transition: all 0.2s; box-shadow: 0 4px 16px rgba(224,112,128,0.35); }
        .btn-pesan:hover { background: #c85070; transform: translateY(-1px); box-shadow: 0 6px 20px rgba(224,112,128,0.45); }
        .secure-note { display: flex; align-items: center; justify-content: center; gap: 6px; font-size: 12px; color: #9E7178; margin-top: 16px; }

        /* ── TOAST ── */
        .toast { position: fixed; bottom: 28px; left: 50%; transform: translateX(-50%) translateY(90px); background: #3b1a1a; color: white; padding: 13px 26px; border-radius: 100px; font-size: 13px; font-weight: 500; z-index: 999; box-shadow: 0 8px 28px rgba(0,0,0,0.2); transition: transform 0.4s cubic-bezier(0.34,1.48,0.64,1); white-space: nowrap; }
        .toast.show { transform: translateX(-50%) translateY(0); }
    </style>
    
    <!-- MIDTRANS SNAP SDK -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>

</head>
<body>

<div class="toast" id="toast"></div>

{{-- Navbar diambil dari file layouts/navigation.blade.php --}}
@include('layouts.navigation')

<!-- STEP BAR -->
<div class="steps-bar">
    <div class="step done"><div class="step-num"><iconify-icon icon="ph:check-bold" width="12"></iconify-icon></div>Keranjang</div>
    <div class="step-arrow">›</div>
    <div class="step active"><div class="step-num">2</div>Checkout</div>
    <div class="step-arrow">›</div>
    <div class="step"><div class="step-num">3</div>Selesai</div>
</div>

<!-- KONTEN -->
<div class="content">

    <!-- KIRI -->
    <div class="checkout-left">
        <div class="page-title">
            <iconify-icon icon="ph:shopping-cart-bold" width="26" style="color:#e07080;"></iconify-icon>
            Checkout
        </div>

        <!-- Alamat -->
        <div class="section-box">
            <div class="section-header">
                <div class="section-icon"><iconify-icon icon="ph:map-pin-bold" width="18" style="color:#e07080;"></iconify-icon></div>
                <div class="section-title">Alamat Pengiriman</div>
            </div>
            <label class="form-label">Nama Lengkap</label>
            <input type="text" class="form-input" placeholder="Masukkan nama lengkap">
            <label class="form-label">Nomor HP</label>
            <input type="text" class="form-input" placeholder="08xxxxxxxxxx">
            <label class="form-label">Alamat Lengkap</label>
            <textarea class="form-input" placeholder="Jalan, nomor rumah, RT/RW, kelurahan..."></textarea>
            <div class="row-2">
                <div>
                    <label class="form-label">Kota</label>
                    <input type="text" class="form-input" placeholder="Jakarta" style="margin-bottom:0;">
                </div>
                <div>
                    <label class="form-label">Kode Pos</label>
                    <input type="text" class="form-input" placeholder="12345" style="margin-bottom:0;">
                </div>
            </div>
        </div>

        <!-- Kurir -->
        <div class="section-box">
            <div class="section-header">
                <div class="section-icon"><iconify-icon icon="ph:truck-bold" width="18" style="color:#e07080;"></iconify-icon></div>
                <div class="section-title">Jasa Pengiriman</div>
            </div>

            <!-- Cari kota/kecamatan tujuan -->
            <label class="form-label">Kota / Kecamatan Tujuan</label>
            <div style="position:relative; margin-bottom:14px;">
                <input type="text" id="destinationSearch" class="form-input"
                       placeholder="Ketik nama kota atau kecamatan..."
                       autocomplete="off"
                       oninput="onDestinationInput()"
                       style="margin-bottom:0;">
                <!-- Dropdown autocomplete -->
                <div id="destinationDropdown" style="
                    display:none; position:absolute; left:0; right:0; top:100%; z-index:100;
                    background:white; border:1.5px solid #F0D5D8; border-radius:0 0 12px 12px;
                    box-shadow:0 8px 24px rgba(184,92,101,0.12); max-height:260px; overflow-y:auto;">
                </div>
            </div>
            <!-- Tujuan terpilih -->
            <div id="destinationSelected" style="display:none; font-size:12px; color:#4CAF7D; font-weight:600; margin-bottom:14px;">
                <iconify-icon icon="ph:check-circle-bold" width="14"></iconify-icon>
                <span id="destinationLabel"></span>
            </div>
            <input type="hidden" id="destinationId">

            <!-- Hasil kurir -->
            <div id="kurir-container">
                <div style="font-size:13px; color:#C4A0A8; padding:14px 0; text-align:center;">
                    <iconify-icon icon="ph:map-pin-bold" width="16" style="vertical-align:middle;"></iconify-icon>
                    Pilih kota tujuan untuk melihat ongkir
                </div>
            </div>
        </div>


        <!-- Voucher & Ayu Koin -->
        <div class="section-box">
            <div class="section-header">
                <div class="section-icon"><iconify-icon icon="ph:ticket-bold" width="18" style="color:#e07080;"></iconify-icon></div>
                <div class="section-title">Voucher & Ayu Koin</div>
            </div>
            <div class="form-label">Kode Voucher</div>
            <div class="voucher-input-wrap">
                <input type="text" id="voucherInput" placeholder="Masukkan kode voucher...">
                <button class="btn-pakai" onclick="pakaiVoucher()">Pakai</button>
            </div>
            <div class="voucher-applied" id="voucherApplied">
                <iconify-icon icon="ph:check-circle-bold" width="16" style="color:#4CAF7D;flex-shrink:0;"></iconify-icon>
                <span id="voucherLabel"></span>
                <span class="voucher-remove" onclick="hapusVoucher()">✕</span>
            </div>
            <div class="koin-toggle" id="koinToggle" onclick="toggleKoin()">
                <div class="koin-toggle-left">
                    <div class="koin-toggle-icon">🪙</div>
                    <div>
                        <div class="koin-toggle-title">Gunakan Ayu Koin</div>
                        <div class="koin-toggle-sub">150 koin = <strong>Rp 15.000</strong> diskon</div>
                    </div>
                </div>
                <div style="display:flex;align-items:center;gap:8px;">
                    <span class="koin-discount-label" id="koinLabel"></span>
                    <label class="koin-switch" onclick="event.stopPropagation()">
                        <input type="checkbox" id="koinCheck" onchange="toggleKoin()">
                        <span class="koin-slider"></span>
                    </label>
                </div>
            </div>
        </div>

        <!-- Metode Pembayaran -->
        <div class="section-box">
            <div class="section-header">
                <div class="section-icon"><iconify-icon icon="ph:credit-card-bold" width="18" style="color:#e07080;"></iconify-icon></div>
                <div class="section-title">Metode Pembayaran</div>
            </div>

            <!-- Tab kategori -->
            <div class="bayar-kategori">
                <div class="bayar-tab active" onclick="switchTab('bank',this)">
                    <iconify-icon icon="ph:bank-bold" width="14"></iconify-icon> Transfer Bank
                </div>
                <div class="bayar-tab" onclick="switchTab('ewallet',this)">
                    <iconify-icon icon="ph:device-mobile-bold" width="14"></iconify-icon> E-Wallet
                </div>
                <div class="bayar-tab" onclick="switchTab('qris',this)">
                    <iconify-icon icon="ph:qr-code-bold" width="14"></iconify-icon> QRIS
                </div>
                <div class="bayar-tab" onclick="switchTab('cod',this)">
                    <iconify-icon icon="ph:hand-coins-bold" width="14"></iconify-icon> COD
                </div>
            </div>

            <!-- Panel: Bank -->
            <div class="bayar-panel show" id="panel-bank">
                <div class="bayar-option selected" onclick="pilihBayar(this,'Transfer BCA')">
                    <div class="radio-circle checked"></div>
                    <div class="bayar-icon"><iconify-icon icon="simple-icons:bca" width="22" style="color:#005BAA;"></iconify-icon></div>
                    <div><div class="bayar-name">BCA</div><div class="bayar-sub">Rek: 1234567890 a.n AYU-NE</div></div>
                </div>
                <div class="bayar-option" onclick="pilihBayar(this,'Transfer BNI')">
                    <div class="radio-circle"></div>
                    <div class="bayar-icon"><iconify-icon icon="ph:bank-bold" width="22" style="color:#F37021;"></iconify-icon></div>
                    <div><div class="bayar-name">BNI</div><div class="bayar-sub">Rek: 0987654321 a.n AYU-NE</div></div>
                </div>
                <div class="bayar-option" onclick="pilihBayar(this,'Transfer BRI')">
                    <div class="radio-circle"></div>
                    <div class="bayar-icon"><iconify-icon icon="ph:bank-bold" width="22" style="color:#004B9E;"></iconify-icon></div>
                    <div><div class="bayar-name">BRI</div><div class="bayar-sub">Rek: 1122334455 a.n AYU-NE</div></div>
                </div>
                <div class="bayar-option" onclick="pilihBayar(this,'Transfer Mandiri')">
                    <div class="radio-circle"></div>
                    <div class="bayar-icon"><iconify-icon icon="ph:bank-bold" width="22" style="color:#003F8F;"></iconify-icon></div>
                    <div><div class="bayar-name">Mandiri</div><div class="bayar-sub">Rek: 5566778899 a.n AYU-NE</div></div>
                </div>
            </div>

            <!-- Panel: E-Wallet -->
            <div class="bayar-panel" id="panel-ewallet">
                <div class="bayar-option" onclick="pilihBayar(this,'GoPay')">
                    <div class="radio-circle"></div>
                    <div class="bayar-icon" style="background:#E8F9F5;">
                        <iconify-icon icon="simple-icons:gojek" width="22" style="color:#00AED6;"></iconify-icon>
                    </div>
                    <div><div class="bayar-name">GoPay</div><div class="bayar-sub">Bayar via aplikasi Gojek</div></div>
                </div>
                <div class="bayar-option" onclick="pilihBayar(this,'OVO')">
                    <div class="radio-circle"></div>
                    <div class="bayar-icon" style="background:#F0ECFA;">
                        <iconify-icon icon="simple-icons:ovo" width="22" style="color:#4C3494;"></iconify-icon>
                    </div>
                    <div><div class="bayar-name">OVO</div><div class="bayar-sub">Bayar via aplikasi OVO</div></div>
                </div>
                <div class="bayar-option" onclick="pilihBayar(this,'Dana')">
                    <div class="radio-circle"></div>
                    <div class="bayar-icon" style="background:#E8F3FD;">
                        <iconify-icon icon="simple-icons:dana" width="22" style="color:#118EEA;"></iconify-icon>
                    </div>
                    <div><div class="bayar-name">Dana</div><div class="bayar-sub">Bayar via aplikasi Dana</div></div>
                </div>
                <div class="bayar-option" onclick="pilihBayar(this,'ShopeePay')">
                    <div class="radio-circle"></div>
                    <div class="bayar-icon" style="background:#FEF0ED;">
                        <iconify-icon icon="simple-icons:shopee" width="22" style="color:#EE4D2D;"></iconify-icon>
                    </div>
                    <div><div class="bayar-name">ShopeePay</div><div class="bayar-sub">Bayar via aplikasi Shopee</div></div>
                </div>
                <div class="bayar-option" onclick="pilihBayar(this,'Ayu Koin')">
                    <div class="radio-circle"></div>
                    <div class="bayar-icon" style="background:linear-gradient(135deg,#ffe8ed,#f5a5b6);">
                        <span style="font-size:20px;">🪙</span>
                    </div>
                    <div>
                        <div class="bayar-name">Ayu Koin</div>
                        <div class="bayar-sub">Kamu punya 150 koin = Rp 15.000</div>
                    </div>
                </div>
            </div>

            <!-- Panel: QRIS -->
            <div class="bayar-panel" id="panel-qris">
                <div class="bayar-option selected" onclick="pilihBayar(this,'QRIS')">
                    <div class="radio-circle checked"></div>
                    <div class="bayar-icon"><iconify-icon icon="ph:qr-code-bold" width="22" style="color:#e07080;"></iconify-icon></div>
                    <div><div class="bayar-name">QRIS</div><div class="bayar-sub">Scan QR pakai aplikasi apapun</div></div>
                </div>
                <div class="qris-box" style="margin-top:14px;">
                    <div class="qris-img">
                        <iconify-icon icon="ph:qr-code-bold" width="80" style="color:#c4a0a0;"></iconify-icon>
                    </div>
                    <div class="qris-label">Scan QR Code di bawah ini</div>
                    <div class="qris-sub">Bisa dibayar via GoPay, OVO, Dana, ShopeePay, m-Banking, dll</div>
                </div>
            </div>

            <!-- Panel: COD -->
            <div class="bayar-panel" id="panel-cod">
                <div class="bayar-option selected" onclick="pilihBayar(this,'COD')">
                    <div class="radio-circle checked"></div>
                    <div class="bayar-icon"><iconify-icon icon="ph:hand-coins-bold" width="22" style="color:#e07080;"></iconify-icon></div>
                    <div><div class="bayar-name">Bayar di Tempat (COD)</div><div class="bayar-sub">Bayar tunai saat paket tiba</div></div>
                </div>
            </div>

        </div>
    </div>

    <!-- KANAN: RINGKASAN LEBIH BESAR -->
    <div class="checkout-right">
        <div class="summary-box">
            <div class="summary-title">
                <iconify-icon icon="ph:receipt-bold" width="22" style="color:#e07080;"></iconify-icon>
                Ringkasan Pesanan
            </div>

            @foreach($cartItems as $item)
            <div class="summary-produk">
                <div class="summary-thumb">
                    @if($item->product->foto && str_starts_with($item->product->foto, 'http'))
                        <img src="{{ $item->product->foto }}">
                    @elseif($item->product->foto)
                        <img src="{{ asset('storage/' . $item->product->foto) }}">
                    @endif
                </div>
                <div class="summary-produk-nama">{{ $item->product->nama_produk }} <span style="color:#9E7178;font-size:12px;">x{{ $item->quantity }}</span></div>
                <div class="summary-produk-harga">Rp {{ number_format($item->product->harga * $item->quantity, 0, ',', '.') }}</div>
            </div>
            @endforeach

            <hr class="summary-divider">

            <div class="summary-row">
                <span>Subtotal ({{ $cartItems->sum('quantity') }} produk)</span><span>Rp {{ number_format($grandTotal, 0, ',', '.') }}</span>
            </div>
            <div class="summary-row">
                <span>Ongkir</span><span id="ongkirVal">Belum dipilih</span>
            </div>
            <div class="summary-row diskon" id="diskonRow" style="display:none;">
                <span>Diskon</span><span id="diskonVal">- Rp 0</span>
            </div>
            <div class="summary-row">
                <span>Metode Bayar</span><span id="bayarVal">Transfer BCA</span>
            </div>

            <hr class="summary-divider">

            <div class="summary-total">
                <span>Total</span>
                <span id="totalVal">Rp {{ number_format($grandTotal, 0, ',', '.') }}</span>
            </div>

            <button id="pay-button" class="btn-pesan">
                <iconify-icon icon="ph:shopping-bag-bold" width="18"></iconify-icon>
                Buat Pesanan
            </button>

            <div class="secure-note">
                <iconify-icon icon="ph:lock-bold" width="13"></iconify-icon>
                Pembayaran aman & terenkripsi
            </div>
        </div>
    </div>

</div>

<script>
    let ongkir      = 0;
    let diskonKoin  = 0;
    let diskonVouch = 0;
    const subtotal  = {{ $grandTotal }};
    const koinNilai = 15000;
    let csrfToken   = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    let searchTimer = null;
    let selectedDestinationId = null;

    // ── AUTOCOMPLETE PENCARIAN KOTA TUJUAN ──────────────────────────────
    function onDestinationInput() {
        const q = document.getElementById('destinationSearch').value.trim();
        selectedDestinationId = null;
        document.getElementById('destinationSelected').style.display = 'none';

        clearTimeout(searchTimer);
        if (q.length < 2) {
            document.getElementById('destinationDropdown').style.display = 'none';
            return;
        }

        searchTimer = setTimeout(async () => {
            try {
                const res = await fetch(
                    `{{ route('api.shipping.search') }}?search=${encodeURIComponent(q)}`,
                    { headers: { 'X-CSRF-TOKEN': csrfToken } }
                );
                const data = await res.json();
                const items = data.data ?? [];
                renderDropdown(Array.isArray(items) ? items : []);
            } catch (e) {
                console.error('Search error:', e);
                document.getElementById('destinationDropdown').innerHTML =
                    '<div style="padding:12px 16px;font-size:13px;color:#e07080;">Gagal mencari lokasi.</div>';
                document.getElementById('destinationDropdown').style.display = 'block';
            }
        }, 200);
    }

    // Simpan seluruh item dari hasil pencarian
    let destinationItems = [];

    function renderDropdown(items) {
        const dd = document.getElementById('destinationDropdown');
        destinationItems = items; // simpan untuk referensi

        if (!items.length) {
            dd.innerHTML = '<div style="padding:12px 16px;font-size:13px;color:#9E7178;">Tidak ditemukan hasil.</div>';
            dd.style.display = 'block';
            return;
        }

        dd.innerHTML = items.map((item, idx) => {
            const dist = item.distance_km ? `~${item.distance_km} km` : '';
            return `<div onclick="selectDestination(${idx})" data-idx="${idx}"
                 style="padding:10px 16px; font-size:13px; cursor:pointer; border-bottom:1px solid #F9EDEF; color:#3b1a1a; transition:background 0.15s; display:flex; justify-content:space-between; align-items:center;"
                 onmouseover="this.style.background='#FFF8F9'" onmouseout="this.style.background='white'">
                <div>
                    <strong>${escapeHtml(item.subdistrict_name ?? '-')}</strong>
                    <span style="color:#9E7178;"> — ${escapeHtml(item.city_name ?? '')} ${escapeHtml(item.province_name ?? '')}</span>
                </div>
                <span style="color:#e07080;font-size:11px;font-weight:600;white-space:nowrap;margin-left:8px;">${dist}</span>
            </div>`;
        }).join('');
        dd.style.display = 'block';
    }

    function selectDestination(idx) {
        const item = destinationItems[idx];
        if (!item || !item.id) { showToast('⚠️ Gagal mendapat ID lokasi.'); return; }

        const label = item.label ?? `${item.subdistrict_name ?? '-'}, ${item.city_name ?? ''} - ${item.province_name ?? ''}`;
        const dist = item.distance_km ? ` (~${item.distance_km} km)` : '';

        selectedDestinationId = item.id;
        document.getElementById('destinationId').value = item.id;
        document.getElementById('destinationSearch').value = label;
        document.getElementById('destinationDropdown').style.display = 'none';
        document.getElementById('destinationLabel').textContent = '✓ ' + label + dist;
        document.getElementById('destinationSelected').style.display = 'block';

        // Auto fetch ongkir
        cekOngkir();
    }


    // Tutup dropdown kalau klik di luar
    document.addEventListener('click', function(e) {
        if (!e.target.closest('#destinationSearch') && !e.target.closest('#destinationDropdown')) {
            document.getElementById('destinationDropdown').style.display = 'none';
        }
    });

    // ── CEK ONGKIR ──────────────────────────────────────────────────────
    async function cekOngkir() {
        if (!selectedDestinationId) { showToast('⚠️ Pilih kota tujuan terlebih dahulu!'); return; }

        const container = document.getElementById('kurir-container');
        container.innerHTML = '<div style="font-size:13px;color:#9E7178;padding:14px 0;text-align:center;"><iconify-icon icon="ph:spinner-gap-bold" width="18" style="vertical-align:middle;animation:spin 1s linear infinite;"></iconify-icon> Mengambil tarif pengiriman...</div>';

        try {
            const res = await fetch('{{ route("api.shipping.rates") }}', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
                body: JSON.stringify({
                    destination_subdistrict_id: selectedDestinationId,
                    weight: 1000
                })
            });
            const data = await res.json();
            if (data.status === 'success' && data.data.length) {
                renderKurirOptions(data.data);
            } else {
                container.innerHTML = `<div style="font-size:13px;color:#e07080;padding:14px 0;text-align:center;">${data.message ?? 'Gagal memuat tarif.'}</div>`;
            }
        } catch (err) {
            console.error(err);
            container.innerHTML = '<div style="font-size:13px;color:#e07080;padding:14px 0;text-align:center;">Terjadi kesalahan saat menghubungi server.</div>';
        }
    }

    function renderKurirOptions(rates) {
        const container = document.getElementById('kurir-container');
        container.innerHTML = '';
        rates.forEach((rate, index) => {
            const isSelected = index === 0;
            container.innerHTML += `
            <div class="kurir-option ${isSelected ? 'selected' : ''}" onclick="pilihKurir(this, ${rate.price})">
                <div class="kurir-left">
                    <div class="radio-circle ${isSelected ? 'checked' : ''}"></div>
                    <div>
                        <div class="kurir-name">${escapeHtml(rate.name)}</div>
                        <div class="kurir-hari">Estimasi ${escapeHtml(String(rate.etd))}</div>
                    </div>
                </div>
                <div class="kurir-harga">${formatRp(rate.price)}</div>
            </div>`;
            if (isSelected) {
                ongkir = rate.price;
                document.getElementById('ongkirVal').textContent = formatRp(ongkir);
                hitungTotal();
            }
        });
    }

    function escapeHtml(str) {
        return String(str).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
    }


    const VOUCHERS = {
        'AYUNE10'  : { label: 'AYUNE10 — diskon 10%',  tipe: 'persen', nilai: 10    },
        'HEMAT20K' : { label: 'HEMAT20K — Rp 20.000',  tipe: 'flat',   nilai: 20000 },
        'PRELOVED5': { label: 'PRELOVED5 — diskon 5%', tipe: 'persen', nilai: 5     },
    };

    function formatRp(num) {
        return 'Rp ' + Math.max(num,0).toLocaleString('id-ID');
    }

    function hitungTotal() {
        const totalDiskon = diskonKoin + diskonVouch;
        document.getElementById('totalVal').textContent  = formatRp(subtotal + ongkir - totalDiskon);
        document.getElementById('diskonVal').textContent = '- ' + formatRp(totalDiskon);
        document.getElementById('diskonRow').style.display = totalDiskon > 0 ? 'flex' : 'none';
    }

    function pilihKurir(el, harga) {
        document.querySelectorAll('.kurir-option').forEach(k => {
            k.classList.remove('selected');
            k.querySelector('.radio-circle').classList.remove('checked');
        });
        el.classList.add('selected');
        el.querySelector('.radio-circle').classList.add('checked');
        ongkir = harga;
        document.getElementById('ongkirVal').textContent = formatRp(ongkir);
        hitungTotal();
    }

    function switchTab(tab, el) {
        // update tab active
        document.querySelectorAll('.bayar-tab').forEach(t => t.classList.remove('active'));
        el.classList.add('active');
        // show panel
        document.querySelectorAll('.bayar-panel').forEach(p => p.classList.remove('show'));
        document.getElementById('panel-' + tab).classList.add('show');
        // auto pilih default
        const def = document.querySelector('#panel-' + tab + ' .bayar-option.selected');
        if (def) {
            const nama = def.querySelector('.bayar-name').textContent;
            document.getElementById('bayarVal').textContent = nama;
        } else {
            const first = document.querySelector('#panel-' + tab + ' .bayar-option');
            if (first) pilihBayar(first, first.querySelector('.bayar-name').textContent);
        }
    }

    function pilihBayar(el, nama) {
        // reset semua panel (karena bisa lintas panel)
        document.querySelectorAll('.bayar-option').forEach(b => {
            b.classList.remove('selected');
            const r = b.querySelector('.radio-circle');
            if (r) r.classList.remove('checked');
        });
        el.classList.add('selected');
        const r = el.querySelector('.radio-circle');
        if (r) r.classList.add('checked');
        document.getElementById('bayarVal').textContent = nama;
    }

    function pakaiVoucher() {
        const kode = document.getElementById('voucherInput').value.trim().toUpperCase();
        const v    = VOUCHERS[kode];
        if (!kode) { showToast('⚠️ Masukkan kode voucher dulu!'); return; }
        if (!v)    { showToast('❌ Kode voucher tidak valid!'); return; }
        diskonVouch = v.tipe === 'persen' ? Math.round(subtotal * v.nilai / 100) : v.nilai;
        document.getElementById('voucherLabel').textContent = '✓ ' + v.label;
        document.getElementById('voucherApplied').classList.add('show');
        document.getElementById('voucherInput').disabled = true;
        hitungTotal();
        showToast('✅ Voucher berhasil dipakai!');
    }

    function hapusVoucher() {
        diskonVouch = 0;
        document.getElementById('voucherInput').value    = '';
        document.getElementById('voucherInput').disabled = false;
        document.getElementById('voucherApplied').classList.remove('show');
        hitungTotal();
    }

    function toggleKoin() {
        const cb     = document.getElementById('koinCheck');
        const toggle = document.getElementById('koinToggle');
        const label  = document.getElementById('koinLabel');
        if (event.target !== cb) cb.checked = !cb.checked;
        if (cb.checked) {
            diskonKoin = koinNilai;
            label.textContent = '- Rp 15.000';
            toggle.classList.add('active');
            showToast('🪙 150 Ayu Koin dipakai!');
        } else {
            diskonKoin = 0;
            label.textContent = '';
            toggle.classList.remove('active');
        }
        hitungTotal();
    }

    function showToast(msg) {
        const t = document.getElementById('toast');
        t.textContent = msg; t.classList.add('show');
        clearTimeout(t._timer); t._timer = setTimeout(() => t.classList.remove('show'), 2800);
    }

    // ── MIDTRANS PAYMENT ─────────────────────────────────────────
    document.getElementById('pay-button').addEventListener('click', function () {
        // Validasi: kurir harus sudah dipilih
        if (!selectedDestinationId || ongkir === 0) {
            showToast('⚠️ Pilih jasa pengiriman dulu!');
            return;
        }

        // Validasi: nama & nomor HP harus diisi
        const nama = document.querySelector('input[placeholder="Masukkan nama lengkap"]').value.trim();
        const hp   = document.querySelector('input[placeholder="08xxxxxxxxxx"]').value.trim();
        if (!nama || !hp) {
            showToast('⚠️ Isi nama dan nomor HP dulu!');
            return;
        }

        const totalDiskon = diskonKoin + diskonVouch;
        const total = subtotal + ongkir - totalDiskon;

        // Tampilkan loading
        const originalBtnText = this.innerHTML;
        this.innerHTML = '<iconify-icon icon="ph:spinner-gap-bold" width="18" style="animation:spin 1s linear infinite;"></iconify-icon> Memproses...';
        this.disabled = true;

        // Kumpulkan nama produk dari summary
        const produkNames = [];
        document.querySelectorAll('.summary-produk-nama').forEach(el => {
            produkNames.push(el.textContent.trim());
        });

        fetch('{{ route("checkout.process") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({
                subtotal     : subtotal,
                ongkir       : ongkir,
                diskon       : totalDiskon,
                total        : total,
                nama         : nama,
                hp           : hp,
                metode_bayar : document.getElementById('bayarVal').textContent,
                produk_names : produkNames,
                items        : [
                    @foreach($cartItems as $item)
                    { product_id: {{ $item->product_id }}, seller_id: {{ $item->product->user_id }}, harga: {{ $item->product->harga * $item->quantity }}, quantity: {{ $item->quantity }} },
                    @endforeach
                ],
                is_direct    : {{ isset($isDirect) && $isDirect ? 'true' : 'false' }}
            })
        })
        .then(res => res.json())
        .then(data => {
            // Reset tombol
            this.innerHTML = originalBtnText;
            this.disabled = false;

            if (data.token) {
                const savedOrderId = data.order_id;
                // Tampilkan popup Midtrans
                window.snap.pay(data.token, {
                    onSuccess: function (result) {
                        // Update status order ke 'dibayar'
                        fetch('{{ route("order.update-status") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken
                            },
                            body: JSON.stringify({
                                order_id: savedOrderId,
                                status: 'diproses'
                            })
                        }).finally(() => {
                            window.location.href = "{{ route('pesanan-berhasil') }}?order_id=" + savedOrderId;
                        });
                    },
                    onPending: function (result) {
                        showToast('⏳ Menunggu pembayaran...');
                    },
                    onError: function (result) {
                        showToast('❌ Pembayaran gagal, coba lagi!');
                    },
                    onClose: function () {
                        showToast('⚠️ Kamu menutup popup sebelum menyelesaikan pembayaran.');
                    }
                });
            } else {
                showToast('❌ Gagal: ' + (data.error || 'Unknown Error'));
                console.error(data);
            }
        })
        .catch(err => {
            this.innerHTML = originalBtnText;
            this.disabled = false;
            console.error(err);
            showToast('❌ Terjadi kesalahan koneksi.');
        });
    });

</script>
<style>
    @keyframes spin { 100% { transform: rotate(360deg); } }
</style>
</body>
</html>