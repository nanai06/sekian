<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - AYU-NE</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #fce4ec 0%, #fff0f3 50%, #fef9f0 100%);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card {
            background: white;
            border-radius: 24px;
            padding: 40px 36px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 4px 30px rgba(0,0,0,0.06);
        }

        .logo {
            height: 36px;
            width: auto;
            object-fit: contain;
            margin: 0 auto 20px auto;
            display: block;
        }
        
        h1 {
            text-align: center;
            font-size: 22px;
            font-weight: 700;
            color: #3b1a1a;
            margin-bottom: 10px;
        }

        /* STEP INDICATOR */
        .step-indicator {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin-bottom: 10px;
        }

        .step-bar {
            width: 40px;
            height: 5px;
            border-radius: 10px;
            background: #f4c0c8;
            transition: background 0.3s;
        }

        .step-bar.active {
            background: #e07080;
        }

        .step-label {
            text-align: center;
            font-size: 12px;
            color: #b07070;
            margin-bottom: 24px;
        }

        /* FORM */
        .step {
            display: none;
        }

        .step.active {
            display: block;
        }

        label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #3b1a1a;
            margin-bottom: 7px;
        }

        .input-wrapper {
            position: relative;
            margin-bottom: 18px;
        }

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

        input::placeholder {
            color: #d4a0a0;
        }

        input:focus {
            border-color: #e8a0a8;
        }

        .eye-icon {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #c9a0a0;
            font-size: 16px;
            background: none;
            border: none;
        }

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

        .btn-main:hover {
            background: #e8858f;
        }

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

        /* OTP BOXES */
        .otp-wrapper {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin: 20px 0;
        }

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

        .resend-text {
            text-align: center;
            font-size: 13px;
            color: #b07070;
            margin-bottom: 20px;
        }

        .resend-text span {
            font-weight: 700;
            color: #3b1a1a;
        }

        /* PASSWORD RULES */
        .password-rules {
            background: #fdf0f2;
            border-radius: 12px;
            padding: 14px 18px;
            margin-bottom: 20px;
        }

        .password-rules p {
            font-size: 12.5px;
            font-weight: 600;
            color: #3b1a1a;
            margin-bottom: 8px;
        }

        .rule {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            color: #9a6a6a;
            margin-bottom: 4px;
        }

        .rule.valid {
            color: #4caf50;
        }

        .rule-icon {
            font-size: 13px;
        }

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

    <img src="{{ asset('images/AYU-NE.png') }}" alt="AYU-NE" class="logo">
    <h1 id="stepTitle">Bergabung dengan Aybies!</h1>

    <!-- Step Indicator -->
    <div class="step-indicator">
        <div class="step-bar active" id="bar1"></div>
        <div class="step-bar" id="bar2"></div>
        <div class="step-bar" id="bar3"></div>
    </div>
    <p class="step-label" id="stepLabel">Step 1 of 3</p>

    @if($errors->any())
        <div class="error-message">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <!-- STEP 1: Data Diri -->
    <div class="step active" id="step1">
        <label for="name">Nama Pengguna</label>
        <div class="input-wrapper">
            <input type="text" id="name" placeholder="Masukkan nama pengguna" value="{{ old('name') }}">
        </div>

        <label for="email">Email</label>
        <div class="input-wrapper">
            <input type="email" id="email" placeholder="nama@email.com" value="{{ old('email') }}">
        </div>

        <label for="birthdate">Tanggal Lahir</label>
        <div class="input-wrapper">
            <input type="date" id="birthdate">
        </div>

        <button type="button" class="btn-main" onclick="goToStep(2)">Lanjutkan</button>

        <p class="login-text">Sudah punya akun? <a href="{{ route('login') }}">Log In</a></p>
    </div>

    <!-- STEP 2: Verifikasi OTP -->
    <div class="step" id="step2">
        <p style="text-align:center; font-size:13px; color:#9a6a6a; margin-bottom:16px;">
            Kode verifikasi telah dikirim ke email kamu
        </p>

        <div class="otp-wrapper">
            <input class="otp-input" type="text" maxlength="1" id="otp1" oninput="moveToNext(this, 'otp2')">
            <input class="otp-input" type="text" maxlength="1" id="otp2" oninput="moveToNext(this, 'otp3')">
            <input class="otp-input" type="text" maxlength="1" id="otp3" oninput="moveToNext(this, 'otp4')">
            <input class="otp-input" type="text" maxlength="1" id="otp4" oninput="moveToNext(this, 'otp5')">
            <input class="otp-input" type="text" maxlength="1" id="otp5" oninput="moveToNext(this, 'otp6')">
            <input class="otp-input" type="text" maxlength="1" id="otp6">
        </div>

        <p class="resend-text">Kirim ulang kode dalam <span id="countdown">60s</span></p>

        <button type="button" class="btn-main" onclick="goToStep(3)">Verifikasi</button>
    </div>

    <!-- STEP 3: Buat Password -->
    <div class="step" id="step3">
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <input type="hidden" name="name" id="hiddenName">
            <input type="hidden" name="email" id="hiddenEmail">
            <input type="hidden" name="birthdate" id="hiddenBirthdate">

            <label for="password">Password</label>
