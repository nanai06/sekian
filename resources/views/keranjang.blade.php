<!DOCTYPE html>
<html lang="id">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja - AYU-NE</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin:0; padding:0; box-sizing:border-box; font-family:'Poppins',sans-serif; }
        body { background:#fff; color:#3b1a1a; }

        .content { padding:36px 40px; display:flex; gap:28px; align-items:flex-start; }
        .cart-left { flex:1; }
        h1 { font-size:24px; font-weight:800; color:#3b1a1a; margin-bottom:24px; }

        .select-all-bar {
            display:flex; align-items:center; gap:10px; margin-bottom:14px; padding:10px 16px;
            background:#fff5f7; border-radius:12px; border:1px solid #f5e0e0;
        }

        .cart-item {
            display:flex; align-items:center; gap:16px; padding:20px;
            border:1px solid #f5e0e0; border-radius:16px; margin-bottom:14px;
            transition:box-shadow 0.2s;
        }
        .cart-item:hover { box-shadow:0 4px 16px rgba(224,112,128,0.08); }

        .item-info { flex:1; }
        .item-name { font-size:15px; font-weight:700; color:#3b1a1a; margin-bottom:4px; }
        .item-brand { font-size:11px; color:#9a6a6a; text-transform:uppercase; letter-spacing:0.5px; margin-bottom:8px; }
        .item-price { font-size:15px; font-weight:700; color:#3b1a1a; }

        .item-right { display:flex; flex-direction:column; align-items:flex-end; gap:16px; }

        .btn-delete {
            background:none; border:1px solid #f5e0e0; border-radius:8px;
            cursor:pointer; padding:6px 8px; display:flex; align-items:center;
            transition:all 0.2s;
        }
        .btn-delete:hover { background:#fff0f2; border-color:#e07080; }

        .qty-wrap { display:flex; align-items:center; gap:12px; }
        .qty-btn {
            width:32px; height:32px; border-radius:50%; border:1.5px solid #f0d5d5;
            background:white; font-size:16px; cursor:pointer; display:flex;
            align-items:center; justify-content:center; color:#7a4a4a;
            font-family:'Poppins',sans-serif; transition:all 0.2s;
        }
        .qty-btn:hover { border-color:#f4a0aa; color:#e07080; }
        .qty-num { font-size:15px; font-weight:600; color:#3b1a1a; min-width:20px; text-align:center; }

        .cart-right { width:320px; flex-shrink:0; }
        .summary-box { border:1px solid #f5e0e0; border-radius:16px; padding:24px; }
        .summary-title { font-size:17px; font-weight:700; color:#3b1a1a; margin-bottom:20px; }
        .summary-row { display:flex; justify-content:space-between; align-items:center; font-size:14px; color:#7a4a4a; margin-bottom:12px; }
        .summary-divider { border:none; border-top:1px solid #f5e0e0; margin:16px 0; }
        .summary-total { display:flex; justify-content:space-between; align-items:center; font-size:16px; font-weight:700; color:#3b1a1a; margin-bottom:20px; }

        .btn-checkout {
            width:100%; padding:14px; background:#f4a0aa; color:white; border:none;
            border-radius:50px; font-size:15px; font-weight:700; cursor:pointer;
            font-family:'Poppins',sans-serif; transition:background 0.2s;
        }
        .btn-checkout:hover { background:#e8858f; }
        .btn-checkout:disabled { background:#ddd; cursor:not-allowed; }

        .item-check { width:18px; height:18px; accent-color:#e07080; cursor:pointer; flex-shrink:0; }
    </style>
</head>
<body>

@include('layouts.navigation')

<div class="content">
    <!-- LEFT -->
    <div class="cart-left">
        <h1>Keranjang Belanja</h1>

        @if($cartItems->isEmpty())
            <div style="text-align:center; padding:60px 20px; color:#9a6a6a;">
                <div style="font-size:48px; margin-bottom:12px;">🛒</div>
                <div style="font-size:16px; font-weight:700; margin-bottom:6px;">Keranjangmu masih kosong</div>
                <div style="font-size:13px;">Yuk temukan produk eco-beauty preloved favoritmu!</div>
                <a href="{{ route('ayu-belanja') }}"
                   style="display:inline-block; margin-top:20px; padding:12px 28px;
                          background:#f4a0aa; color:white; border-radius:50px;
                          font-weight:700; font-size:14px; text-decoration:none;">
                    Mulai Belanja
                </a>
            </div>
        @else
            {{-- Pilih Semua --}}
            <div class="select-all-bar">
                <input type="checkbox" id="selectAll" onchange="toggleSelectAll()" checked class="item-check">
                <label for="selectAll" style="font-size:13px; font-weight:600; color:#5D393B; cursor:pointer;">
                    Pilih Semua ({{ $cartItems->count() }} produk)
                </label>
            </div>

            @foreach($cartItems as $item)
            <div class="cart-item" id="item-{{ $item->id }}">
                {{-- Checkbox pilih --}}
                <input type="checkbox" class="item-check cart-check" value="{{ $item->id }}"
                       data-harga="{{ $item->product->harga }}" data-qty="{{ $item->quantity }}"
                       checked onchange="updateSummary()">

                {{-- Foto produk --}}
                @if($item->product->foto && str_starts_with($item->product->foto, 'http'))
                    <img src="{{ $item->product->foto }}" style="width:80px;height:80px;border-radius:12px;object-fit:cover;flex-shrink:0;">
                @elseif($item->product->foto)
                    <img src="{{ asset('storage/' . $item->product->foto) }}" style="width:80px;height:80px;border-radius:12px;object-fit:cover;flex-shrink:0;">
                @else
                    <div style="width:80px;height:80px;border-radius:12px;background:#fdf0f2;display:flex;align-items:center;justify-content:center;font-size:10px;color:#c4a0a0;">No Photo</div>
                @endif

                <div class="item-info">
                    <div class="item-name">{{ $item->product->nama_produk }}</div>
                    <div class="item-brand">{{ $item->product->brand ?? $item->product->kategori }}</div>
                    <div class="item-price" id="subtotal-{{ $item->id }}">
                        Rp {{ number_format($item->product->harga * $item->quantity, 0, ',', '.') }}
                    </div>
                </div>

                <div class="item-right">
                    {{-- Tombol hapus --}}
                    <form action="{{ route('cart.destroy', $item->id) }}" method="POST" style="margin:0;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete" onclick="return confirm('Hapus item ini?')">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#e07080" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                        </button>
                    </form>

                    {{-- Qty controller --}}
                    <div class="qty-wrap">
                        <button class="qty-btn" id="btn-min-{{ $item->id }}"
                                onclick="updateQty({{ $item->id }}, {{ $item->quantity - 1 }}, {{ $item->product->harga }})"
                                {{ $item->quantity <= 1 ? 'disabled style=opacity:0.4;cursor:not-allowed;' : '' }}>−</button>
                        <span class="qty-num" id="qty-{{ $item->id }}">{{ $item->quantity }}</span>
                        <button class="qty-btn" id="btn-plus-{{ $item->id }}"
                                onclick="updateQty({{ $item->id }}, {{ $item->quantity + 1 }}, {{ $item->product->harga }})">+</button>
                    </div>
                </div>
            </div>
            @endforeach
        @endif
    </div>

    <!-- RIGHT: SUMMARY -->
    <div class="cart-right">
        <div class="summary-box">
            <div class="summary-title">Ringkasan Belanja</div>
            <div class="summary-row">
                <span>Subtotal (<span id="selectedCount">{{ $cartItems->sum('quantity') }}</span> produk)</span>
                <span id="subtotal">Rp {{ number_format($grandTotal, 0, ',', '.') }}</span>
            </div>
            <div class="summary-row">
                <span>Estimasi Ongkir</span>
                <span>Rp 15.000</span>
            </div>
            <hr class="summary-divider">
            <div class="summary-total">
                <span>Total</span>
                <span id="total">Rp {{ number_format($grandTotal + 15000, 0, ',', '.') }}</span>
            </div>
            <button class="btn-checkout" id="btnCheckout" onclick="goCheckout()">
                Lanjut ke Checkout
            </button>
        </div>
    </div>
</div>

<script>
const ongkir = 15000;

function formatRp(num) {
    return 'Rp ' + Math.max(0, Math.round(num)).toLocaleString('id-ID');
}

// ── CHECKBOX: Pilih Semua ──
function toggleSelectAll() {
    const all = document.getElementById('selectAll').checked;
    document.querySelectorAll('.cart-check').forEach(cb => { cb.checked = all; });
    updateSummary();
}

// ── CHECKBOX: Update summary berdasarkan item terpilih ──
function updateSummary() {
    const checks = document.querySelectorAll('.cart-check');
    let sub = 0, count = 0;
    checks.forEach(cb => {
        if (cb.checked) {
            const qty = parseInt(cb.dataset.qty);
            sub += parseFloat(cb.dataset.harga) * qty;
            count += qty;
        }
    });
    document.getElementById('subtotal').textContent = formatRp(sub);
    document.getElementById('total').textContent = formatRp(sub + ongkir);
    document.getElementById('selectedCount').textContent = count;

    // Update "Pilih Semua" state
    const allChecked = [...checks].every(cb => cb.checked);
    document.getElementById('selectAll').checked = allChecked;
}

// ── CHECKOUT: Kirim hanya item terpilih ──
function goCheckout() {
    const selected = [];
    document.querySelectorAll('.cart-check:checked').forEach(cb => {
        selected.push(cb.value);
    });
    if (selected.length === 0) {
        alert('Pilih minimal 1 produk untuk checkout!');
        return;
    }
    window.location.href = '{{ route("checkout") }}?items=' + selected.join(',');
}

// ── QTY: Update quantity via AJAX ──
function updateQty(cartId, newQty, hargaSatuan) {
    if (newQty < 1) return;

    fetch(`/keranjang/${cartId}`, {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        },
        body: JSON.stringify({ quantity: newQty }),
    })
    .then(res => res.json())
    .then(data => {
        if (!data.success) return;

        // update qty display
        document.getElementById(`qty-${cartId}`).textContent = newQty;

        // update subtotal item
        document.getElementById(`subtotal-${cartId}`).textContent = formatRp(hargaSatuan * newQty);

        // update data-qty on checkbox
        const cb = document.querySelector(`.cart-check[value="${cartId}"]`);
        if (cb) cb.dataset.qty = newQty;

        // recalculate summary
        updateSummary();

        // update minus button state
        const btnMin = document.getElementById(`btn-min-${cartId}`);
        btnMin.disabled = newQty <= 1;
        btnMin.style.opacity = newQty <= 1 ? '0.4' : '1';
        btnMin.style.cursor = newQty <= 1 ? 'not-allowed' : 'pointer';

        // update onclick
        document.getElementById(`btn-min-${cartId}`)
            .setAttribute('onclick', `updateQty(${cartId}, ${newQty - 1}, ${hargaSatuan})`);
        document.getElementById(`btn-plus-${cartId}`)
            .setAttribute('onclick', `updateQty(${cartId}, ${newQty + 1}, ${hargaSatuan})`);
    })
    .catch(() => alert('Gagal update quantity, coba lagi ya!'));
}
</script>

</body>
</html>
