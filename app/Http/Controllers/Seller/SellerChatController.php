<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class SellerChatController extends Controller
{
    /**
     * Beranda chat — daftar room berdasarkan pembeli unik dari pesanan.
     */
    public function index(): View
    {
        $sellerId = Auth::id();

        // Ambil buyer unik dari semua pesanan seller
        $buyerIds = Order::where('seller_id', $sellerId)
            ->distinct()
            ->pluck('buyer_id');

        // Untuk setiap buyer, ambil pesanan terakhir sebagai "preview"
        $chatRooms = collect();
        foreach ($buyerIds as $buyerId) {
            $lastOrder = Order::where('seller_id', $sellerId)
                ->where('buyer_id', $buyerId)
                ->with('buyer')
                ->latest()
                ->first();

            if ($lastOrder && $lastOrder->buyer) {
                $orderCount = Order::where('seller_id', $sellerId)
                    ->where('buyer_id', $buyerId)
                    ->count();

                $chatRooms->push((object) [
                    'buyer'       => $lastOrder->buyer,
                    'lastOrder'   => $lastOrder,
                    'orderCount'  => $orderCount,
                    'lastTime'    => $lastOrder->created_at,
                ]);
            }
        }

        // Sort by most recent
        $chatRooms = $chatRooms->sortByDesc('lastTime')->values();

        return view('Seller.chat.index', compact('chatRooms'));
    }

    /**
     * Room chat dengan pembeli tertentu.
     */
    public function show(User $buyer): View
    {
        $sellerId = Auth::id();

        // Pastikan buyer pernah order dari seller ini
        $hasOrder = Order::where('seller_id', $sellerId)
            ->where('buyer_id', $buyer->id)
            ->exists();

        abort_if(!$hasOrder, 403);

        // Ambil semua pesanan antara seller dan buyer ini
        $orders = Order::where('seller_id', $sellerId)
            ->where('buyer_id', $buyer->id)
            ->with('orderItems.product')
            ->latest()
            ->get();

        return view('Seller.chat.show', compact('buyer', 'orders'));
    }
}
