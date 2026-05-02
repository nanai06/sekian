<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.iconify.design/iconify-icon/2.1.0/iconify-icon.min.js"></script>
    <title>Edit Produk - AYU-NE</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --pk: #639922; --pk2: #4a7a1e; --pk-light: #eaf3de;
            --border: #c5e0a0; --text: #2d5016; --text-secondary: #5a7a40;
        }
        * { margin:0; padding:0; box-sizing:border-box; font-family:'Poppins',sans-serif; }
        body { background: linear-gradient(180deg, #e8f5e0 0%, #f5fff5 50%, #e8f5e0 100%); color:var(--text); }

        .seller-page { max-width:800px; margin:0 auto; padding:30px 40px 60px; }
        .page-header { display:flex; align-items:center; justify-content:space-between; margin-bottom:28px; }
        .page-title { font-size:24px; font-weight:800; color:var(--text); }
        .page-title span { color:var(--pk); }
        .breadcrumb { font-size:12px; color:var(--text-secondary); margin-bottom:4px; }
        .breadcrumb a { color:var(--pk); text-decoration:none; }

        .card {
            background:white; border:1px solid var(--border); border-radius:16px;
            padding:0; margin-bottom:16px;
            box-shadow:0 2px 12px rgba(99,153,34,0.06); overflow:hidden;
        }
        .card-header-title {
            font-size:13px; font-weight:700; color:var(--text);
            padding:14px 20px; border-bottom:1px solid #e8f3de;
            display:flex; align-items:center; gap:8px;
        }

        .field-row {
            padding:12px 20px; border-bottom:0.5px solid #e8f3de;
            display:flex; align-items:center; justify-content:space-between; gap:12px;
        }
        .field-row:last-child { border-bottom:none; }
        .field-label { font-size:13px; color:var(--text-secondary); font-weight:500; flex-shrink:0; min-width:110px; }
        .field-req { color:var(--pk); font-size:12px; }
        .field-right { flex:1; display:flex; flex-direction:column; align-items:flex-end; }
        .field-input {
            width:100%; border:none; outline:none; font-size:13px;
            font-family:'Poppins',sans-serif; color:var(--text);
            text-align:right; background:transparent;
        }
        .field-input::placeholder { color:#ccc; }
        textarea.field-input { resize:none; text-align:left; }
        .field-count { font-size:10px; color:#ccc; margin-top:2px; }

        .foto-section { padding:14px 20px; }
        .foto-grid { display:flex; gap:8px; flex-wrap:wrap; }
        .foto-add-btn {
            width:80px; height:80px; border:1.5px dashed var(--border);
            border-radius:10px; display:flex; flex-direction:column;
            align-items:center; justify-content:center; cursor:pointer;
            background:var(--pk-light); transition:all 0.2s; gap:4px;
        }
        .foto-add-btn:hover { border-color:var(--pk); }
        .foto-add-btn input { display:none; }

        .foto-existing-item { position:relative; width:80px; height:80px; }
        .foto-existing-item img {
            width:100%; height:100%; object-fit:cover;
            border-radius:10px; border:1px solid var(--border);
        }
        .btn-hapus-foto {
            position:absolute; top:-5px; right:-5px;
            width:18px; height:18px; border-radius:50%;
            background:#e74c3c; color:white; border:none;
            font-size:10px; cursor:pointer; font-weight:700;
            display:flex; align-items:center; justify-content:center;
        }
        .foto-existing-item.marked img { opacity:0.4; border-color:#e74c3c; }
        .foto-existing-item.marked::after {
            content:'Hapus'; position:absolute; inset:0;
            display:flex; align-items:center; justify-content:center;
            font-size:10px; font-weight:700; color:#e74c3c; border-radius:10px;
        }
        .foto-preview-item { position:relative; width:80px; height:80px; }
        .foto-preview-item img {
            width:100%; height:100%; object-fit:cover;
            border-radius:10px; border:1px solid var(--border);
        }
        .foto-preview-item .hapus-foto {
            position:absolute; top:-5px; right:-5px;
            width:18px; height:18px; border-radius:50%;
            background:#e74c3c; color:white; border:none;
            font-size:10px; cursor:pointer; font-weight:700;
            display:flex; align-items:center; justify-content:center;
        }
        .foto-hint { font-size:11px; color:#ccc; margin-top:8px; }

        .chips-wrap { display:flex; flex-wrap:wrap; gap:8px; padding:14px 20px; }
        .chip-label { cursor:pointer; }
        .chip-label input { display:none; }
        .chip {
            display:inline-block; padding:6px 16px; border-radius:20px;
            font-size:12px; font-weight:500;
            border:1px solid var(--border); color:var(--text-secondary);
            background:white; transition:all 0.2s; cursor:pointer;
        }
        .chip.active { background:var(--pk-light); color:var(--pk); border-color:var(--pk); }

        .kondisi-wrap { display:flex; gap:10px; padding:14px 20px; }
        .kond-label { flex:1; cursor:pointer; }
        .kond-label input { display:none; }
        .kond-chip {
            display:block; padding:10px; border-radius:10px; text-align:center;
            font-size:13px; font-weight:600; border:1px solid var(--border);
            color:var(--text-secondary); background:white; transition:all 0.2s;
        }
        .kond-chip.active { background:var(--pk-light); color:var(--pk); border-color:var(--pk); }
        .kond-sub { font-size:10px; font-weight:400; margin-top:2px; }

        .stok-counter { display:flex; align-items:center; }
        .stok-btn {
            width:32px; height:32px; border:1px solid var(--border);
            background:#f0f9e8; font-size:16px; cursor:pointer;
            display:flex; align-items:center; justify-content:center;
            font-family:'Poppins',sans-serif; color:var(--pk); transition:background 0.2s;
        }
        .stok-btn:first-child { border-radius:8px 0 0 8px; }
        .stok-btn:last-child { border-radius:0 8px 8px 0; }
        .stok-btn:hover { background:var(--pk-light); }
        .stok-input {
            width:50px; height:32px; text-align:center;
            border-top:1px solid var(--border); border-bottom:1px solid var(--border);
            border-left:none; border-right:none;
            font-size:13px; font-family:'Poppins',sans-serif; outline:none;
        }

        .persen-wrap { display:flex; align-items:center; gap:10px; }
        .persen-val { font-size:14px; font-weight:700; color:var(--pk); min-width:36px; }
        input[type=range] {
            -webkit-appearance:none; height:4px; border-radius:4px; outline:none; flex:1;
        }
        input[type=range]::-webkit-slider-thumb {
            -webkit-appearance:none; width:16px; height:16px;
            border-radius:50%; background:var(--pk); cursor:pointer;
            border:2px solid white; box-shadow:0 1px 4px rgba(99,153,34,0.3);
        }

        .prefix-wrap { display:flex; align-items:center; gap:6px; width:100%; justify-content:flex-end; }
        .prefix-label { font-size:13px; color:var(--text-secondary); font-weight:500; }

        .alert-error {
            background:#fff0f0; border:1px solid #ffcccc;
            border-radius:12px; padding:14px 18px; margin-bottom:16px;
        }
        .alert-error ul { margin:0; padding-left:16px; }
        .alert-error li { font-size:12px; color:#e74c3c; margin-bottom:2px; }
        .error-text { font-size:11px; color:#e74c3c; margin-top:4px; padding:0 20px; }

        .btn-row { display:flex; gap:12px; justify-content:flex-end; margin-top:8px; }
        .btn-batal {
            padding:11px 24px; border:1.5px solid var(--border);
            border-radius:10px; font-size:13px; font-weight:600;
            color:var(--text-secondary); background:white;
            text-decoration:none; cursor:pointer; font-family:'Poppins',sans-serif;
            transition:all 0.2s; display:inline-flex; align-items:center; gap:6px;
        }
        .btn-batal:hover { border-color:var(--pk); color:var(--pk); }
        .btn-submit {
            padding:11px 28px; background:var(--pk); border:none;
            border-radius:10px; font-size:13px; font-weight:700;
            color:white; cursor:pointer; font-family:'Poppins',sans-serif;
            transition:all 0.2s; display:inline-flex; align-items:center; gap:8px;
        }
        .btn-submit:hover { background:var(--pk2); transform:translateY(-1px); }

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
                    Edit Produk
                </div>
                <div class="page-title">Edit <span>Produk</span></div>
            </div>
            <a href="{{ route('seller.produk.index') }}" style="font-size:13px; color:var(--pk); text-decoration:none; font-weight:500; display:flex; align-items:center; gap:4px;">
                <iconify-icon icon="solar:arrow-left-linear" width="16"></iconify-icon>
                Kembali
            </a>
        </div>

        @if($errors->any())
            <div class="alert-error">
                <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            </div>
        @endif

        <form action="{{ route('seller.produk.update', $produk) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- FOTO --}}
            <div class="card">
                <div class="card-header-title">
                    <iconify-icon icon="solar:camera-bold" width="15" style="color:var(--pk);"></iconify-icon>
                    Foto Produk
                </div>
                <div class="foto-section">
                    <div class="foto-grid" id="fotoGrid">
                        @if($produk->foto && count($produk->foto) > 0)
                            @foreach($produk->foto as $path)
                                <div class="foto-existing-item" id="existing-{{ Str::slug($path, '_') }}">
                                    <img src="{{ asset('storage/'.$path) }}" alt="foto produk">
                                    <input type="hidden" name="foto_lama[]" value="{{ $path }}">
                                    <input type="checkbox" name="foto_hapus[]" value="{{ $path }}"
                                        id="cb-{{ Str::slug($path, '_') }}" style="display:none;">
                                    <button type="button" class="btn-hapus-foto"
                                        onclick="tandaiHapus('{{ Str::slug($path, '_') }}')">×</button>
                                </div>
                            @endforeach
                        @endif
                        <label class="foto-add-btn" id="fotoAddLabel">
                            <input type="file" id="inputFotoBaru" name="foto_baru[]"
                                multiple accept="image/jpg,image/jpeg,image/png,image/webp"
                                onchange="previewFotoBaru(this)">
                            <iconify-icon icon="solar:add-circle-bold" width="24" style="color:var(--pk);"></iconify-icon>
                            <span style="font-size:10px; color:var(--pk); font-weight:500;">Tambah foto</span>
                        </label>
                    </div>
                    <div class="foto-hint">Klik × untuk hapus foto lama • Maks. 9 foto total • JPG, PNG, WebP • Maks 2MB per foto</div>
                    @error('foto_baru')<div style="font-size:11px; color:#e74c3c; margin-top:6px;">{{ $message }}</div>@enderror
                </div>
            </div>

            {{-- INFORMASI --}}
            <div class="card">
                <div class="card-header-title">
                    <iconify-icon icon="solar:box-bold" width="15" style="color:var(--pk);"></iconify-icon>
                    Informasi Produk
                </div>
                <div class="field-row">
                    <div class="field-label">Nama Produk <span class="field-req">*</span></div>
                    <div class="field-right">
                        <input type="text" name="nama_produk" class="field-input"
                            placeholder="Contoh: Serum Vitamin C SKINTIFIC" maxlength="255"
                            value="{{ old('nama_produk', $produk->nama_produk) }}"
                            oninput="document.getElementById('nama-count').textContent=this.value.length+'/255'">
                        <span class="field-count" id="nama-count">{{ strlen(old('nama_produk', $produk->nama_produk)) }}/255</span>
                    </div>
                </div>
                @error('nama_produk')<div class="error-text">{{ $message }}</div>@enderror
                <div class="field-row">
                    <div class="field-label">Merek <span style="font-size:10px; color:#ccc;">(opsional)</span></div>
                    <div class="field-right">
                        <input type="text" name="merek" class="field-input"
                            placeholder="Contoh: SKINTIFIC, Wardah"
                            value="{{ old('merek', $produk->merek) }}">
                    </div>
                </div>
                <div class="field-row" style="align-items:flex-start;">
                    <div class="field-label" style="padding-top:2px;">Deskripsi <span class="field-req">*</span></div>
                    <div class="field-right">
                        <textarea name="deskripsi" class="field-input" rows="4"
                            placeholder="Ceritain produknya: kandungan, manfaat, cara pakai, expired date..."
                            maxlength="3000"
                            oninput="document.getElementById('desk-count').textContent=this.value.length+'/3000'">{{ old('deskripsi', $produk->deskripsi) }}</textarea>
                        <span class="field-count" id="desk-count">{{ strlen(old('deskripsi', $produk->deskripsi)) }}/3000</span>
                    </div>
                </div>
                @error('deskripsi')<div class="error-text">{{ $message }}</div>@enderror
            </div>

            {{-- KATEGORI --}}
            <div class="card">
                <div class="card-header-title">
                    <iconify-icon icon="solar:tag-bold" width="15" style="color:var(--pk);"></iconify-icon>
                    Kategori <span class="field-req">*</span>
                </div>
                <div class="chips-wrap">
                    @foreach($categories as $cat)
                        @php $catSelected = old('category_id', $produk->category_id) == $cat->id; @endphp
                        <label class="chip-label">
                            <input type="radio" name="category_id" value="{{ $cat->id }}"
                                {{ $catSelected ? 'checked' : '' }} onchange="updateChip(this)">
                            <span class="chip {{ $catSelected ? 'active' : '' }}" id="chip-{{ $cat->id }}">
                                {{ $cat->nama }}
                            </span>
                        </label>
                    @endforeach
                </div>
                @error('category_id')<div class="error-text">{{ $message }}</div>@enderror
            </div>

            {{-- KONDISI --}}
            <div class="card">
                <div class="card-header-title">
                    <iconify-icon icon="solar:star-bold" width="15" style="color:var(--pk);"></iconify-icon>
                    Kondisi <span class="field-req">*</span>
                </div>
                @php $kondisiNow = old('kondisi', $produk->kondisi ?? 'baru'); @endphp
                <div class="kondisi-wrap">
                    <label class="kond-label">
                        <input type="radio" name="kondisi" value="baru"
                            {{ $kondisiNow === 'baru' ? 'checked' : '' }} onchange="updateKondisi(this)">
                        <div class="kond-chip {{ $kondisiNow === 'baru' ? 'active' : '' }}" id="kond-baru">
                            <iconify-icon icon="solar:star-shine-bold" width="14"></iconify-icon>
                            Baru
                            <div class="kond-sub">Belum pernah dipakai</div>
                        </div>
                    </label>
                    <label class="kond-label">
                        <input type="radio" name="kondisi" value="bekas"
                            {{ $kondisiNow === 'bekas' ? 'checked' : '' }} onchange="updateKondisi(this)">
                        <div class="kond-chip {{ $kondisiNow === 'bekas' ? 'active' : '' }}" id="kond-bekas">
                            <iconify-icon icon="solar:refresh-bold" width="14"></iconify-icon>
                            Bekas / Preloved
                            <div class="kond-sub">Sudah pernah digunakan</div>
                        </div>
                    </label>
                </div>
                @php $persenNow = old('persen_sisa', $produk->persen_sisa ?? 70); @endphp
                <div id="bagian-bekas" style="{{ $kondisiNow === 'bekas' ? '' : 'display:none;' }} border-top:0.5px solid #e8f3de;">
                    <div class="field-row">
                        <div class="field-label">Sisa produk <span class="field-req">*</span></div>
                        <div class="persen-wrap">
                            <span class="persen-val" id="persen-val">{{ $persenNow }}%</span>
                            <input type="range" name="persen_sisa" min="10" max="99" step="5"
                                value="{{ $persenNow }}" oninput="updatePersen(this)">
                        </div>
                    </div>
                    <div class="field-row">
                        <div class="field-label">Catatan kondisi</div>
                        <div class="field-right">
                            <input type="text" name="catatan_kondisi" class="field-input"
                                placeholder="Contoh: Kemasan sedikit penyok"
                                value="{{ old('catatan_kondisi', $produk->catatan_kondisi) }}">
                        </div>
                    </div>
                </div>
                @error('kondisi')<div class="error-text">{{ $message }}</div>@enderror
            </div>

            {{-- HARGA & STOK --}}
            <div class="card">
                <div class="card-header-title">
                    <iconify-icon icon="solar:wallet-money-bold" width="15" style="color:var(--pk);"></iconify-icon>
                    Harga &amp; Stok
                </div>
                <div class="field-row">
                    <div class="field-label">Harga <span class="field-req">*</span></div>
                    <div class="prefix-wrap">
                        <span class="prefix-label">Rp</span>
                        <input type="number" name="harga" class="field-input"
                            placeholder="0" min="1000" value="{{ old('harga', $produk->harga) }}"
                            style="text-align:right; max-width:160px;">
                    </div>
                </div>
                @error('harga')<div class="error-text">{{ $message }}</div>@enderror
                <div class="field-row">
                    <div class="field-label">Stok <span class="field-req">*</span></div>
                    <div class="stok-counter">
                        <button type="button" class="stok-btn" onclick="changeStok(-1)">−</button>
                        <input type="number" name="stok" id="stok-val" class="stok-input"
                            value="{{ old('stok', $produk->stok) }}" min="1">
                        <button type="button" class="stok-btn" onclick="changeStok(1)">+</button>
                    </div>
                </div>
                @error('stok')<div class="error-text">{{ $message }}</div>@enderror
                <div class="field-row">
                    <div class="field-label">Berat <span class="field-req">*</span></div>
                    <div class="prefix-wrap">
                        <input type="number" name="berat_gram" class="field-input"
                            placeholder="0" min="1" value="{{ old('berat_gram', $produk->berat_gram) }}"
                            style="text-align:right; max-width:120px;">
                        <span class="prefix-label">gram</span>
                    </div>
                </div>
                @error('berat_gram')<div class="error-text">{{ $message }}</div>@enderror
            </div>

            <div class="btn-row">
                <a href="{{ route('seller.produk.index') }}" class="btn-batal">Batal</a>
                <button type="submit" class="btn-submit">
                    <iconify-icon icon="solar:diskette-bold" width="16"></iconify-icon>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

    <footer>
        <div class="footer-bottom">
            <span style="display:flex; align-items:center; gap:6px;">
                &copy; 2025 AYU-NE. Eco-beauty untuk bumi yang lebih sehat
                <iconify-icon icon="solar:leaf-bold" width="13" style="color:var(--pk);"></iconify-icon>
            </span>
        </div>
    </footer>

    <script>
        function updateChip(radio) {
            document.querySelectorAll('.chip').forEach(c => c.classList.remove('active'));
            document.getElementById('chip-' + radio.value).classList.add('active');
        }
        function updateKondisi(radio) {
            document.getElementById('kond-baru').classList.toggle('active', radio.value === 'baru');
            document.getElementById('kond-bekas').classList.toggle('active', radio.value === 'bekas');
            document.getElementById('bagian-bekas').style.display = radio.value === 'bekas' ? '' : 'none';
        }
        function updatePersen(input) {
            document.getElementById('persen-val').textContent = input.value + '%';
            const pct = (input.value - input.min) / (input.max - input.min) * 100;
            input.style.background = `linear-gradient(to right, var(--pk) ${pct}%, #c5e0a0 ${pct}%)`;
        }
        function changeStok(delta) {
            const input = document.getElementById('stok-val');
            input.value = Math.max(1, parseInt(input.value || 1) + delta);
        }
        function tandaiHapus(slug) {
            const wrapper = document.getElementById('existing-' + slug);
            const cb = document.getElementById('cb-' + slug);
            if (!wrapper || !cb) return;
            cb.checked = !cb.checked;
            wrapper.classList.toggle('marked', cb.checked);
        }
        function previewFotoBaru(input) {
            document.querySelectorAll('.foto-preview-item').forEach(el => el.remove());
            if (input.files.length > 9) { alert('Maksimal 9 foto!'); input.value = ''; return; }
            const grid = document.getElementById('fotoGrid');
            const addBtn = document.getElementById('fotoAddLabel');
            Array.from(input.files).forEach(function(file, i) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const item = document.createElement('div');
                    item.className = 'foto-preview-item';
                    item.innerHTML = `<img src="${e.target.result}" alt="foto baru ${i+1}"><button type="button" class="hapus-foto">×</button>`;
                    grid.insertBefore(item, addBtn);
                };
                reader.readAsDataURL(file);
            });
        }
        (function(){ const s = document.querySelector('input[type=range]'); if(s) updatePersen(s); })();
    </script>
</body>
</html>