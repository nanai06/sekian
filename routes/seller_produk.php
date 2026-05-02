<?php

use App\Http\Controllers\Seller\SellerProductController;
use Illuminate\Support\Facades\Route;

Route::get('produk/arsip', [SellerProductController::class, 'arsip'])
    ->name('produk.arsip');

Route::resource('produk', SellerProductController::class)->except(['show']);

Route::patch('produk/{produk}/toggle', [SellerProductController::class, 'toggle'])
    ->name('produk.toggle');