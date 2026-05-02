<?php

namespace App\Models;

use App\Enums\ProductStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $table = 'ayune_products';

    protected $fillable = [
        'user_id',
        'category_id',
        'nama_produk',
        'merek',
        'kondisi',
        'persen_sisa',
        'catatan_kondisi',
        'deskripsi',
        'harga',
        'berat_gram',
        'stok',
        'foto',
        'status',
    ];

    protected $casts = [
        'foto'   => 'array',          // otomatis json <-> array
        'status' => ProductStatus::class,
        'harga'  => 'decimal:2',
    ];

    // ──────────────── Relasi ────────────────

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // ──────────────── Accessor ────────────────

    // Ambil foto pertama (buat thumbnail)
    public function getFotoUtamaAttribute(): ?string
    {
        $fotos = $this->foto;
        return $fotos[0] ?? null;
    }

    // Harga format rupiah
    public function getHargaRupiahAttribute(): string
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }

    // ──────────────── Scope ────────────────

    public function scopeAktif($query)
    {
        return $query->where('status', ProductStatus::Aktif);
    }

    public function scopeMilik($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}