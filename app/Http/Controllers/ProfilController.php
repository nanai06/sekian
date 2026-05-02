<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class ProfilController extends Controller
{
    /**
     * Halaman Profil User/Pembeli
     * 
     * Menampilkan:
     * - Header profil (avatar, nama, badge, stats)
     * - Informasi akun (data pribadi)
     * - Preview riwayat pesanan (3 terbaru)
     */
    public function index()
    {
        $user = auth()->user();
        //ambil data user yang lagi login

        // Eager load relasi yang dibutuhin di halaman profil
        $user->load(['primaryAddress', 'sellerProfile.store']);

        // Hitung total pesanan (sebagai pembeli)
        $totalPesanan = Order::where('buyer_id', $user->id)->count();

        // Ambil 3 pesanan terbaru dengan relasi order items → product
        $pesananTerbaru = Order::where('buyer_id', $user->id)
            ->with(['orderItems.product'])
            ->latest()
            ->take(3)
            ->get();

        // Saldo koin user (dari kolom ayu_koin di users)
        $saldoKoin = $user->ayu_koin ?? 0;

        return view('profil.index', compact(
            'user',
            'totalPesanan',
            'pesananTerbaru',
            'saldoKoin'
        ));
    }
}
