<?php

namespace App\Models;

use App\Enums\StoreStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

class Store extends Model
{
    protected $fillable = [
        'user_id',
        'seller_profile_id',
        'nama_toko',
        'slug',
        'email_toko',
        'nomor_hp',
        'foto_toko',
        'status',
    ];

    protected $casts = [
        'status' => StoreStatus::class,
    ];

    // ── Relasi ──────────────────────────────────────────────

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function sellerProfile(): BelongsTo
    {
        return $this->belongsTo(SellerProfile::class);
    }

    public function addresses(): HasMany
    {
        return $this->hasMany(StoreAddress::class);
    }
    public function primaryAddress()
    {
        return $this->addresses()->first();
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    // ── Helper ──────────────────────────────────────────────

    public static function generateSlug(string $namaToko): string
    {
        $slug  = Str::slug($namaToko);
        $count = static::where('slug', 'like', "{$slug}%")->count();
        return $count > 0 ? "{$slug}-{$count}" : $slug;
    }

    public function isAktif(): bool
    {
        return $this->status === StoreStatus::Active;
    }
}