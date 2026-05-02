<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Store;
use App\Models\StoreAddress;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerDashboardController extends Controller
{
    public function index()
    {
        $user  = Auth::user();
        $store = $user->sellerProfile?->store;

        if (!$store) {
            return redirect()->route('seller.register');
        }

        // Statistik produk
        $produkAktif = Product::where('user_id', $user->id)->where('status', 'aktif')->count();
        $produkArsip = Product::where('user_id', $user->id)->where('status', 'nonaktif')->count();

        $produkDiarsipkan = Product::where('user_id', $user->id)
            ->where('status', 'nonaktif')->latest()->take(4)->get();

        $ratingToko = $store->rating ?? 0;

        // Pesanan masuk
        $pesananMasuk = Order::where('seller_id', $user->id)
            ->with(['orderItems.product', 'buyer'])->latest()->take(5)->get();

        // Status counts untuk status row
        $pesananBaru       = Order::where('seller_id', $user->id)->where('status', 'menunggu_konfirmasi')->count();
        $pesananDiproses   = Order::where('seller_id', $user->id)->where('status', 'diproses')->count();
        $pesananDikirim    = Order::where('seller_id', $user->id)->where('status', 'dikirim')->count();
        $pesananPerluBalas = Order::where('seller_id', $user->id)->where('status', 'selesai')->count();

        // Produk terbaru aktif
        $produkTerbaru = Product::where('user_id', $user->id)
            ->where('status', 'aktif')->latest()->take(6)->get();

        // Total pendapatan
        $totalPendapatan = Order::where('seller_id', $user->id)
            ->where('status', 'selesai')->sum('total_harga');

        // Chart penjualan 30 hari
        $chartPenjualan = Order::where('seller_id', $user->id)
            ->where('status', 'selesai')
            ->where('created_at', '>=', now()->subDays(30))
            ->selectRaw('DATE(created_at) as tanggal, SUM(total_harga) as total')
            ->groupBy('tanggal')->orderBy('tanggal')
            ->get()
            ->map(fn($row) => [
                'tanggal' => Carbon::parse($row->tanggal)->isoFormat('D MMM'),
                'total'   => (int) $row->total,
            ]);

        return view('Seller.dashboard', compact(
            'user', 'store', 'produkAktif', 'produkArsip', 'produkDiarsipkan',
            'ratingToko', 'pesananMasuk', 'pesananBaru', 'pesananDiproses',
            'pesananDikirim', 'pesananPerluBalas',
            'produkTerbaru', 'totalPendapatan', 'chartPenjualan'
        ));
    }

    // ──────────────── Edit Profil Toko ────────────────

    public function editToko()
    {
        $user    = Auth::user();
        $store   = $user->sellerProfile?->store;

        if (!$store) {
            return redirect()->route('seller.register');
        }

        $address = StoreAddress::where('store_id', $store->id)
            ->where('is_primary', true)->first();

        return view('Seller.toko.edit', compact('store', 'address'));
    }

    public function updateToko(Request $request)
    {
        $user  = Auth::user();
        $store = Store::where('user_id', $user->id)->firstOrFail();

        $existingStore  = $store;
        $uniqueNamaToko = $existingStore->nama_toko === $request->nama_toko
            ? 'required|string|max:30'
            : 'required|string|max:30|unique:stores,nama_toko';

        $validated = $request->validate([
            'nama_toko'         => $uniqueNamaToko,
            'nomor_hp'          => 'required|string|max:20',
            'email_toko'        => 'nullable|email|max:100',
            'jasa_pengiriman'   => 'required|array|min:1',
            'jasa_pengiriman.*' => 'string',
            'nama_penerima'     => 'required|string|max:100',
            'no_hp_alamat'      => 'required|string|max:20',
            'alamat_lengkap'    => 'required|string',
            'kecamatan'         => 'required|string|max:100',
            'kota'              => 'required|string|max:100',
            'provinsi'          => 'required|string|max:100',
            'kode_pos'          => 'required|string|max:10',
        ]);

        $store->update([
            'nama_toko'       => $validated['nama_toko'],
            'nomor_hp'        => $validated['nomor_hp'],
            'email_toko'      => $validated['email_toko'],
            'jasa_pengiriman' => $request->jasa_pengiriman,
        ]);

        StoreAddress::updateOrCreate(
            ['store_id' => $store->id, 'is_primary' => true],
            [
                'label'          => 'Alamat Utama',
                'nama_penerima'  => $validated['nama_penerima'],
                'no_hp'          => $validated['no_hp_alamat'],
                'alamat_lengkap' => $validated['alamat_lengkap'],
                'kecamatan'      => $validated['kecamatan'],
                'kota'           => $validated['kota'],
                'provinsi'       => $validated['provinsi'],
                'kode_pos'       => $validated['kode_pos'],
            ]
        );

        return redirect()->route('seller.dashboard')
            ->with('success', 'Profil toko berhasil diperbarui! 🌸');
    }

    // ──────────────── Statistik ────────────────

    public function statistik()
    {
        $user  = Auth::user();
        $store = $user->sellerProfile?->store;

        if (!$store) return redirect()->route('seller.register');

        $totalPendapatan = Order::where('seller_id', $user->id)
            ->where('status', 'selesai')->sum('total_harga');

        $totalPesanan = Order::where('seller_id', $user->id)->count();
        $pesananSelesai = Order::where('seller_id', $user->id)->where('status', 'selesai')->count();
        $ratingToko = $store->rating ?? 0;
        $produkAktif = Product::where('user_id', $user->id)->where('status', 'aktif')->count();
        $produkList = Product::where('user_id', $user->id)
            ->where('status', 'aktif')
            ->with('category')
            ->latest()
            ->get();
        // Chart 30 hari
        $chartPenjualan = Order::where('seller_id', $user->id)
            ->where('status', 'selesai')
            ->where('created_at', '>=', now()->subDays(30))
            ->selectRaw('DATE(created_at) as tanggal, SUM(total_harga) as total, COUNT(*) as jumlah')
            ->groupBy('tanggal')->orderBy('tanggal')
            ->get()
            ->map(fn($r) => [
                'tanggal' => Carbon::parse($r->tanggal)->isoFormat('D MMM'),
                'total'   => (int) $r->total,
                'jumlah'  => (int) $r->jumlah,
            ]);

        return view('Seller.statistik', compact(
            'store', 'totalPendapatan', 'totalPesanan', 'pesananSelesai',
            'ratingToko', 'produkAktif', 'chartPenjualan', 'produkList'
        ));
    }

    // ──────────────── Keuangan ────────────────

    public function keuangan()
    {
        $user  = Auth::user();
        $store = $user->sellerProfile?->store;

        if (!$store) return redirect()->route('seller.register');

        $totalPendapatan = Order::where('seller_id', $user->id)
            ->where('status', 'selesai')->sum('total_harga');

        $pendapatanBulanIni = Order::where('seller_id', $user->id)
            ->where('status', 'selesai')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('total_harga');

        $jumlahTransaksi = Order::where('seller_id', $user->id)
            ->where('status', 'selesai')->count();

        // Riwayat transaksi (pesanan selesai)
        $riwayatTransaksi = Order::where('seller_id', $user->id)
            ->where('status', 'selesai')
            ->with(['orderItems.product', 'buyer'])
            ->latest()
            ->paginate(10);

        // Pesanan belum selesai (pending income)
        $pendingIncome = Order::where('seller_id', $user->id)
            ->whereIn('status', ['menunggu_konfirmasi', 'diproses', 'dikirim'])
            ->sum('total_harga');

        return view('Seller.keuangan', compact(
            'store', 'totalPendapatan', 'pendapatanBulanIni',
            'jumlahTransaksi', 'riwayatTransaksi', 'pendingIncome'
        ));
    }
}