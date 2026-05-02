<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Lokasi Drop-Off - AYU-NE</title>

    {{-- Google Fonts: font Poppins --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        /* Reset semua margin/padding bawaan browser */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        /* Background halaman: gradient pink muda */
        body {
            background: linear-gradient(180deg, #ffe8ed 0%, #fff5f5 50%, #ffe8ed 100%);
            color: #3b1a1a;
        }

        /* Wrapper konten utama halaman */
        .content {
            padding: 36px 40px;
        }

        h1 {
            font-size: 22px;
            font-weight: 800;
            color: #3b1a1a;
            margin-bottom: 20px;
            margin-left: 10px;
        }

        /* ==========================================
           TAB BUTTONS
           Dua tombol: "Peta" dan "Daftar"
           Diklik memanggil switchTab() untuk ganti tampilan
           ========================================== */
        .tab-wrap {
            display: flex;
            gap: 10px;
            margin-bottom: 24px;
        }

        /* Tombol tab: default putih outline */
        .tab-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 22px;
            border-radius: 50px;
            border: 1.5px solid #f0d5d5;
            background: white;
            font-size: 15px;
            font-weight: 500;
            color: #7a4a4a;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
            transition: all 0.2s;
        }

        /* Tombol tab aktif: solid pink */
        .tab-btn.active {
            background: #f4a0aa;
            color: white;
            border-color: #f4a0aa;
            font-weight: 600;
        }

        .tab-btn:hover:not(.active) {
            border-color: #f4a0aa;
            color: #e07080;
        }

        /* ==========================================
           SEARCH BAR
           Input pencarian lokasi: filter card saat mengetik
           ========================================== */
        .search-location {
            width: 100%;
            padding: 14px 20px;
            border: 1.5px solid #f0d5d5;
            border-radius: 50px;
            font-size: 14px;
            color: #3b1a1a;
            outline: none;
            font-family: 'Poppins', sans-serif;
            margin-bottom: 28px;
            transition: border 0.2s;
        }
        .search-location::placeholder { color: #c4a0a0; }
        .search-location:focus { border-color: #e8a0a8; }

        /* ==========================================
           MAP VIEW
           Tampilan peta Google Maps (iframe)
           Tersembunyi default, muncul saat tab Peta aktif
           ========================================== */
        .map-view { display: none; }
        .map-view.active { display: block; }

        /* Box wrapper peta */
        .map-box {
            width: 100%;
            height: 400px;
            background: #fdf0f2;
            border-radius: 25px;
            border: 5px solid #e8a0a8;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            color: #c4a0a0;
            margin-bottom: 16px;
        }

        /* Legenda warna titik di bawah peta */
        .map-legend {
            display: flex;
            gap: 24px;
            align-items: center;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            color: #7a4a4a;
        }

        .legend-dot {
            width: 14px;
            height: 14px;
            border-radius: 50%;
        }

        /* ==========================================
           LIST VIEW
           Tampilan daftar lokasi drop-box
           Aktif secara default (tab Daftar)
           ========================================== */
        .list-view { display: none; }
        .list-view.active { display: block; }

        /* Card tiap lokasi drop-box */
        .location-card {
            display: flex;
            gap: 30px;
            padding: 25px;
            border: 1px solid #f5e0e0;
            border-radius: 16px;
            margin-bottom: 16px;
            background: white;
            transition: box-shadow 0.2s;
            align-items: stretch;
        }

        .location-card:hover {
            box-shadow: 0 4px 16px rgba(123, 49, 60, 0.24);
        }

        /* Foto lokasi di kiri card */
        .location-photo {
            width: 170px;
            height: 170px;
            border-radius: 12px;
            object-fit: cover;
            flex-shrink: 0;
        }

        /* Info lokasi: nama, jam, alamat */
        .location-info {
            flex: 1;
            display: flex;
            flex-direction: column;
            margin-top: 4px;
            gap: 3px;
            justify-content: flex-start;
        }

        .location-bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 8px;
        }

        /* Jarak lokasi dari user (pojok kanan atas card) */
        .location-distance {
            font-size: 13px;
            font-weight: 600;
            color: #e07080;
        }

        .location-top { margin-bottom: 4px; }
        .location-jam { font-size: 12px; color: #9a6a6a; margin-bottom: 4px; }
        .location-name { font-size: 17px; font-weight: 700; color: #3b1a1a; }
        .location-sub { font-size: 12px; color: #9a6a6a; margin-bottom: 2px; }

        /* Alamat: potong kalau terlalu panjang */
        .location-address {
            font-size: 15px;
            color: #9a6a6a;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 400px;
        }

        /* Tombol Pilih Lokasi (pojok kanan bawah card)
           Diklik redirect ke halaman scan-kemasan */
        .btn-pilih {
            align-self: flex-end;
            padding: 10px 28px;
            border-radius: 50px;
            background: #f4a0aa;
            color: white;
            border: none;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
            transition: all 0.2s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-pilih:hover {
            background: #e07080;
        }
    </style>
</head>
<body>

    {{-- Navbar diambil dari file layouts/navigation.blade.php --}}
    @include('layouts.navigation')

    {{-- ==========================================
         CONTENT UTAMA
         ========================================== --}}
    <div class="content">
        <h1>Pilih Lokasi Drop-Box</h1>

        {{-- ==========================================
             TAB BUTTONS
             Tab "Peta" → tampilkan Google Maps iframe
             Tab "Daftar" → tampilkan list lokasi (default aktif)
             Keduanya memanggil switchTab() di JS
             ========================================== --}}
        <div class="tab-wrap">
            <button class="tab-btn" id="tabPeta" onclick="switchTab('peta')">
                <iconify-icon icon="hugeicons:maps"></iconify-icon> Peta
            </button>
            <button class="tab-btn active" id="tabDaftar" onclick="switchTab('daftar')">☰ Daftar</button>
        </div>

        {{-- ==========================================
             SEARCH BAR
             Mengetik di sini akan memanggil searchLokasi()
             yang memfilter card berdasarkan data-name
             ========================================== --}}
        <div style="display:flex; align-items:center; gap:12px; margin-bottom:28px;">
            <div style="flex:1; display:flex; align-items:center; gap:10px; background:white; border:1.5px solid #f0d5d5; border-radius:50px; padding:14px 20px;">
                {{-- Ikon kaca pembesar --}}
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#c4a0a0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"/>
                    <path d="M21 21l-4.35-4.35"/>
                </svg>
                {{-- Input pencarian: oninput memanggil searchLokasi() tiap ketikan --}}
                <input type="text" style="border:none; outline:none; font-family:'Poppins',sans-serif; font-size:14px; color: #3b1a1a; width:100%; background:transparent;" placeholder="Cari lokasi drop-box..." oninput="searchLokasi(this.value)">
            </div>
        </div>

        {{-- ==========================================
             MAP VIEW
             Tersembunyi default, muncul saat tab Peta diklik
             Menampilkan Google Maps embed Jakarta
             ========================================== --}}
        <div class="map-view" id="mapView">
            <div class="map-box" style="padding: 0; overflow: hidden;">
                {{-- Google Maps iframe: lokasi Jakarta --}}
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126748.5856065798!2d106.7447222!3d-6.2297465!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3e945e34b9d%3A0x5371bf0fdad786a2!2sJakarta!5e0!3m2!1sid!2sid!4v1234567890"
                    width="100%" 
                    height="100%" 
                    style="border: none;"
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
            {{-- Legenda warna titik di bawah peta --}}
            <div class="map-legend">
                <div class="legend-item">
                    <div class="legend-dot" style="background: #f4a0aa;"></div>
                    Titik Drop-Box AYU-NE
                </div>
                <div class="legend-item">
                    <div class="legend-dot" style="background: #3498db;"></div>
                    Lokasi Kamu
                </div>
            </div>
        </div>

        {{-- ==========================================
             LIST VIEW
             Aktif secara default (class "active")
             Berisi card tiap lokasi drop-box
             data-name dipakai untuk filter pencarian
             Tombol "Pilih Lokasi" redirect ke scan-kemasan
             
             TODO: sambungkan ke database drop_boxes
             ========================================== --}}
        <div class="list-view active" id="listView">

            @php
                $photos = [
                    'https://images.unsplash.com/photo-1578916171728-46686eac8d58?q=80&w=600&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1710905284916-74c42985384e?q=80&w=600&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1559171667-74fe3499b5ba?q=80&w=600&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1604689598793-b8bf1dc445a1?q=80&w=600&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1588964895597-cfccd6e2dbf9?q=80&w=600&auto=format&fit=crop',
                ];
                $jams = ['08:00 - 22:00', '24 Jam', '10:00 - 22:00', '07:00 - 22:00', '08:00 - 21:00'];
            @endphp

            @forelse($dropBoxes as $i => $db)
            <div class="location-card" data-name="{{ strtolower($db->nama_lokasi) }}" style="position: relative;">
                <img class="location-photo"
                     src="{{ $photos[$i % count($photos)] }}"
                     alt="{{ $db->nama_lokasi }}">
                <div class="location-info">
                    <div style="display:flex; align-items:center; gap:8px;">
                        <span class="location-name">{{ $db->nama_lokasi }}</span>
                        @if($i === 0)
                        <span class="tag-terdekat" style="color: #35843a; font-weight: 600;">Terdekat</span>
                        @endif
                    </div>
                    <div class="location-jam">{{ $jams[$i % count($jams)] }}</div>
                    <div class="location-address">{{ $db->alamat }}</div>
                    </div>
                <a href="{{ route('scan-kemasan', ['lokasi' => $db->qr_code]) }}"
                   class="btn-pilih"
                   style="position:absolute; bottom:16px; right:16px; text-decoration:none;">
                    Pilih Lokasi
                </a>
            </div>
            @empty
            <div style="text-align:center; padding:40px; color:#c4a0a0;">
                Belum ada lokasi drop box yang tersedia.
            </div>
            @endforelse
        </div>
    </div>

    <script>
        // Fungsi ganti tampilan antara tab Peta dan tab Daftar
        function switchTab(tab) {
            const mapView   = document.getElementById('mapView');
            const listView  = document.getElementById('listView');
            const tabPeta   = document.getElementById('tabPeta');
            const tabDaftar = document.getElementById('tabDaftar');

            if (tab === 'peta') {
                // Aktifkan tampilan peta, nonaktifkan daftar
                mapView.classList.add('active');
                listView.classList.remove('active');
                tabPeta.classList.add('active');
                tabDaftar.classList.remove('active');
            } else {
                // Aktifkan tampilan daftar, nonaktifkan peta
                listView.classList.add('active');
                mapView.classList.remove('active');
                tabDaftar.classList.add('active');
                tabPeta.classList.remove('active');
            }
        }

        // Fungsi filter card lokasi berdasarkan keyword pencarian
        // Membandingkan keyword dengan atribut data-name tiap card
        function searchLokasi(keyword) {
            const cards = document.querySelectorAll('.location-card');
            const lower = keyword.toLowerCase(); // ubah ke huruf kecil agar case-insensitive
            cards.forEach(card => {
                const name = card.dataset.name; // ambil nilai data-name
                // Tampilkan card kalau nama mengandung keyword, sembunyikan kalau tidak
                card.style.display = name.includes(lower) ? 'flex' : 'none';
            });
        }
    </script>
</body>
</html>