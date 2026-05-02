<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.iconify.design/iconify-icon/2.1.0/iconify-icon.min.js"></script>
    <title>Chat dengan {{ $buyer->name }} - AYU-NE</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --pk: #639922; --pk2: #4a7a1e; --pk-light: #eaf3de;
            --border: #c5e0a0; --text: #2d5016; --text2: #5a7a40;
        }
        * { margin:0; padding:0; box-sizing:border-box; font-family:'Poppins',sans-serif; }
        body { background:#f5fff5; color:var(--text); display:flex; flex-direction:column; height:100vh; }

        /* CHAT HEADER */
        .chat-header {
            display:flex; align-items:center; gap:14px;
            padding:14px 24px; border-bottom:1px solid var(--border);
            background:white; flex-shrink:0;
        }
        .back-btn {
            font-size:18px; color:var(--text); text-decoration:none;
            font-weight:600; line-height:1; display:flex; align-items:center;
            width:32px; height:32px; justify-content:center;
            border-radius:8px; transition:background 0.15s;
        }
        .back-btn:hover { background:var(--pk-light); }
        .buyer-avatar {
            width:42px; height:42px; border-radius:50%;
            background:linear-gradient(135deg, #d4eab8, #a5d791);
            display:flex; align-items:center; justify-content:center;
            font-size:15px; font-weight:700; color:var(--pk2); flex-shrink:0;
        }
        .buyer-name { font-size:15px; font-weight:700; color:var(--text); }
        .online-lbl { font-size:11px; color:#4CAF7D; font-weight:500; display:flex; align-items:center; gap:4px; }
        .online-dot-sm { width:6px; height:6px; border-radius:50%; background:#4CAF7D; }

        /* ORDER CONTEXT */
        .order-context {
            display:flex; align-items:center; gap:12px;
            padding:10px 24px; border-bottom:1px solid var(--border);
            background:#f9fdf5; flex-shrink:0; overflow-x:auto;
        }
        .ctx-item {
            display:flex; align-items:center; gap:8px;
            background:white; border:1px solid var(--border); border-radius:10px;
            padding:8px 12px; flex-shrink:0;
        }
        .ctx-thumb {
            width:32px; height:32px; border-radius:6px;
            background:var(--pk-light); display:flex; align-items:center;
            justify-content:center; font-size:14px; overflow:hidden; flex-shrink:0;
        }
        .ctx-thumb img { width:100%; height:100%; object-fit:cover; }
        .ctx-name { font-size:11px; color:var(--text2); max-width:120px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
        .ctx-price { font-size:11px; font-weight:700; color:var(--pk); }

        /* CHAT BODY */
        .chat-body {
            flex:1; overflow-y:auto; padding:20px 24px;
            display:flex; flex-direction:column; gap:12px;
        }
        .date-divider {
            text-align:center; font-size:10px; color:#9ab87a;
            background:var(--pk-light); padding:3px 12px; border-radius:10px;
            align-self:center; font-weight:500;
        }
        .bubble-left { align-self:flex-start; max-width:65%; }
        .bubble-left .bubble {
            background:white; border:1px solid var(--border);
            border-radius:0 14px 14px 14px; padding:10px 14px;
            font-size:13px; line-height:1.5; color:var(--text);
        }
        .bubble-left .time { font-size:10px; color:#9ab87a; margin-top:3px; padding-left:4px; }

        .bubble-right { align-self:flex-end; max-width:65%; }
        .bubble-right .bubble {
            background:var(--pk); color:white;
            border-radius:14px 0 14px 14px; padding:10px 14px;
            font-size:13px; line-height:1.5;
        }
        .bubble-right .time { font-size:10px; color:#9ab87a; margin-top:3px; text-align:right; padding-right:4px; }

        /* CHAT INPUT */
        .chat-footer {
            display:flex; align-items:center; gap:10px;
            padding:12px 24px; border-top:1px solid var(--border);
            background:white; flex-shrink:0;
        }
        .btn-attach {
            font-size:20px; cursor:pointer; color:#9ab87a;
            background:none; border:none; flex-shrink:0; transition:color 0.2s;
        }
        .btn-attach:hover { color:var(--pk); }
        .chat-input {
            flex:1; padding:10px 18px;
            border:1.5px solid var(--border); border-radius:25px;
            font-size:13px; color:var(--text); outline:none;
            font-family:'Poppins',sans-serif; transition:border 0.2s;
        }
        .chat-input::placeholder { color:#b5d4a0; }
        .chat-input:focus { border-color:var(--pk); }
        .btn-send {
            width:40px; height:40px; border-radius:50%;
            background:var(--pk); border:none; cursor:pointer;
            display:flex; align-items:center; justify-content:center;
            flex-shrink:0; transition:background 0.2s; color:white; font-size:16px;
        }
        .btn-send:hover { background:var(--pk2); }
    </style>
</head>
<body>

    {{-- HEADER --}}
    <div class="chat-header">
        <a href="{{ route('seller.chat.index') }}" class="back-btn">←</a>
        <div class="buyer-avatar">{{ strtoupper(substr($buyer->name, 0, 2)) }}</div>
        <div>
            <div class="buyer-name">{{ $buyer->name }}</div>
            <div class="online-lbl"><div class="online-dot-sm"></div> Online</div>
        </div>
    </div>

    {{-- ORDER CONTEXT --}}
    @if($orders->isNotEmpty())
    <div class="order-context">
        @foreach($orders->take(3) as $order)
            @php $item = $order->orderItems->first(); $prod = $item?->product; @endphp
            @if($prod)
            <div class="ctx-item">
                <div class="ctx-thumb">
                    @if($prod->foto_utama)
                        <img src="{{ asset('storage/'.$prod->foto_utama) }}" alt="">
                    @else
                        🧴
                    @endif
                </div>
                <div>
                    <div class="ctx-name">{{ $prod->nama_produk }}</div>
                    <div class="ctx-price">Rp {{ number_format($prod->harga, 0, ',', '.') }}</div>
                </div>
            </div>
            @endif
        @endforeach
    </div>
    @endif

    {{-- CHAT BODY --}}
    <div class="chat-body" id="chatBody">
        <div class="date-divider">Hari ini</div>

        {{-- Auto-generated context message --}}
        <div class="bubble-left">
            <div class="bubble">Halo kak! Saya {{ $buyer->name }}, mau tanya soal produk yang saya pesan 😊</div>
            <div class="time">{{ now()->subMinutes(5)->format('H:i') }}</div>
        </div>
    </div>

    {{-- CHAT INPUT --}}
    <div class="chat-footer">
        <button class="btn-attach">📎</button>
        <input type="text" class="chat-input" id="chatInput"
            placeholder="Ketik pesan..." onkeydown="if(event.key==='Enter') kirimPesan()">
        <button class="btn-send" onclick="kirimPesan()">
            <iconify-icon icon="solar:plain-bold" width="18"></iconify-icon>
        </button>
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
            bubble.innerHTML = `<div class="bubble">${pesan}</div><div class="time">${time}</div>`;

            chatBody.appendChild(bubble);
            input.value = '';
            chatBody.scrollTop = chatBody.scrollHeight;

            // Simulate auto-reply after 1.5s
            setTimeout(() => {
                const reply = document.createElement('div');
                reply.className = 'bubble-left';
                const replyTime = new Date();
                const rt = replyTime.getHours().toString().padStart(2,'0') + ':' + replyTime.getMinutes().toString().padStart(2,'0');
                const replies = [
                    'Baik kak, terima kasih ya! 😊',
                    'Oke kak, ditunggu ya!',
                    'Siap kak! Ada yang lain mau ditanyakan? 🌸',
                    'Noted kak! 👍',
                ];
                const randomReply = replies[Math.floor(Math.random() * replies.length)];
                reply.innerHTML = `<div class="bubble">${randomReply}</div><div class="time">${rt}</div>`;
                chatBody.appendChild(reply);
                chatBody.scrollTop = chatBody.scrollHeight;
            }, 1500);
        }

        // Scroll to bottom on load
        document.getElementById('chatBody').scrollTop = document.getElementById('chatBody').scrollHeight;
    </script>

</body>
</html>
