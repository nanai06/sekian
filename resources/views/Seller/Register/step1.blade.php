{{-- resources/views/Seller/Register/step1.blade.php --}}
@extends('seller.register.layout')

@section('page-title', 'Verifikasi Data Diri')
@section('form-id', 'form-step1')

@section('content')
<form id="form-step1"
      action="{{ route('seller.register.step1.store') }}"
      method="POST"
      enctype="multipart/form-data">
    @csrf

    {{-- Tipe penjual --}}
    <div class="section">
        <div class="field-group">
            <label class="radio-row" onclick="selectTipe('perorangan')">
                <input type="radio" name="tipe_penjual" value="perorangan"
                    id="tipe-perorangan"
                    {{ old('tipe_penjual', $profile?->tipe_penjual ?? 'perorangan') == 'perorangan' ? 'checked' : '' }}
                    style="display:none;">
                <div class="radio-circle {{ old('tipe_penjual', $profile?->tipe_penjual ?? 'perorangan') == 'perorangan' ? 'selected' : '' }}" id="circle-perorangan">
                    <div class="radio-dot" style="{{ old('tipe_penjual', $profile?->tipe_penjual ?? 'perorangan') != 'perorangan' ? 'display:none' : '' }}" id="dot-perorangan"></div>
                </div>
                <span class="radio-label">Perorangan</span>
            </label>
            <label class="radio-row" onclick="selectTipe('perusahaan')">
                <input type="radio" name="tipe_penjual" value="perusahaan"
                    id="tipe-perusahaan"
                    {{ old('tipe_penjual', $profile?->tipe_penjual) == 'perusahaan' ? 'checked' : '' }}
                    style="display:none;">
                <div class="radio-circle {{ old('tipe_penjual', $profile?->tipe_penjual) == 'perusahaan' ? 'selected' : '' }}" id="circle-perusahaan">
                    <div class="radio-dot" style="{{ old('tipe_penjual', $profile?->tipe_penjual) != 'perusahaan' ? 'display:none' : '' }}" id="dot-perusahaan"></div>
                </div>
                <span class="radio-label">Perusahaan (PT/CV)</span>
            </label>
        </div>
    </div>

    {{-- Foto KTP --}}
    <div class="section">
        <div style="font-size:14px;color:#333;margin-bottom:8px;font-weight:500;">
            Foto KTP <span class="field-req">*</span>
        </div>
        <div class="field-group">
            <div class="ktp-upload-wrap">
                <label for="foto_ktp" class="upload-box">
                    <span class="upload-plus">+</span>
                </label>
                <input type="file" id="foto_ktp" name="foto_ktp"
                    accept="image/*" style="display:none;"
                    onchange="previewKtp(this)">

                {{-- Preview foto --}}
                <div id="ktp-preview" style="flex:1;min-height:68px;background:#FBEAF0;border-radius:8px;border:0.5px solid #eee;display:flex;align-items:center;justify-content:center;overflow:hidden;">
                    @if($profile?->foto_ktp)
                        <img src="{{ Storage::url($profile->foto_ktp) }}"
                            style="width:100%;height:100%;object-fit:cover;border-radius:8px;">
                    @else
                        <span style="font-size:11px;color:#C2617A;">Contoh KTP</span>
                    @endif
                </div>
            </div>
            <p class="ktp-hint">Pastikan seluruh KTP berada dalam bingkai, info terlihat jelas, tidak buram, dan jangan gunakan screenshot KTP.</p>
        </div>
    </div>

    {{-- Nama & NIK --}}
    <div class="section">
        <div class="field-group">
            <div class="field-row">
                <div class="field-label">
                    <span>Nama sesuai KTP <span class="field-req">*</span></span>
                    <span class="field-count" id="nama-count">0/40</span>
                </div>
                <input class="field-input" type="text" name="nama_ktp"
                    placeholder="Masukkan nama sesuai KTP"
                    maxlength="40"
                    value="{{ old('nama_ktp', $profile?->nama_ktp) }}"
                    oninput="updateCount(this, 'nama-count')">
            </div>
            <div class="field-row">
                <div class="field-label">
                    <span>NIK <span class="field-req">*</span></span>
                    <span class="field-count" id="nik-count">0/16</span>
                </div>
                <input class="field-input" type="text" name="nik"
                    placeholder="Masukkan 16 digit NIK"
                    maxlength="16" inputmode="numeric"
                    value="{{ old('nik', $profile?->nik) }}"
                    oninput="updateCount(this, 'nik-count'); this.value=this.value.replace(/\D/g,'')">
            </div>

            {{-- Verifikasi Wajah --}}
            <div class="field-row" style="display:flex;align-items:center;justify-content:space-between;">
                <span style="font-size:14px;color:#333;">Verifikasi Wajah <span class="field-req">*</span></span>
                @if($profile?->verifikasi_wajah)
                    <span id="wajah-status" style="font-size:13px;color:#27ae60;font-weight:600;">✓ Terverifikasi</span>
                @else
                    <button type="button" onclick="bukaKamera()"
                        id="btn-verifikasi"
                        style="font-size:13px;color:#C2617A;font-weight:500;background:none;border:none;cursor:pointer;padding:0;">
                        Verifikasi Sekarang ›
                    </button>
                @endif
            </div>

            {{-- Preview selfie kalau sudah diambil --}}
            <div id="selfie-preview-wrap" style="display:none;padding:8px 1rem 10px;">
                <img id="selfie-preview-img"
                    style="width:80px;height:80px;object-fit:cover;border-radius:50%;border:2px solid #C2617A;display:block;margin:0 auto;">
                <p style="text-align:center;font-size:11px;color:#27ae60;margin-top:6px;">✓ Foto wajah berhasil diambil</p>
            </div>
        </div>
    </div>

    {{-- Hidden inputs verifikasi wajah --}}
    <input type="hidden" name="foto_selfie" id="foto_selfie" value="">
    <input type="hidden" name="verifikasi_wajah" id="verifikasi_wajah_input" value="0">

    {{-- Checkbox syarat --}}
    <div class="checkbox-row">
        <input type="checkbox" name="setuju_syarat" id="setuju_syarat" value="1"
            style="width:18px;height:18px;accent-color:#C2617A;cursor:pointer;"
            {{ old('setuju_syarat', $profile?->setuju_syarat) ? 'checked' : '' }}>
        <label for="setuju_syarat" class="checkbox-text">
            Saya menyetujui <a href="#" class="checkbox-link">Syarat &amp; Ketentuan</a>
            yang berlaku di AYU-NE.
        </label>
    </div>

    {{-- Bottom buttons --}}
    <div class="bottom-btns" style="position:fixed;bottom:0;left:0;right:0;max-width:480px;margin:0 auto;">
        <a href="{{ route('dashboard') }}" class="btn-back" style="display:flex;align-items:center;justify-content:center;text-decoration:none;">Kembali</a>
        <button type="submit" class="btn-next">Lanjut</button>
    </div>
