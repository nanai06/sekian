<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class SellerOrderController extends Controller
{
    /**
     * Daftar pesanan masuk ke seller.
     * Menampilkan semua order where seller_id = auth user.
     */
    public function index(): View
    {
        $query = Order::where('seller_id', Auth::id())
            ->with(['orderItems.product', 'buyer']);

        // Filter by status jika ada query parameter
        if (request('status')) {
            $query->where('status', request('status'));
        }

        $pesanan = $query->latest()->paginate(15);

        $jumlahBaru     = Order::where('seller_id', Auth::id())->where('status', 'menunggu_konfirmasi')->count();
        $jumlahDiproses = Order::where('seller_id', Auth::id())->where('status', 'diproses')->count();
        $jumlahDikirim  = Order::where('seller_id', Auth::id())->where('status', 'dikirim')->count();

        return view('seller.pesanan.index', compact(
            'pesanan',
            'jumlahBaru',
            'jumlahDiproses',
            'jumlahDikirim'
        ));
    }
}
