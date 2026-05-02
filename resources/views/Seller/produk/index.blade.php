<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.iconify.design/iconify-icon/2.1.0/iconify-icon.min.js"></script>
    <title>Produk Saya - AYU-NE</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --pk: #639922; --pk2: #4a7a1e; --pk-light: #eaf3de;
            --border: #c5e0a0; --text: #2d5016; --text-secondary: #5a7a40;
            --grn: #4CAF7D; --grn-bg: #EAF3DE;
            --org: #E65100; --org-bg: #FFF3E0;
            --blu: #1565C0; --blu-bg: #E3F2FD;
        }
        * { margin:0; padding:0; box-sizing:border-box; font-family:'Poppins',sans-serif; }
        body { background: linear-gradient(180deg, #e8f5e0 0%, #f5fff5 50%, #e8f5e0 100%); color:var(--text); }

        .seller-page { max-width:1100px; margin:0 auto; padding:30px 40px 60px; }

        .page-header { display:flex; align-items:center; justify-content:space-between; margin-bottom:24px; }
        .page-title { font-size:24px; font-weight:800; color:var(--text); }
        .page-title span { color:var(--pk); }
        .breadcrumb { font-size:12px; color:var(--text-secondary); margin-bottom:4px; }
        .breadcrumb a { color:var(--pk); text-decoration:none; }

        .header-actions { display:flex; gap:10px; align-items:center; }
        .btn-arsip-link {
            display:inline-flex; align-items:center; gap:6px;
            padding:9px 18px; border:1.5px solid var(--border);
            border-radius:10px; font-size:13px; font-weight:600;
            color:var(--text-secondary); background:white;
            text-decoration:none; transition:all 0.2s;
        }
        .btn-arsip-link:hover { border-color:var(--pk); color:var(--pk); }
        .btn-tambah {
            display:inline-flex; align-items:center; gap:6px;
            padding:9px 20px; background:var(--pk); border:none;
            border-radius:10px; font-size:13px; font-weight:700;
            color:white; text-decoration:none; cursor:pointer; transition:all 0.2s;
        }
        .btn-tambah:hover { background:var(--pk2); transform:translateY(-1px); }

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
        }
        .produk-card:hover { transform:translateY(-3px); box-shadow:0 6px 20px rgba(99,153,34,0.12); }
        .produk-card.diarsipkan { opacity:0.65; }

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
        /* overlay default hidden */
        .hapus-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0,0,0,0.45);

            display: flex;
            align-items: center;
            justify-content: center;

            opacity: 0;
            transition: 0.25s;
        }

        /* muncul saat hover */
        .produk-img:hover .hapus-overlay {
            opacity: 1;
        }

        /* tombol hapus di tengah */
        .btn-hapus-hover {
            display: inline-flex;
            align-items: center;
            gap: 6px;

            background: #e74c3c;
            color: white;
            border: none;

            padding: 8px 14px;
            border-radius: 20px;

            font-size: 12px;
            font-weight: 600;
            cursor: pointer;

            transform: translateY(10px);
            transition: 0.25s;
        }

        /* animasi naik dikit */
        .produk-img:hover .btn-hapus-hover {
            transform: translateY(0);
        }

        /* hover tombol */
        .btn-hapus-hover:hover {
            background: #c0392b;
        }

        .produk-body { padding:12px 14px; }
        .produk-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 6px;
        }

        .produk-nama {
            font-size: 13px;
            font-weight: 600;
            color: var(--text);
            line-height: 1.4;

            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;

            flex: 1; /* biar judul ngisi ruang */
        }

        .produk-header .pill {
            flex-shrink: 0;
            margin-top: 2px;
            font-size: 9px; 
            font-weight: 200;
            padding: 1px 6px;        /* dipersempit */
            border-radius: 12px;     /* biar tetap soft */
            gap: 2px;                /* jarak icon-teks dipadatkan */
            line-height: 1.2;
        }
        .produk-kategori { font-size:11px; color:var(--text-secondary); margin-bottom:6px; }
        .produk-harga { font-size:15px; font-weight:700; color:var(--pk); margin-bottom:8px; }

        .produk-pills { display:flex; gap:6px; flex-wrap:wrap; margin-bottom:10px; }
        .pill {
            font-size:10px; font-weight:600; padding:2px 8px; border-radius:20px;
            display:inline-flex; align-items:center; gap:3px;
        }
        .pill-baru     { background:#eaf3de; color:#4a7a1e; }
        .pill-bekas    { background:var(--org-bg); color:var(--org); }
        .pill-aktif    { background:#eaf3de; color:#4a7a1e; }
        .pill-review   { background:var(--org-bg); color:var(--org); }
        .pill-draft    { background:#F3F1EE; color:#7a6a5f; }
        .pill-arsip    { background:#F3F1EE; color:#7a6a5f; }
        .pill-terjual  { background:var(--blu-bg); color:var(--blu); }

        .produk-actions { display:flex; gap:6px; }
        .btn-edit {
            flex:1; padding:7px 6px; border:1.5px solid var(--border);
            border-radius:8px; font-size:11px; font-weight:600;
            color:var(--text); background:white; text-decoration:none;
            text-align:center; transition:all 0.2s; cursor:pointer;
            font-family:'Poppins',sans-serif;
            display:inline-flex; align-items:center; justify-content:center; gap:4px;
        }
        .btn-edit:hover { border-color:var(--pk); color:var(--pk); }

        .btn-toggle {
            padding:7px 10px; border-radius:8px; font-size:11px; font-weight:600;
            cursor:pointer; font-family:'Poppins',sans-serif; transition:all 0.2s;
            display:inline-flex; align-items:center; gap:4px; border:none;
            white-space:nowrap;
        }
        .btn-toggle.arsipkan { background:#F3F1EE; color:#7a6a5f; border:1.5px solid #e0dbd8; }
        .btn-toggle.arsipkan:hover { background:#e8e4e0; }
        .btn-toggle.tampilkan { background:var(--grn-bg); color:#2d7a4f; border:1.5px solid var(--border); }
        .btn-toggle.tampilkan:hover { background:#d4eab8; }

        .btn-hapus {
            padding:7px 8px; border:1.5px solid #ffcccc;
            border-radius:8px; font-size:11px; font-weight:600;
            color:#e74c3c; background:white; cursor:pointer;
            font-family:'Poppins',sans-serif; transition:all 0.2s;
            display:inline-flex; align-items:center;
        }
        .btn-hapus:hover { background:#fff0f0; }

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
                    Produk Saya
                </div>
                <div class="page-title">Produk <span>Saya</span></div>
            </div>
            <div class="header-actions">
                <a href="{{ route('seller.produk.arsip') }}" class="btn-arsip-link">
                    <iconify-icon icon="solar:archive-bold" width="15"></iconify-icon>
                    Produk Diarsipkan
                </a>
                <a href="{{ route('seller.produk.create') }}" class="btn-tambah">
                    <iconify-icon icon="solar:add-square-bold" width="16"></iconify-icon>
                    Tambah Produk
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
                <iconify-icon icon="solar:box-bold" width="50" style="color:var(--border); display:center; margin:0 auto;"></iconify-icon>
                <div class="empty-text">Belum ada produk</div>
                <div class="empty-sub">Yuk upload produk pertamamu dan mulai berjualan!</div>
                <a href="{{ route('seller.produk.create') }}" class="btn-tambah" style="display:inline-flex; margin:0 auto;">
                    <iconify-icon icon="solar:add-square-bold" width="16"></iconify-icon>
                    Tambah Produk Pertama
                </a>
            </div>
        @else
            <div class="produk-grid">
                @foreach($produk as $item)
                    @php
                        $fotoUtama = $item->foto[0] ?? null;
                        $statusVal = $item->status->value ?? $item->status;
                        $isArsip   = in_array($statusVal, ['nonaktif', 'draft', 'arsip']);
                        $statusClass = match($statusVal) {
                            'aktif'        => 'pill-aktif',
                            'under_review' => 'pill-review',
                            'draft'        => 'pill-draft',
                            'nonaktif','arsip' => 'pill-arsip',
                            'terjual'      => 'pill-terjual',
                            default        => 'pill-draft',
                        };
                        $statusLabel = match($statusVal) {
                            'aktif'        => 'Aktif',
                            'under_review' => 'Review',
                            'draft'        => 'Draft',
                            'nonaktif','arsip' => 'Diarsipkan',
                            'terjual'      => 'Terjual',
                            default        => ucfirst($statusVal),
                        };
                    @endphp

                    <div class="produk-card {{ $isArsip ? 'diarsipkan' : '' }}">
                        <div class="produk-img">
                            @if($fotoUtama)
                                <img src="{{ asset('storage/'.$fotoUtama) }}" alt="{{ $item->nama_produk }}">
                            @else
                                <iconify-icon icon="solar:cosmetic-bold" width="40" style="color:var(--border);"></iconify-icon>
                            @endif
                            @if($isArsip)
                                <div class="arsip-overlay">
                                    <div class="arsip-overlay-text">
                                        <iconify-icon icon="solar:archive-bold" width="12"></iconify-icon>
                                        Diarsipkan
                                    </div>
                                </div>
                            @endif
                            <div class="hapus-overlay">
                            <form action="{{ route('seller.produk.destroy', $item) }}" method="POST"
                                onsubmit="return confirm('Hapus produk ini? Tindakan tidak bisa dibatalkan.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-hapus-hover">
                                    <iconify-icon icon="solar:trash-bin-trash-bold" width="18"></iconify-icon>
                                    Hapus
                                </button>
                            </form>
                        </div>
                        </div>

                        <div class="produk-body">
                            <div class="produk-header">
                                <div class="produk-nama">{{ $item->nama_produk }}</div>
                                <span class="pill {{ $item->kondisi === 'baru' ? 'pill-baru' : 'pill-bekas' }}">
                                    <iconify-icon icon="{{ $item->kondisi === 'baru' ? 'solar:star-shine-bold' : 'solar:refresh-bold' }}" width="10"></iconify-icon>
                                    {{ ucfirst($item->kondisi) }}
                                </span>
                            </div>
                            <div class="produk-kategori">{{ $item->category->nama ?? '-' }}</div>
                            <div class="produk-harga">Rp {{ number_format($item->harga, 0, ',', '.') }}</div>

                            <div class="produk-actions">
                                <a href="{{ route('seller.produk.edit', $item) }}" class="btn-edit">
                                    <iconify-icon icon="solar:pen-bold" width="12"></iconify-icon>
                                    Edit
                                </a>
                                <form action="{{ route('seller.produk.toggle', $item) }}" method="POST" style="display:contents;">
                                    @csrf
                                    @method('PATCH')
                                    @if($isArsip)
                                        <button type="submit" class="btn-toggle tampilkan">
                                            <iconify-icon icon="solar:eye-bold" width="12"></iconify-icon>
                                            Tampilkan
                                        </button>
                                    @else
                                        <button type="submit" class="btn-toggle arsipkan"
                                            onclick="return confirm('Arsipkan produk ini? Produk tidak akan terlihat pembeli.')">
                                            <iconify-icon icon="solar:archive-bold" width="12"></iconify-icon>
                                            Arsip
                                        </button>
                                    @endif
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