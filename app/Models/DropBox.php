<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DropBox extends Model
{
    protected $fillable = [
        'nama_lokasi',
        'alamat',
        'qr_code',
        'aktif',
    ];

    public function submissions()
    {
        return $this->hasMany(RecyclingSubmission::class);
    }
}