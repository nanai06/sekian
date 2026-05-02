<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Tampilkan halaman keranjang
    public function index()
    {
        $cartItems = Cart::with('product')
            ->where('user_id', auth()->id())
            ->get();

        $grandTotal = $cartItems->sum(function ($item) {
            return $item->product->harga * $item->quantity;
        });

        return view('keranjang', compact('cartItems', 'grandTotal'));
    }

    // Tambah produk ke keranjang (dipanggil via fetch dari ayu-belanja)
    public function store(Request $request)
    {
        if (!auth()->check()) {
            return response()->json([
                'success'  => false,
                'redirect' => route('login')
            ], 401);
        }

        $request->validate([
            'product_id' => 'required|exists:ayune_products,id',
            'quantity'   => 'integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        // cek apakah produk udah ada di keranjang user ini
        $existing = Cart::where('user_id', auth()->id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($existing) {
            // kalau udah ada tinggal tambah qty-nya
            $existing->increment('quantity', $request->quantity ?? 1);
        } else {
            // kalau belum ada bikin baru
            Cart::create([
                'user_id'    => auth()->id(),
                'product_id' => $request->product_id,
                'seller_id'  => $product->user_id,
                'quantity'   => $request->quantity ?? 1,
            ]);
        }

        $cartCount = Cart::where('user_id', auth()->id())->sum('quantity');

        return response()->json([
            'success'    => true,
            'message'    => 'Produk ditambahkan ke keranjang!',
            'cart_count' => $cartCount,
        ]);
    }

    // Update quantity via AJAX dari halaman keranjang
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $item = Cart::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $item->update(['quantity' => $request->quantity]);

        $grandTotal = Cart::with('product')
            ->where('user_id', auth()->id())
            ->get()
            ->sum(fn($i) => $i->product->harga * $i->quantity);

        return response()->json([
            'success'    => true,
            'subtotal'   => $item->product->harga * $item->quantity,
            'grandTotal' => $grandTotal,
        ]);
    }

    // Hapus item dari keranjang
    public function destroy($id)
    {
        Cart::where('id', $id)
            ->where('user_id', auth()->id())
            ->delete();

        return redirect()->route('keranjang')
            ->with('success', 'Item dihapus dari keranjang');
    }

    /**
     * Halaman Checkout — ambil semua item di keranjang user
     * untuk ditampilkan di ringkasan pesanan
     */
    public function checkout(Request $request)
    {
        // Mode 1: Direct buy — beli langsung 1 produk tanpa keranjang
        if ($request->has('direct')) {
            $product = \App\Models\Product::findOrFail($request->direct);

            // Buat "fake" cart item object supaya view bisa pakai format yang sama
            $fakeItem = new \stdClass();
            $fakeItem->id = 0;
            $fakeItem->product_id = $product->id;
            $fakeItem->quantity = 1;
            $fakeItem->product = $product;

            $cartItems = collect([$fakeItem]);
            $grandTotal = $product->harga;
            $isDirect = true;

            return view('checkout', compact('cartItems', 'grandTotal', 'isDirect'));
        }

        // Mode 2: Checkout dari keranjang (bisa filter items terpilih)
        $query = Cart::with('product')
            ->where('user_id', auth()->id());

        if ($request->has('items')) {
            $selectedIds = explode(',', $request->items);
            $query->whereIn('id', $selectedIds);
        }

        $cartItems = $query->get();

        $grandTotal = $cartItems->sum(function ($item) {
            return $item->product->harga * $item->quantity;
        });

        $isDirect = false;

        return view('checkout', compact('cartItems', 'grandTotal', 'isDirect'));
    }
}