<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StoreAddress extends Model
{
    protected $fillable = [
        'store_id',
        'label',
        'nama_penerima',
        'no_hp',
        'alamat_lengkap',
        'kecamatan',
        'kota',
        'provinsi',
        'kode_pos',
        'is_primary',
    ];

    protected $casts = [
        'is_primary' => 'boolean',
    ];

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }
}