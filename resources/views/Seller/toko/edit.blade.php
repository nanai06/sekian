<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.iconify.design/iconify-icon/2.1.0/iconify-icon.min.js"></script>
    <title>Edit Profil Toko - AYU-NE</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --pk: #639922; --pk2: #4a7a1e; --pk-light: #eaf3de;
            --border: #c5e0a0; --text: #2d5016; --text2: #5a7a40;
        }
        * { margin:0; padding:0; box-sizing:border-box; font-family:'Poppins',sans-serif; }
        body { background:linear-gradient(180deg,#e8f5e0 0%,#f5fff5 50%,#e8f5e0 100%); color:var(--text); }
        .page { max-width:720px; margin:0 auto; padding:30px 40px 60px; }
        .breadcrumb { font-size:12px; color:var(--text2); margin-bottom:4px; }
        .breadcrumb a { color:var(--pk); text-decoration:none; }
        .page-title { font-size:24px; font-weight:800; margin-bottom:24px; }
        .page-title span { color:var(--pk); }

        .card { background:white; border:1px solid var(--border); border-radius:16px; padding:24px; margin-bottom:20px; box-shadow:0 2px 12px rgba(99,153,34,0.06); }
        .card-title { font-size:14px; font-weight:700; color:var(--text); margin-bottom:16px; display:flex; align-items:center; gap:8px; }

        .field { margin-bottom:16px; }
        .field-label { font-size:12px; font-weight:600; color:var(--text2); margin-bottom:6px; display:flex; justify-content:space-between; }
        .field-req { color:#e74c3c; }
        .field-count { font-size:11px; color:#9ab87a; }
        .field-input {
            width:100%; padding:10px 14px; border:1.5px solid var(--border);
            border-radius:10px; font-size:13px; font-family:'Poppins',sans-serif;
            color:var(--text); outline:none; transition:border 0.2s;
        }
        .field-input:focus { border-color:var(--pk); }
        textarea.field-input { resize:none; }

        .field-row-2 { display:grid; grid-template-columns:1fr 1fr; gap:12px; }

        .jasa-wrap { display:flex; flex-wrap:wrap; gap:8px; }
        .jasa-chip {
            display:inline-block; padding:7px 16px; border-radius:20px;
            font-size:12px; font-weight:500; border:1.5px solid var(--border);
            color:var(--text2); background:white; cursor:pointer; transition:all 0.15s;
        }
        .jasa-chip.active { background:var(--pk-light); color:var(--pk); border-color:var(--pk); }
        .jasa-check { display:none; }

        .info-box {
            padding:12px 16px; background:#eaf3de; border:1px solid var(--border);
            border-radius:10px; margin-bottom:20px;
        }
        .info-box p { font-size:12px; color:var(--pk2); line-height:1.5; margin:0; }

        .alert-success {
            background:var(--pk-light); border:1px solid var(--border);
            border-radius:12px; padding:12px 18px; margin-bottom:20px;
            font-size:13px; color:#2d7a4f; font-weight:500;
            display:flex; align-items:center; gap:8px;
        }
        .alert-error {
            background:#fff0f0; border:1px solid #ffcccc;
            border-radius:12px; padding:12px 18px; margin-bottom:20px;
            font-size:12px; color:#e74c3c;
        }
        .alert-error ul { margin:4px 0 0 16px; }

        .btn-row { display:flex; gap:12px; justify-content:flex-end; }
        .btn-cancel {
            padding:10px 24px; border:1.5px solid var(--border); border-radius:10px;
            font-size:13px; font-weight:600; color:var(--text2); background:white;
            text-decoration:none; cursor:pointer; transition:all 0.2s;
        }
        .btn-cancel:hover { border-color:var(--pk); color:var(--pk); }
        .btn-save {
            padding:10px 28px; border:none; border-radius:10px;
            font-size:13px; font-weight:700; color:white; background:var(--pk);
            cursor:pointer; transition:all 0.2s; font-family:'Poppins',sans-serif;
        }
        .btn-save:hover { background:var(--pk2); }
    </style>
</head>
<body>

    <div class="page">
        <div class="breadcrumb">
            <a href="{{ route('profil') }}">Profil</a> /
            <a href="{{ route('seller.dashboard') }}">Dashboard Penjual</a> /
            Edit Profil Toko
        </div>
        <div class="page-title">Edit Profil <span>Toko</span></div>

        @if(session('success'))
            <div class="alert-success">
                <iconify-icon icon="solar:check-circle-bold" width="16"></iconify-icon>
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert-error">
                <strong>Oops!</strong> Ada yang perlu diperbaiki:
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('seller.toko.update') }}" method="POST">
            @csrf
            @method('PATCH')

            {{-- Info Toko --}}
            <div class="card">
                <div class="card-title">
                    <iconify-icon icon="solar:shop-bold" width="18" style="color:var(--pk);"></iconify-icon>
                    Informasi Toko
                </div>

                <div class="field">
                    <div class="field-label">
                        <span>Nama Toko <span class="field-req">*</span></span>
                        <span class="field-count" id="nama-count">{{ strlen(old('nama_toko', $store->nama_toko)) }}/30</span>
                    </div>
                    <input class="field-input" type="text" name="nama_toko" maxlength="30"
                        value="{{ old('nama_toko', $store->nama_toko) }}"
                        oninput="document.getElementById('nama-count').textContent = this.value.length + '/30'">
                </div>

                <div class="field-row-2">
                    <div class="field">
                        <div class="field-label"><span>Nomor HP <span class="field-req">*</span></span></div>
                        <input class="field-input" type="tel" name="nomor_hp"
                            placeholder="+62 xxx xxxx xxxx"
                            value="{{ old('nomor_hp', $store->nomor_hp) }}">
                    </div>
                    <div class="field">
                        <div class="field-label"><span>Email Toko</span></div>
                        <input class="field-input" type="email" name="email_toko"
                            placeholder="email@toko.com"
                            value="{{ old('email_toko', $store->email_toko) }}">
                    </div>
                </div>
            </div>

            {{-- Jasa Pengiriman --}}
            <div class="card">
                <div class="card-title">
                    <iconify-icon icon="solar:delivery-bold" width="18" style="color:var(--pk);"></iconify-icon>
                    Jasa Pengiriman <span class="field-req">*</span>
                </div>
                @php
                    $selectedJasa = old('jasa_pengiriman', $store->jasa_pengiriman ?? []);
                    $jasaOptions  = ['JNE', 'J&T', 'SiCepat', 'Anteraja', 'GoSend', 'Pos Indonesia'];
                @endphp
                <div class="jasa-wrap">
                    @foreach($jasaOptions as $jasa)
                        <label>
                            <input type="checkbox" name="jasa_pengiriman[]" value="{{ $jasa }}"
                                class="jasa-check"
                                {{ in_array($jasa, $selectedJasa) ? 'checked' : '' }}
                                onchange="this.nextElementSibling.classList.toggle('active', this.checked)">
                            <span class="jasa-chip {{ in_array($jasa, $selectedJasa) ? 'active' : '' }}">{{ $jasa }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            {{-- Alamat Toko --}}
            <div class="card">
                <div class="card-title">
                    <iconify-icon icon="solar:map-point-bold" width="18" style="color:var(--pk);"></iconify-icon>
                    Alamat Toko <span class="field-req">*</span>
                </div>

                <div class="field-row-2">
                    <div class="field">
                        <div class="field-label"><span>Nama Penerima <span class="field-req">*</span></span></div>
                        <input class="field-input" type="text" name="nama_penerima"
                            value="{{ old('nama_penerima', $address->nama_penerima ?? '') }}">
                    </div>
                    <div class="field">
                        <div class="field-label"><span>No. HP Penerima <span class="field-req">*</span></span></div>
                        <input class="field-input" type="tel" name="no_hp_alamat"
                            value="{{ old('no_hp_alamat', $address->no_hp ?? '') }}">
                    </div>
                </div>

                <div class="field">
                    <div class="field-label"><span>Alamat Lengkap <span class="field-req">*</span></span></div>
                    <textarea class="field-input" name="alamat_lengkap" rows="2"
                        placeholder="Nama jalan, nomor rumah, RT/RW...">{{ old('alamat_lengkap', $address->alamat_lengkap ?? '') }}</textarea>
                </div>

                <div class="field">
                    <div class="field-label"><span>Kecamatan <span class="field-req">*</span></span></div>
                    <input class="field-input" type="text" name="kecamatan"
                        value="{{ old('kecamatan', $address->kecamatan ?? '') }}">
                </div>

                <div class="field-row-2">
                    <div class="field">
                        <div class="field-label"><span>Kota <span class="field-req">*</span></span></div>
                        <input class="field-input" type="text" name="kota"
                            value="{{ old('kota', $address->kota ?? '') }}">
                    </div>
                    <div class="field">
                        <div class="field-label"><span>Kode Pos <span class="field-req">*</span></span></div>
                        <input class="field-input" type="text" name="kode_pos" maxlength="10"
                            value="{{ old('kode_pos', $address->kode_pos ?? '') }}">
                    </div>
                </div>

                <div class="field">
                    <div class="field-label"><span>Provinsi <span class="field-req">*</span></span></div>
                    <input class="field-input" type="text" name="provinsi"
                        value="{{ old('provinsi', $address->provinsi ?? '') }}">
                </div>
            </div>

            <div class="info-box">
                <p>🌿 Alamat toko digunakan untuk menentukan ongkos kirim ke pembeli. Pastikan alamat akurat ya!</p>
            </div>

            <div class="btn-row">
                <a href="{{ route('seller.dashboard') }}" class="btn-cancel">Batal</a>
                <button type="submit" class="btn-save">Simpan Perubahan</button>
            </div>
        </form>
    </div>

</body>
</html>
