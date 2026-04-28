{{-- Library ikon Iconify: digunakan untuk ikon search, notifikasi, keranjang, avatar --}}
<script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>

<style>
    /* ==========================================
       NAVBAR
       Layout 3 kolom: kiri = logo, tengah = nav links, kanan = search + ikon
       Sticky di atas layar saat scroll (position: sticky + z-index)
       ========================================== */
    .navbar {
        display: grid;
        grid-template-columns: 1fr auto 1fr;
        align-items: center;
        padding: 0 50px;
        height: 75px;
        border-bottom: 1px solid #f5e0e0;
        background: white;
        background-image: url("{{ asset('images/frame 310(2).png') }}"); /* Gambar dekorasi background navbar */
        background-size: cover;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
        position: sticky;
        top: 0;
        z-index: 100; /* Pastikan navbar selalu di atas konten halaman */
    }

    /* Link navigasi tengah: horizontal, tanpa bullet list */
    .nav-links {
        font-size: 13px;
        display: flex;
        gap: 28px;
        list-style: none;
    }

    /* Style link nav: warna merah tua, transparan 70%, tanpa underline bawaan */
    .nav-links a {
        font-weight: 500;
        color: #7a4a4a;
        text-decoration: none;
        padding: 4px 0;
        border-bottom: 1.5px solid transparent; /* Garis bawah tersembunyi, muncul saat hover/active */
        opacity: 0.7;
        transition: all 0.2s;
    }

    /* State hover & active: warna lebih terang, garis bawah pink muncul, opacity penuh */
    .nav-links a:hover,
    .nav-links a.active {
        color: #e07080;
        border-bottom-color: #FFBBC0;
        opacity: 1;
    }

    /* Wrapper sisi kanan navbar: search box + ikon + avatar */
    .nav-right {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 18px;
    }

    /* ==========================================
       SEARCH BOX
       Input pencarian produk dengan ikon kaca pembesar
       ========================================== */
    .search-box {
        display: flex;
        align-items: center;
        gap: 8px;
        background: rgba(255,255,255,0.8);
        border: 1px solid #f5e0e0;
        border-radius: 100px;
        padding: 8px 16px;
        width: 180px;
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

    /* Warna placeholder input search */
    .search-box input::placeholder { color: #c4a0a0; }

    /* ==========================================
       IKON NAVBAR (Notifikasi & Keranjang)
       Wrapper relatif agar badge bisa diposisikan absolute di pojok atas
       ========================================== */
    .nav-icon {
        position: relative;
        cursor: pointer;
        color: #7a4a4a;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Badge merah kecil di pojok kanan atas ikon: menampilkan jumlah notif / item keranjang */
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

    /* ==========================================
       AVATAR + DROPDOWN
       Avatar lingkaran bergradien dengan ikon perempuan
       Dropdown muncul saat hover: profil + logout
       ========================================== */
    .avatar {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: linear-gradient(135deg, #ffe8ed 0%, #f5a5b6 50%, #ffdde4 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        cursor: pointer;
    }

    /* Wrapper avatar: position relative agar dropdown bisa absolute di bawahnya */
    .avatar-wrap {
        position: relative;
    }

    /* Dropdown profil: tersembunyi default, muncul saat hover .avatar-wrap */
    .user-dropdown {
        display: none;
        position: absolute;
        top: 45px;   /* Tepat di bawah avatar */
        right: 0;    /* Rata kanan dengan avatar */
        background: white;
        border: 1px solid #f5e0e0;
        border-radius: 12px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.1);
        padding: 8px;
        min-width: 160px;
        z-index: 999; /* Di atas semua konten, termasuk navbar */
    }

    /* Tampilkan dropdown saat cursor hover di atas avatar */
    .avatar-wrap:hover .user-dropdown {
        display: block;
    }
</style>

<nav class="navbar">

    {{-- KIRI: Logo AYU-NE --}}
    <img src="{{ asset('images/AYU-NE.png') }}" alt="AYU-NE" style="height: 36px; width: auto; object-fit: contain;">

    {{-- TENGAH: Link navigasi utama
         Class "active" ditambahkan secara dinamis jika route saat ini cocok --}}
    <ul class="nav-links">
        <li><a href="{{ route('dashboard') }}"       class="{{ request()->routeIs('dashboard')       ? 'active' : '' }}">Home</a></li>
        <li><a href="{{ route('ayu-belanja') }}"     class="{{ request()->routeIs('ayu-belanja')     ? 'active' : '' }}">Ayu Belanja</a></li>
        <li><a href="{{ route('ayu-daur-ulang') }}"  class="{{ request()->routeIs('ayu-daur-ulang')  ? 'active' : '' }}">Ayu Daur Ulang</a></li>
        <li><a href="{{ route('ayu-koin') }}"        class="{{ request()->routeIs('ayu-koin')        ? 'active' : '' }}">Ayu Koin</a></li>
    </ul>

    {{-- KANAN: Search box, ikon notifikasi, ikon keranjang, avatar + dropdown --}}
    <div class="nav-right">

        {{-- Search box: ikon kaca pembesar + input teks --}}
        <div class="search-box">
            <span style="color: #7a4a4a; display:flex; align-items:center;">
                <iconify-icon icon="basil:search-solid" width="20"></iconify-icon>
            </span>
            <input type="text" placeholder="Cari produk...">
        </div>

        {{-- Ikon notifikasi: badge titik merah menandakan ada notif baru
             Redirect ke halaman notifikasi --}}
        <a href="{{ route('notifikasi') }}" class="nav-icon">
            <iconify-icon icon="basil:notification-outline" width="25"></iconify-icon>
            <div class="badge">•</div>
        </a>

        {{-- Ikon keranjang belanja: badge angka menampilkan jumlah item
             Redirect ke halaman keranjang --}}
        <a href="{{ route('keranjang') }}" class="nav-icon">
            <iconify-icon icon="mynaui:cart" width="25"></iconify-icon>
            <div class="badge">2</div>
        </a>

        {{-- Avatar + Dropdown (muncul saat hover)
             Menampilkan nama user, link ke profil, dan tombol logout --}}
        <div class="avatar-wrap">

            {{-- Lingkaran avatar dengan ikon perempuan --}}
            <div class="avatar">
                <iconify-icon icon="icon-park-solid:women" width="20"></iconify-icon>
            </div>

            {{-- Dropdown profil: tampil saat hover avatar --}}
            <div class="user-dropdown">

                {{-- Nama user yang sedang login, diambil dari Auth::user() --}}
                <div style="padding: 8px 12px; font-size: 13px; color: #7a4a4a; font-weight: 600; border-bottom: 1px solid #f5e0e0;">
                    {{ Auth::user()->name }}
                </div>

                {{-- Link ke halaman edit profil --}}
                <a href="{{ route('profile.edit') }}" style="display: block; padding: 8px 12px; font-size: 13px; color: #7a4a4a; text-decoration: none;">
                    Profile
                </a>

                {{-- Form logout: POST ke route logout dengan CSRF token --}}
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" style="width: 100%; text-align: left; padding: 8px 12px; font-size: 13px; color: #e07080; background: none; border: none; cursor: pointer; font-family: 'Poppins', sans-serif;">
                        Log Out
                    </button>
                </form>

            </div>
        </div>

    </div>
</nav>