{{-- resources/views/seller/register/done.blade.php --}}
@extends('layouts.app')

@section('title', 'Selamat Datang - AYU-NE')

@section('content')
<div class="seller-onboarding">
    <div class="onb-header">
        <span></span>
        <span class="onb-title">AYU-NE Seller</span>
        <span></span>
    </div>

    @include('seller.register._stepper', ['step' => 4])

    <div class="onb-done-wrap">
        <div class="onb-done-icon">&#10003;</div>
        <h2 class="onb-done-title">Toko kamu sudah aktif!</h2>
        <p class="onb-done-sub">
            Selamat bergabung di AYU-NE, <strong>{{ $store->nama_toko }}</strong>!<br>
            Produk pertamamu sedang ditinjau tim kami. Kamu tetap bisa mulai mengelola tokomu sekarang.
        </p>
        <a href="{{ route('seller.dashboard') }}" class="onb-btn-primary onb-btn-full">
            Ke Dashboard Penjual &rarr;
        </a>
    </div>
</div>
@endsection