{{-- resources/views/seller/register/step2.blade.php --}}
@extends('seller.register.layout')

@section('page-title', 'Informasi Toko')
@section('form-id', 'form-step2')

@section('content')
<form id="form-step2"
      action="{{ route('seller.register.step2.store') }}"
      method="POST">
    @csrf

    {{-- Info toko --}}
    <div class="section" style="margin-top:0.75rem;">
        <div class="field-group">
            <div class="field-row">
                <div class="field-label">
                    <span>Nama Toko <span class="field-req">*</span></span>
                    <span class="field-count" id="nama-toko-count">{{ strlen(old('nama_toko', $store?->nama_toko ?? '')) }}/30</span>
                </div>
                <input class="field-input" type="text" name="nama_toko"
                    placeholder="Masukkan nama toko"
                    maxlength="30"
                    value="{{ old('nama_toko', $store?->nama_toko) }}"
                    oninput="updateCount(this, 'nama-toko-count')">
            </div>
            <div class="field-row">
                <div class="field-label"><span>Email Toko</span></div>
                <input class="field-input" type="email" name="email_toko"
                    placeholder="Masukkan email toko (opsional)"
                    value="{{ old('email_toko', $store?->email_toko) }}">
            </div>
            <div class="field-row">
                <div class="field-label"><span>Nomor HP <span class="field-req">*</span></span></div>
                <input class="field-input" type="tel" name="nomor_hp"
                    placeholder="+62 xxx xxxx xxxx"
                    value="{{ old('nomor_hp', $store?->nomor_hp) }}">
            </div>
        </div>
    </div>

    {{-- Jasa pengiriman --}}
    <div class="section">
        <div style="font-size:13px;color:#555;margin-bottom:8px;">Jasa Pengiriman <span class="field-req">*</span></div>
        @php
            $selectedJasa = old('jasa_pengiriman', $store?->jasa_pengiriman ?? []);
            $jasaOptions  = ['JNE', 'J&T', 'SiCepat', 'Anteraja', 'GoSend', 'Pos Indonesia'];
        @endphp
        <div style="display:flex;flex-wrap:wrap;gap:8px;margin-bottom:1rem;">
            @foreach($jasaOptions as $jasa)
                <label style="cursor:pointer;">
                    <input type="checkbox" name="jasa_pengiriman[]" value="{{ $jasa }}"
                        {{ in_array($jasa, $selectedJasa) ? 'checked' : '' }}
                        style="display:none;" class="jasa-check"
                        onchange="updateJasaChip(this)">
                    <span class="jasa-chip {{ in_array($jasa, $selectedJasa) ? 'active' : '' }}"
                        style="display:inline-block;padding:6px 14px;border-radius:20px;font-size:13px;border:0.5px solid #eee;color:#666;background:#fff;cursor:pointer;transition:all .15s;"
                        id="chip-{{ Str::slug($jasa) }}">
                        {{ $jasa }}
                    </span>
                </label>
            @endforeach
        </div>
    </div>

    {{-- Alamat toko --}}
    <div class="section">
        <div style="font-size:13px;color:#555;margin-bottom:8px;font-weight:500;">Alamat Toko <span class="field-req">*</span></div>
        @php $addr = $store?->primaryAddress(); @endphp
        <div class="field-group">
            <div class="field-row">
                <div class="field-label"><span>Nama penerima <span class="field-req">*</span></span></div>
                <input class="field-input" type="text" name="nama_penerima"
                    placeholder="Nama penerima paket"
                    value="{{ old('nama_penerima', $addr?->nama_penerima) }}">
            </div>
            <div class="field-row">
                <div class="field-label"><span>No. HP penerima <span class="field-req">*</span></span></div>
                <input class="field-input" type="tel" name="no_hp_alamat"
                    placeholder="+62 xxx xxxx xxxx"
                    value="{{ old('no_hp_alamat', $addr?->no_hp) }}">
            </div>
            <div class="field-row">
                <div class="field-label"><span>Alamat lengkap <span class="field-req">*</span></span></div>
                <textarea class="field-input" name="alamat_lengkap"
                    placeholder="Nama jalan, nomor rumah, RT/RW, kelurahan..."
                    rows="2"
                    style="resize:none;margin-top:4px;">{{ old('alamat_lengkap', $addr?->alamat_lengkap) }}</textarea>
            </div>
            <div class="field-row">
                <div class="field-label"><span>Kecamatan <span class="field-req">*</span></span></div>
                <input class="field-input" type="text" name="kecamatan"
                    placeholder="Kecamatan"
                    value="{{ old('kecamatan', $addr?->kecamatan) }}">
            </div>
            <div style="display:grid;grid-template-columns:1fr 1fr;border-top:0.5px solid #f0f0f0;">
                <div class="field-row" style="border-right:0.5px solid #f0f0f0;border-bottom:none;">
                    <div class="field-label"><span>Kota <span class="field-req">*</span></span></div>
                    <input class="field-input" type="text" name="kota"
                        placeholder="Kota/Kabupaten"
                        value="{{ old('kota', $addr?->kota) }}">
                </div>
                <div class="field-row" style="border-bottom:none;">
                    <div class="field-label"><span>Kode pos <span class="field-req">*</span></span></div>
                    <input class="field-input" type="text" name="kode_pos"
                        placeholder="00000" maxlength="10" inputmode="numeric"
                        value="{{ old('kode_pos', $addr?->kode_pos) }}">
                </div>
            </div>
            <div class="field-row">
                <div class="field-label"><span>Provinsi <span class="field-req">*</span></span></div>
                <input class="field-input" type="text" name="provinsi"
                    placeholder="Provinsi"
                    value="{{ old('provinsi', $addr?->provinsi) }}">
            </div>
        </div>
    </div>

    <div style="margin:0.75rem 1.25rem;padding:0.75rem 1rem;background:#FBEAF0;border:0.5px solid #E8A0B0;border-radius:8px;">
        <p style="font-size:12px;color:#8B3A4F;line-height:1.5;margin:0;">Alamat toko digunakan untuk menentukan ongkos kirim ke pembeli. Pastikan alamat akurat ya!</p>
    </div>

    {{-- Bottom buttons --}}
    <div class="bottom-btns" style="position:fixed;bottom:0;left:0;right:0;max-width:480px;margin:0 auto;">
        <a href="{{ route('seller.register.step', ['step' => 1]) }}" class="btn-back" style="display:flex;align-items:center;justify-content:center;text-decoration:none;">Kembali</a>
        <button type="submit" class="btn-next">Lanjut</button>
    </div>
</form>

<script>
function updateCount(input, countId) {
    document.getElementById(countId).textContent = input.value.length + '/' + input.maxLength;
}
function updateJasaChip(checkbox) {
    const slug  = checkbox.value.replace(/[^a-z0-9]/gi, '-').toLowerCase();
    const chip  = document.getElementById('chip-' + slug);
    if (!chip) return;
    if (checkbox.checked) {
        chip.style.background    = '#FBEAF0';
        chip.style.color         = '#993556';
        chip.style.borderColor   = '#E8A0B0';
    } else {
        chip.style.background    = '#fff';
        chip.style.color         = '#666';
        chip.style.borderColor   = '#eee';
    }
}
</script>
@endsection