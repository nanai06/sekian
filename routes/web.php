<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecyclingController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\Seller\SellerRegistrationController;
use App\Http\Controllers\Seller\SellerDashboardController;
use App\Http\Controllers\Seller\SellerOrderController;
use App\Http\Controllers\Seller\SellerChatController;
use App\Http\Controllers\ChatController;


// API Pengiriman (RajaOngkir V2 via Komerce)
Route::get('/api/shipping/search-destination', [ShippingController::class, 'searchDestination'])->name('api.shipping.search');
Route::post('/api/shipping/rates', [ShippingController::class, 'getRates'])->name('api.shipping.rates');

Route::middleware('auth')->group(function () {
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::get('/chat/{seller}', [ChatController::class, 'show'])->name('chat.show');
    Route::post('/chat/kirim', [ChatController::class, 'send'])->name('chat.send');
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
    
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

use App\Http\Controllers\ProfilController;

Route::get('/profil', [ProfilController::class, 'index'])
    ->middleware(['auth'])->name('profil');

Route::get('/ayu-belanja', [App\Http\Controllers\ProductController::class, 'belanja'])
    ->middleware(['auth'])->name('ayu-belanja');

Route::get('/ayu-daur-ulang', function () {
    return view('ayu-daur-ulang');
})->middleware(['auth'])->name('ayu-daur-ulang');

Route::get('/dropoff-lokasi', [App\Http\Controllers\DropOffLocationController::class, 'index'])
    ->middleware(['auth'])->name('dropoff-lokasi');

use App\Http\Controllers\CartController;

Route::middleware('auth')->group(function () {
    Route::get('/keranjang',         [CartController::class, 'index'])->name('keranjang');
    Route::post('/keranjang',        [CartController::class, 'store'])->name('cart.store');
    Route::patch('/keranjang/{id}',  [CartController::class, 'update'])->name('cart.update');
    Route::delete('/keranjang/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
});

Route::get('/notifikasi', function () {
    return view('notifikasi');
})->middleware(['auth'])->name('notifikasi');

Route::get('/detail-produk/{id}', [App\Http\Controllers\ProductController::class, 'detail'])
    ->middleware(['auth'])->name('detail-produk');

Route::get('/checkout', [CartController::class, 'checkout'])
    ->middleware(['auth'])->name('checkout');

Route::post('/checkout/process', [App\Http\Controllers\OrderController::class, 'process'])
    ->middleware(['auth'])->name('checkout.process');

Route::post('/order/update-status', [App\Http\Controllers\OrderController::class, 'updateStatus'])
    ->middleware(['auth'])->name('order.update-status');

Route::get('/chat-penjual', function () {
    return view('chat-penjual');
})->middleware(['auth'])->name('chat-penjual');

Route::get('/ayu-koin', function () {
    $user = auth()->user();
    $coin = \App\Models\Coin::firstOrCreate(
        ['user_id' => $user->id],
        ['saldo' => 0]
    );
    $saldoKoin = $coin->saldo;
    $coinHistories = \App\Models\CoinHistory::where('user_id', $user->id)
        ->latest()
        ->take(20)
        ->get();
    return view('ayu-koin', compact('saldoKoin', 'coinHistories'));
})->middleware(['auth'])->name('ayu-koin');

Route::get('/pesanan-berhasil', function (\Illuminate\Http\Request $request) {
    $order = null;
    $koinReward = 0;
    if ($request->has('order_id')) {
        $order = \App\Models\Order::with('orderItems.product')
            ->where('id', $request->order_id)
            ->where('buyer_id', auth()->id())
            ->first();
        if ($order) {
            $koinReward = max(5, floor($order->total_bayar / 10000));
        }
    }
    return view('pesanan-berhasil', compact('order', 'koinReward'));
})->middleware(['auth'])->name('pesanan-berhasil');

Route::get('/pesanan-saya', function () {
    $orders = \App\Models\Order::where('buyer_id', auth()->id())
        ->with(['orderItems.product'])
        ->latest()
        ->get();
    return view('pesanan-saya', compact('orders'));
})->middleware(['auth'])->name('pesanan-saya');

Route::get('/detail-pesanan/{id}', function ($id) {
    $order = \App\Models\Order::with(['orderItems.product', 'buyer'])
        ->where('id', $id)
        ->where('buyer_id', auth()->id())
        ->firstOrFail();
    return view('detail-pesanan', compact('order'));
})->middleware(['auth'])->name('detail-pesanan');

Route::get('/lacak-pesanan', function () {
    return view('lacak-pesanan');
})->middleware(['auth'])->name('lacak-pesanan');

Route::middleware('auth')->group(function () {
    Route::get('/scan-kemasan', [RecyclingController::class, 'index'])->name('scan-kemasan');
    Route::post('/scan-kemasan/upload', [RecyclingController::class, 'uploadFoto'])->name('upload-foto');
    Route::get('/scan-qr', [RecyclingController::class, 'scanQR'])->name('scan-qr');
    Route::post('/scan-qr/proses', [RecyclingController::class, 'prosesQR'])->name('proses-qr');
    Route::get('/daur-ulang-sukses', [RecyclingController::class, 'sukses'])->name('daur-ulang-sukses');
});
require __DIR__.'/auth.php';

Route::prefix('jual')->middleware('auth')->name('seller.')->group(function () {

    // Dashboard penjual
    Route::get('/dashboard', [SellerDashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/', [SellerRegistrationController::class, 'index'])
        ->name('register');

    // dynamic step
    Route::get('/step/{step}', [SellerRegistrationController::class, 'showStep'])
        ->name('register.step');

    // simpan per step
    Route::post('/step/1', [SellerRegistrationController::class, 'saveStep1'])
        ->name('register.step1.store');

    Route::post('/step/2', [SellerRegistrationController::class, 'saveStep2'])
        ->name('register.step2.store');

    // selesai onboarding
    Route::post('/finish', [SellerRegistrationController::class, 'finishOnboarding'])
        ->name('register.finish');
    
    Route::post('/skip-step3', [SellerRegistrationController::class, 'skipStep3'])
    ->name('register.skip3');
    require base_path('routes/seller_produk.php');

    // Pesanan penjual
    Route::get('/pesanan', [SellerOrderController::class, 'index'])
        ->name('pesanan.index');

    // Edit Profil Toko
    Route::get('/toko/edit', [SellerDashboardController::class, 'editToko'])
        ->name('toko.edit');
    Route::patch('/toko/update', [SellerDashboardController::class, 'updateToko'])
        ->name('toko.update');

    // Statistik
    Route::get('/statistik', [SellerDashboardController::class, 'statistik'])
        ->name('statistik');

    // Keuangan
    Route::get('/keuangan', [SellerDashboardController::class, 'keuangan'])
        ->name('keuangan');

    // Chat pembeli
    Route::get('/chat', [SellerChatController::class, 'index'])
        ->name('chat.index');
    Route::get('/chat/{buyer}', [SellerChatController::class, 'show'])
        ->name('chat.show');
});