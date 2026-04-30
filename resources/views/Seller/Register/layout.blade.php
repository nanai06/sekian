{{-- resources/views/seller/register/layout.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('page-title', 'Daftar Penjual') - AYU-NE</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: #f8f8f8;
            color: #333;
            min-height: 100vh;
        }

        /* ── Top bar ────────────────────────────── */
        .top-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 1.25rem;
            background: #fff;
            border-bottom: 0.5px solid #f0f0f0;
            position: sticky;
            top: 0;
            z-index: 100;
            max-width: 480px;
            margin: 0 auto;
        }

        .top-bar .back-arrow {
            font-size: 20px;
            color: #333;
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        .top-bar .title {
            font-size: 15px;
            font-weight: 600;
            color: #333;
        }

        .top-bar .spacer {
            width: 24px;
        }

        /* ── Step indicator ─────────────────────── */
        .step-indicator {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0;
            padding: 18px 1.25rem 14px;
            background: #fff;
            max-width: 480px;
            margin: 0 auto;
        }

        .step-dot {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 600;
            border: 2px solid #eee;
            color: #bbb;
            background: #fff;
            flex-shrink: 0;
            transition: all 0.2s;
        }

        .step-dot.active {
            border-color: #C2617A;
            color: #fff;
            background: #C2617A;
        }

        .step-dot.done {
            border-color: #C2617A;
            color: #fff;
            background: #C2617A;
        }

        .step-line {
            width: 40px;
            height: 2px;
            background: #eee;
            flex-shrink: 0;
        }

        .step-line.done {
            background: #C2617A;
        }

        /* ── Content wrapper ────────────────────── */
        .reg-wrapper {
            max-width: 480px;
            margin: 0 auto;
            background: #fff;
            min-height: calc(100vh - 110px);
            padding-bottom: 90px;
        }

        /* ── Sections & fields ──────────────────── */
        .section {
            padding: 0 1.25rem;
            margin-top: 0.75rem;
        }

        .field-group {
            background: #fff;
            border: 0.5px solid #f0f0f0;
            border-radius: 10px;
            overflow: hidden;
        }

        .field-row {
            padding: 0.75rem 1rem;
            border-bottom: 0.5px solid #f0f0f0;
        }

        .field-row:last-child {
            border-bottom: none;
        }

        .field-label {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 13px;
            color: #555;
            margin-bottom: 4px;
        }

        .field-input {
            width: 100%;
            border: none;
            outline: none;
            font-size: 14px;
            color: #333;
            font-family: 'Poppins', sans-serif;
            background: transparent;
        }

        .field-input::placeholder {
            color: #ccc;
        }

        .field-req {
            color: #C2617A;
            font-weight: 600;
        }

        .field-count {
            font-size: 11px;
            color: #bbb;
        }

        /* ── Radio rows ─────────────────────────── */
        .radio-row {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0.75rem 1rem;
            cursor: pointer;
            border-bottom: 0.5px solid #f0f0f0;
        }

        .radio-row:last-child {
            border-bottom: none;
        }

        .radio-circle {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            border: 2px solid #ddd;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: border-color 0.15s;
        }

        .radio-circle.selected {
            border-color: #C2617A;
        }

        .radio-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: #C2617A;
        }

        .radio-label {
            font-size: 14px;
            color: #333;
        }

        /* ── KTP upload ─────────────────────────── */
        .ktp-upload-wrap {
            display: flex;
            gap: 10px;
            padding: 0.75rem 1rem;
        }

        .upload-box {
            width: 68px;
            height: 68px;
            border: 1.5px dashed #E8A0B0;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            background: #FBEAF0;
            flex-shrink: 0;
        }

        .upload-plus {
            font-size: 24px;
            color: #E8A0B0;
        }

        .ktp-hint {
            font-size: 11px;
            color: #999;
            line-height: 1.5;
            padding: 0 1rem 0.75rem;
            margin: 0;
        }

        /* ── Checkbox row ───────────────────────── */
        .checkbox-row {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            padding: 1rem 1.25rem;
        }

        .checkbox-text {
            font-size: 12px;
            color: #666;
            line-height: 1.6;
            cursor: pointer;
        }

        .checkbox-link {
            color: #C2617A;
            text-decoration: none;
            font-weight: 500;
        }

        /* ── Bottom buttons ─────────────────────── */
        .bottom-btns {
            display: flex;
            gap: 10px;
            padding: 14px 1.25rem;
            background: #fff;
            border-top: 0.5px solid #f0f0f0;
        }

        .btn-back {
            flex: 1;
            padding: 12px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            font-family: 'Poppins', sans-serif;
            border: 0.5px solid #eee;
            background: #f8f8f8;
            color: #666;
            cursor: pointer;
            text-align: center;
        }

        .btn-next {
            flex: 1;
            padding: 12px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
            border: none;
            background: #C2617A;
            color: #fff;
            cursor: pointer;
            transition: background 0.15s;
        }

        .btn-next:hover {
            background: #a8506a;
        }

        /* ── Validation errors ──────────────────── */
        .validation-errors {
            padding: 0.75rem 1.25rem;
        }

        .validation-errors ul {
            background: #FFF0F0;
            border: 1px solid #FECACA;
            border-radius: 8px;
            padding: 0.75rem 1rem 0.75rem 1.75rem;
            margin: 0;
        }

        .validation-errors li {
            font-size: 12px;
            color: #B91C1C;
            line-height: 1.6;
        }

        /* ── Jasa chip active ───────────────────── */
        .jasa-chip.active {
            background: #FBEAF0 !important;
            color: #993556 !important;
            border-color: #E8A0B0 !important;
        }
    </style>
</head>
<body>

    {{-- Top bar --}}
    <div class="top-bar">
        <a href="{{ url()->previous() }}" class="back-arrow">‹</a>
        <span class="title">@yield('page-title', 'Daftar Penjual')</span>
        <span class="spacer"></span>
    </div>

    {{-- Step indicator --}}
    @php $currentStep = $step ?? 1; @endphp
    <div class="step-indicator">
        @for ($i = 1; $i <= 3; $i++)
            <div class="step-dot {{ $i < $currentStep ? 'done' : ($i == $currentStep ? 'active' : '') }}">
                @if($i < $currentStep)
                    ✓
                @else
                    {{ $i }}
                @endif
            </div>
            @if ($i < 3)
                <div class="step-line {{ $i < $currentStep ? 'done' : '' }}"></div>
            @endif
        @endfor
    </div>

    {{-- Content wrapper --}}
    <div class="reg-wrapper">

        {{-- Validation errors --}}
        @if ($errors->any())
            <div class="validation-errors">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Success flash --}}
        @if (session('success'))
            <div style="padding:0.75rem 1.25rem;">
                <div style="background:#ECFDF5;border:1px solid #6EE7B7;border-radius:8px;padding:0.75rem 1rem;font-size:12px;color:#065F46;">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @yield('content')
    </div>

</body>
</html>
