<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scan Kemasan - AYU-NE</title>

    {{-- Iconify: library ikon --}}
    <script src="https://code.iconify.design/iconify-icon/2.1.0/iconify-icon.min.js"></script>

    {{-- Google Fonts: font Poppins --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        /* Reset semua margin/padding bawaan browser */
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }

        /* Background halaman: gradient pink muda */
        body { background: linear-gradient(180deg, #ffe8ed 0%, #fff5f5 50%, #ffe8ed 100%); background-attachment: fixed; color: #3b1a1a; }

        /* Wrapper utama konten halaman */
        .container {
            max-width: 1100px;
            margin: 24px auto;
            padding: 0 20px;
        }

        /* Card putih utama yang membungkus seluruh konten */
        .card {
            background: #ffffff;
            border-radius: 24px;
            padding: 40px;
            box-shadow: 0 8px 32px rgba(224,112,128,0.12);
            max-width: 1100px;
            margin: 0 auto;
            margin-top: 45px;
            overflow: hidden;
        }

        /* ==========================================
           STEP INDICATOR
           3 dot di atas menunjukkan progress:
           Dot 1 = Upload Foto (aktif), Dot 2 = Scan QR, Dot 3 = Sukses
           ========================================== */
        .step-indicator {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 32px;
        }

        /* Dot tidak aktif: bulat kecil abu */
        .step-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: #f5e0e0;
        }

        /* Dot aktif: lonjong merah */
        .step-dot.active {
            background: #e07080;
            width: 28px;
            border-radius: 50px;
        }

        h1 {
            font-size: 24px;
            font-weight: 800;
            color: #3b1a1a;
            margin-bottom: 8px;
        }

        .subtitle {
            font-size: 14px;
            color: #9a6a6a;
            margin-bottom: 32px;
        }

        /* Area upload foto: border dashed merah, klik memicu file input */
        .upload-area {
            border: 2px dashed #e07080;
            border-radius: 16px;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s;
            margin-bottom: 24px;
            position: relative; /* agar file input bisa overlay penuh */
        }

        .upload-area:hover {
            background: #fff5f7;
            border-color: #e07080;
        }

        .upload-icon {
            font-size: 48px;
            margin-bottom: 8px;
            color: #e07080;
        }

        .upload-text {
            font-size: 14px;
            color: #9a6a6a;
            margin-bottom: 8px;
        }

        .upload-hint {
            font-size: 12px;
            color: #c4a0a0;
        }

        /* Input file disembunyikan, tapi overlay seluruh area upload
           Jadi area upload bisa diklik untuk buka file picker */
        .upload-area input[type="file"] {
            position: absolute;
            inset: 0;
            opacity: 0;
            cursor: pointer;
        }

        /* Preview gambar setelah upload (tidak dipakai langsung, pakai preview-grid) */
        .preview-img {
            width: 100%;
            max-height: 250px;
            object-fit: contain;
            border-radius: 12px;
            display: none;
            margin-bottom: 16px;
        }

        /* Divider "atau" antara dua pilihan */
        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 24px;
            color: #c4a0a0;
            font-size: 13px;
        }

        /* Garis kiri-kanan divider */
        .divider::before, .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #f5e0e0;
        }

        /* Tombol buka kamera (tidak dipakai langsung di HTML, ada versi inline) */
        .btn-kamera {
            width: 100%;
            padding: 14px;
            border: 1.5px solid #f4a0aa;
            border-radius: 50px;
            background: white;
            color: #e07080;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
            margin-bottom: 24px;
            transition: all 0.2s;
        }

        .btn-kamera:hover {
            background: #fff5f7;
        }

        /* Tombol submit (tidak dipakai langsung di HTML, ada versi inline) */
        .btn-submit {
            width: 100%;
            padding: 16px;
            background: #e07080;
            color: white;
            border: none;
            border-radius: 50px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
            transition: background 0.2s;
        }

        .btn-submit:hover { background: #c05060; }
    </style>
</head>
<body>
    {{-- Navbar diambil dari file layouts/navigation.blade.php --}}
    @include('layouts.navigation')

    <div class="container">
        <div class="card">

            {{-- Step indicator: dot ke-1 aktif karena ini halaman step 1 --}}
            <div class="step-indicator">
                <div class="step-dot active"></div>  {{-- Step 1: Upload Foto (halaman ini) --}}
                <div class="step-dot"></div>          {{-- Step 2: Scan QR (belum) --}}
                <div class="step-dot"></div>          {{-- Step 3: Sukses (belum) --}}
            </div>

            <h1>Foto Kemasanmu</h1>
            <p class="subtitle">Upload foto kemasan kosmetik yang ingin kamu daur ulang</p>

            {{-- Form upload foto kemasan
                 Action: route upload-foto (RecyclingController@uploadFoto)
                 enctype multipart/form-data wajib ada untuk upload file --}}
            <form method="POST" action="{{ route('upload-foto') }}" enctype="multipart/form-data">
                @csrf

                {{-- Layout 2 kolom: kiri (kamera + upload) lebih lebar, kanan (info + tombol) lebih kecil --}}
                <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 24px; align-items: stretch;">

                    {{-- ==========================================
                         KOLOM KIRI
                         Berisi tombol kamera, tombol upload, video kamera,
                         preview foto, dan area upload
                         ========================================== --}}
                    <div>

                        {{-- Tombol Gunakan Kamera: default tampil, hilang saat kamera aktif --}}
                        <div id="btnKameraWrap">
                            <button type="button" onclick="bukaKamera()"
                                style="width:100%; padding:10px; border:2px dashed #e07080; border-radius:12px; background:white; color:#9a6a6a; font-size:14px; cursor:pointer; font-family:'Poppins',sans-serif; display:flex; align-items:center; justify-content:center; gap:8px;">
                                <iconify-icon icon="solar:camera-linear" style="font-size:20px; color:#e07080;"></iconify-icon>
                                Gunakan Kamera
                            </button>
                        </div>

                        {{-- Tombol Upload Foto: tersembunyi dulu, muncul saat kamera aktif
                             Berfungsi sebagai alternatif kalau mau ganti ke upload file --}}
                        <div id="btnUploadWrap" style="display:none;">
                            <button type="button" onclick="document.getElementById('fileInput').click()"
                                style="width:100%; padding:10px; border:2px dashed #e07080; border-radius:12px; background:white; color:#9a6a6a; font-size:14px; cursor:pointer; font-family:'Poppins',sans-serif; display:flex; align-items:center; justify-content:center; gap:8px;">
                                <iconify-icon icon="garden:upload-stroke-16" style="font-size:20px; color:#e07080;"></iconify-icon>
                                Upload Foto
                            </button>
                        </div>

                        {{-- Divider pemisah antara dua metode --}}
                        <div id="divider-upload" style="display:flex; align-items:center; gap:12px; margin:16px 0; color:#c4a0a0; font-size:13px;">
                            <div style="flex:1; height:1px; background:#f5e0e0;"></div>
                            atau pilih metode lain
                            <div style="flex:1; height:1px; background:#f5e0e0;"></div>
                        </div>

                        {{-- Box video kamera: tersembunyi dulu, muncul saat bukaKamera() dipanggil --}}
                        <div id="kamera-box" style="display:none; margin-bottom:16px;">
                            <video id="kamera-video" style="width:100%; max-height:250px; border-radius:12px; object-fit:cover;" autoplay playsinline></video>
                            {{-- Tombol ambil foto: capture frame video ke canvas --}}
                            <button type="button" onclick="ambilFoto()"
                                style="width:100%; margin-top:12px; padding:12px; border:1.5px solid #f4a0aa; border-radius:12px; background:white; color:#e07080; font-size:14px; cursor:pointer; font-family:'Poppins',sans-serif; display:flex; align-items:center; justify-content:center; gap:8px;">
                                <iconify-icon icon="solar:camera-linear" style="font-size:20px;"></iconify-icon>
                                Ambil Foto
                            </button>
                            {{-- Canvas tersembunyi: dipakai untuk capture frame video --}}
                            <canvas id="kamera-canvas" style="display:none;"></canvas>
                        </div>

                        {{-- Preview grid: muncul setelah foto dipilih/diambil
                             Menampilkan thumbnail foto yang akan diupload (max 4) --}}
                        <div id="preview-container" style="display:none; margin-bottom:16px;">
                            <div id="preview-grid" style="display:flex; gap:8px; flex-wrap:wrap; justify-content:center;"></div>
                        </div>

                        {{-- Area upload file: klik untuk buka file picker
                             Input file tersembunyi di baliknya (opacity 0 tapi overlay penuh) --}}
                        <div class="upload-area" id="uploadArea">
                            <div class="upload-icon">
                                <iconify-icon icon="garden:upload-stroke-16" style="color:#e07080;"></iconify-icon>
                            </div>
                            <p class="upload-text">Klik untuk upload foto</p>
                            <p class="upload-hint">JPG, PNG, max 5MB</p>
                            {{-- name="foto_kemasan[]" array karena bisa multiple foto --}}
                            <input type="file" name="foto_kemasan[]" accept="image/*" id="fileInput" multiple onchange="previewFoto(this)">
                        </div>

                        {{-- Tampilkan error validasi foto kalau ada --}}
                        @error('foto_kemasan')
                            <p style="color:#e07080; font-size:13px; margin-top:8px;">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- ==========================================
                         KOLOM KANAN
                         Berisi info ketentuan foto + tombol Lanjut Scan QR
                         ========================================== --}}
                    <div style="display: flex; flex-direction: column; justify-content: flex-start; gap: 16px; height: 100%;">

                        {{-- Box info ketentuan foto kemasan --}}
                        <div style="background: #fff5f7; border-radius: 12px; padding: 16px 20px;">
                            <h3 style="font-size: 16px; font-weight: 700; color: #3b1a1a; margin-bottom: 12px;">Ketentuan</h3>
                            <p style="font-size: 13px; color: #7a4a4a; line-height: 1.8;">
                                ✿  Pastikan foto kemasan jelas dan tidak buram<br>
                                ✿  Kemasan harus bersih dan kosong<br>
                                ✿  Pastikan seluruh bagian kemasan terpisah<br>
                            </p>
                        </div>

                        {{-- Tombol submit: disabled dulu (abu), aktif setelah ada foto
                             Diaktifkan via fungsi aktifkanTombol() di JS --}}
                        <button type="submit" id="btnSubmit" disabled
                            style="width:100%; padding:18px; background: #f0d5d5; color:#c4a0a0; border:none; border-radius:12px; font-size:15px; font-weight:700; cursor:not-allowed; font-family:'Poppins',sans-serif;">
                            Lanjut Scan QR →
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Variabel stream kamera, dipakai untuk matikan kamera setelah foto diambil
        let stream = null;

        // Fungsi mengaktifkan tombol submit (ubah tampilan dari disabled ke aktif)
        function aktifkanTombol() {
            const btn = document.getElementById('btnSubmit');
            btn.disabled = false;
            btn.style.background = 'linear-gradient(135deg, #f4a0aa 0%, #e07080 100%)';
            btn.style.color = 'white';
            btn.style.cursor = 'pointer';
            btn.style.boxShadow = '0 4px 16px rgba(224,112,128,0.3)';
        }

        // Fungsi preview foto setelah user memilih file dari file picker
        function previewFoto(input) {
            if (input.files && input.files.length > 0) {
                const container = document.getElementById('preview-container');
                const grid = document.getElementById('preview-grid');
                grid.innerHTML = ''; // bersihkan preview lama
                grid.style.justifyContent = 'center';
                document.getElementById('uploadArea').style.display = 'none'; // sembunyikan area upload
                container.style.display = 'block'; // tampilkan preview

                const total = input.files.length;
                const maxShow = 4; // maksimal 4 foto ditampilkan
                let loadedCount = 0;
                const images = new Array(Math.min(total, maxShow));

                Array.from(input.files).forEach((file, index) => {
                    if (index >= maxShow) return; // lewati foto ke-5 dst

                    const reader = new FileReader();
                    reader.onload = e => {
                        images[index] = e.target.result;
                        loadedCount++;

                        if (loadedCount === Math.min(total, maxShow)) {
                            // Semua foto sudah ke-load, baru render ke grid
                            images.forEach((src, i) => {
                                const wrapper = document.createElement('div');
                                wrapper.style.cssText = 'width:150px; height:190px; flex-shrink:0; position:relative;';

                                // Kalau foto lebih dari 4, foto ke-4 tampilkan overlay "+N"
                                if (i === maxShow - 1 && total > maxShow) {
                                    wrapper.innerHTML = `
                                        <img src="${src}" style="width:150px; height:190px; object-fit:cover; border-radius:12px; border:1px solid #f5e0e0;">
                                        <div style="position:absolute; inset:0; background:rgba(0,0,0,0.5); display:flex; align-items:center; justify-content:center; color:white; font-size:24px; font-weight:700; border-radius:12px;">
                                            +${total - maxShow + 1}
                                        </div>`;
                                } else {
                                    wrapper.innerHTML = `<img src="${src}" style="width:150px; height:190px; object-fit:cover; border-radius:12px; border:1px solid #f5e0e0;">`;
                                }
                                grid.appendChild(wrapper);
                            });
                        }
                    }
                    reader.readAsDataURL(file); // baca file sebagai base64
                });

                aktifkanTombol(); // aktifkan tombol submit
            }
        }

        // Fungsi membuka kamera untuk foto kemasan
        async function bukaKamera() {
            const video = document.getElementById('kamera-video');
            try {
                // Minta akses kamera belakang (environment)
                stream = await navigator.mediaDevices.getUserMedia({ video: { facingMode: 'environment' } });
                video.srcObject = stream;
                document.getElementById('kamera-box').style.display = 'block';      // tampilkan video
                document.getElementById('btnKameraWrap').style.display = 'none';    // sembunyikan tombol kamera
                document.getElementById('btnUploadWrap').style.display = 'block';   // tampilkan tombol upload
                document.getElementById('divider-upload').style.display = 'flex';   // tampilkan divider
                document.getElementById('uploadArea').style.display = 'none';       // sembunyikan area upload
                document.getElementById('preview-container').style.display = 'none'; // sembunyikan preview lama
            } catch (err) {
                alert('Kamera tidak bisa diakses!');
            }
        }

        // Fungsi mengambil foto dari video kamera (capture frame)
        function ambilFoto() {
            const video = document.getElementById('kamera-video');
            const canvas = document.getElementById('kamera-canvas');

            // Set ukuran canvas sama dengan resolusi video
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            canvas.getContext('2d').drawImage(video, 0, 0); // gambar frame video ke canvas

            // Matikan kamera setelah foto diambil
            stream.getTracks().forEach(t => t.stop());
            document.getElementById('kamera-box').style.display = 'none';

            // Tampilkan preview foto hasil kamera di grid
            const container = document.getElementById('preview-container');
            const grid = document.getElementById('preview-grid');
            grid.innerHTML = '';
            grid.style.justifyContent = 'center';
            container.style.display = 'block';

            const wrapper = document.createElement('div');
            wrapper.style.cssText = 'width:150px; height:190px; flex-shrink:0; position:relative;';
            wrapper.innerHTML = `<img src="${canvas.toDataURL('image/jpeg')}" style="width:150px; height:190px; object-fit:cover; border-radius:12px; border:1px solid #f5e0e0;">`;
            grid.appendChild(wrapper);

            // Konversi canvas ke File object dan masukkan ke input file
            // Supaya bisa disubmit lewat form
            canvas.toBlob(blob => {
                const file = new File([blob], 'foto-kemasan.jpg', { type: 'image/jpeg' });
                const dt = new DataTransfer();
                dt.items.add(file);
                document.getElementById('fileInput').files = dt.files;
            }, 'image/jpeg');

            aktifkanTombol(); // aktifkan tombol submit
        }
    </script>
</body>
</html>