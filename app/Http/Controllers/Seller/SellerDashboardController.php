<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class SellerDashboardController extends Controller
{
    /**
     * Dashboard Penjual
     * 
     * Menampilkan:
     * - Statistik toko (produk aktif, pesanan masuk, total penjualan, rating)
     * - Pesanan terbaru yang perlu diproses
     * - Daftar produk yang dijual
     */
    public function index()
    {
        $user  = Auth::user();
        $store = $user->sellerProfile?->store;

        // Redirect ke registrasi kalau belum punya toko
        if (!$store) {
            return redirect()->route('seller.register');
        }

        // Statistik toko
        $totalProduk    = Product::where('user_id', $user->id)->count();
        $produkAktif    = Product::where('user_id', $user->id)->where('status', 'aktif')->count();
        $totalPenjualan = $store->total_penjualan ?? 0;
        $ratingToko     = $store->rating ?? 0;

        // Pesanan masuk (sebagai penjual)
        $pesananMasuk = Order::where('seller_id', $user->id)
            ->with(['orderItems.product', 'buyer'])
            ->latest()
            ->take(5)
            ->get();

        $pesananBaru     = Order::where('seller_id', $user->id)->where('status', 'menunggu_konfirmasi')->count();
        $pesananDiproses = Order::where('seller_id', $user->id)->where('status', 'diproses')->count();

        // Produk terbaru
        $produkTerbaru = Product::where('user_id', $user->id)
            ->latest()
            ->take(6)
            ->get();

        // Total pendapatan
        $totalPendapatan = Order::where('seller_id', $user->id)
            ->where('status', 'selesai')
            ->sum('total_harga');

        return view('Seller.dashboard', compact(
            'user',
            'store',
            'totalProduk',
            'produkAktif',
            'totalPenjualan',
            'ratingToko',
            'pesananMasuk',
            'pesananBaru',
            'pesananDiproses',
            'produkTerbaru',
            'totalPendapatan'
        ));
    }
}
