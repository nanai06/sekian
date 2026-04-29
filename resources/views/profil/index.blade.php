<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.iconify.design/iconify-icon/2.1.0/iconify-icon.min.js"></script>
    <title>Profil Saya - AYU-NE</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * { margin:0; padding:0; box-sizing:border-box; font-family:'Poppins',sans-serif; }
        body { background:#F8F6F3; color:#3b1a1a; }

        /* ==========================================
           LAYOUT UTAMA
           ========================================== */
        .profil-page { max-width:800px; margin:0 auto; padding:34px 20px 60px; }

        

        /* ==========================================
           HEADER PROFIL
           Avatar + nama + badge + stats
           ========================================== */
        .profil-header-card {
            background:white;
            border:0.5px solid #E8E3DF;
            border-radius: 16px 16px 16px 16px;
            padding:50px 28px 28px 24px;
            margin-bottom:12px;
        }

        .avatar-row {
            display:flex;
            align-items:flex-end;
            gap:16px;
            margin-top:-32px;
            margin-bottom:12px;
        }

        .avatar-circle {
            width:64px; height:64px;
            border-radius:50%;
            border:3px solid white;
            background: linear-gradient(135deg, #FBEAF0 0%, #F4C0D1 100%);
            display:flex; align-items:center; justify-content:center;
            font-size:22px; font-weight:700; color:#D4537E;
            overflow:hidden;
            flex-shrink:0;
            box-shadow:0 2px 8px rgba(212,83,126,0.18);
        }
        .avatar-circle img { width:100%; height:100%; object-fit:cover; }

        .profil-name { font-size:16px; font-weight:700; color:#3b1a1a; line-height:1.2; }
        .profil-handle { font-size:12px; color:#9E7178; margin-top:1px; }
        .profil-kota { font-size:11px; color:#9E7178; margin-top:2px; display:flex; align-items:center; gap:4px; }

        .profil-bio {
            font-size:12px; color:#5D393B; line-height:1.6;
            margin:10px 0 12px;
            padding:8px 12px;
            background:#FBEAF0;
            border-radius:10px;
            border:0.5px solid #F4C0D1;
        }
        .profil-bio.empty { color:#9E7178; font-style:italic; }

        /* Badge row */
        .badge-row { display:flex; flex-wrap:wrap; gap:6px; margin-bottom:14px; }
        .badge-pill {
            font-size:11px; font-weight:500;
            padding:3px 10px;
            border-radius:20px;
            display:inline-flex; align-items:center; gap:4px;
        }
        .badge-eco { background:#EAF3DE; color:#639922; }
        .badge-verified { background:#FBEAF0; color:#D4537E; }
        .badge-member { background:#F3F1EE; color:#7a6a5f; }

        /* Tombol edit profil */
        .btn-edit-profil {
            display:inline-flex; align-items:center; gap:6px;
            background:#D4537E; color:white;
            border:none; border-radius:20px;
            padding:7px 18px;
            margin-left: 570px;
            font-size:12px; font-weight:600;
            font-family:'Poppins',sans-serif;
            cursor:pointer;
            text-decoration:none;
            transition:all 0.2s;
        }
        .btn-edit-profil:hover { background:#b8436a; transform:translateY(-1px); }

        /* ==========================================
           CARD INFORMASI AKUN
           ========================================== */
        .info-card {
            background:white;
            border:0.5px solid #E8E3DF;
            border-radius:16px;
            padding:20px 24px;
            margin-bottom:12px;
        }
        .info-card-title {
            font-size:15px; font-weight:700; color:#3b1a1a;
            margin-bottom:16px;
        }
        .info-row {
            display:flex; align-items:flex-start; gap:12px;
            padding:10px 0;
        }
        .info-row + .info-row { border-top:0.5px solid #F3F1EE; }
        .info-icon {
            flex-shrink:0;
            width:32px; height:32px;
            background:#FBEAF0;
            border-radius:8px;
            display:flex; align-items:center; justify-content:center;
        }
        .info-label { font-size:11px; color:#9E7178; }
        .info-value { font-size:13px; font-weight:500; color:#3b1a1a; margin-top:1px; }

        /* ==========================================
           RIWAYAT PESANAN PREVIEW
           ========================================== */
        .riwayat-card {
            background:white;
            border:0.5px solid #E8E3DF;
            border-radius:16px;
            padding:20px 24px;
            margin-bottom:12px;
        }
        .riwayat-header {
            display:flex; justify-content:space-between; align-items:center;
            margin-bottom:14px;
        }
        .riwayat-title { font-size:15px; font-weight:700; color:#3b1a1a; }
        .riwayat-link {
            font-size:12px; font-weight:500; color:#D4537E;
            text-decoration:none;
            transition:color 0.2s;
        }
        .riwayat-link:hover { color:#993556; }

        .order-item {
            display:flex; align-items:center; gap:12px;
            padding:10px 0;
        }
        .order-item + .order-item { border-top:0.5px solid #F3F1EE; }

        .order-thumb {
            width:44px; height:44px;
            border-radius:10px;
            border:0.5px solid #E8E3DF;
            overflow:hidden;
            flex-shrink:0;
            display:flex; align-items:center; justify-content:center;
            background:#FBEAF0;
            font-size:20px;
        }
        .order-thumb img { width:100%; height:100%; object-fit:cover; }

        .order-info { flex:1; min-width:0; }
        .order-produk {
            font-size:13px; font-weight:500; color:#3b1a1a;
            white-space:nowrap; overflow:hidden; text-overflow:ellipsis;
        }
        .order-tanggal { font-size:11px; color:#9E7178; margin-top:1px; }

        .order-right { text-align:right; flex-shrink:0; }
        .order-harga { font-size:13px; font-weight:600; color:#3b1a1a; }

        .status-pill {
            display:inline-block;
            font-size:10px; font-weight:600;
            padding:2px 8px;
            border-radius:20px;
            margin-top:3px;
        }
        .status-selesai { background:#EAF3DE; color:#639922; }
        .status-proses { background:#FBEAF0; color:#D4537E; }
        .status-batal { background:#F3F1EE; color:#7a6a5f; }

        /* Empty state */
        .empty-state {
            text-align:center; padding:24px 0;
        }
        .empty-icon { font-size:28px; margin-bottom:6px; }
        .empty-text { font-size:13px; color:#9E7178; font-weight:500; }
        .empty-sub { font-size:11px; color:#b5a5a0; margin-top:2px; }

        /* ==========================================
           FOOTER
           ========================================== */
        footer { background:#FFF8F8; border-top:1px solid #F0D5D8; }
        .footer-inner {
            display:grid; grid-template-columns:2fr 1fr 1fr 1fr;
            gap:48px; padding:60px 48px 40px;
        }
        .f-logo img { height:28px; width:auto; object-fit:contain; }
        .footer-brand .f-logo { font-size:22px; font-weight:800; font-style:italic; color:#5D393B; margin-bottom:12px; }
        .footer-brand p { font-size:13px; color:#9E7178; line-height:1.7; max-width:280px; }
        .footer-col h4 { font-size:12px; font-weight:700; letter-spacing:1.5px; text-transform:uppercase; color:#5D393B; margin-bottom:16px; }
        .footer-col ul { list-style:none; }
        .footer-col li { margin-bottom:10px; }
        .footer-col a { font-size:13px; color:#9E7178; transition:color 0.2s; text-decoration:none; }
        .footer-col a:hover { color:#5D393B; }
        .footer-bottom {
            border-top:1px solid #F0D5D8; padding:20px 48px;
            display:flex; justify-content:space-between; align-items:center;
            font-size:12px; color:#9E7178;
        }
        .payment-icons { display:flex; gap:8px; align-items:center; }
        .pay-badge { background:white; border:1px solid #F0D5D8; border-radius:6px; padding:4px 8px; font-size:10px; font-weight:700; color:#5D393B; }

        /* Custom scrollbar */
        .riwayat-scroll::-webkit-scrollbar { width:4px; }
        .riwayat-scroll::-webkit-scrollbar-track { background:#fff5f5; border-radius:10px; }
        .riwayat-scroll::-webkit-scrollbar-thumb { background:#f4a0aa; border-radius:10px; }
    </style>
</head>
<body>

    @include('layouts.navigation')

    <div class="profil-page">

        {{-- ==========================================
             BAGIAN 1: HEADER PROFIL
             Cover banner + avatar + nama + badge + stats
             ========================================== --}}
        <div class="profil-header-card">

            {{-- Avatar + Nama --}}
            <div class="avatar-row">
                <div class="avatar-circle">
                    @if($user->foto_profil_url)
                        <img src="{{ $user->foto_profil_url }}" alt="Foto Profil">
                    @else
                        {{ $user->initials }}
                    @endif
                </div>
                <div style="padding-bottom:4px;">
                    <div class="profil-name">{{ $user->name }}</div>
                    <div class="profil-handle">{{ $user->username ? '@'.$user->username : '@'.strtolower(str_replace(' ', '', $user->name)) }}</div>
                    @if($user->kota)
                        <div class="profil-kota">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#D4537E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                            {{ $user->kota }}
                        </div>
                    @endif
                </div>
            </div>

            {{-- Bio --}}
            @if($user->bio)
                <div class="profil-bio">{{ $user->bio }}</div>
            @else
                <div class="profil-bio empty">Belum ada bio. Yuk ceritakan tentang dirimu! ✨</div>
            @endif

            {{-- Badge dinamis --}}
            <div class="badge-row">
                @if($user->is_eco_warrior)
                    <span class="badge-pill badge-eco">🌿 Eco Warrior</span>
                @endif
                @if($user->email_verified_at)
                    <span class="badge-pill badge-verified">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#D4537E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                        Terverifikasi
                    </span>
                @endif
                <span class="badge-pill badge-member">Member sejak {{ $user->created_at->format('Y') }}</span>
            </div>


            {{-- Tombol Edit Profil --}}
            <a href="{{ route('profile.edit') }}" class="btn-edit-profil">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                Edit Profil
            </a>
        </div>

        {{-- ==========================================
             BAGIAN 2: INFORMASI AKUN
             Card data pribadi user
             ========================================== --}}
        <div class="info-card">
            <div class="info-card-title">Informasi Akun</div>

            {{-- Nama Lengkap --}}
            <div class="info-row">
                <div class="info-icon">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#D4537E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                </div>
                <div>
                    <div class="info-label">Nama Lengkap</div>
                    <div class="info-value">{{ $user->name }}</div>
                </div>
            </div>

            {{-- Email --}}
            <div class="info-row">
                <div class="info-icon">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#D4537E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                </div>
                <div>
                    <div class="info-label">Email</div>
                    <div class="info-value">{{ $user->email }}</div>
                </div>
            </div>

            {{-- No. HP --}}
            <div class="info-row">
                <div class="info-icon">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#D4537E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                </div>
                <div>
                    <div class="info-label">No. HP</div>
                    <div class="info-value">{{ $user->no_hp ? '+62 '.ltrim($user->no_hp, '0+62') : 'Belum diisi' }}</div>
                </div>
            </div>

            {{-- Alamat Utama --}}
            <div class="info-row">
                <div class="info-icon">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#D4537E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                </div>
                <div>
                    <div class="info-label">Alamat Utama</div>
                    <div class="info-value">
                        @if($user->primaryAddress)
                            {{ $user->primaryAddress->alamat_lengkap }}
                            @if($user->primaryAddress->kota), {{ $user->primaryAddress->kota }}@endif
                        @else
                            Belum ada alamat utama
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- ==========================================
             BAGIAN 3: RIWAYAT PESANAN (PREVIEW)
             3 pesanan terbaru + link lihat semua
             ========================================== --}}
        <div class="riwayat-card">
            <div class="riwayat-header">
                <div class="riwayat-title">Riwayat Pesanan</div>
                <a href="{{ route('pesanan-saya') }}" class="riwayat-link">Lihat semua →</a>
            </div>

            @if($pesananTerbaru->isEmpty())
                <div class="empty-state">
                    <div class="empty-icon">📦</div>
                    <div class="empty-text">Belum ada pesanan</div>
                    <div class="empty-sub">Yuk mulai belanja produk eco-beauty!</div>
                </div>
            @else
                <div class="riwayat-scroll" style="max-height:280px; overflow-y:auto;">
                    @foreach($pesananTerbaru as $order)
                        @php
                            $firstItem = $order->orderItems->first();
                            $product = $firstItem ? $firstItem->product : null;
                            $namaProduk = $product ? $product->nama_produk : 'Produk tidak tersedia';
                            $fotoProduk = $product ? $product->foto : null;

                            // Status pill class
                            $statusClass = 'status-proses';
                            $statusLabel = ucfirst(str_replace('_', ' ', $order->status));
                            if($order->status == 'selesai') $statusClass = 'status-selesai';
                            elseif($order->status == 'dibatalkan') $statusClass = 'status-batal';
                        @endphp
                        <div class="order-item">
                            <div class="order-thumb">
                                @if($fotoProduk && str_starts_with($fotoProduk, 'http'))
                                    <img src="{{ $fotoProduk }}" alt="{{ $namaProduk }}">
                                @elseif($fotoProduk)
                                    <img src="{{ asset('storage/'.$fotoProduk) }}" alt="{{ $namaProduk }}">
                                @else
                                    🛍️
                                @endif
                            </div>
                            <div class="order-info">
                                <div class="order-produk">{{ $namaProduk }}</div>
                                <div class="order-tanggal">{{ \Carbon\Carbon::parse($order->created_at)->format('d M Y') }}</div>
                            </div>
                            <div class="order-right">
                                <div class="order-harga">Rp {{ number_format($order->total_bayar ?? $order->total_harga, 0, ',', '.') }}</div>
                                <span class="status-pill {{ $statusClass }}">{{ $statusLabel }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

    </div>

    {{-- FOOTER (sama dengan dashboard) --}}
    <footer>
        <div class="footer-inner">
            <div class="footer-brand">
                <div class="f-logo"><img src="{{ asset('images/AYU-NE.png') }}"></div>
                <p>Platform eco-beauty sirkular pertama di Indonesia. Belanja preloved, daur ulang kemasan, dan raih reward — semuanya dalam satu ekosistem.</p>
            </div>
            <div class="footer-col">
                <h4>Belanja</h4>
                <ul>
                    <li><a href="#">Skincare</a></li>
                    <li><a href="#">Makeup</a></li>
                    <li><a href="#">Alat Makeup</a></li>
                    <li><a href="#">Isi Ulang</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Informasi</h4>
                <ul>
                    <li><a href="#">Tentang AYU-NE</a></li>
                    <li><a href="#">Cara Daur Ulang</a></li>
                    <li><a href="#">Ayu Koin</a></li>
                    <li><a href="#">FAQ</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Bantuan</h4>
                <ul>
                    <li><a href="#">Hubungi Kami</a></li>
                    <li><a href="#">Cara Pembelian</a></li>
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
                <span class="pay-badge">BCA</span>
            </div>
        </div>
    </footer>

</body>
</html>