</form>

{{-- ── Modal Kamera ─────────────────────────────────────── --}}
<div id="modal-kamera"
    style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.75);z-index:999;align-items:center;justify-content:center;padding:1rem;">

    <div style="background:#fff;border-radius:16px;padding:20px;width:100%;max-width:360px;">
        <p style="font-size:15px;font-weight:600;color:#333;margin-bottom:4px;text-align:center;">Verifikasi Wajah</p>
        <p style="font-size:12px;color:#999;text-align:center;margin-bottom:14px;">Posisikan wajah di tengah lingkaran</p>

        {{-- Kamera dengan overlay oval --}}
        <div style="position:relative;width:100%;aspect-ratio:3/4;background:#000;border-radius:12px;overflow:hidden;">
            <video id="video-kamera" autoplay playsinline muted
                style="width:100%;height:100%;object-fit:cover;"></video>

            {{-- Overlay oval guide --}}
            <div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;pointer-events:none;">
                <div style="width:65%;aspect-ratio:3/4;border:3px solid #C2617A;border-radius:50%;box-shadow:0 0 0 9999px rgba(0,0,0,0.45);"></div>
            </div>

            {{-- Status kamera --}}
            <div id="kamera-status" style="position:absolute;bottom:12px;left:0;right:0;text-align:center;">
                <span style="background:rgba(0,0,0,0.5);color:#fff;font-size:11px;padding:4px 10px;border-radius:20px;">
                    Memuat kamera...
                </span>
            </div>
        </div>

        <canvas id="canvas-kamera" style="display:none;"></canvas>

        {{-- Tombol --}}
        <div style="display:flex;gap:10px;margin-top:16px;">
            <button type="button" onclick="tutupKamera()"
                style="flex:1;padding:11px;border:0.5px solid #eee;border-radius:8px;background:#f8f8f8;color:#666;font-size:14px;font-family:inherit;cursor:pointer;">
                Batal
            </button>
            <button type="button" onclick="ambilFoto()" id="btn-ambil"
                style="flex:2;padding:11px;background:#C2617A;color:#fff;border:none;border-radius:8px;font-size:14px;font-weight:600;font-family:inherit;cursor:pointer;">
                📷 Ambil Foto
            </button>
        </div>
    </div>
