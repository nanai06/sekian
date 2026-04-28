<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{
    public function process(Request $request)
    {
        // Validasi payload dari frontend
        $request->validate([
            'subtotal' => 'required|numeric',
            'ongkir'   => 'required|numeric',
            'total'    => 'required|numeric',
        ]);

        $user = auth()->user();
        $diskon = $request->diskon ?? 0;

        // ── SIMPAN ORDER KE DATABASE ──────────────────────────────
        $order = Order::create([
            'buyer_id'           => $user->id,
            'seller_id'          => $user->id, // sementara pakai buyer_id, nanti bisa diupdate
            'alamat_pengiriman'  => $request->nama . ' - ' . ($request->hp ?? ''),
            'metode_pengiriman'  => $request->metode_bayar ?? 'Midtrans',
            'total_harga'        => $request->subtotal,
            'koin_digunakan'     => 0,
            'diskon'             => $diskon,
            'total_bayar'        => $request->total,
            'catatan'            => $request->produk_names ? implode(', ', $request->produk_names) : ($request->catatan ?? null),
            'status'             => 'menunggu_pembayaran',
        ]);

        // Simpan order items (dari product_items jika dikirim, atau dummy)
        if ($request->has('items') && is_array($request->items)) {
            foreach ($request->items as $item) {
                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $item['product_id'],
                    'seller_id'  => $item['seller_id'] ?? $user->id,
                    'harga'      => $item['harga'],
                ]);
            }
        }

        // ── MIDTRANS SNAP TOKEN ──────────────────────────────────
        \Midtrans\Config::$serverKey    = config('midtrans.server_key');
        \Midtrans\Config::$isProduction  = config('midtrans.is_production');
        \Midtrans\Config::$isSanitized   = config('midtrans.is_sanitized');
        \Midtrans\Config::$is3ds         = config('midtrans.is_3ds');

        // WORKAROUND: Fix SSL certificate issue pada environment development
        if (!config('midtrans.is_production')) {
            \Midtrans\Config::$curlOptions = [
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_SSL_VERIFYHOST => false,
                CURLOPT_HTTPHEADER     => [],
            ];
        }

        $params = [
            'transaction_details' => [
                'order_id'     => 'ORDER-' . $order->id . '-' . strtoupper(Str::random(6)),
                'gross_amount' => (int) $request->total,
            ],
            'customer_details' => [
                'first_name' => $user->name,
                'email'      => $user->email,
            ],
        ];

        try {
            $snapToken = \Midtrans\Snap::getSnapToken($params);
            return response()->json([
                'token'    => $snapToken,
                'order_id' => $order->id,
            ]);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Midtrans Error: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Update status order setelah pembayaran berhasil
     */
    public function updateStatus(Request $request)
    {
        $request->validate([
            'order_id' => 'required|integer',
            'status'   => 'required|string',
        ]);

        $order = Order::where('id', $request->order_id)
            ->where('buyer_id', auth()->id())
            ->firstOrFail();

        $order->update(['status' => $request->status]);

        return response()->json(['success' => true]);
    }
}