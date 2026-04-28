<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;

class PaymentController extends Controller
{
    public function pay()
    {
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => 'ORDER-' . rand(),
                'gross_amount' => 50000,
            ],
            'customer_details' => [
                'first_name' => 'Puti',
                'email' => 'puti@email.com',
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        return view('payment', compact('snapToken'));
    }
}