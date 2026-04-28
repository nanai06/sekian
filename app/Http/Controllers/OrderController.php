<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

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

        // Set konfigurasi Midtrans dari config/midtrans.php
        \Midtrans\Config::$serverKey    = config('midtrans.server_key');
        \Midtrans\Config::$isProduction  = config('midtrans.is_production');
        \Midtrans\Config::$isSanitized   = config('midtrans.is_sanitized');
        \Midtrans\Config::$is3ds         = config('midtrans.is_3ds');

        // WORKAROUND: Fix SSL certificate issue pada environment development (Windows/XAMPP)
        // Bypass SSL di local (karena php.ini CA bundle seringkali tidak terbaca oleh artisan serve)
        // CURLOPT_HTTPHEADER => [] WAJIB ada! SDK Midtrans akses key ini (nilainya 10023)
        // tanpa isset(), sehingga tanpa key ini akan muncul error "Undefined array key 10023"
        if (!config('midtrans.is_production')) {
            \Midtrans\Config::$curlOptions = [
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_SSL_VERIFYHOST => false,
                CURLOPT_HTTPHEADER     => [],  // <- mencegah "Undefined array key 10023"
            ];
        }

        // Generate unique order ID
        $orderId = 'ORDER-' . strtoupper(Str::random(10));

        // Parameter transaksi untuk Midtrans Snap API
        $params = [
            'transaction_details' => [
                'order_id'     => $orderId,
                'gross_amount' => (int) $request->total,
            ],
            'customer_details' => [
                'first_name' => auth()->check() ? auth()->user()->name : 'Guest',
                'email'      => auth()->check() ? auth()->user()->email : 'guest@example.com',
            ],
        ];

        try {
            // Generate Snap Token dari Midtrans
            $snapToken = \Midtrans\Snap::getSnapToken($params);
            return response()->json(['token' => $snapToken]);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Midtrans Error: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}