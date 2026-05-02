<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'ayune_addresses';
    //model ini buat tabel ayune_addresses

    protected $fillable = [
        'user_id',
        'alamat_lengkap',
        'kota',
        'provinsi',
        'kode_pos',
        'is_primary',
    ];

    protected $casts = [
        'is_primary' => 'boolean',
    ];

    //RELASI
    public function user(){
        return $this->belongsTo(User::class);
        //alamat ini milik satu user
    }
}
