<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecyclingController;
use App\Http\Controllers\ShippingController;

// API Pengiriman (RajaOngkir V2 via Komerce)
Route::get('/api/shipping/search-destination', [ShippingController::class, 'searchDestination'])->name('api.shipping.search');
Route::post('/api/shipping/rates', [ShippingController::class, 'getRates'])->name('api.shipping.rates');



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

Route::get('/profil', function () {
    return view('profile.index');
})->middleware(['auth'])->name('profil');

Route::get('/ayu-belanja', function () {
    return view('ayu-belanja');
})->middleware(['auth'])->name('ayu-belanja');

Route::get('/ayu-daur-ulang', function () {
    return view('ayu-daur-ulang');
})->middleware(['auth'])->name('ayu-daur-ulang');

Route::get('/dropoff-lokasi', [App\Http\Controllers\DropOffLocationController::class, 'index'])
    ->middleware(['auth'])->name('dropoff-lokasi');

Route::get('/keranjang', function () {
    return view('keranjang');
})->middleware(['auth'])->name('keranjang');

Route::get('/notifikasi', function () {
    return view('notifikasi');
})->middleware(['auth'])->name('notifikasi');

Route::get('/detail-produk', function () {
    return view('detail-produk');
})->middleware(['auth'])->name('detail-produk');

Route::get('/checkout', function () {
    return view('checkout');
})->middleware(['auth'])->name('checkout');

Route::post('/checkout/process', [App\Http\Controllers\OrderController::class, 'process'])
    ->middleware(['auth'])->name('checkout.process');

Route::post('/order/update-status', [App\Http\Controllers\OrderController::class, 'updateStatus'])
    ->middleware(['auth'])->name('order.update-status');

Route::get('/chat-penjual', function () {
    return view('chat-penjual');
})->middleware(['auth'])->name('chat-penjual');

Route::get('/ayu-koin', function () {
    return view('ayu-koin');
})->middleware(['auth'])->name('ayu-koin');

Route::get('/pesanan-berhasil', function () {
    return view('pesanan-berhasil');
})->middleware(['auth'])->name('pesanan-berhasil');

Route::get('/pesanan-saya', function () {
    $orders = \App\Models\Order::where('buyer_id', auth()->id())
        ->with(['orderItems.product'])
        ->latest()
        ->get();
    return view('pesanan-saya', compact('orders'));
})->middleware(['auth'])->name('pesanan-saya');

Route::get('/detail-pesanan', function () {
    return view('detail-pesanan');
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
