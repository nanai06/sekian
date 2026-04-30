{{-- resources/views/seller/register/step3.blade.php --}}
@extends('seller.register.layout')

@section('page-title', 'Upload Produk')
@section('form-id', 'form-step3')

@section('content')
<div style="padding:1rem 1.25rem 0;">
    <p style="font-size:14px;font-weight:500;color:#333;margin-bottom:4px;">Upload produk pertama kamu</p>
    <p style="font-size:12px;color:#888;line-height:1.5;">Tambahkan minimal 1 produk untuk mengaktifkan tokomu di AYU-NE.</p>
</div>

{{-- Form produk diarahkan ke SellerProductController@storeOnboarding --}}
<form id="form-step3"
      action="{{ route('seller.register.finish') }}"
      method="POST"
      enctype="multipart/form-data">
    @csrf

    {{-- Foto produk --}}
    <div class="section">
        <div class="field-group">
            <div style="padding:0.75rem 1rem 0.5rem;">
                <div style="font-size:13px;color:#555;margin-bottom:8px;">
                    Foto Produk <span class="field-req">*</span>
                </div>
                <div style="display:flex;gap:8px;flex-wrap:wrap;" id="photo-previews">
                    <label for="foto_produk" style="width:80px;height:80px;border:1.5px dashed #E8A0B0;border-radius:8px;display:flex;flex-direction:column;align-items:center;justify-content:center;cursor:pointer;background:#FBEAF0;">
                        <span style="font-size:22px;color:#E8A0B0;">+</span>
                        <span style="font-size:10px;color:#C2617A;">Tambah foto</span>
                    </label>
                    <input type="file" id="foto_produk" name="foto_produk[]"
                        accept="image/*" multiple style="display:none;"
                        onchange="previewFoto(this)">
                </div>
                <p style="font-size:11px;color:#888;margin-top:8px;">Maks. 9 foto. Foto pertama jadi foto utama.</p>
            </div>
        </div>
    </div>

    {{-- Info produk --}}
    <div class="section">
        <div class="field-group">
            <div class="field-row">
                <div class="field-label">
                    <span>Nama Produk <span class="field-req">*</span></span>
                    <span class="field-count" id="nama-count">0/255</span>
                </div>
                <input class="field-input" type="text" name="nama_produk"
                    placeholder="Masukkan nama produk"
                    maxlength="255"
                    value="{{ old('nama_produk') }}"
                    oninput="updateCount(this,'nama-count')">
            </div>
            <div class="field-row">
                <div class="field-label">
                    <span>Deskripsi <span class="field-req">*</span></span>
                    <span class="field-count" id="desk-count">0/3000</span>
                </div>
                <textarea class="field-input" name="deskripsi"
                    placeholder="Ceritain produkmu: kondisi, ukuran, keunggulan..."
                    maxlength="3000" rows="3"
                    style="resize:none;margin-top:4px;"
                    oninput="updateCount(this,'desk-count')">{{ old('deskripsi') }}</textarea>
            </div>
        </div>
    </div>

    {{-- Kategori --}}
    <div class="section">
        <div style="font-size:13px;color:#555;margin-bottom:8px;">Kategori <span class="field-req">*</span></div>
        @php
            $kategoriOptions = ['Skincare','Makeup','Haircare','Bodycare','Tools','Lainnya'];
        @endphp
        <div style="display:flex;flex-wrap:wrap;gap:8px;margin-bottom:1rem;">
            @foreach($kategoriOptions as $kat)
                <label style="cursor:pointer;">
                    <input type="radio" name="kategori" value="{{ $kat }}"
                        {{ old('kategori') == $kat ? 'checked' : '' }}
                        style="display:none;" class="kat-radio"
                        onchange="updateKatChip(this)">
                    <span style="display:inline-block;padding:6px 14px;border-radius:20px;font-size:13px;border:0.5px solid #eee;color:#666;background:#fff;cursor:pointer;"
                        id="kat-{{ Str::slug($kat) }}">{{ $kat }}</span>
                </label>
            @endforeach
        </div>
    </div>

    {{-- Kondisi --}}
    <div class="section">
        <div style="font-size:13px;color:#555;margin-bottom:8px;">Kondisi <span class="field-req">*</span></div>
        <div class="field-group">
            <div style="display:flex;gap:8px;padding:0.75rem 1rem;">
                @foreach(['Baru','Preloved'] as $kond)
                    <label style="flex:1;cursor:pointer;text-align:center;">
                        <input type="radio" name="kondisi" value="{{ $kond }}"
                            {{ old('kondisi', 'Baru') == $kond ? 'checked' : '' }}
                            style="display:none;" class="kond-radio"
                            onchange="updateKondisi(this)">
                        <span style="display:block;padding:8px 4px;border-radius:8px;font-size:13px;border:0.5px solid #eee;color:#666;background:#fff;"
                            id="kond-{{ strtolower($kond) }}">{{ $kond }}</span>
                    </label>
                @endforeach
            </div>
            {{-- Slider sisa produk (hanya muncul kalau preloved) --}}
            <div class="field-row" id="sisa-row" style="{{ old('kondisi','Baru') == 'Baru' ? 'display:none;' : '' }}">
                <span style="font-size:13px;color:#555;">Persentase sisa produk</span>
                <div style="display:flex;align-items:center;gap:8px;">
                    <span id="persen-val" style="font-size:13px;color:#C2617A;font-weight:500;">{{ old('persen_sisa', 70) }}%</span>
                    <input type="range" name="persen_sisa" min="10" max="100" step="10"
                        value="{{ old('persen_sisa', 70) }}"
                        oninput="document.getElementById('persen-val').textContent=this.value+'%'"
                        style="width:80px;">
                </div>
            </div>
        </div>
    </div>

    {{-- Harga & Stok --}}
    <div class="section">
        <div class="field-group">
            <div class="field-row">
                <div class="field-label"><span>Harga <span class="field-req">*</span></span></div>
                <div style="display:flex;align-items:center;gap:6px;margin-top:4px;">
                    <span style="font-size:14px;color:#888;">Rp</span>
                    <input class="field-input" type="number" name="harga"
                        placeholder="0" min="0"
                        value="{{ old('harga') }}">
                </div>
            </div>
            <div class="field-row">
                <div class="field-label"><span>Stok <span class="field-req">*</span></span></div>
                <div style="display:flex;align-items:center;gap:0;margin-top:8px;">
                    <button type="button" onclick="changeStok(-1)"
                        style="width:32px;height:32px;border:0.5px solid #eee;background:#f8f8f8;border-radius:8px 0 0 8px;font-size:16px;cursor:pointer;">−</button>
                    <input type="number" name="stok" id="stok-val"
                        value="{{ old('stok', 1) }}" min="1"
                        style="width:50px;height:32px;text-align:center;border-top:0.5px solid #eee;border-bottom:0.5px solid #eee;border-left:none;border-right:none;font-size:14px;font-family:inherit;">
                    <button type="button" onclick="changeStok(1)"
                        style="width:32px;height:32px;border:0.5px solid #eee;background:#f8f8f8;border-radius:0 8px 8px 0;font-size:16px;cursor:pointer;">+</button>
                </div>
            </div>
            <div class="field-row">
                <div class="field-label"><span>Berat produk <span class="field-req">*</span></span></div>
                <div style="display:flex;align-items:center;gap:6px;margin-top:4px;">
                    <input class="field-input" type="number" name="berat"
                        placeholder="0" min="1"
                        value="{{ old('berat') }}" style="flex:1;">
                    <span style="font-size:13px;color:#888;">gram</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Bottom buttons --}}
    <div class="bottom-btns" style="position:fixed;bottom:0;left:0;right:0;max-width:480px;margin:0 auto;">
        <a href="{{ route('seller.register.step', ['step' => 2]) }}" class="btn-back" style="display:flex;align-items:center;justify-content:center;text-decoration:none;">Kembali</a>
        <button type="submit" class="btn-next">Selesaikan</button>
    </div>
