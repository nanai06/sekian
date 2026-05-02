<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $table = 'ayune_categories';

    protected $fillable = [
        'nama',
        'slug',
        'ikon',
        'is_aktif',
    ];

    protected $casts = [
        'is_aktif' => 'boolean',
    ];

    // Scope: ambil kategori yang aktif aja
    public function scopeAktif($query)
    {
        return $query->where('is_aktif', true);
    }

    // Relasi ke produk
    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}