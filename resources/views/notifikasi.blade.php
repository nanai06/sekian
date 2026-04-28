<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi - AYU-NE</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: #fff;
            color: #3b1a1a;
        }

        /* NAVBAR */
        .navbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 40px;
            border-bottom: 1px solid #f5e0e0;
            background: white;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .nav-logo img {
            height: 36px;
            width: auto;
            object-fit: contain;
        }

        .nav-links {
            display: flex;
            gap: 36px;
            list-style: none;
        }

        .nav-links a {
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            color: #7a4a4a;
            transition: color 0.2s;
        }

        .nav-links a:hover { color: #e07080; }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 18px;
        }

        .search-box {
            display: flex;
            align-items: center;
            background: #f9f0f2;
            border-radius: 50px;
            padding: 8px 16px;
            gap: 8px;
            width: 220px;
        }

        .search-box input {
            border: none;
            background: transparent;
            outline: none;
            font-size: 13px;
            color: #3b1a1a;
            width: 100%;
            font-family: 'Poppins', sans-serif;
        }

        .search-box input::placeholder { color: #c4a0a0; }

        .nav-icon {
            position: relative;
            cursor: pointer;
            font-size: 20px;
            color: #7a4a4a;
            text-decoration: none;
        }

        .badge {
            position: absolute;
            top: -6px;
            right: -6px;
            background: #e07080;
            color: white;
            font-size: 9px;
            font-weight: 700;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: #f4a0aa;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            font-weight: 700;
            color: white;
            cursor: pointer;
            text-decoration: none;
        }

        /* CONTENT */
        .content {
            max-width: 760px;
            margin: 0 auto;
            padding: 36px 20px;
        }

        /* HEADER */
        .notif-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 28px;
        }

        .notif-title {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .back-btn {
            font-size: 20px;
            color: #3b1a1a;
            text-decoration: none;
            font-weight: 600;
        }

        .notif-title h1 {
            font-size: 22px;
            font-weight: 800;
            color: #3b1a1a;
        }

        .tandai-semua {
            font-size: 13px;
            color: #e07080;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            background: none;
            border: none;
            font-family: 'Poppins', sans-serif;
        }

        .tandai-semua:hover { opacity: 0.7; }

        /* GROUP LABEL */
        .group-label {
            font-size: 11px;
            font-weight: 700;
            color: #9a6a6a;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            background: #fdf0f2;
            padding: 8px 16px;
            border-radius: 8px;
            margin-bottom: 4px;
            margin-top: 8px;
        }

        /* NOTIF ITEM */
        .notif-item {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 16px 12px;
            border-bottom: 1px solid #f5e0e0;
            cursor: pointer;
            transition: background 0.15s;
            border-radius: 10px;
        }

        .notif-item:hover { background: #fdf8f8; }

        .notif-item.unread { background: #fff5f6; }

        .notif-icon-wrap {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: #fdf0f2;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
            border: 1.5px solid #f5e0e0;
        }

        .notif-info {
            flex: 1;
        }

        .notif-judul {
            font-size: 14px;
            font-weight: 700;
            color: #3b1a1a;
            margin-bottom: 3px;
        }

        .notif-desc {
            font-size: 12.5px;
            color: #7a4a4a;
        }

        .notif-right {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-shrink: 0;
        }

        .notif-time {
            font-size: 12px;
            color: #b4a0a0;
        }

        .notif-arrow {
            font-size: 14px;
            color: #c4a0a0;
        }
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar">
    <div class="nav-logo">
        <a href="{{ route('dashboard') }}">
            <img src="{{ asset('images/AYU-NE.png') }}" alt="AYU-NE" style="height: 36px; width: auto; object-fit: contain;">
        </a>
    </div>
    <ul class="nav-links">
        <li><a href="{{ route('dashboard') }}">Home</a></li>
        <li><a href="{{ route('ayu-belanja') }}">Ayu Belanja</a></li>
        <li><a href="{{ route('ayu-daur-ulang') }}">Ayu Daur Ulang</a></li>
        <li><a href="{{ route('ayu-koin') }}">Ayu Koin</a></li>
    </ul>
    <div class="nav-right">
        <div class="search-box">
            <span>🔍</span>
            <input type="text" placeholder="Cari produk...">
        </div>
        <a href="{{ route('notifikasi') }}" class="nav-icon">🔔<div class="badge">•</div></a>
        <a href="{{ route('keranjang') }}" class="nav-icon">🛒<div class="badge">2</div></a>
        <a href="{{ route('profil') }}" class="avatar">A</a>
    </div>
</nav>

<!-- CONTENT -->
<div class="content">

    <!-- HEADER -->
    <div class="notif-header">
        <div class="notif-title">
            <a href="{{ route('dashboard') }}" class="back-btn">←</a>
            <h1>Notifikasi</h1>
        </div>
        <button class="tandai-semua" onclick="tandaiSemua()">Tandai Semua Dibaca</button>
    </div>

    <!-- HARI INI -->
    <div class="group-label">Hari Ini</div>

    <div class="notif-item unread" id="notif1">
        <div class="notif-icon-wrap">⭐</div>
        <div class="notif-info">
            <div class="notif-judul">Misi Ayu Baru!</div>
            <div class="notif-desc">Lakukan dan dapatkan Ayu Koin!</div>
        </div>
        <div class="notif-right">
            <span class="notif-time">1 Jam</span>
            <span class="notif-arrow">›</span>
        </div>
    </div>

    <div class="notif-item" id="notif2">
        <div class="notif-icon-wrap">🤍</div>
        <div class="notif-info">
            <div class="notif-judul">Postingan Anda!</div>
            <div class="notif-desc">AkmalCipularang menyukai postingan Anda</div>
        </div>
        <div class="notif-right">
            <span class="notif-time">10 Jam</span>
            <span class="notif-arrow">›</span>
        </div>
    </div>

    <!-- KEMARIN -->
    <div class="group-label">Kemarin</div>

    <div class="notif-item" id="notif3">
        <div class="notif-icon-wrap">➕</div>
        <div class="notif-info">
            <div class="notif-judul">Barangmu sudah diterima!</div>
            <div class="notif-desc">Donasimu telah sampai ke tangan yang tepat.</div>
        </div>
        <div class="notif-right">
            <span class="notif-time">12 Jam</span>
            <span class="notif-arrow">›</span>
        </div>
    </div>

    <div class="notif-item" id="notif4">
        <div class="notif-icon-wrap">⭐</div>
        <div class="notif-info">
            <div class="notif-judul">Misi Ayu Baru!</div>
            <div class="notif-desc">Lakukan dan dapatkan Ayu Koin!</div>
        </div>
        <div class="notif-right">
            <span class="notif-time">13 Jam</span>
            <span class="notif-arrow">›</span>
        </div>
    </div>

    <!-- KAMIS 13 JULI 2025 -->
    <div class="group-label">Kamis, 13 Juli 2025</div>

    <div class="notif-item" id="notif5">
        <div class="notif-icon-wrap">🛍️</div>
        <div class="notif-info">
            <div class="notif-judul">Pesanan Dikirim!</div>
            <div class="notif-desc">Pesananmu sedang dalam perjalanan</div>
        </div>
        <div class="notif-right">
            <span class="notif-time">2 hari</span>
            <span class="notif-arrow">›</span>
        </div>
    </div>

    <div class="notif-item" id="notif6">
        <div class="notif-icon-wrap">🪙</div>
        <div class="notif-info">
            <div class="notif-judul">50 Ayu Koin Diterima!</div>
            <div class="notif-desc">Terima kasih sudah mendaur ulang</div>
        </div>
        <div class="notif-right">
            <span class="notif-time">3 hari</span>
            <span class="notif-arrow">›</span>
        </div>
    </div>

</div>

<script>
    function tandaiSemua() {
        document.querySelectorAll('.notif-item.unread').forEach(el => {
            el.classList.remove('unread');
        });
    }
</script>

</body>
</html>