</form>

<script>
function updateCount(input, countId) {
    document.getElementById(countId).textContent = input.value.length + '/' + input.maxLength;
}
function changeStok(delta) {
    const input = document.getElementById('stok-val');
    input.value = Math.max(1, parseInt(input.value || 1) + delta);
}
function updateKondisi(radio) {
    ['baru','preloved'].forEach(k => {
        const el = document.getElementById('kond-' + k);
        const isActive = 'kond-' + k === 'kond-' + radio.value.toLowerCase();
        el.style.background   = isActive ? '#FBEAF0' : '#fff';
        el.style.color        = isActive ? '#993556' : '#666';
        el.style.borderColor  = isActive ? '#E8A0B0' : '#eee';
    });
    document.getElementById('sisa-row').style.display =
        radio.value === 'Preloved' ? '' : 'none';
}
function updateKatChip(radio) {
    document.querySelectorAll('.kat-radio').forEach(r => {
        const slug = r.value.toLowerCase().replace(/[^a-z0-9]/g, '-');
        const chip = document.getElementById('kat-' + slug);
        if (!chip) return;
        const isActive = r.checked;
        chip.style.background  = isActive ? '#FBEAF0' : '#fff';
        chip.style.color       = isActive ? '#993556' : '#666';
        chip.style.borderColor = isActive ? '#E8A0B0' : '#eee';
    });
}
function previewFoto(input) {
    if (!input.files) return;
    const container = document.getElementById('photo-previews');
    Array.from(input.files).slice(0, 9).forEach(file => {
        const reader = new FileReader();
        reader.onload = e => {
            const div = document.createElement('div');
            div.style.cssText = 'width:80px;height:80px;border-radius:8px;overflow:hidden;border:0.5px solid #eee;';
            div.innerHTML = `<img src="${e.target.result}" style="width:100%;height:100%;object-fit:cover;">`;
            container.insertBefore(div, container.querySelector('label'));
        };
        reader.readAsDataURL(file);
    });
}
// Init kondisi chips on load
document.addEventListener('DOMContentLoaded', () => {
    const checked = document.querySelector('.kond-radio:checked');
    if (checked) updateKondisi(checked);
    const checkedKat = document.querySelector('.kat-radio:checked');
    if (checkedKat) updateKatChip(checkedKat);
});
</script>
@endsection