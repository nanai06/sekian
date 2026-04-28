<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja - AYU-NE</title>
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
            padding: 36px 40px;
            display: flex;
            gap: 28px;
            align-items: flex-start;
        }

        /* LEFT: CART ITEMS */
        .cart-left {
            flex: 1;
        }

        h1 {
            font-size: 24px;
            font-weight: 800;
            color: #3b1a1a;
            margin-bottom: 24px;
        }

        .cart-item {
            display: flex;
            align-items: center;
            gap: 20px;
            padding: 20px;
            border: 1px solid #f5e0e0;
            border-radius: 16px;
            margin-bottom: 14px;
            transition: box-shadow 0.2s;
        }

        .cart-item:hover {
            box-shadow: 0 4px 16px rgba(224,112,128,0.08);
        }

        .item-photo {
            width: 80px;
            height: 80px;
            border-radius: 12px;
            background: #fdf0f2;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            color: #c4a0a0;
            text-align: center;
            line-height: 1.4;
            flex-shrink: 0;
        }

        .item-info {
            flex: 1;
        }

        .item-name {
            font-size: 15px;
            font-weight: 700;
            color: #3b1a1a;
            margin-bottom: 4px;
        }

        .item-brand {
            font-size: 11px;
            color: #9a6a6a;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }

        .item-price {
            font-size: 15px;
            font-weight: 700;
            color: #3b1a1a;
        }

        .item-right {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 16px;
        }

        .btn-delete {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 18px;
            color: #e07080;
            padding: 0;
        }

        .qty-wrap {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .qty-btn {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            border: 1.5px solid #f0d5d5;
            background: white;
            font-size: 16px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #7a4a4a;
            font-family: 'Poppins', sans-serif;
            transition: all 0.2s;
        }

        .qty-btn:hover {
            border-color: #f4a0aa;
            color: #e07080;
        }

        .qty-num {
            font-size: 15px;
            font-weight: 600;
            color: #3b1a1a;
            min-width: 20px;
            text-align: center;
        }

        /* RIGHT: SUMMARY */
        .cart-right {
            width: 320px;
            flex-shrink: 0;
        }

        .summary-box {
            border: 1px solid #f5e0e0;
            border-radius: 16px;
            padding: 24px;
        }

        .summary-title {
            font-size: 17px;
            font-weight: 700;
            color: #3b1a1a;
            margin-bottom: 20px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 14px;
            color: #7a4a4a;
            margin-bottom: 12px;
        }

        .summary-divider {
            border: none;
            border-top: 1px solid #f5e0e0;
            margin: 16px 0;
        }

        .summary-total {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 16px;
            font-weight: 700;
            color: #3b1a1a;
            margin-bottom: 20px;
        }

        .btn-checkout {
            width: 100%;
            padding: 14px;
            background: #f4a0aa;
            color: white;
            border: none;
            border-radius: 50px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
            transition: background 0.2s;
        }

        .btn-checkout:hover { background: #e8858f; }
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
        <a href="{{ route('keranjang') }}" class="nav-icon">🛒<div class="badge" id="cartBadge">2</div></a>
        <a href="{{ route('profil') }}" class="avatar">A</a>
    </div>
</nav>

<!-- CONTENT -->
<div class="content">

    <!-- LEFT -->
    <div class="cart-left">
        <h1>Keranjang Belanja</h1>

        <!-- Item 1 -->
        <div class="cart-item" id="item1">
            <div class="item-photo">Product<br>Photo</div>
            <div class="item-info">
                <div class="item-name">5X Ceramide Barrier Repair Moisture Gel</div>
                <div class="item-brand">Skintific</div>
                <div class="item-price" id="price1">Rp 95.000</div>
            </div>
            <div class="item-right">
                <button class="btn-delete" onclick="hapusItem('item1')">🗑️</button>
                <div class="qty-wrap">
                    <button class="qty-btn" onclick="kurang(1, 95000)">−</button>
                    <span class="qty-num" id="qty1">1</span>
                    <button class="qty-btn" onclick="tambah(1, 95000)">+</button>
                </div>
            </div>
        </div>

        <!-- Item 2 -->
        <div class="cart-item" id="item2">
            <div class="item-photo">Product<br>Photo</div>
            <div class="item-info">
                <div class="item-name">Holyshield Sunscreen SPF 50</div>
                <div class="item-brand">Somethinc</div>
                <div class="item-price" id="price2">Rp 75.000</div>
            </div>
            <div class="item-right">
                <button class="btn-delete" onclick="hapusItem('item2')">🗑️</button>
                <div class="qty-wrap">
                    <button class="qty-btn" onclick="kurang(2, 75000)">−</button>
                    <span class="qty-num" id="qty2">1</span>
                    <button class="qty-btn" onclick="tambah(2, 75000)">+</button>
                </div>
            </div>
        </div>
    </div>

    <!-- RIGHT -->
    <div class="cart-right">
        <div class="summary-box">
            <div class="summary-title">Ringkasan Belanja</div>
            <div class="summary-row">
                <span>Subtotal</span>
                <span id="subtotal">Rp 170.000</span>
            </div>
            <div class="summary-row">
                <span>Estimasi Ongkir</span>
                <span>Rp 15.000</span>
            </div>
            <hr class="summary-divider">
            <div class="summary-total">
                <span>Total</span>
                <span id="total">Rp 185.000</span>
            </div>
            <a href="{{ route('checkout') }}" class="btn-checkout" style="display:block; text-align:center; text-decoration:none;">Lanjut ke Checkout</a>
        </div>
    </div>

</div>

<script>
    const harga = { 1: 95000, 2: 75000 };
    const ongkir = 15000;

    function formatRp(num) {
        return 'Rp ' + num.toLocaleString('id-ID');
    }

    function updateTotal() {
        let subtotal = 0;
        [1, 2].forEach(i => {
            const item = document.getElementById('item' + i);
            if (item && item.style.display !== 'none') {
                const qty = parseInt(document.getElementById('qty' + i).textContent);
                subtotal += harga[i] * qty;
            }
        });
        document.getElementById('subtotal').textContent = formatRp(subtotal);
        document.getElementById('total').textContent = formatRp(subtotal + ongkir);
    }

    function tambah(id, h) {
        const el = document.getElementById('qty' + id);
        el.textContent = parseInt(el.textContent) + 1;
        updateTotal();
    }

    function kurang(id, h) {
        const el = document.getElementById('qty' + id);
        const val = parseInt(el.textContent);
        if (val > 1) {
            el.textContent = val - 1;
            updateTotal();
        }
    }

    function hapusItem(itemId) {
        const item = document.getElementById(itemId);
        item.style.display = 'none';
        updateTotal();
    }
</script>

</body>
</html>
