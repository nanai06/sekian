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

        // Kalau udah aktif, redirect ke dashboard
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

        // Guard: jangan skip step
        $currentStep = $profile ? $profile->currentStep() : 1;
        if ($step > $currentStep) {
            return redirect()->route('seller.register.step', ['step' => $currentStep]);
        }

        $store = $profile?->store;

        return view("seller.register.step{$step}", compact('profile', 'store', 'step'));
    }

    // ─── STEP 1: Simpan verifikasi data diri ─────────────────

    public function saveStep1(Request $request)
    {
        $request->validate([
            'tipe_penjual'  => 'required|in:perorangan,perusahaan',
            'nama_ktp'      => 'required|string|max:100',
            'nik'           => 'required|digits:16',
            'foto_ktp'      => 'required|image|max:5120',    // maks 5MB
            'setuju_syarat' => 'accepted',
        ], [
            'nik.digits'           => 'NIK harus 16 digit.',
            'foto_ktp.required'    => 'Foto KTP wajib diupload.',
            'setuju_syarat.accepted' => 'Kamu harus menyetujui syarat & ketentuan.',
        ]);

        $user = Auth::user();

        // Simpan foto KTP ke storage
        $fotoPath = $request->file('foto_ktp')->store('seller/ktp', 'public');

        $profile = SellerProfile::updateOrCreate(
            ['user_id' => $user->id],
            [
                'tipe_penjual'       => $request->tipe_penjual,
                'nama_ktp'           => $request->nama_ktp,
                'nik'                => $request->nik,
                'foto_ktp'           => $fotoPath,
                'verifikasi_wajah'   => false, // nanti dari proses verifikasi wajah
                'setuju_syarat'      => true,
                'status_verifikasi'  => 'step1_done',
            ]
        );

        return redirect()->route('seller.register.step', ['step' => 2])
            ->with('success', 'Data diri berhasil disimpan!');
    }

    // ─── STEP 2: Simpan informasi toko ───────────────────────

    public function saveStep2(Request $request)
    {
        $request->validate([
            'nama_toko'        => 'required|string|max:30|unique:stores,nama_toko',
            'nomor_hp'         => 'required|string|max:20',
            'email_toko'       => 'nullable|email|max:100',
            'jasa_pengiriman'  => 'required|array|min:1',
            'jasa_pengiriman.*'=> 'string',
            // Alamat
            'nama_penerima'    => 'required|string|max:100',
            'no_hp_alamat'     => 'required|string|max:20',
            'alamat_lengkap'   => 'required|string',
            'kecamatan'        => 'required|string|max:100',
            'kota'             => 'required|string|max:100',
            'provinsi'         => 'required|string|max:100',
            'kode_pos'         => 'required|string|max:10',
        ]);

        $user    = Auth::user();
        $profile = $user->sellerProfile;

        // Buat / update toko
        $store = Store::updateOrCreate(
            ['user_id' => $user->id],
            [
                'seller_profile_id' => $profile->id,
                'nama_toko'         => $request->nama_toko,
                'nomor_hp'          => $request->nomor_hp,
                'email_toko'        => $request->email_toko,
                'jasa_pengiriman'   => $request->jasa_pengiriman,
            ]
        );

        // Simpan alamat toko
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

        // Update status profile
        $profile->update(['status_verifikasi' => 'step2_done']);

        return redirect()->route('seller.register.step', ['step' => 3])
            ->with('success', 'Informasi toko berhasil disimpan!');
    }

    // ─── STEP 3: Upload produk pertama ───────────────────────
    // (produk handling ada di SellerProductController)
    // Step 3 blade hanya nge-redirect ke form tambah produk
    // setelah produk pertama disimpan, status jadi 'aktif'

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
}