<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan #{{ $order->id }} - AYU-NE</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body { background: #f9f5f5; color: #3b1a1a; }

        .content { max-width: 620px; margin: 0 auto; padding: 32px 20px; }

        .page-header { display: flex; align-items: center; gap: 12px; margin-bottom: 24px; }
        .back-btn { font-size: 20px; color: #3b1a1a; text-decoration: none; font-weight: 600; }
        .page-title { font-size: 20px; font-weight: 800; color: #3b1a1a; }

        .card { background: white; border-radius: 16px; padding: 20px; margin-bottom: 14px; border: 1px solid #f5e0e0; }
        .card-title { font-size: 14px; font-weight: 700; color: #3b1a1a; margin-bottom: 14px; }

        .produk-item {
            display: flex; align-items: center; gap: 14px;
            padding-bottom: 14px; margin-bottom: 14px; border-bottom: 1px solid #f9f0f2;
        }
        .produk-item:last-child { border-bottom: none; padding-bottom: 0; margin-bottom: 0; }

        .produk-thumb {
            width: 56px; height: 56px; border-radius: 10px;
            background: #fdf0f2; flex-shrink: 0; overflow: hidden;
        }
        .produk-thumb img { width: 100%; height: 100%; object-fit: cover; }

        .produk-name { font-size: 14px; font-weight: 600; color: #3b1a1a; margin-bottom: 3px; }
        .produk-qty { font-size: 12px; color: #9a6a6a; margin-bottom: 3px; }
        .produk-price { font-size: 14px; font-weight: 800; color: #3b1a1a; }

        .info-row { display: flex; align-items: flex-start; gap: 12px; margin-bottom: 6px; }
        .info-icon { font-size: 16px; flex-shrink: 0; margin-top: 1px; }
        .info-label { font-size: 14px; font-weight: 700; color: #3b1a1a; margin-bottom: 4px; }
        .info-text { font-size: 13px; color: #7a4a4a; line-height: 1.6; }
        .info-green { font-size: 13px; font-weight: 600; }

        .summary-row { display: flex; justify-content: space-between; font-size: 13px; color: #7a4a4a; margin-bottom: 10px; }
        .summary-total {
            display: flex; justify-content: space-between;
            font-size: 15px; font-weight: 800; color: #3b1a1a;
            padding-top: 12px; border-top: 1px solid #f5e0e0; margin-top: 4px;
        }

        .status-badge {
            display: inline-block; padding: 5px 14px; border-radius: 50px;
            font-size: 12px; font-weight: 600;
        }
        .status-menunggu_pembayaran { background: #fce4ec; color: #e07080; }
        .status-dibayar { background: #fce4ec; color: #e07080; }
        .status-diproses { background: #fff3e0; color: #f57c00; }
        .status-dikirim { background: #e3f2fd; color: #1976d2; }
        .status-selesai { background: #e8f5e9; color: #388e3c; }
        .status-dibatalkan { background: #f5f5f5; color: #9e9e9e; }
    </style>
</head>
<body>

@include('layouts.navigation')

@php
    $statusLabels = [
        'menunggu_pembayaran' => 'Menunggu Pembayaran',
        'dibayar' => 'Dibayar',
        'diproses' => 'Sedang Diproses',
        'dikirim' => 'Dikirim',
        'selesai' => 'Selesai',
        'dibatalkan' => 'Dibatalkan',
    ];
    $statusLabel = $statusLabels[$order->status] ?? $order->status;
    $ongkir = $order->total_bayar - $order->total_harga + $order->diskon;
@endphp

<div class="content">
    <div class="page-header">
        <a href="{{ route('pesanan-saya') }}" class="back-btn">←</a>
        <div class="page-title">Detail Pesanan</div>
    </div>

    {{-- STATUS --}}
    <div class="card" style="display:flex; align-items:center; justify-content:space-between;">
        <div>
            <div style="font-size:12px; color:#9a6a6a; margin-bottom:4px;">Pesanan #{{ $order->id }}</div>
            <div style="font-size:12px; color:#9a6a6a;">{{ $order->created_at->format('d M Y, H:i') }}</div>
        </div>
        <span class="status-badge status-{{ $order->status }}">{{ $statusLabel }}</span>
    </div>

    {{-- PRODUK --}}
    <div class="card">
        <div class="card-title">Produk</div>

        @if($order->orderItems->count())
            @foreach($order->orderItems as $item)
                <div class="produk-item">
                    <div class="produk-thumb">
                        @if($item->product && $item->product->foto && str_starts_with($item->product->foto, 'http'))
                            <img src="{{ $item->product->foto }}">
                        @elseif($item->product && $item->product->foto)
                            <img src="{{ asset('storage/' . $item->product->foto) }}">
                        @else
                            <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;font-size:9px;color:#c4a0a0;">No Photo</div>
                        @endif
                    </div>
                    <div style="flex:1;">
                        <div class="produk-name">{{ $item->product->nama_produk ?? 'Produk' }}</div>
                        <div class="produk-qty">Qty: 1</div>
                        <div class="produk-price">Rp {{ number_format($item->harga, 0, ',', '.') }}</div>
                    </div>
                </div>
            @endforeach
        @else
            {{-- Fallback untuk order lama tanpa items --}}
            <div class="produk-item">
                <div class="produk-thumb">
                    <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;font-size:9px;color:#c4a0a0;">-</div>
                </div>
                <div>
                    <div class="produk-name">{{ $order->catatan ?? 'Pesanan #' . $order->id }}</div>
                    <div class="produk-price">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</div>
                </div>
            </div>
        @endif
    </div>

    {{-- ALAMAT PENGIRIMAN --}}
    <div class="card">
        <div class="info-row">
            <div class="info-icon">📍</div>
            <div>
                <div class="info-label">Alamat Pengiriman</div>
                <div class="info-text">{{ $order->alamat_pengiriman ?? '-' }}</div>
            </div>
        </div>
    </div>

    {{-- PEMBAYARAN --}}
    <div class="card">
        <div class="info-row">
            <div class="info-icon">🏦</div>
            <div>
                <div class="info-label">Pembayaran</div>
                <div class="info-text">{{ $order->metode_pengiriman ?? 'Midtrans' }}</div>
                <div class="info-green" style="color:{{ $order->status === 'menunggu_pembayaran' ? '#e07080' : '#2ecc71' }};">
                    Status: {{ $statusLabel }}
                </div>
            </div>
        </div>
    </div>

    {{-- RINGKASAN PEMBAYARAN --}}
    <div class="card">
        <div class="card-title">Ringkasan Pembayaran</div>
        <div class="summary-row">
            <span>Subtotal</span>
            <span>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</span>
        </div>
        @if($order->diskon > 0)
        <div class="summary-row">
            <span>Diskon</span>
            <span style="color:#2ecc71;">- Rp {{ number_format($order->diskon, 0, ',', '.') }}</span>
        </div>
        @endif
        @if($ongkir > 0)
        <div class="summary-row">
            <span>Ongkir</span>
            <span>Rp {{ number_format($ongkir, 0, ',', '.') }}</span>
        </div>
        @endif
        <div class="summary-total">
            <span>Total</span>
            <span>Rp {{ number_format($order->total_bayar, 0, ',', '.') }}</span>
        </div>
    </div>
</div>

</body>
</html>