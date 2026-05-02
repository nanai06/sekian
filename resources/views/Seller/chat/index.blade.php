<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.iconify.design/iconify-icon/2.1.0/iconify-icon.min.js"></script>
    <title>Chat Pembeli - AYU-NE</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --pk: #639922; --pk2: #4a7a1e; --pk-light: #eaf3de;
            --border: #c5e0a0; --text: #2d5016; --text2: #5a7a40;
        }
        * { margin:0; padding:0; box-sizing:border-box; font-family:'Poppins',sans-serif; }
        body { background:linear-gradient(180deg,#e8f5e0 0%,#f5fff5 50%,#e8f5e0 100%); color:var(--text); }
        .page { max-width:720px; margin:0 auto; padding:30px 40px 60px; }
        .breadcrumb { font-size:12px; color:var(--text2); margin-bottom:4px; }
        .breadcrumb a { color:var(--pk); text-decoration:none; }
        .page-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; }
        .page-title { font-size:24px; font-weight:800; }
        .page-title span { color:var(--pk); }
        .btn-back {
            display:inline-flex; align-items:center; gap:6px;
            padding:9px 18px; border:1.5px solid var(--border);
            border-radius:10px; font-size:13px; font-weight:600;
            color:var(--text2); background:white; text-decoration:none; transition:all 0.2s;
        }
        .btn-back:hover { border-color:var(--pk); color:var(--pk); }

        /* SEARCH */
        .search-bar {
            display:flex; align-items:center; gap:10px;
            background:white; border:1.5px solid var(--border); border-radius:12px;
            padding:10px 16px; margin-bottom:16px;
        }
        .search-bar input {
            flex:1; border:none; outline:none; font-size:13px;
            font-family:'Poppins',sans-serif; color:var(--text); background:transparent;
        }
        .search-bar input::placeholder { color:#9ab87a; }

        /* CHAT LIST */
        .chat-list {
            background:white; border:1px solid var(--border); border-radius:16px;
            overflow:hidden; box-shadow:0 2px 12px rgba(99,153,34,0.06);
        }
        .chat-room {
            display:flex; align-items:center; gap:14px;
            padding:16px 20px; border-bottom:0.5px solid #e8f3de;
            text-decoration:none; color:var(--text); transition:background 0.15s;
            cursor:pointer;
        }
        .chat-room:last-child { border-bottom:none; }
        .chat-room:hover { background:#f9fdf5; }

        .room-avatar {
            width:48px; height:48px; border-radius:50%;
            background:linear-gradient(135deg, #d4eab8, #a5d791);
            display:flex; align-items:center; justify-content:center;
            font-size:16px; font-weight:700; color:var(--pk2); flex-shrink:0;
            position:relative;
        }
        .online-dot {
            position:absolute; bottom:2px; right:2px;
            width:10px; height:10px; border-radius:50%;
            background:#4CAF7D; border:2px solid white;
        }

        .room-info { flex:1; min-width:0; }
        .room-name { font-size:14px; font-weight:600; color:var(--text); }
        .room-preview {
            font-size:12px; color:var(--text2); margin-top:2px;
            white-space:nowrap; overflow:hidden; text-overflow:ellipsis;
        }

        .room-meta { display:flex; flex-direction:column; align-items:flex-end; gap:4px; flex-shrink:0; }
        .room-time { font-size:10px; color:#9ab87a; }
        .room-badge {
            background:var(--pk); color:white; font-size:9px; font-weight:700;
            width:18px; height:18px; border-radius:50%;
            display:flex; align-items:center; justify-content:center;
        }

        /* EMPTY */
        .empty { text-align:center; padding:60px 20px; }
        .empty-text { font-size:15px; font-weight:700; margin-top:12px; }
        .empty-sub { font-size:13px; color:var(--text2); margin-top:4px; line-height:1.6; }
    </style>
</head>
<body>

    <div class="page">
        <div class="page-header">
            <div>
                <div class="breadcrumb">
                    <a href="{{ route('profil') }}">Profil</a> /
                    <a href="{{ route('seller.dashboard') }}">Dashboard</a> /
                    Chat Pembeli
                </div>
                <div class="page-title">Chat <span>Pembeli</span></div>
            </div>
            <a href="{{ route('seller.dashboard') }}" class="btn-back">
                <iconify-icon icon="solar:arrow-left-linear" width="15"></iconify-icon>
                Kembali
            </a>
        </div>

        {{-- SEARCH --}}
        <div class="search-bar">
            <iconify-icon icon="solar:magnifer-linear" width="18" style="color:#9ab87a;"></iconify-icon>
            <input type="text" placeholder="Cari pembeli..." id="searchInput" oninput="filterRooms(this.value)">
        </div>

        {{-- CHAT LIST --}}
        @if($chatRooms->isEmpty())
            <div class="chat-list">
                <div class="empty">
                    <iconify-icon icon="solar:chat-round-dots-bold" width="56" style="color:var(--border); display:center; margin:0 auto;"></iconify-icon>
                    <div class="empty-text">Belum ada chat</div>
                    <div class="empty-sub">Chat dengan pembeli akan muncul di sini<br>setelah ada yang membeli produk kamu 🌿</div>
                </div>
            </div>
        @else
            <div class="chat-list" id="chatList">
                @foreach($chatRooms as $room)
                    @php
                        $name = $room->buyer->name;
                        $initials = strtoupper(substr($name, 0, 2));
                        $lastProduct = $room->lastOrder->orderItems->first()?->product;
                        $preview = $lastProduct
                            ? "Pesanan: {$lastProduct->nama_produk}"
                            : "Pesanan baru";
                        $timeAgo = $room->lastTime->diffForHumans(null, true, true);
                    @endphp
                    <a href="{{ route('seller.chat.show', $room->buyer) }}" class="chat-room" data-name="{{ strtolower($name) }}">
                        <div class="room-avatar">
                            {{ $initials }}
                            <div class="online-dot"></div>
                        </div>
                        <div class="room-info">
                            <div class="room-name">{{ $name }}</div>
                            <div class="room-preview">{{ Str::limit($preview, 40) }}</div>
                        </div>
                        <div class="room-meta">
                            <div class="room-time">{{ $timeAgo }}</div>
                            @if($room->orderCount > 1)
                                <div class="room-badge">{{ $room->orderCount }}</div>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>

    <script>
        function filterRooms(query) {
            const rooms = document.querySelectorAll('.chat-room');
            const q = query.toLowerCase();
            rooms.forEach(room => {
                const name = room.getAttribute('data-name');
                room.style.display = name.includes(q) ? '' : 'none';
            });
        }
    </script>
</body>
</html>
