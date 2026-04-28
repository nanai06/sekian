<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scan Barcode - AYU-NE</title>

    <script src="https://code.iconify.design/iconify-icon/2.1.0/iconify-icon.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(180deg, #ffe8ed 0%, #fff5f5 50%, #ffe8ed 100%);
            background-attachment: fixed;
            color: #3b1a1a;
            min-height: 100vh;
        }

        .container {
            max-width: 1100px;
            margin: 24px auto;
            padding: 0 20px;
        }

        .card {
            background: #fff;
            border-radius: 24px;
            padding: 40px;
            box-shadow: 0 8px 32px rgba(224,112,128,0.12);
            margin-top: 45px;
        }

        .step-indicator {
            display: flex;
            gap: 12px;
            margin-bottom: 32px;
            align-items: center;
        }

        .step-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: #f5e0e0;
        }

        .step-dot.active {
            width: 28px;
            border-radius: 50px;
            background: #e07080;
        }

        h1 {
            font-size: 24px;
            font-weight: 800;
            margin-bottom: 8px;
        }

        .subtitle {
            font-size: 14px;
            color: #9a6a6a;
            margin-bottom: 32px;
        }

        .input-kode {
            width: 100%;
            padding: 14px 20px;
            border: 2px dashed #e07080;
            border-radius: 12px;
            outline: none;
            margin-bottom: 16px;
        }

        .input-kode:focus {
            background: #fff5f7;
        }

        .error-msg {
            color: #e07080;
            font-size: 13px;
            margin-bottom: 16px;
        }

        .confirm-btn {
            width: 100%;
            padding: 18px;
            border: none;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 700;
            transition: 0.3s;
            background: #f0d5d5;
            color: #c4a0a0;
            cursor: not-allowed;
        }

        .confirm-btn.active {
            background: linear-gradient(135deg, #f4a0aa 0%, #e07080 100%);
            color: white;
            cursor: pointer;
            box-shadow: 0 4px 16px rgba(224,112,128,0.3);
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    </style>
</head>
<body>

@include('layouts.navigation')

<div class="container">
    <div class="card">

        <div class="step-indicator">
            <div class="step-dot"></div>
            <div class="step-dot active"></div>
            <div class="step-dot"></div>
        </div>

        <h1>Scan Barcode Drop Box</h1>
        <p class="subtitle">Scan barcode yang ada di drop box AYU-NE atau input kode manual</p>

        <div style="display:grid; grid-template-columns:2fr 1fr; gap:24px;">

            <!-- KIRI -->
            <div>
                <div id="btnScanWrap" style="margin-bottom:16px;">
                    <button type="button" onclick="startScanner()"
                        style="width:100%; min-height:310px; border:2px dashed #e07080; border-radius:12px; background:white; display:flex; flex-direction:column; justify-content:center; align-items:center; gap:8px; cursor:pointer;">
                        <iconify-icon icon="solar:qr-code-linear" style="font-size:48px; color:#e07080;"></iconify-icon>
                        <span>Gunakan Kamera untuk Barcode</span>
                        <span style="font-size:12px; color:#c4a0a0;">Arahkan kamera ke Barcode</span>
                    </button>
                </div>

                <div id="qr-box" style="display:none; margin-bottom:16px;">
                    <video id="qr-video" style="width:100%; min-height:160px; max-height:300px; border-radius:12px; object-fit:cover;"></video>
                </div>

                <div style="display:flex; align-items:center; gap:12px; margin:16px 0; color:#c4a0a0; font-size:13px;">
                    <div style="flex:1; height:1px; background:#f5e0e0;"></div>
                    atau input kode manual
                    <div style="flex:1; height:1px; background:#f5e0e0;"></div>
                </div>

                @php $qrPilihan = session('lokasi_pilih'); @endphp
                <input type="text" id="kodeInput" class="input-kode"
                    placeholder="Masukkan kode drop box..."
                    value="">

                @if($qrPilihan)
                @endif

                @error('qr_code')
                <p class="error-msg">{{ $message }}</p>
                @enderror
            </div>

            <!-- KANAN -->
            <div style="display:flex; flex-direction:column; gap:16px;">
                 @php $lokasiDipilih = $dropBoxes->firstWhere('qr_code', session('lokasi_pilih')); @endphp
                @if($lokasiDipilih)
                <div style="background:#fff0f3; border-radius:12px; padding:14px 18px;">
                    <p style="font-size:14px; font-weight:500; color: #5f1212;">{{ $lokasiDipilih->nama_lokasi }}</p>
                    <p style="font-size:10px; color:#7a4a4a;">{{ $lokasiDipilih->alamat }}</p>
                </div>
                @endif
                <div style="background:#fff5f7; border-radius:12px; padding:16px 20px;">
                    <h3 style="font-size:16px; font-weight:700; margin-bottom:12px;">Cara Scan Barcode</h3>
                    <p style="font-size:13px; color:#7a4a4a; line-height:1.8;">
                        ✿ Arahkan kamera ke Barcode di drop box<br>
                        ✿ Atau input kode yang tertera di drop box<br>
                        ✿ Pastikan kode sesuai dengan lokasi drop box
                    </p>
                </div>

                    <form method="POST" action="{{ route('proses-qr') }}" id="formKonfirmasi">
                    @csrf
                    <input type="hidden" name="qr_code" id="kodeHidden" value="">
                    <input type="hidden" name="lokasi_pilih" value="{{ session('lokasi_pilih') }}">
                    <button id="btnKonfirmasi" class="confirm-btn {{ session('qr_code_pilihan') ? 'active' : '' }}"
                            {{ session('qr_code_pilihan') ? '' : 'disabled' }}>
                        Konfirmasi
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="scan-loading" style="display:none; position:fixed; inset:0; background:rgba(255,255,255,0.88); z-index:9999; justify-content:center; align-items:center; flex-direction:column; gap:16px;">
    <div style="width:56px; height:56px; border:4px solid #f5e0e0; border-top-color:#e07080; border-radius:50%; animation:spin 0.8s linear infinite;"></div>
    <p style="font-weight:700; color:#e07080;">QR Terdeteksi! Memproses...</p>
</div>

<script src="https://cdn.jsdelivr.net/npm/jsqr@1.4.0/dist/jsQR.js"></script>

<script>
let scanning = false;

async function startScanner() {
    const video = document.getElementById('qr-video');
    const box = document.getElementById('qr-box');
    const btn = document.getElementById('btnScanWrap');

    try {
        const stream = await navigator.mediaDevices.getUserMedia({
            video: { facingMode: "environment" }
        });

        video.srcObject = stream;
        await video.play();

        box.style.display = 'block';
        btn.style.display = 'none';

        scanning = true;
        scanFrame(video);
    } catch (error) {
        alert('Kamera tidak bisa diakses, gunakan input manual ya!');
    }
}

function scanFrame(video) {
    if (!scanning) return;

    const canvas = document.createElement('canvas');
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;

    const ctx = canvas.getContext('2d');
    ctx.drawImage(video, 0, 0);

    const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
    const code = jsQR(imageData.data, imageData.width, imageData.height);

    if (code) {
        scanning = false;
        video.srcObject.getTracks().forEach(t => t.stop());

        document.getElementById('kodeHidden').value = code.data;
        document.getElementById('scan-loading').style.display = 'flex';
        document.getElementById('formKonfirmasi').submit();
    } else {
        requestAnimationFrame(() => scanFrame(video));
    }
}

document.getElementById('kodeInput').addEventListener('input', function() {
    const btn = document.getElementById('btnKonfirmasi');
    document.getElementById('kodeHidden').value = this.value;

    if (this.value.trim() !== '') {
        btn.disabled = false;
        btn.classList.add('active');
    } else {
        btn.disabled = true;
        btn.classList.remove('active');
    }
});

function pilihDropBox(kode, nama) {
    document.getElementById('kodeInput').value = kode;
    document.getElementById('kodeHidden').value = kode;
    const btn = document.getElementById('btnKonfirmasi');
    btn.disabled = false;
    btn.classList.add('active');
    btn.textContent = 'Konfirmasi – ' + nama;
}
</script>

</body>
</html>