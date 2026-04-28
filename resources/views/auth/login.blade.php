<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - AYU-NE</title>

    {{-- Google Fonts: font Poppins untuk semua teks di halaman --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        /* Reset semua margin/padding bawaan browser */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        /* Background halaman: gradien pink-krem, card di tengah secara vertikal & horizontal */
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #fce4ec 0%, #fff0f3 50%, #fef9f0 100%);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Card putih utama: membungkus seluruh konten form registrasi */
        .card {
            background: white;
            border-radius: 24px;
            padding: 40px 36px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 4px 30px rgba(0,0,0,0.06);
        }

        /* Logo AYU-NE: di-center horizontal, jarak bawah ke judul */
        .logo {
            height: 36px;
            width: auto;
            object-fit: contain;
            margin: 0 auto 20px auto;
            display: block;
        }

        /* Judul step: teks berubah dinamis via JS setiap pindah step */
        h1 {
            text-align: center;
            font-size: 22px;
            font-weight: 700;
            color: #3b1a1a;
            margin-bottom: 10px;
        }

        /* ==========================================
           STEP INDICATOR
           3 bar horizontal menunjukkan progres registrasi
           Bar aktif berwarna lebih gelap (merah muda tua)
           ========================================== */
        .step-indicator {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin-bottom: 10px;
        }

        /* Bar progres: default warna pink muda */
        .step-bar {
            width: 40px;
            height: 5px;
            border-radius: 10px;
            background: #f4c0c8;
            transition: background 0.3s;
        }

        /* Bar aktif: warna pink lebih gelap */
        .step-bar.active {
            background: #e07080;
        }

        /* Label "Step X of 3" di bawah bar indikator */
        .step-label {
            text-align: center;
            font-size: 12px;
            color: #b07070;
            margin-bottom: 24px;
        }

        /* ==========================================
           STEP FORM
           Sistem multi-step: hanya step dengan class "active" yang ditampilkan
           JS mengatur class active via goToStep()
           ========================================== */
        .step {
            display: none;
        }

        .step.active {
            display: block;
        }

        /* Label input form */
        label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #3b1a1a;
            margin-bottom: 7px;
        }

        /* Wrapper input: position relative agar tombol mata bisa absolute di dalamnya */
        .input-wrapper {
            position: relative;
            margin-bottom: 10px;
        }

        /* Style semua input teks: border pink lembut, sudut bulat */
        input[type="text"],
        input[type="email"],
        input[type="date"],
        input[type="password"] {
            width: 100%;
            padding: 13px 16px;
            border: 1.5px solid #f0d5d5;
            border-radius: 12px;
            font-size: 13px;
            color: #3b1a1a;
            background: #fff;
            outline: none;
            transition: border 0.2s;
            font-family: 'Poppins', sans-serif;
        }

        /* Warna placeholder input */
        input::placeholder {
            color: #d4a0a0;
        }

        /* Border berubah warna saat input difokus */
        input:focus {
            border-color: #e8a0a8;
        }

        /* ==========================================
           TOMBOL MATA (SHOW/HIDE PASSWORD)
           Posisi absolute di kanan tengah input password
           ========================================== */
        .eye-icon {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            background: none;
            border: none;
            padding: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Wrapper ikon mata untuk password & konfirmasi password
           Animasi flip vertikal saat toggle, transform-origin ke tengah atas SVG */
        #eyeWrap1, #eyeWrap2 {
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            transform-origin: center 11px;
        }

        /* Tombol utama: full width, sudut pill, warna pink */
        .btn-main {
            width: 100%;
            padding: 14px;
            background: #f4a0aa;
            color: white;
            font-size: 15px;
            font-weight: 700;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            transition: background 0.2s;
            margin-top: 4px;
            font-family: 'Poppins', sans-serif;
        }

        /* Hover tombol: pink lebih gelap */
        .btn-main:hover {
            background: #e8858f;
        }

        /* Teks "Sudah punya akun?" di bawah tombol step 1 */
        .login-text {
            text-align: center;
            font-size: 13px;
            color: #b07070;
            margin-top: 16px;
        }

        .login-text a {
            color: #e07080;
            font-weight: 700;
            text-decoration: none;
        }

        /* ==========================================
           OTP INPUT BOXES (STEP 2)
           6 kotak input 1 karakter, auto-focus ke kotak berikutnya
           ========================================== */
        .otp-wrapper {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin: 20px 0;
        }

        /* Tiap kotak OTP: persegi, font besar, teks di tengah */
        .otp-input {
            width: 52px !important;
            height: 52px;
            text-align: center;
            font-size: 20px;
            font-weight: 700;
            border: 1.5px solid #f0d5d5;
            border-radius: 12px;
            padding: 0 !important;
            color: #3b1a1a;
        }

        .otp-input:focus {
            border-color: #e8a0a8;
        }

        /* Teks countdown "Kirim ulang kode dalam Xs" */
        .resend-text {
            text-align: center;
            font-size: 13px;
            color: #b07070;
            margin-bottom: 20px;
        }

        /* Angka countdown: bold hitam */
        .resend-text span {
            font-weight: 700;
            color: #3b1a1a;
        }

        /* ==========================================
           PASSWORD RULES (STEP 3)
           Kotak panduan syarat password dengan indikator ✓/✕
           Tiap rule berubah hijau saat syarat terpenuhi
           ========================================== */
        .password-rules {
            background: #fdf0f2;
            border-radius: 12px;
            padding: 10px 14px;
            margin-bottom: 12px;
        }

        .password-rules p {
            font-size: 12.5px;
            font-weight: 600;
            color: #3b1a1a;
            margin-bottom: 6px;
        }

        /* Satu baris rule: ikon ✕/✓ + teks syarat */
        .rule {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            color: #9a6a6a; /* Merah muda (belum terpenuhi) */
            margin-bottom: 2px;
        }

        /* Rule terpenuhi: warna berubah hijau */
        .rule.valid {
            color: #4caf50;
        }

        .rule-icon {
            font-size: 13px;
        }

        /* Pesan error validasi dari server */
        .error-message {
            background: #ffe0e3;
            color: #c0404a;
            border-radius: 10px;
            padding: 10px 14px;
            font-size: 12px;
            margin-bottom: 16px;
        }
    </style>
</head>
<body>
<div class="card">

    {{-- Logo AYU-NE di bagian atas card --}}
    <img src="{{ asset('images/AYU-NE.png') }}" alt="AYU-NE" class="logo">

    {{-- Judul step: teks diubah dinamis oleh JS array `titles` setiap pindah step --}}
    <h1 id="stepTitle">Bergabung dengan Aybies!</h1>

    {{-- ==========================================
         STEP INDICATOR
         3 bar progres; bar aktif s/d step saat ini diwarnai gelap oleh JS
         ========================================== --}}
    <div class="step-indicator">
        <div class="step-bar active" id="bar1"></div>
        <div class="step-bar" id="bar2"></div>
        <div class="step-bar" id="bar3"></div>
    </div>
    <p class="step-label" id="stepLabel">Step 1 of 3</p>

    {{-- Pesan error validasi dari server: ditampilkan jika ada error dari controller --}}
    @if($errors->any())
        <div class="error-message">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    {{-- ==========================================
         STEP 1: Data Diri
         Input: nama pengguna, email, tanggal lahir
         Tombol "Lanjutkan" → validasi JS → goToStep(2)
         ========================================== --}}
    <div class="step active" id="step1">

        <label for="name">Nama Pengguna</label>
        <div class="input-wrapper">
            {{-- old('name') → isi ulang value jika form gagal disubmit --}}
            <input type="text" id="name" placeholder="Masukkan nama pengguna" value="{{ old('name') }}">
        </div>

        <label for="email">Email</label>
        <div class="input-wrapper">
            {{-- old('email') → isi ulang value jika form gagal disubmit --}}
            <input type="email" id="email" placeholder="nama@email.com" value="{{ old('email') }}">
        </div>

        <label for="birthdate">Tanggal Lahir</label>
        <div class="input-wrapper">
            <input type="date" id="birthdate">
        </div>

        {{-- Tombol lanjut ke step 2: validasi field dulu sebelum pindah --}}
        <button type="button" class="btn-main" onclick="goToStep(2)">Lanjutkan</button>

        {{-- Link ke halaman login untuk user yang sudah punya akun --}}
        <p class="login-text">Sudah punya akun? <a href="{{ route('login') }}">Log In</a></p>
    </div>

    {{-- ==========================================
         STEP 2: Verifikasi OTP
         6 kotak input 1 digit; auto-focus ke kotak berikutnya via moveToNext()
         Countdown 60 detik untuk kirim ulang kode
         ========================================== --}}
    <div class="step" id="step2">

        <p style="text-align:center; font-size:13px; color:#9a6a6a; margin-bottom:16px;">
            Kode verifikasi telah dikirim ke email kamu
        </p>

        {{-- 6 kotak OTP: tiap input maxlength=1, auto-focus ke kotak berikutnya via oninput --}}
        <div class="otp-wrapper">
            <input class="otp-input" type="text" maxlength="1" id="otp1" oninput="moveToNext(this, 'otp2')">
            <input class="otp-input" type="text" maxlength="1" id="otp2" oninput="moveToNext(this, 'otp3')">
            <input class="otp-input" type="text" maxlength="1" id="otp3" oninput="moveToNext(this, 'otp4')">
            <input class="otp-input" type="text" maxlength="1" id="otp4" oninput="moveToNext(this, 'otp5')">
            <input class="otp-input" type="text" maxlength="1" id="otp5" oninput="moveToNext(this, 'otp6')">
            <input class="otp-input" type="text" maxlength="1" id="otp6">
        </div>

        {{-- Countdown kirim ulang: angka di-update tiap detik oleh startCountdown() --}}
        <p class="resend-text">Kirim ulang kode dalam <span id="countdown">60s</span></p>

        {{-- Tombol verifikasi: lanjut ke step 3 --}}
        <button type="button" class="btn-main" onclick="goToStep(3)">Verifikasi</button>
    </div>

    {{-- ==========================================
         STEP 3: Buat Password
         Form POST ke route register dengan data dari step sebelumnya
         via hidden input (hiddenName, hiddenEmail, hiddenBirthdate)
         ========================================== --}}
    <div class="step" id="step3">
        <form method="POST" action="{{ route('register') }}">
            {{-- Token CSRF: wajib di setiap form POST Laravel --}}
            @csrf

            {{-- Hidden input: menyimpan data dari step 1 agar ikut tersubmit --}}
            <input type="hidden" name="name"      id="hiddenName">
            <input type="hidden" name="email"     id="hiddenEmail">
            <input type="hidden" name="birthdate" id="hiddenBirthdate">

            {{-- INPUT PASSWORD
                 oninput="checkPassword()" → update strength bar & validasi rules real-time --}}
            <label for="password">Password</label>
            <div class="input-wrapper">
                <input type="password" id="password" name="password" placeholder="Masukkan password" oninput="checkPassword()">

                {{-- Tombol toggle show/hide password: animasi flip + ganti path SVG ikon --}}
                <button type="button" class="eye-icon" onclick="togglePass('password', 'eyeWrap1', 'eyePath1')">
                    <span id="eyeWrap1">
                        {{-- SVG ikon mata: path diganti dinamis oleh JS saat toggle --}}
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                            <path id="eyePath1" fill="#c9a0a0" d="M12 4.998c-3.53 0-6.539 2.005-9.5 6.243a1.5 1.5 0 0 0 0 1.516C5.461 17 8.47 19.004 12 19.004s6.539-2.005 9.5-6.243a1.5 1.5 0 0 0 0-1.516C18.539 7.003 15.53 4.998 12 4.998m0 10.006a3 3 0 1 1 0-6 3 3 0 0 1 0 6"/>
                        </svg>
                    </span>
                </button>
            </div>

            {{-- ==========================================
                 PASSWORD STRENGTH BAR
                 Bar visual kekuatan password: merah (lemah) → kuning (sedang) → hijau (kuat)
                 Lebar & warna bar di-update real-time oleh checkPassword()
                 ========================================== --}}
            <div style="margin-top: 6px; margin-bottom: 16px;">
                <div style="height: 6px; background: #f0d5d5; border-radius: 10px; overflow: hidden;">
                    <div id="strengthBar" style="height: 100%; width: 0%; border-radius: 10px; transition: all 0.4s ease;"></div>
                </div>
                {{-- Label teks kekuatan: "Lemah" / "Sedang" / "Kuat", tersembunyi jika kosong --}}
                <p id="strengthLabel" style="font-size: 10px; font-weight: 500; margin-top: 3px; color: transparent;">-</p>
            </div>

            {{-- INPUT KONFIRMASI PASSWORD
                 Tombol mata kedua (eyeWrap2/eyePath2) terpisah dari password utama --}}
            <label for="password_confirmation">Konfirmasi Password</label>
            <div class="input-wrapper">
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi password">

                {{-- Tombol toggle show/hide konfirmasi password --}}
                <button type="button" class="eye-icon" onclick="togglePass('password_confirmation', 'eyeWrap2', 'eyePath2')">
                    <span id="eyeWrap2">
                        {{-- SVG ikon mata konfirmasi password: path diganti dinamis oleh JS --}}
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                            <path id="eyePath2" fill="#c9a0a0" d="M12 4.998c-3.53 0-6.539 2.005-9.5 6.243a1.5 1.5 0 0 0 0 1.516C5.461 17 8.47 19.004 12 19.004s6.539-2.005 9.5-6.243a1.5 1.5 0 0 0 0-1.516C18.539 7.003 15.53 4.998 12 4.998m0 10.006a3 3 0 1 1 0-6 3 3 0 0 1 0 6"/>
                        </svg>
                    </span>
                </button>
            </div>

            {{-- ==========================================
                 PASSWORD RULES
                 3 syarat password; tiap rule berubah hijau + ikon ✓ saat terpenuhi
                 Diupdate real-time oleh checkPassword() via setRule()
                 ========================================== --}}
            <div class="password-rules">
                <p>Password harus mengandung:</p>
                <div class="rule" id="ruleLength">
                    <span class="rule-icon">✕</span> Minimal 8 karakter
                </div>
                <div class="rule" id="ruleNumber">
                    <span class="rule-icon">✕</span> Huruf dan angka
                </div>
                <div class="rule" id="ruleSpecial">
                    <span class="rule-icon">✕</span> Karakter unik (!@#$%^&*)
                </div>
            </div>

            {{-- Tombol submit: kirim form ke server untuk proses registrasi --}}
            <button type="submit" class="btn-main">Daftar Sekarang</button>
        </form>
    </div>

</div>

<script>
    // Judul tiap step: dipakai oleh goToStep() untuk update teks h1
    const titles = ["Bergabung dengan Aybies!", "Verifikasi Akunmu", "Buat Passwordmu"];
    let countdownInterval; // Referensi interval countdown OTP, untuk di-clear saat pindah step

    // ==========================================
    // goToStep(step): pindah ke step tertentu
    // - Step 2: validasi field step 1 dulu + mulai countdown OTP
    // - Step 3: salin data step 1 ke hidden input + hentikan countdown
    // - Update tampilan: aktifkan step, judul, label, dan bar indikator
    // ==========================================
    function goToStep(step) {
        // Validasi step 1: semua field wajib diisi
        if (step === 2) {
            const name      = document.getElementById('name').value.trim();
            const email     = document.getElementById('email').value.trim();
            const birthdate = document.getElementById('birthdate').value;
            if (!name || !email || !birthdate) {
                alert('Mohon lengkapi semua field!');
                return;
            }
            startCountdown(); // Mulai countdown 60 detik OTP
        }

        // Salin data step 1 ke hidden input agar ikut tersubmit di step 3
        if (step === 3) {
            document.getElementById('hiddenName').value      = document.getElementById('name').value;
            document.getElementById('hiddenEmail').value     = document.getElementById('email').value;
            document.getElementById('hiddenBirthdate').value = document.getElementById('birthdate').value;
            clearInterval(countdownInterval); // Hentikan countdown saat pindah ke step 3
        }

        // Sembunyikan semua step & nonaktifkan semua bar
        document.querySelectorAll('.step').forEach(s => s.classList.remove('active'));
        document.querySelectorAll('.step-bar').forEach(b => b.classList.remove('active'));

        // Tampilkan step yang dipilih + update judul & label
        document.getElementById('step' + step).classList.add('active');
        document.getElementById('stepTitle').textContent = titles[step - 1];
        document.getElementById('stepLabel').textContent = `Step ${step} of 3`;

        // Aktifkan semua bar dari bar1 sampai bar step saat ini
        for (let i = 1; i <= step; i++) {
            document.getElementById('bar' + i).classList.add('active');
        }
    }

    // ==========================================
    // moveToNext(current, nextId): auto-focus ke kotak OTP berikutnya
    // Dipanggil via oninput pada tiap input OTP
    // ==========================================
    function moveToNext(current, nextId) {
        if (current.value.length === 1 && nextId) {
            document.getElementById(nextId).focus();
        }
    }

    // ==========================================
    // startCountdown(): hitung mundur 60 detik untuk kirim ulang OTP
    // Setelah 0, teks berubah menjadi "Kirim Ulang"
    // ==========================================
    function startCountdown() {
        let seconds = 60;
        document.getElementById('countdown').textContent = seconds + 's';
        countdownInterval = setInterval(() => {
            seconds--;
            document.getElementById('countdown').textContent = seconds + 's';
            if (seconds <= 0) {
                clearInterval(countdownInterval);
                document.getElementById('countdown').textContent = 'Kirim Ulang';
            }
        }, 1000);
    }

    // Path SVG ikon mata: terbuka (password terlihat) dan tertutup (password tersembunyi)
    const iconOpen   = "M12 4.998c-3.53 0-6.539 2.005-9.5 6.243a1.5 1.5 0 0 0 0 1.516C5.461 17 8.47 19.004 12 19.004s6.539-2.005 9.5-6.243a1.5 1.5 0 0 0 0-1.516C18.539 7.003 15.53 4.998 12 4.998m0 10.006a3 3 0 1 1 0-6 3 3 0 0 1 0 6";
    const iconClosed = "M4.851 5.567L3.437 4.153L4.15 3.44l16.97 16.97l-.713.713l-2.388-2.388A10.45 10.45 0 0 1 12 19c-3.53 0-6.539-2.005-9.5-6.243a1.5 1.5 0 0 1 0-1.516a17.7 17.7 0 0 1 2.35-2.674m10.26 10.26l-1.607-1.606A3 3 0 0 1 9.111 10.13L7.647 8.666A5 5 0 0 0 12 17a4.98 4.98 0 0 0 3.11-1.173M12 5c3.53 0 6.539 2.005 9.5 6.241a1.5 1.5 0 0 1 0 1.516a17.8 17.8 0 0 1-1.9 2.348l-1.42-1.42a15.8 15.8 0 0 0 1.62-1.986C17.197 8.548 14.806 7 12 7a7.7 7.7 0 0 0-2.635.47l-1.534-1.535A10.2 10.2 0 0 1 12 5m-3.053 4.053l1.485 1.486a3 3 0 0 1 3.98 3.98l1.485 1.484A5 5 0 0 0 9 12c0-.829.207-1.61.571-2.294z";
    let isAnimating = false; // Flag pencegah double-click saat animasi toggle berjalan

    // Set ikon awal kedua tombol mata ke "tertutup" setelah DOM siap
    document.addEventListener('DOMContentLoaded', () => {
        document.getElementById('eyePath1').setAttribute('d', iconClosed);
        document.getElementById('eyePath2').setAttribute('d', iconClosed);
    });

    // ==========================================
    // togglePass(inputId, wrapId, pathId): toggle show/hide password
    // Dapat dipakai untuk input password maupun konfirmasi password
    // Animasi: ikon "menutup" (scaleY 0.08) → ganti type & path → "membuka" (scaleY 1)
    // ==========================================
    function togglePass(inputId, wrapId, pathId) {
        if (isAnimating) return; // Cegah klik ganda saat animasi berjalan
        isAnimating = true;

        const wrap  = document.getElementById(wrapId);
        const path  = document.getElementById(pathId);
        const input = document.getElementById(inputId);

        // Fase 1: ikon "menutup" selama 250ms
        wrap.style.transform = 'scaleY(0.08)';
        setTimeout(() => {
            const isNowText = input.type === 'password';

            // Ganti type input: password ↔ text
            input.type = isNowText ? 'text' : 'password';

            // Ganti path SVG ikon: terbuka ↔ tertutup
            path.setAttribute('d', isNowText ? iconOpen : iconClosed);

            // Fase 2: ikon "membuka" selama 250ms
            wrap.style.transform = 'scaleY(1)';
            setTimeout(() => { isAnimating = false; }, 250);
        }, 250);
    }

    // ==========================================
    // checkPassword(): validasi syarat password real-time
    // Update: ikon & warna tiap rule, lebar & warna strength bar, label teks kekuatan
    // Score dihitung dari jumlah syarat yang terpenuhi (0–3)
    // ==========================================
    function checkPassword() {
        const val = document.getElementById('password').value;

        const ruleLength  = document.getElementById('ruleLength');
        const ruleNumber  = document.getElementById('ruleNumber');
        const ruleSpecial = document.getElementById('ruleSpecial');
        const bar         = document.getElementById('strengthBar');
        const label       = document.getElementById('strengthLabel');

        // Cek tiap syarat dengan regex
        const hasLength  = val.length >= 8;
        const hasNumber  = /[0-9]/.test(val);
        const hasSpecial = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(val);

        // Helper: set class valid + ganti ikon ✓/✕ pada elemen rule
        function setRule(el, valid) {
            if (valid) {
                el.classList.add('valid');
                el.querySelector('.rule-icon').textContent = '✓';
            } else {
                el.classList.remove('valid');
                el.querySelector('.rule-icon').textContent = '✕';
            }
        }

        setRule(ruleLength,  hasLength);
        setRule(ruleNumber,  hasNumber);
        setRule(ruleSpecial, hasSpecial);

        // Hitung skor: berapa syarat yang terpenuhi (0–3)
        const score = [hasLength, hasNumber, hasSpecial].filter(Boolean).length;

        // Update strength bar berdasarkan skor
        if (val.length === 0) {
            // Kosong: sembunyikan bar
            bar.style.width = '0%';
            bar.style.background = 'transparent';
            label.style.color = 'transparent';
            label.textContent = '-';
        } else if (score === 1) {
            // 1 syarat: Lemah (merah)
            bar.style.width = '33%';
            bar.style.background = '#e05555';
            label.style.color = '#e05555';
            label.textContent = 'Lemah';
        } else if (score === 2) {
            // 2 syarat: Sedang (kuning)
            bar.style.width = '66%';
            bar.style.background = '#f0a500';
            label.style.color = '#f0a500';
            label.textContent = 'Sedang';
        } else if (score === 3) {
            // 3 syarat: Kuat (hijau)
            bar.style.width = '100%';
            bar.style.background = '#4caf50';
            label.style.color = '#4caf50';
            label.textContent = 'Kuat';
        }
    }
</script>
</body>
</html>