<div class="input-wrapper">
    <input type="password" id="password" name="password" placeholder="Masukkan password" oninput="checkPassword()">
    <button type="button" class="eye-icon" onclick="togglePass('password')">👁</button>
</div>

<div style="margin-top: -10px; margin-bottom: 16px;">
    <div style="height: 6px; background: #f0d5d5; border-radius: 10px; overflow: hidden;">
        <div id="strengthBar" style="height: 100%; width: 0%; border-radius: 10px; transition: all 0.4s ease;"></div>
    </div>
    <p id="strengthLabel" style="font-size: 12px; font-weight: 600; margin-top: 5px; color: transparent;">-</p>
</div>

<label for="password_confirmation">Konfirmasi Password</label>
<div class="input-wrapper">
    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi password">
    <button type="button" class="eye-icon" onclick="togglePass('password_confirmation')">👁</button>
</div>

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

            <button type="submit" class="btn-main">Daftar Sekarang</button>
        </form>
    </div>

</div>

<script>
    const titles = ["Bergabung dengan Aybies!", "Verifikasi Akunmu", "Buat Passwordmu"];
    let countdownInterval;

    function goToStep(step) {
        // Validasi step 1
        if (step === 2) {
            const name = document.getElementById('name').value.trim();
            const email = document.getElementById('email').value.trim();
            const birthdate = document.getElementById('birthdate').value;
            if (!name || !email || !birthdate) {
                alert('Mohon lengkapi semua field!');
                return;
            }
            startCountdown();
        }

        // Simpan data ke hidden input sebelum submit
        if (step === 3) {
            document.getElementById('hiddenName').value = document.getElementById('name').value;
            document.getElementById('hiddenEmail').value = document.getElementById('email').value;
            document.getElementById('hiddenBirthdate').value = document.getElementById('birthdate').value;
            clearInterval(countdownInterval);
        }

        // Hide semua step
        document.querySelectorAll('.step').forEach(s => s.classList.remove('active'));
        document.querySelectorAll('.step-bar').forEach(b => b.classList.remove('active'));

        // Show step yang dipilih
        document.getElementById('step' + step).classList.add('active');
        document.getElementById('stepTitle').textContent = titles[step - 1];
        document.getElementById('stepLabel').textContent = `Step ${step} of 3`;

        // Aktifkan bar sampai step saat ini
        for (let i = 1; i <= step; i++) {
            document.getElementById('bar' + i).classList.add('active');
        }
    }

    function moveToNext(current, nextId) {
        if (current.value.length === 1 && nextId) {
            document.getElementById(nextId).focus();
        }
    }

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

    function togglePass(id) {
        const input = document.getElementById(id);
        input.type = input.type === 'password' ? 'text' : 'password';
    }

function checkPassword() {
    const val = document.getElementById('password').value;

    const ruleLength  = document.getElementById('ruleLength');
    const ruleNumber  = document.getElementById('ruleNumber');
    const ruleSpecial = document.getElementById('ruleSpecial');
    const bar         = document.getElementById('strengthBar');
    const label       = document.getElementById('strengthLabel');

    const hasLength  = val.length >= 8;
    const hasNumber  = /[0-9]/.test(val);
    const hasSpecial = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(val);

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

    const score = [hasLength, hasNumber, hasSpecial].filter(Boolean).length;

    if (val.length === 0) {
        bar.style.width = '0%';
        bar.style.background = 'transparent';
        label.style.color = 'transparent';
        label.textContent = '-';
    } else if (score === 1) {
        bar.style.width = '33%';
        bar.style.background = '#e05555';
        label.style.color = '#e05555';
        label.textContent = 'Lemah';
    } else if (score === 2) {
        bar.style.width = '66%';
        bar.style.background = '#f0a500';
        label.style.color = '#f0a500';
        label.textContent = 'Sedang';
    } else if (score === 3) {
        bar.style.width = '100%';
        bar.style.background = '#4caf50';
        label.style.color = '#4caf50';
        label.textContent = 'Kuat';
    }
}
</script>
</body>
</html>