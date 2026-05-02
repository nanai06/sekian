<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\SellerProfile;
use App\Models\Store;
use App\Models\StoreAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SellerRegistrationController extends Controller
{
    // ─── Tampilkan step yang sesuai ──────────────────────────

    public function index()
    {
        $user    = Auth::user();
        $profile = $user->sellerProfile;

        if ($profile && $profile->isAktif()) {
            return redirect()->route('seller.dashboard');
        }

        $step = $profile ? $profile->currentStep() : 1;

        return redirect()->route('seller.register.step', ['step' => $step]);
    }

    // ─── Show step ───────────────────────────────────────────

    public function showStep(int $step)
    {
        $user    = Auth::user();
        $profile = $user->sellerProfile;

        $currentStep = $profile ? $profile->currentStep() : 1;
        if ($step > $currentStep) {
            return redirect()->route('seller.register.step', ['step' => $currentStep]);
        }

        $store = $profile?->store;

        return view("Seller.Register.step{$step}", compact('profile', 'store', 'step'));
    }

    // ─── STEP 1: Simpan verifikasi data diri ─────────────────

    public function saveStep1(Request $request)
    {
        $user    = Auth::user();
        $profile = $user->sellerProfile;

        // Foto KTP wajib hanya kalau belum pernah upload
        $fotoRule = $profile?->foto_ktp ? 'nullable|image|max:5120' : 'required|image|max:5120';

        // Verifikasi wajah wajib kalau belum pernah terverifikasi
        $wajahRule = $profile?->verifikasi_wajah ? 'nullable' : 'required';

        $request->validate([
            'tipe_penjual'     => 'required|in:perorangan,perusahaan',
            'nama_ktp'         => 'required|string|max:100',
            'nik'              => 'required|digits:16',
            'foto_ktp'         => $fotoRule,
            'foto_selfie'      => $wajahRule . '|string',
            'verifikasi_wajah' => $wajahRule,
            'setuju_syarat'    => 'accepted',
        ], [
            'nik.digits'             => 'NIK harus 16 digit.',
            'foto_ktp.required'      => 'Foto KTP wajib diupload.',
            'foto_selfie.required'   => 'Verifikasi wajah wajib dilakukan.',
            'setuju_syarat.accepted' => 'Kamu harus menyetujui syarat & ketentuan.',
        ]);

        // Pakai foto KTP baru kalau ada, kalau tidak pakai foto lama
        $fotoPath = $request->hasFile('foto_ktp')
            ? $request->file('foto_ktp')->store('seller/ktp', 'public')
            : $profile?->foto_ktp;

        // Simpan foto selfie dari base64 kalau ada
        $selfiePath      = $profile?->foto_selfie;
        $sudahVerifikasi = $profile?->verifikasi_wajah ?? false;

        if ($request->filled('foto_selfie') && $request->verifikasi_wajah == '1') {
            $base64  = $request->foto_selfie;
            $base64  = preg_replace('/^data:image\/\w+;base64,/', '', $base64);
            $decoded = base64_decode($base64);

            $filename = 'seller/selfie/' . uniqid() . '.jpg';
            Storage::disk('public')->put($filename, $decoded);

            $selfiePath      = $filename;
            $sudahVerifikasi = true;
        }

        SellerProfile::updateOrCreate(
            ['user_id' => $user->id],
            [
                'tipe_penjual'      => $request->tipe_penjual,
                'nama_ktp'          => $request->nama_ktp,
                'nik'               => $request->nik,
                'foto_ktp'          => $fotoPath,
                'foto_selfie'       => $selfiePath,
                'verifikasi_wajah'  => $sudahVerifikasi,
                'setuju_syarat'     => true,
                'status_verifikasi' => 'step1_done',
            ]
        );

        return redirect()->route('seller.register.step', ['step' => 2])
            ->with('success', 'Data diri berhasil disimpan!');
    }

    // ─── STEP 2: Simpan informasi toko ───────────────────────

    public function saveStep2(Request $request)
    {
        $user    = Auth::user();
        $profile = $user->sellerProfile;

        // Nama toko unique kecuali kalau nama toko tidak berubah
        $existingStore  = Store::where('user_id', $user->id)->first();
        $uniqueNamaToko = $existingStore && $existingStore->nama_toko === $request->nama_toko
            ? 'required|string|max:30'
            : 'required|string|max:30|unique:stores,nama_toko';

        $request->validate([
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

        // Slug: pakai slug lama kalau sudah ada, generate baru kalau belum
        $slug = $existingStore?->slug ?? Store::generateSlug($request->nama_toko);

        $store = Store::updateOrCreate(
            ['user_id' => $user->id],
            [
                'seller_profile_id' => $profile->id,
                'nama_toko'         => $request->nama_toko,
                'slug'              => $slug,
                'nomor_hp'          => $request->nomor_hp,
                'email_toko'        => $request->email_toko,
                'jasa_pengiriman'   => $request->jasa_pengiriman,
            ]
        );

        StoreAddress::updateOrCreate(
            ['store_id' => $store->id, 'is_primary' => true],
            [
                'label'          => 'Alamat Utama',
                'nama_penerima'  => $request->nama_penerima,
                'no_hp'          => $request->no_hp_alamat,
                'alamat_lengkap' => $request->alamat_lengkap,
                'kecamatan'      => $request->kecamatan,
                'kota'           => $request->kota,
                'provinsi'       => $request->provinsi,
                'kode_pos'       => $request->kode_pos,
            ]
        );

        $profile->update(['status_verifikasi' => 'step2_done']);

        return redirect()->route('seller.register.step', ['step' => 3])
            ->with('success', 'Informasi toko berhasil disimpan!');
    }

    // ─── STEP 3: Selesai onboarding ──────────────────────────

    public function finishOnboarding()
    {
        $profile = Auth::user()->sellerProfile;
        $profile->update([
            'status_verifikasi' => 'aktif',
            'verified_at'       => now(),
        ]);

        return redirect()->route('seller.dashboard')
            ->with('success', 'Selamat! Toko kamu sudah aktif di AYU-NE 🌸');
    }
    // ─── SKIP STEP 3: Langsung aktifkan toko tanpa produk ────────
    public function skipStep3()
    {
        $profile = Auth::user()->sellerProfile;
        $profile->update([
            'status_verifikasi' => 'aktif',
            'verified_at'       => now(),
        ]);

        return redirect()->route('seller.dashboard')
            ->with('success', 'Toko kamu sudah aktif! Yuk tambah produk kapanpun kamu siap 🌿');
    }
}