<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.iconify.design/iconify-icon/2.1.0/iconify-icon.min.js"></script>
    <title>Produk Diarsipkan - AYU-NE</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --pk: #639922; --pk2: #4a7a1e; --pk-light: #eaf3de;
            --border: #c5e0a0; --text: #2d5016; --text-secondary: #5a7a40;
            --grn: #4CAF7D; --grn-bg: #EAF3DE;
            --org: #E65100; --org-bg: #FFF3E0;
        }
        * { margin:0; padding:0; box-sizing:border-box; font-family:'Poppins',sans-serif; }
        body { background: linear-gradient(180deg, #e8f5e0 0%, #f5fff5 50%, #e8f5e0 100%); color:var(--text); }

        .seller-page { max-width:1100px; margin:0 auto; padding:30px 40px 60px; }

        .page-header { display:flex; align-items:center; justify-content:space-between; margin-bottom:24px; }
        .page-title { font-size:24px; font-weight:800; color:var(--text); }
        .page-title span { color:var(--org); }
        .breadcrumb { font-size:12px; color:var(--text-secondary); margin-bottom:4px; }
        .breadcrumb a { color:var(--pk); text-decoration:none; }

        .header-actions { display:flex; gap:10px; align-items:center; }
        .btn-back {
            display:inline-flex; align-items:center; gap:6px;
            padding:9px 18px; border:1.5px solid var(--border);
            border-radius:10px; font-size:13px; font-weight:600;
            color:var(--text-secondary); background:white;
            text-decoration:none; transition:all 0.2s;
        }
        .btn-back:hover { border-color:var(--pk); color:var(--pk); }

        .alert-success {
            background:var(--grn-bg); border:1px solid var(--border);
            border-radius:12px; padding:12px 18px; margin-bottom:20px;
            font-size:13px; color:#2d7a4f; font-weight:500;
            display:flex; align-items:center; gap:8px;
        }

        .produk-grid {
            display:grid; grid-template-columns:repeat(auto-fill, minmax(200px, 1fr));
            gap:16px;
        }

        .produk-card {
            background:white; border:1px solid var(--border); border-radius:16px;
            overflow:hidden; transition:all 0.2s;
            box-shadow:0 2px 12px rgba(99,153,34,0.06);
            opacity:0.75;
        }
        .produk-card:hover { transform:translateY(-3px); box-shadow:0 6px 20px rgba(99,153,34,0.12); opacity:1; }

        .produk-img {
            width:100%; aspect-ratio:1; background:var(--pk-light);
            display:flex; align-items:center; justify-content:center;
            overflow:hidden; position:relative;
        }
        .produk-img img { width:100%; height:100%; object-fit:cover; }

        .arsip-overlay {
            position:absolute; inset:0; background:rgba(0,0,0,0.35);
            display:flex; align-items:center; justify-content:center;
        }
        .arsip-overlay-text {
            background:rgba(0,0,0,0.6); color:white;
            font-size:11px; font-weight:700; padding:4px 10px;
            border-radius:20px; letter-spacing:0.5px;
            display:flex; align-items:center; gap:4px;
        }

        .produk-body { padding:12px 14px; }
        .produk-nama {
            font-size:13px; font-weight:600; color:var(--text); line-height:1.4;
            display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical;
            overflow:hidden; margin-bottom:4px;
        }
        .produk-kategori { font-size:11px; color:var(--text-secondary); margin-bottom:6px; }
        .produk-harga { font-size:15px; font-weight:700; color:var(--text-secondary); margin-bottom:10px; text-decoration:line-through; }

        .produk-actions { display:flex; gap:6px; }
        .btn-tampilkan {
            flex:1; padding:8px 6px; border:1.5px solid var(--pk);
            border-radius:8px; font-size:12px; font-weight:600;
            color:var(--pk); background:white; text-align:center;
            transition:all 0.2s; cursor:pointer; font-family:'Poppins',sans-serif;
            display:inline-flex; align-items:center; justify-content:center; gap:5px;
        }
        .btn-tampilkan:hover { background:var(--grn-bg); }

        .empty-state {
            text-align:center; padding:60px 20px;
            background:white; border:1px solid var(--border); border-radius:16px;
        }
        .empty-text { font-size:15px; font-weight:700; color:var(--text); margin-bottom:6px; margin-top:12px; }
        .empty-sub { font-size:13px; color:var(--text-secondary); margin-bottom:20px; }

        .pagination-wrap { display:flex; justify-content:center; margin-top:24px; }

        footer { background:#f5fbf0; border-top:1px solid var(--border); }
        .footer-bottom {
            padding:20px 48px; display:flex; justify-content:space-between;
            align-items:center; font-size:12px; color:var(--text-secondary);
        }
    </style>
</head>
<body>

    <div class="seller-page">

        <div class="page-header">
            <div>
                <div class="breadcrumb">
                    <a href="{{ route('profil') }}">Profil</a> /
                    <a href="{{ route('seller.dashboard') }}">Dashboard Penjual</a> /
                    <a href="{{ route('seller.produk.index') }}">Produk Saya</a> /
                    Produk Diarsipkan
                </div>
                <div class="page-title">Produk <span>Diarsipkan</span></div>
            </div>
            <div class="header-actions">
                <a href="{{ route('seller.produk.index') }}" class="btn-back">
                    <iconify-icon icon="solar:arrow-left-linear" width="15"></iconify-icon>
                    Kembali ke Produk
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert-success">
                <iconify-icon icon="solar:check-circle-bold" width="16"></iconify-icon>
                {{ session('success') }}
            </div>
        @endif

        @if($produk->isEmpty())
            <div class="empty-state">
                <iconify-icon icon="solar:archive-bold" width="50" style="color:var(--border); display:center; margin:0 auto;"></iconify-icon>
                <div class="empty-text">Tidak ada produk diarsipkan</div>
                <div class="empty-sub">Semua produk kamu sedang aktif di toko</div>
                <a href="{{ route('seller.produk.index') }}" class="btn-back" style="display:inline-flex; margin:0 auto;">
                    <iconify-icon icon="solar:arrow-left-linear" width="15"></iconify-icon>
                    Kembali ke Produk
                </a>
            </div>
        @else
            <div class="produk-grid">
                @foreach($produk as $item)
                    @php $fotoUtama = $item->foto[0] ?? null; @endphp

                    <div class="produk-card">
                        <div class="produk-img">
                            @if($fotoUtama)
                                <img src="{{ asset('storage/'.$fotoUtama) }}" alt="{{ $item->nama_produk }}">
                            @else
                                <iconify-icon icon="solar:cosmetic-bold" width="40" style="color:var(--border);"></iconify-icon>
                            @endif
                            <div class="arsip-overlay">
                                <div class="arsip-overlay-text">
                                    <iconify-icon icon="solar:archive-bold" width="12"></iconify-icon>
                                    Diarsipkan
                                </div>
                            </div>
                        </div>

                        <div class="produk-body">
                            <div class="produk-nama">{{ $item->nama_produk }}</div>
                            <div class="produk-kategori">{{ $item->category->nama ?? '-' }}</div>
                            <div class="produk-harga">Rp {{ number_format($item->harga, 0, ',', '.') }}</div>

                            <div class="produk-actions">
                                <form action="{{ route('seller.produk.toggle', $item) }}" method="POST" style="display:contents;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn-tampilkan">
                                        <iconify-icon icon="solar:eye-bold" width="14"></iconify-icon>
                                        Tampilkan
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="pagination-wrap">
                {{ $produk->links() }}
            </div>
        @endif

    </div>

</body>
</html>
