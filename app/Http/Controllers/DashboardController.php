<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\RecyclingSubmission;
use App\Models\Coin;
use App\Models\CoinHistory;

class DashboardController extends Controller
{
    //index buat nampilin doang bkn masuk smpe detail gt
    public function index(){ 
        $user = auth()->user();
        //cek login ambil data user yg lg login ini

        $totalProdukDijual = Product::where('user_id', $user->id)
            ->count();
        //buka tabel ayune produk cari yg sesuai id, itung jumlah data produk yg diajual
        
        $totalProdukTerjual = Product::where('user_id', $user->id)
            ->where('status','terjual')
            ->count();
        //sama aja bedanya ini di filter lagi produk yg udh terjual / kebeli sm org di kolom status
        
        $totalProdukDibeli = Product::where('buyer_id', $user->id)
            ->where('status', 'selesai');
        
        $totalDaurUlang = RecyclingSubmission::where('user_id', $user->id)
            ->where('status','confirmed')
            ->count();

        $saldoKoin = Coin::where('user_id', $user->id)
            ->first();
        //ambil satu baris pertama yg ketemu sesuai idnya

        $riwayatKoin = CoinHistory::where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        $riwayatDaurUlang = RecyclingSubmission::where('user_id', $user->id)
            ->latest() //urutkan yg terbaru
            ->take(3) //ambil 3 ajh
            ->get(); //ambil smua baris yg cocok sesuai idnya
        
        $produkTerbaru = Product::where('user_id', $user->id)
            ->latest()
            ->take(4)
            ->get();
        
        return view('dashboard', compact(
            'user',
            'totalProdukDijual',
            'totalProdukTerjual',
            'totalProdukDibeli',
            'saldoKoin',
            'riwayatKoin',
            'riwayatDaurUlang',
            'produkTerbaru'
        ));

    }
}
