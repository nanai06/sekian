<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DropBox;
use App\Models\RecyclingSubmission;
use Illuminate\Support\Facades\Auth;


class RecyclingController extends Controller
{
    public function index(Request $request)
    {
        if ($request->lokasi) {
            // lokasi param = qr_code dari drop box yang dipilih
            session(['lokasi_pilih' => $request->lokasi]);
            session(['qr_code_pilihan' => $request->lokasi]);
        }

        return view('scan-kemasan');
    }

    public function uploadFoto(Request $request)
    {
        if ($request->lokasi) {
            session(['lokasi_pilih' => $request->lokasi]);
        }

        $request->validate([
            'foto_kemasan'   => 'required|array|min:1',
            'foto_kemasan.*' => 'image|mimes:jpg,jpeg,png|max:5048',
        ]);

        $paths = [];
        foreach ($request->file('foto_kemasan') as $foto) {
            $paths[] = $foto->store('kemasan', 'public');
        }

        session(['foto_kemasan' => json_encode($paths)]);

        return redirect()->route('scan-qr');
    }

    public function scanQR()
    {
        $dropBoxes = DropBox::where('aktif', true)->get();
        return view('scan-qr', compact('dropBoxes'));
    }

    public function prosesQR(Request $request)
    {
        $request->validate([
            'qr_code' => 'required|string',
        ]);

        $dropBox = DropBox::where('qr_code', $request->qr_code)
                          ->where('aktif', true)
                          ->first();

        if (!$dropBox) {
            return back()->withErrors(['qr_code' => 'QR tidak valid']);
        }

        $lokasiPilih = session('lokasi_pilih');
        if ($lokasiPilih && $dropBox->qr_code !== $lokasiPilih) {
        $lokasiYangDipilih = DropBox::where('qr_code', $lokasiPilih)->first();
        return back()->withErrors([
            'qr_code' => 'QR tidak sesuai Anda memilih drop box "' 
                        . ($lokasiYangDipilih->nama_lokasi ?? 'yang sudah dipilih') 
                        . '", tapi scan QR lokasi lain.'
        ]);
        }

        $fotoKemasan = session('foto_kemasan');
        $fotoArray = json_decode($fotoKemasan, true);

        // simpan submission utama
        $jumlahKemasan = count($fotoArray);
        $koinReward = $jumlahKemasan * 10; // 10 koin per kemasan

        $submission = RecyclingSubmission::create([
            'user_id'        => Auth::id(),
            'drop_box_id'    => $dropBox->id,
            'foto_kemasan'   => $fotoKemasan,
            'status'         => 'confirmed',
            'koin_diberikan' => $koinReward,
        ]);

        // ── UPDATE KOIN DI SEMUA TABEL ──
        $user = Auth::user();

        // 1. Update ayune_coins
        $coin = \App\Models\Coin::firstOrCreate(
            ['user_id' => $user->id],
            ['saldo' => 0]
        );
        $saldoSebelum = $coin->saldo;
        $saldoSesudah = $saldoSebelum + $koinReward;
        $coin->update(['saldo' => $saldoSesudah]);

        // 2. Update users.ayu_koin
        $user->update(['ayu_koin' => $saldoSesudah]);

        // 3. Update poin_eco (jumlah kemasan yang sudah didaur ulang)
        $user->increment('poin_eco', $jumlahKemasan);

        // 4. Catat di coin_histories
        \App\Models\CoinHistory::create([
            'user_id'       => $user->id,
            'jumlah'        => $koinReward,
            'tipe'          => 'masuk',
            'sumber'        => 'daur_ulang',
            'keterangan'    => 'Daur ulang ' . $jumlahKemasan . ' kemasan di ' . ($dropBox->nama_lokasi ?? 'drop box'),
            'saldo_sebelum' => $saldoSebelum,
            'saldo_sesudah' => $saldoSesudah,
        ]);

        session()->forget('foto_kemasan');

       return redirect()->route('daur-ulang-sukses')->with([
            'koin' => $koinReward,
            'jumlah_kemasan' => $jumlahKemasan,
            'lokasi' => $dropBox->nama_lokasi ?? null
        ]);
    }

    public function sukses()
    {
        return view('daur-ulang-sukses');
    }
}