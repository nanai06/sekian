<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Penjual - AYU-NE</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body { background: #fff; color: #3b1a1a; display: flex; flex-direction: column; height: 100vh; }

        /* NAVBAR */
        .navbar {
            display: flex; align-items: center; justify-content: space-between;
            padding: 16px 40px; border-bottom: 1px solid #f5e0e0;
            background: white; flex-shrink: 0;
        }
        .nav-logo img { height: 36px; width: auto; object-fit: contain; }
        .nav-links { display: flex; gap: 36px; list-style: none; }
        .nav-links a { text-decoration: none; font-size: 14px; font-weight: 500; color: #7a4a4a; }
        .nav-links a:hover { color: #e07080; }
        .nav-right { display: flex; align-items: center; gap: 18px; }
        .search-box { display: flex; align-items: center; background: #f9f0f2; border-radius: 50px; padding: 8px 16px; gap: 8px; width: 220px; }
        .search-box input { border: none; background: transparent; outline: none; font-size: 13px; width: 100%; font-family: 'Poppins', sans-serif; }
        .search-box input::placeholder { color: #c4a0a0; }
        .nav-icon { position: relative; cursor: pointer; font-size: 20px; color: #7a4a4a; text-decoration: none; }
        .badge { position: absolute; top: -6px; right: -6px; background: #e07080; color: white; font-size: 9px; font-weight: 700; width: 16px; height: 16px; border-radius: 50%; display: flex; align-items: center; justify-content: center; }
        .avatar { width: 38px; height: 38px; border-radius: 50%; background: #f4a0aa; display: flex; align-items: center; justify-content: center; font-size: 16px; font-weight: 700; color: white; text-decoration: none; }

        /* CHAT HEADER */
        .chat-header {
            display: flex; align-items: center; gap: 14px;
            padding: 16px 24px; border-bottom: 1px solid #f5e0e0;
            background: white; flex-shrink: 0;
        }

        .back-btn {
            font-size: 20px; color: #3b1a1a; text-decoration: none;
            font-weight: 600; line-height: 1;
        }

        .seller-avatar {
            width: 44px; height: 44px; border-radius: 50%;
            background: #f4a0aa; display: flex; align-items: center;
            justify-content: center; font-size: 18px; font-weight: 700; color: white;
            flex-shrink: 0;
        }

        .seller-name { font-size: 15px; font-weight: 700; color: #3b1a1a; }

        .online-status {
            display: flex; align-items: center; gap: 5px;
            font-size: 12px; color: #4caf50; font-weight: 500;
        }

        .online-dot {
            width: 8px; height: 8px; border-radius: 50%; background: #4caf50;
        }

        /* PRODUCT CONTEXT */
        .product-context {
            display: flex; align-items: center; gap: 14px;
            padding: 14px 24px; border-bottom: 1px solid #f5e0e0;
            background: #fdf8f8; flex-shrink: 0;
        }

        .product-thumb {
            width: 48px; height: 48px; border-radius: 8px;
            background: #fce4ec; display: flex; align-items: center;
            justify-content: center; font-size: 10px; color: #c4a0a0;
            flex-shrink: 0;
        }

        .product-context-name { font-size: 13px; color: #7a4a4a; margin-bottom: 3px; }
        .product-context-price { font-size: 14px; font-weight: 700; color: #3b1a1a; }

        /* CHAT MESSAGES */
        .chat-body {
            flex: 1; overflow-y: auto; padding: 24px;
            display: flex; flex-direction: column; gap: 16px;
        }

        /* Bubble kiri (penjual) */
        .bubble-left {
            align-self: flex-start;
            max-width: 55%;
        }

        .bubble-left .bubble {
            background: #f9f0f2;
            border-radius: 0px 16px 16px 16px;
            padding: 12px 16px;
            font-size: 14px;
            color: #3b1a1a;
            line-height: 1.5;
        }

        .bubble-left .time {
            font-size: 11px; color: #b4a0a0;
            margin-top: 4px; padding-left: 4px;
        }

        /* Bubble kanan (saya) */
        .bubble-right {
            align-self: flex-end;
            max-width: 55%;
        }

        .bubble-right .bubble {
            background: #f4a0aa;
            border-radius: 16px 0px 16px 16px;
            padding: 12px 16px;
            font-size: 14px;
            color: white;
            line-height: 1.5;
        }

        .bubble-right .time {
            font-size: 11px; color: #b4a0a0;
            margin-top: 4px; text-align: right; padding-right: 4px;
        }

        /* CHAT INPUT */
        .chat-footer {
            display: flex; align-items: center; gap: 12px;
            padding: 14px 24px; border-top: 1px solid #f5e0e0;
            background: white; flex-shrink: 0;
        }

        .btn-attach {
            font-size: 22px; cursor: pointer; color: #c4a0a0;
            background: none; border: none; flex-shrink: 0;
            transition: color 0.2s;
        }

        .btn-attach:hover { color: #e07080; }

        .chat-input {
            flex: 1; padding: 12px 20px;
            border: 1.5px solid #f0d5d5; border-radius: 50px;
            font-size: 14px; color: #3b1a1a; outline: none;
            font-family: 'Poppins', sans-serif; transition: border 0.2s;
        }

        .chat-input::placeholder { color: #c4a0a0; }
        .chat-input:focus { border-color: #e8a0a8; }

        .btn-send {
            width: 42px; height: 42px; border-radius: 50%;
            background: #f4a0aa; border: none; cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            font-size: 18px; flex-shrink: 0; transition: background 0.2s;
        }

        .btn-send:hover { background: #e8858f; }
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar">
    <div class="nav-logo">
        <a href="{{ route('dashboard') }}"><img src="{{ asset('images/logo.png') }}" alt="AYU-NE"></a>
    </div>
    <ul class="nav-links">
        <li><a href="{{ route('dashboard') }}">Home</a></li>
        <li><a href="{{ route('ayu-belanja') }}">Ayu Belanja</a></li>
        <li><a href="{{ route('ayu-daur-ulang') }}">Ayu Daur Ulang</a></li>
        <li><a href="{{ route('ayu-koin') }}">Ayu Koin</a></li>
    </ul>
    <div class="nav-right">
        <div class="search-box"><span>🔍</span><input type="text" placeholder="Cari produk..."></div>
        <a href="{{ route('notifikasi') }}" class="nav-icon">🔔<div class="badge">•</div></a>
        <a href="{{ route('keranjang') }}" class="nav-icon">🛒<div class="badge">2</div></a>
        <a href="{{ route('profil') }}" class="avatar">A</a>
    </div>
</nav>

<!-- CHAT HEADER -->
<div class="chat-header">
    <a href="{{ route('detail-produk') }}" class="back-btn">←</a>
    <div class="seller-avatar">S</div>
    <div>
        <div class="seller-name">Sarah Beauty Store</div>
        <div class="online-status">
            <div class="online-dot"></div>
            Online
        </div>
    </div>
</div>

<!-- PRODUCT CONTEXT -->
<div class="product-context">
    <div class="product-thumb">Img</div>
    <div>
        <div class="product-context-name">5X Ceramide Barrier Repair Moisture Gel</div>
        <div class="product-context-price">Rp 95.000</div>
    </div>
</div>

<!-- CHAT MESSAGES -->
<div class="chat-body" id="chatBody">

    <div class="bubble-left">
        <div class="bubble">Halo kak! Masih tersedia ya?</div>
        <div class="time">10:23</div>
    </div>

    <div class="bubble-right">
        <div class="bubble">Halo! Masih ada kak, minat?</div>
        <div class="time">10:25</div>
    </div>

    <div class="bubble-left">
        <div class="bubble">Iya kak, kondisinya masih bagus?</div>
        <div class="time">10:26</div>
    </div>

</div>

<!-- CHAT INPUT -->
<div class="chat-footer">
    <button class="btn-attach">📎</button>
    <input
        type="text"
        class="chat-input"
        id="chatInput"
        placeholder="Ketik pesan..."
        onkeydown="if(event.key==='Enter') kirimPesan()"
    >
    <button class="btn-send" onclick="kirimPesan()">➤</button>
</div>

<script>
    function kirimPesan() {
        const input = document.getElementById('chatInput');
        const pesan = input.value.trim();
        if (!pesan) return;

        const chatBody = document.getElementById('chatBody');
        const now = new Date();
        const time = now.getHours().toString().padStart(2,'0') + ':' + now.getMinutes().toString().padStart(2,'0');

        const bubble = document.createElement('div');
        bubble.className = 'bubble-right';
        bubble.innerHTML = `
            <div class="bubble">${pesan}</div>
            <div class="time">${time}</div>
        `;

        chatBody.appendChild(bubble);
        input.value = '';
        chatBody.scrollTop = chatBody.scrollHeight;
    }
</script>

</body>
</html>