</div>

<script>
// ── Counter & Radio ──────────────────────────────────────
function updateCount(input, countId) {
    document.getElementById(countId).textContent = input.value.length + '/' + input.maxLength;
}
function selectTipe(tipe) {
    ['perorangan','perusahaan'].forEach(t => {
        const isSelected = t === tipe;
        document.getElementById('tipe-' + t).checked = isSelected;
        document.getElementById('circle-' + t).classList.toggle('selected', isSelected);
        document.getElementById('dot-' + t).style.display = isSelected ? '' : 'none';
    });
}
function previewKtp(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            const preview = document.getElementById('ktp-preview');
            preview.innerHTML = `<img src="${e.target.result}" style="width:100%;height:100%;object-fit:cover;border-radius:8px;">`;
        };
        reader.readAsDataURL(input.files[0]);
    }
}
document.addEventListener('DOMContentLoaded', () => {
    const nama = document.querySelector('[name="nama_ktp"]');
    const nik  = document.querySelector('[name="nik"]');
    if (nama) document.getElementById('nama-count').textContent = nama.value.length + '/40';
    if (nik)  document.getElementById('nik-count').textContent  = nik.value.length  + '/16';
});

// ── Kamera ───────────────────────────────────────────────
let stream = null;

async function bukaKamera() {
    const modal = document.getElementById('modal-kamera');
    modal.style.display = 'flex';

    try {
        stream = await navigator.mediaDevices.getUserMedia({
            video: { facingMode: 'user', width: { ideal: 720 }, height: { ideal: 960 } }
        });
        const video = document.getElementById('video-kamera');
        video.srcObject = stream;
        video.onloadedmetadata = () => {
            document.getElementById('kamera-status').innerHTML =
                '<span style="background:rgba(0,0,0,0.5);color:#fff;font-size:11px;padding:4px 10px;border-radius:20px;">Kamera siap ✓</span>';
        };
    } catch (err) {
        document.getElementById('kamera-status').innerHTML =
            '<span style="background:rgba(220,0,0,0.7);color:#fff;font-size:11px;padding:4px 10px;border-radius:20px;">Tidak bisa akses kamera</span>';
        console.error('Kamera error:', err);
    }
}

function tutupKamera() {
    if (stream) {
        stream.getTracks().forEach(t => t.stop());
        stream = null;
    }
    document.getElementById('modal-kamera').style.display = 'none';
    document.getElementById('video-kamera').srcObject = null;
}

function ambilFoto() {
    const video  = document.getElementById('video-kamera');
    const canvas = document.getElementById('canvas-kamera');

    if (!stream || video.readyState < 2) {
        alert('Kamera belum siap, tunggu sebentar.');
        return;
    }

    canvas.width  = video.videoWidth;
    canvas.height = video.videoHeight;
    canvas.getContext('2d').drawImage(video, 0, 0);

    const dataUrl = canvas.toDataURL('image/jpeg', 0.85);

    // Simpan ke hidden input
    document.getElementById('foto_selfie').value = dataUrl;
    document.getElementById('verifikasi_wajah_input').value = '1';

    // Tampilkan preview selfie
    const previewWrap = document.getElementById('selfie-preview-wrap');
    const previewImg  = document.getElementById('selfie-preview-img');
    previewImg.src = dataUrl;
    previewWrap.style.display = 'block';

    // Update tombol verifikasi
    const btnVerifikasi = document.getElementById('btn-verifikasi');
    if (btnVerifikasi) {
        btnVerifikasi.outerHTML = '<span id="wajah-status" style="font-size:13px;color:#27ae60;font-weight:600;">✓ Terverifikasi</span>';
    }

    tutupKamera();
}
</script>
@endsection