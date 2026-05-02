<?php

namespace App\Http\Controllers\Seller;

use App\Enums\ProductStatus;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SellerProductController extends Controller
{
    // ──────────────── Index ────────────────

    public function index(): View
{
    $produk = Product::milik(Auth::id())
        ->whereNotIn('status', [ProductStatus::Nonaktif])
        ->with('category')
        ->latest()
        ->paginate(10);

    return view('seller.produk.index', compact('produk'));
}

    // ──────────────── Arsip ────────────────

    public function arsip(): View
    {
        $produk = Product::milik(Auth::id())
            ->where('status', ProductStatus::Nonaktif)
            ->with('category')
            ->latest()
            ->paginate(10);

        return view('seller.produk.arsip', compact('produk'));
    }
    

    // ──────────────── Tambah ────────────────

    public function create(): View
    {
        $categories = Category::aktif()->orderBy('nama')->get();

        return view('seller.produk.tambah', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama_produk'      => 'required|string|max:255',
            'category_id'      => 'required|exists:ayune_categories,id',
            'merek'            => 'nullable|string|max:100',
            'kondisi'          => 'required|in:baru,bekas',
            'persen_sisa'      => 'nullable|integer|min:1|max:99',
            'catatan_kondisi'  => 'nullable|string|max:255',
            'deskripsi'        => 'required|string',
            'harga'            => 'required|numeric|min:1000',
            'berat_gram'       => 'required|integer|min:1',
            'stok'             => 'required|integer|min:1',
            'foto'             => 'required|array|min:1|max:9',
            'foto.*'           => 'image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'category_id.required' => 'Pilih kategori produk.',
            'category_id.exists'   => 'Kategori tidak valid.',
            'kondisi.required'     => 'Pilih kondisi produk.',
            'foto.required'        => 'Upload minimal 1 foto produk.',
            'foto.max'             => 'Maksimal 9 foto produk.',
            'foto.*.image'         => 'File harus berupa gambar.',
            'foto.*.max'           => 'Ukuran tiap foto maksimal 2MB.',
            'harga.min'            => 'Harga minimal Rp 1.000.',
            'berat_gram.required'  => 'Berat produk wajib diisi.',
        ]);

        // Upload semua foto, simpan path-nya dalam array
        $pathFoto = [];
        foreach ($request->file('foto') as $file) {
            $pathFoto[] = $file->store('produk', 'public');
        }

        // Kalau kondisi baru, persen_sisa otomatis 100
        if ($validated['kondisi'] === 'baru') {
            $validated['persen_sisa'] = 100;
        }

        Product::create([
            'user_id'         => Auth::id(),
            'category_id'     => $validated['category_id'],
            'nama_produk'     => $validated['nama_produk'],
            'merek'           => $validated['merek'] ?? null,
            'kondisi'         => $validated['kondisi'],
            'persen_sisa'     => $validated['persen_sisa'] ?? null,
            'catatan_kondisi' => $validated['catatan_kondisi'] ?? null,
            'deskripsi'       => $validated['deskripsi'],
            'harga'           => $validated['harga'],
            'berat_gram'      => $validated['berat_gram'],
            'stok'            => $validated['stok'],
            'foto'            => $pathFoto,
            'status'          => ProductStatus::Aktif,
        ]);

        return redirect()->route('seller.produk.index')
            ->with('success', 'Produk berhasil dikirim! Menunggu review admin. 🌸');
    }

    // ──────────────── Edit ────────────────

    public function edit(Product $produk): View
    {
        // Pastikan produk milik seller yang login
        abort_if($produk->user_id !== Auth::id(), 403);

        $categories = Category::aktif()->orderBy('nama')->get();

        return view('seller.produk.edit', compact('produk', 'categories'));
    }

    public function update(Request $request, Product $produk): RedirectResponse
    {
        abort_if($produk->user_id !== Auth::id(), 403);

        $validated = $request->validate([
            'nama_produk'      => 'required|string|max:255',
            'category_id'      => 'required|exists:ayune_categories,id',
            'merek'            => 'nullable|string|max:100',
            'kondisi'          => 'required|in:baru,bekas',
            'persen_sisa'      => 'nullable|integer|min:1|max:99',
            'catatan_kondisi'  => 'nullable|string|max:255',
            'deskripsi'        => 'required|string',
            'harga'            => 'required|numeric|min:1000',
            'berat_gram'       => 'required|integer|min:1',
            'stok'             => 'required|integer|min:1',
            'foto_baru'        => 'nullable|array|max:9',
            'foto_baru.*'      => 'image|mimes:jpg,jpeg,png,webp|max:2048',
            'foto_hapus'       => 'nullable|array',
        ]);

        // Ambil foto yang masih tersisa (yang tidak dihapus)
        $fotoLama = $produk->foto ?? [];
        $fotoHapus = $request->input('foto_hapus', []);

        // Hapus file fisik dari storage
        foreach ($fotoHapus as $path) {
            Storage::disk('public')->delete($path);
        }

        // Saring foto lama yang tidak dihapus
        $fotoTersisa = array_values(array_diff($fotoLama, $fotoHapus));

        // Upload foto baru kalau ada
        $fotoTambahan = [];
        if ($request->hasFile('foto_baru')) {
            foreach ($request->file('foto_baru') as $file) {
                $fotoTambahan[] = $file->store('produk', 'public');
            }
        }

        $fotoFinal = array_merge($fotoTersisa, $fotoTambahan);

        if (empty($fotoFinal)) {
            return back()->withErrors(['foto_baru' => 'Produk harus punya minimal 1 foto.']);
        }

        if ($validated['kondisi'] === 'baru') {
            $validated['persen_sisa'] = 100;
        }

        // Kalau produk aktif terus diedit → balik ke under_review
        $statusBaru = $produk->status === ProductStatus::Aktif
            ? ProductStatus::UnderReview
            : $produk->status;

        $produk->update([
            'category_id'     => $validated['category_id'],
            'nama_produk'     => $validated['nama_produk'],
            'merek'           => $validated['merek'] ?? null,
            'kondisi'         => $validated['kondisi'],
            'persen_sisa'     => $validated['persen_sisa'] ?? null,
            'catatan_kondisi' => $validated['catatan_kondisi'] ?? null,
            'deskripsi'       => $validated['deskripsi'],
            'harga'           => $validated['harga'],
            'berat_gram'      => $validated['berat_gram'],
            'stok'            => $validated['stok'],
            'foto'            => $fotoFinal,
            'status'          => $statusBaru,
        ]);

        return redirect()->route('seller.produk.index')
            ->with('success', 'Produk berhasil diperbarui! 🌸');
    }

    // ──────────────── Hapus ────────────────

    public function destroy(Product $produk): RedirectResponse
    {
        abort_if($produk->user_id !== Auth::id(), 403);

        // Hapus semua foto dari storage
        foreach ($produk->foto ?? [] as $path) {
            Storage::disk('public')->delete($path);
        }

        $produk->delete();

        return redirect()->route('seller.produk.index')
            ->with('success', 'Produk berhasil dihapus.');
    }
    public function toggle(Product $produk): RedirectResponse
    {
        abort_if($produk->user_id !== Auth::id(), 403);

        $isArsip = $produk->status === ProductStatus::Nonaktif;

        $produk->update([
            'status' => $isArsip
                ? ProductStatus::Aktif
                : ProductStatus::Nonaktif,
        ]);

        if ($isArsip) {
            return redirect()->route('seller.produk.arsip')
                ->with('success', 'Produk berhasil diaktifkan kembali!');
        }

        return redirect()->route('seller.produk.index')
            ->with('success', 'Produk dipindahkan ke arsip.');
    }
}