{{-- resources/views/seller/register/step1.blade.php --}}
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
            <div class="field-row" style="display:flex;align-items:center;justify-content:space-between;">
                <span style="font-size:14px;color:#333;">Verifikasi Wajah <span class="field-req">*</span></span>
                <a href="#" style="font-size:13px;color:#C2617A;font-weight:500;">
                    {{ $profile?->verifikasi_wajah ? '✓ Terverifikasi' : 'Verifikasi Sekarang ›' }}
                </a>
            </div>
        </div>
    </div>

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
        <a href="{{ route('home') }}" class="btn-back" style="display:flex;align-items:center;justify-content:center;text-decoration:none;">Kembali</a>
        <button type="submit" class="btn-next">Lanjut</button>
    </div>
</form>

<script>
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
// Init counter
document.addEventListener('DOMContentLoaded', () => {
    const nama = document.querySelector('[name="nama_ktp"]');
    const nik  = document.querySelector('[name="nik"]');
    if (nama) document.getElementById('nama-count').textContent = nama.value.length + '/40';
    if (nik)  document.getElementById('nik-count').textContent  = nik.value.length  + '/16';
});
</script>
@endsection